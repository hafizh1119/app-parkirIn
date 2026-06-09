@extends('SuperAdmin.layouts.superadmin')

@section('title', 'Kelola Mitra')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Mitra</h5>
        <button class="btn btn-primary btn-sm" id="btnTambahMitra">
          <i class="mdi mdi-plus"></i> Tambah Mitra
        </button>
      </div>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Mitra</th>
              <th>Email</th>
              <th>No Telepon</th>
              <th>Status</th>
              <th>Bergabung</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="mitraTableBody">
            <tr>
              <td>1</td>
              <td>CV Berkah Jaya</td>
              <td>berkah@jaya.com</td>
              <td>08123456789</td>
              <td><span class="badge badge-success">Aktif</span></td>
              <td>2024-01-15</td>
              <td>
                <button class="btn btn-sm btn-info edit-mitra"><i class="mdi mdi-pencil"></i></button>
                <button class="btn btn-sm btn-danger delete-mitra"><i class="mdi mdi-delete"></i></button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>PT Makmur Sentosa</td>
              <td>makmur@sentosa.com</td>
              <td>082211223344</td>
              <td><span class="badge badge-success">Aktif</span></td>
              <td>2024-03-20</td>
              <td>
                <button class="btn btn-sm btn-info edit-mitra"><i class="mdi mdi-pencil"></i></button>
                <button class="btn btn-sm btn-danger delete-mitra"><i class="mdi mdi-delete"></i></button>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>UD Sumber Rezeki</td>
              <td>sumber@rezeki.com</td>
              <td>085555666777</td>
              <td><span class="badge badge-warning">Pending</span></td>
              <td>2025-01-10</td>
              <td>
                <button class="btn btn-sm btn-info edit-mitra"><i class="mdi mdi-pencil"></i></button>
                <button class="btn btn-sm btn-danger delete-mitra"><i class="mdi mdi-delete"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah/Edit Mitra -->
<div id="mitraModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:2000; justify-content:center; align-items:center;">
  <div style="background:white; width:450px; border-radius:16px; padding:1.5rem;">
    <h4 id="modalTitle" class="mb-3">Tambah Mitra</h4>
    <div class="mb-3">
      <label class="form-label">Nama Mitra</label>
      <input type="text" id="namaMitra" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" id="emailMitra" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
    </div>
    <div class="mb-3">
      <label class="form-label">No Telepon</label>
      <input type="text" id="telpMitra" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select id="statusMitra" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
        <option value="aktif">Aktif</option>
        <option value="pending">Pending</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
    </div>
    <div class="d-flex justify-content-end gap-2">
      <button class="btn btn-secondary" id="closeModal">Batal</button>
      <button class="btn btn-primary" id="saveMitra">Simpan</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // Modal handling
  const modal = document.getElementById('mitraModal');
  const btnTambah = document.getElementById('btnTambahMitra');
  const closeModal = document.getElementById('closeModal');
  
  btnTambah.onclick = () => {
    document.getElementById('modalTitle').innerText = 'Tambah Mitra';
    document.getElementById('namaMitra').value = '';
    document.getElementById('emailMitra').value = '';
    document.getElementById('telpMitra').value = '';
    modal.style.display = 'flex';
  };
  
  closeModal.onclick = () => { modal.style.display = 'none'; };
  
  window.onclick = (e) => { if (e.target === modal) modal.style.display = 'none'; };
  
  // Edit & Delete handlers
  document.querySelectorAll('.edit-mitra').forEach(btn => {
    btn.onclick = () => {
      const row = btn.closest('tr');
      document.getElementById('modalTitle').innerText = 'Edit Mitra';
      document.getElementById('namaMitra').value = row.cells[1].innerText;
      document.getElementById('emailMitra').value = row.cells[2].innerText;
      document.getElementById('telpMitra').value = row.cells[3].innerText;
      modal.style.display = 'flex';
    };
  });
  
  document.querySelectorAll('.delete-mitra').forEach(btn => {
    btn.onclick = () => {
      if(confirm('Yakin hapus mitra ini?')) btn.closest('tr').remove();
    };
  });
</script>
@endpush