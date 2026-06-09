@extends('SuperAdmin.layouts.superadmin')

@section('title', 'Keuangan')

@section('content')
<div class="row">
  <!-- Stat Cards -->
  <div class="col-md-4">
    <div class="card">
      <div class="stat-card">
        <div class="stat-info">
          <p class="text-muted mb-1">Total Pendapatan</p>
          <h5 class="mb-0">Rp 487.500.000</h5>
        </div>
        <div class="stat-icon">
          <i class="mdi mdi-currency-usd"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="stat-card">
        <div class="stat-info">
          <p class="text-muted mb-1">Komisi Mitra</p>
          <h5 class="mb-0">Rp 92.300.000</h5>
        </div>
        <div class="stat-icon">
          <i class="mdi mdi-percent"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card">
      <div class="stat-card">
        <div class="stat-info">
          <p class="text-muted mb-1">Saldo Super Admin</p>
          <h5 class="mb-0">Rp 395.200.000</h5>
        </div>
        <div class="stat-icon">
          <i class="mdi mdi-bank"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Chart -->
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Grafik Pendapatan per Mitra</h5>
      </div>
      <div id="revenuePerMitraChart"></div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Transaksi -->
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Transaksi Terbaru</h5>
      </div>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>Tanggal</th>
              <th>Mitra</th>
              <th>Deskripsi</th>
              <th>Nominal</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>2025-06-10</td>
              <td>CV Berkah Jaya</td>
              <td>Pembayaran bulan Juni</td>
              <td>Rp 25.000.000</td>
              <td><span class="badge badge-success">Selesai</span></td>
            </tr>
            <tr>
              <td>2025-06-08</td>
              <td>PT Makmur Sentosa</td>
              <td>Komisi referral</td>
              <td>Rp 7.500.000</td>
              <td><span class="badge badge-success">Selesai</span></td>
            </tr>
            <tr>
              <td>2025-06-05</td>
              <td>UD Sumber Rezeki</td>
              <td>Pendaftaran mitra</td>
              <td>Rp 1.200.000</td>
              <td><span class="badge badge-warning">Pending</span></td>
            </tr>
            <tr>
              <td>2025-06-01</td>
              <td>CV Berkah Jaya</td>
              <td>Pembayaran bulan Mei</td>
              <td>Rp 25.000.000</td>
              <td><span class="badge badge-success">Selesai</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  var options = {
    series: [{
      name: 'Pendapatan',
      data: [215000000, 182500000, 90000000]
    }],
    chart: { type: 'bar', height: 350, toolbar: { show: false } },
    xaxis: { categories: ['CV Berkah Jaya', 'PT Makmur Sentosa', 'UD Sumber Rezeki'] },
    colors: ['#7367f0'],
    plotOptions: { bar: { borderRadius: 8, horizontal: false } }
  };
  var chart = new ApexCharts(document.querySelector("#revenuePerMitraChart"), options);
  chart.render();
</script>
@endpush