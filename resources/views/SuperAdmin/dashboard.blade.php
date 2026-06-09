@extends('SuperAdmin.layouts.superadmin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
  <!-- Welcome Card -->
  <div class="col-md-12 col-lg-8">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-md-6">
          <h4 class="mb-2">Selamat Datang Super Admin! 🎉</h4>
          <p class="mb-1">Total mitra aktif <strong>24</strong> mitra</p>
          <p class="mb-2">Total pendapatan bulan ini: <strong>Rp 487.500.000</strong></p>
          <a href="{{ url('/SuperAdmin/kelola-mitra') }}" class="btn btn-primary mt-2">
            <i class="mdi mdi-store"></i> Kelola Mitra
          </a>
        </div>
        <div class="col-md-6 text-center">
          <i class="mdi mdi-shield-crown" style="font-size: 80px; color: #7367f0;"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- Stat Cards -->
  <div class="col-lg-2">
    <div class="card">
      <div class="stat-card">
        <div class="stat-info">
          <p class="text-muted mb-1">Total Mitra</p>
          <h5 class="mb-0">24</h5>
          <small class="text-success">+12%</small>
        </div>
        <div class="stat-icon">
          <i class="mdi mdi-store"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-2">
    <div class="card">
      <div class="stat-card">
        <div class="stat-info">
          <p class="text-muted mb-1">Total User</p>
          <h5 class="mb-0">156</h5>
          <small class="text-success">+8%</small>
        </div>
        <div class="stat-icon">
          <i class="mdi mdi-account-group"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Chart Pendapatan -->
  <div class="col-12 col-xl-8">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Statistik Pendapatan</h5>
      </div>
      <div id="revenueChart"></div>
    </div>
  </div>

  <!-- Chart Kinerja -->
  <div class="col-12 col-xl-4">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title">Kinerja Mitra</h5>
      </div>
      <div id="performanceChart"></div>
    </div>
  </div>
</div>

<!-- Transaksi Terbaru -->
<div class="row">
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
  // Revenue Chart
  var revenueOptions = {
    series: [{
      name: 'Pendapatan (Rp)',
      data: [32000000, 45000000, 38000000, 52000000, 48700000, 65000000, 71200000]
    }],
    chart: { type: 'area', height: 320, toolbar: { show: false } },
    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul'] },
    colors: ['#7367f0'],
    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.3 } }
  };
  var revenueChart = new ApexCharts(document.querySelector("#revenueChart"), revenueOptions);
  revenueChart.render();

  // Performance Chart
  var perfOptions = {
    series: [78, 65, 42],
    chart: { type: 'donut', height: 280 },
    labels: ['CV Berkah Jaya', 'PT Makmur Sentosa', 'UD Sumber Rezeki'],
    colors: ['#7367f0', '#28c76f', '#ff9f43'],
    legend: { position: 'bottom' }
  };
  var perfChart = new ApexCharts(document.querySelector("#performanceChart"), perfOptions);
  perfChart.render();
</script>
@endpush