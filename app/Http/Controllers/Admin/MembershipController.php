<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\MembershipTier;
use App\Models\PointSetting;
use App\Models\PointTransaction;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $totalMembers = Membership::count();
        $totalPoints = PointTransaction::sum('points');

        $activeMembers = Membership::where('is_active', true)->count();

        $newMembersThisMonth = Membership::where('is_active', true)
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $members = Membership::with('user')
            ->where('is_active', true)
            ->withSum('pointTransactions as computed_points', 'points')
            ->withMax('pointTransactions as latest_transaction_at', 'created_at')
            ->orderByDesc('computed_points')
            ->paginate(10);

        $pointSettings = PointSetting::getSettings();
        $tiers = MembershipTier::where('is_active', true)->get();

        $stats = [
            'total_members' => $totalMembers,
            'total_points' => $totalPoints,
            'active_members' => $activeMembers,
            'inactive_members' => $totalMembers - $activeMembers,
            'new_members_this_month' => $newMembersThisMonth,
            'avg_points' => $activeMembers > 0 ? round($totalPoints / $activeMembers) : 0,
        ];

        return view('Admin.membership.index', compact('members', 'stats', 'pointSettings', 'tiers'));
    }

    public function updateTier(Request $request, $id)
    {
        $validTiers = MembershipTier::where('is_active', true)->pluck('slug')->toArray();

        $request->validate([
            'tier' => 'required|in:' . implode(',', $validTiers)
        ]);

        $membership = Membership::findOrFail($id);
        $membership->tier = $request->tier;
        $membership->save();

        return redirect()->back()->with('success', 'Tingkatan member berhasil diperbarui!');
    }

    public function toggleStatus($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->is_active = !$membership->is_active;
        $membership->save();

        $status = $membership->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Member berhasil {$status}!");
    }

    public function updatePointSettings(Request $request)
    {
        $request->validate([
            'points_per_rupiah' => 'required|integer|min:1',
            'min_transaction' => 'required|integer|min:1000',
            'redeem_points' => 'required|integer|min:100',
        ]);

        $settings = PointSetting::getSettings();
        $settings->update([
            'points_per_rupiah' => $request->points_per_rupiah,
            'min_transaction' => $request->min_transaction,
            'redeem_points' => $request->redeem_points,
        ]);

        return redirect()->back()->with('success', 'Pengaturan poin berhasil diperbarui!');
    }

    public function addTier(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'min_points' => 'required|integer|min:0',
            'max_points' => 'nullable|integer|min:0|gt:min_points',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'point_multiplier' => 'required|numeric|min:1',
            'benefits' => 'nullable|string',
        ]);

        $benefits = $request->benefits ? array_map('trim', explode(',', $request->benefits)) : [];

        MembershipTier::create([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
            'min_points' => $request->min_points,
            'max_points' => $request->max_points,
            'discount_percentage' => $request->discount_percentage,
            'point_multiplier' => $request->point_multiplier,
            'benefits' => json_encode($benefits),
            'is_active' => true,
        ]);

        return redirect()->back()->with('success', 'Tingkatan baru berhasil ditambahkan!');
    }

    public function deleteTier($id)
    {
        $tier = MembershipTier::findOrFail($id);

        $memberCount = Membership::where('tier', $tier->slug)->count();
        if ($memberCount > 0) {
            return redirect()->back()->with('error', "Tidak bisa menghapus. Ada {$memberCount} member dengan tier ini.");
        }

        $tier->delete();
        return redirect()->back()->with('success', 'Tingkatan berhasil dihapus!');
    }

    public function detail($id)
    {
        $member = Membership::with('user')->findOrFail($id);

        $pointTransactions = PointTransaction::where('user_id', $member->user_id)
            ->latest()
            ->get();

        $totalPoint  = $pointTransactions->sum('points');
        $pointMasuk  = $pointTransactions->where('points', '>', 0)->sum('points');
        $pointKeluar = abs($pointTransactions->where('points', '<', 0)->sum('points'));

        return view('Admin.membership.detail', compact(
            'member', 'pointTransactions', 'totalPoint', 'pointMasuk', 'pointKeluar'
        ));
    }

    public function addPoints(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $membership = Membership::findOrFail($id);

        PointTransaction::create([
            'user_id' => $membership->user_id,
            'points' => $request->points,
            'type' => 'earn',
            'description' => $request->description ?? 'Bonus poin dari admin',
        ]);

        return redirect()->back()->with('success', "{$request->points} poin berhasil ditambahkan!");
    }

    public function redeemPoints(Request $request, $id)
    {
        $request->validate([
            'points' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $membership = Membership::findOrFail($id);

        $totalPoint = PointTransaction::where('user_id', $membership->user_id)->sum('points');

        if ($totalPoint < $request->points) {
            return redirect()->back()->with('error', 'Poin tidak mencukupi');
        }

        PointTransaction::create([
            'user_id' => $membership->user_id,
            'points' => -$request->points,
            'type' => 'redeem',
            'description' => $request->description ?? 'Penukaran poin',
        ]);

        return redirect()->back()->with('success', "{$request->points} poin berhasil ditukarkan!");
    }

    public function export()
    {
        $members = Membership::with('user')
            ->withSum('pointTransactions as computed_points', 'points')
            ->get();

        $filename = 'membership_report_' . date('Y-m-d') . '.csv';
        $handle = fopen('php://output', 'w');

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['Nama', 'Email', 'Tier', 'Total Poin', 'Status', 'Bergabung']);

        foreach ($members as $member) {
            fputcsv($handle, [
                $member->user->name ?? '-',
                $member->user->email ?? '-',
                ucfirst($member->tier),
                $member->computed_points ?? 0,
                $member->is_active ? 'Aktif' : 'Tidak Aktif',
                $member->join_date ? $member->join_date->format('d/m/Y') : '-'
            ]);
        }

        fclose($handle);
        exit;
    }
}