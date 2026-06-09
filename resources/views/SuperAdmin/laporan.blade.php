@extends('SuperAdmin.layouts.superadmin')

@section('title', 'Laporan')

@section('content')
<div class="row">
  <!-- Filter -->
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Filter Laporan</h5>
      </div>
      <div class="row" style="margin: 0; padding: 0 1.5rem 1.5rem 1.5rem;">
        <div class="col-md-4">
          <label class="form-label">Dari Tanggal</label>
          <input type="date" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
        </div>
        <div class="col-md-4">
          <label class="form-label">Sampai Tanggal</label>
          <input type="date" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
        </div>
        <div class="col-md-3">
          <label class="form-label">Pilih Mitra</label>
          <select class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
            <option>Semua Mitra</option>
            <option>CV Berkah Jaya</option>
            <option>PT Makmur Sentosa</option>
            <option>UD Sumber Rezeki</option>
          </select>
        </div>
        <div class="col-md-1 d-flex align-items-end">
          <button class="btn btn-primary" style="width:100%">Filter</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Summary -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Ringkasan Pendapatan</h5>
      </div>
      <div class="d-flex justify-content-between mb-2" style="padding: 0 1.5rem;">
        <span>Total Pendapatan:</span>
        <strong>Rp 487.500.000</strong>
      </div>
      <div class="d-flex justify-content-between mb-2" style="padding: 0 1.5rem;">
        <span>Total Komisi Mitra:</span>
        <strong>Rp 92.300.000</strong>
      </div>
      <div class="d-flex justify-content-between mb-3" style="padding: 0 1.5rem 1.5rem 1.5rem;">
        <span>Net Profit:</span>
        <strong class="text-success">Rp 395.200.000</strong>
      </div>
    </div>
  </div>

  <!-- Export -->
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Ekspor Laporan</h5>
      </div>
      <div class="d-flex gap-3" style="padding: 0 1.5rem 1.5rem 1.5rem;">
        <button class="btn btn-danger">
          <i class="mdi mdi-file-pdf"></i> Export PDF
        </button>
        <button class="btn btn-success">
          <i class="mdi mdi-file-excel"></i> Export Excel
        </button>
        <button class="btn btn-primary" id="exportCSVBtn">
          <i class="mdi mdi-download"></i> Export CSV
        </button>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Tabel Laporan -->
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Detail Laporan Transaksi</h5>
      </div>
      <div class="table-responsive">
        <table class="table" id="laporanTable">
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Mitra</th>
              <th>Deskripsi</th>
              <th>Nominal</th>
              <th>Komisi (10%)</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2025-06-10</td>
              <td>CV Berkah Jaya</td>
              <td>Pembayaran bulan Juni</td>
              <td>Rp 25.000.000</td>
              <td>Rp 2.500.000</td>
              <td><span class="badge badge-success">Selesai</span></td>
            </tr>
            <tr>
              <td>2025-06-08</td>
              <td>PT Makmur Sentosa</td>
              <td>Komisi referral</td>
              <td>Rp 7.500.000</td>
              <td>Rp 750.000</td>
              <td><span class="badge badge-success">Selesai</span></td>
            </tr>
            <tr>
              <td>2025-06-05</td>
              <td>UD Sumber Rezeki</td>
              <td>Pendaftaran mitra</td>
              <td>Rp 1.200.000</td>
              <td>Rp 120.000</td>
              <td><span class="badge badge-warning">Pending</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.getElementById('exportCSVBtn')?.addEventListener('click', function() {
    let csv = "Tanggal,Mitra,Deskripsi,Nominal,Komisi,Status\n";
    csv += "2025-06-10,CV Berkah Jaya,Pembayaran bulan Juni,25000000,2500000,Selesai\n";
    csv += "2025-06-08,PT Makmur Sentosa,Komisi referral,7500000,750000,Selesai\n";
    csv += "2025-06-05,UD Sumber Rezeki,Pendaftaran mitra,1200000,120000,Pending";
    
    const blob = new Blob([csv], {type: 'text/csv'});
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'laporan_superadmin.csv';
    link.click();
    URL.revokeObjectURL(link.href);
  });
</script>
@endpush