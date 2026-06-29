<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\LokasiParkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('lokasiParkirs');

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $events = $query->orderBy('start_date', 'desc')->paginate(10);
        
        // Auto update status
        foreach ($events as $event) {
            $event->updateStatus();
        }

        // Statistik
        $stats = [
            'total' => Event::count(),
            'active' => Event::where('status', 'active')->count(),
            'upcoming' => Event::where('status', 'upcoming')->count(),
            'completed' => Event::where('status', 'completed')->count(),
        ];

        return view('Admin.events.index', compact('events', 'stats'));
    }

    public function create()
    {
        // Ambil semua lokasi parkir untuk ditampilkan
        $lokasiParkirs = LokasiParkir::orderBy('nama')->get();
        return view('Admin.events.create', compact('lokasiParkirs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            'max_capacity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('events', $filename, 'public');
            $data['image'] = $filename;
        }

        $data['status'] = 'upcoming';
        $data['is_active'] = true;

        // Create event
        $event = Event::create($data);

        // Attach semua lokasi parkir yang ada ke event
        $allLokasiIds = LokasiParkir::pluck('id')->toArray();
        $event->lokasiParkirs()->attach($allLokasiIds);

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event berhasil ditambahkan! Terhubung dengan ' . count($allLokasiIds) . ' lokasi parkir.');
    }

    public function show(Event $event)
    {
        $event->load('lokasiParkirs');
        $event->updateStatus();
        return view('Admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        $event->load('lokasiParkirs');
        $lokasiParkirs = LokasiParkir::orderBy('nama')->get();
        return view('Admin.events.edit', compact('event', 'lokasiParkirs'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'discount_percentage' => 'required|integer|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'max_capacity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable|in:upcoming,active,completed,waiting',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete('events/' . $event->image);
            }
            
            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('events', $filename, 'public');
            $data['image'] = $filename;
        }

        $event->update($data);

        // Update relasi lokasi parkir
        if ($request->has('lokasi_parkir_ids')) {
            $event->lokasiParkirs()->sync($request->lokasi_parkir_ids);
        }

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->image) {
            Storage::disk('public')->delete('events/' . $event->image);
        }
        
        // Detach semua relasi
        $event->lokasiParkirs()->detach();
        $event->delete();

        return redirect()->route('admin.events.index')
                        ->with('success', 'Event berhasil dihapus!');
    }

    public function toggleStatus(Event $event)
    {
        $event->is_active = !$event->is_active;
        $event->save();

        return redirect()->route('admin.events.index')
                        ->with('success', 'Status event berhasil diubah!');
    }
}