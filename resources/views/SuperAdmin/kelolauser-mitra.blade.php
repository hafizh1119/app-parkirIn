@extends('SuperAdmin.layouts.superadmin')

@section('title', 'Kelola User Mitra')

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar User Mitra</h5>
        <button class="btn btn-primary btn-sm" id="btnTambahUser">
          <i class="mdi mdi-plus"></i> Tambah User
        </button>
      </div>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama User</th>
              <th>Email</th>
              <th>Role</th>
              <th>Mitra</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody id="userTableBody">
            <tr>
              <td>1</td>
              <td>Andi Prasetyo</td>
              <td>andi@berkahjaya.com</td>
              <td>Admin Mitra</td>
              <td>CV Berkah Jaya</td>
              <td><span class="badge badge-success">Aktif</span></td>
              <td>
                <button class="btn btn-sm btn-info edit-user"><i class="mdi mdi-pencil"></i></button>
                <button class="btn btn-sm btn-danger delete-user"><i class="mdi mdi-delete"></i></button>
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>Siti Nurhaliza</td>
              <td>siti@makmur.com</td>
              <td>Keuangan</td>
              <td>PT Makmur Sentosa</td>
              <td><span class="badge badge-success">Aktif</span></td>
              <td>
                <button class="btn btn-sm btn-info edit-user"><i class="mdi mdi-pencil"></i></button>
                <button class="btn btn-sm btn-danger delete-user"><i class="mdi mdi-delete"></i></button>
              </td>
            </tr>
            <tr>
              <td>3</td>
              <td>Budi Santoso</td>
              <td>budi@berkahjaya.com</td>
              <td>Operator</td>
              <td>CV Berkah Jaya</td>
              <td><span class="badge badge-warning">Nonaktif</span></td>
              <td>
                <button class="btn btn-sm btn-info edit-user"><i class="mdi mdi-pencil"></i></button>
                <button class="btn btn-sm btn-danger delete-user"><i class="mdi mdi-delete"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah/Edit User -->
<div id="userModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:2000; justify-content:center; align-items:center;">
  <div style="background:white; width:450px; border-radius:16px; padding:1.5rem;">
    <h4 id="modalUserTitle" class="mb-3">Tambah User</h4>
    <div class="mb-3">
      <label class="form-label">Pilih Mitra</label>
      <select id="mitraUser" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
        <option value="CV Berkah Jaya">CV Berkah Jaya</option>
        <option value="PT Makmur Sentosa">PT Makmur Sentosa</option>
        <option value="UD Sumber Rezeki">UD Sumber Rezeki</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama User</label>
      <input type="text" id="namaUser" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" id="emailUser" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
    </div>
    <div class="mb-3">
      <label class="form-label">Role</label>
      <select id="roleUser" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
        <option value="Admin Mitra">Admin Mitra</option>
        <option value="Keuangan">Keuangan</option>
        <option value="Operator">Operator</option>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select id="statusUser" class="form-control" style="width:100%; padding:8px; border:1px solid #ddd; border-radius:8px;">
        <option value="aktif">Aktif</option>
        <option value="nonaktif">Nonaktif</option>
      </select>
    </div>
    <div class="d-flex justify-content-end gap-2">
      <button class="btn btn-secondary" id="closeUserModal">Batal</button>
      <button class="btn btn-primary" id="saveUser">Simpan</button>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  const userModal = document.getElementById('userModal');
  const btnTambahUser = document.getElementById('btnTambahUser');
  const closeUserModal = document.getElementById('closeUserModal');
  
  btnTambahUser.onclick = () => {
    document.getElementById('modalUserTitle').innerText = 'Tambah User';
    document.getElementById('namaUser').value = '';
    document.getElementById('emailUser').value = '';
    userModal.style.display = 'flex';
  };
  
  closeUserModal.onclick = () => { userModal.style.display = 'none'; };
  
  window.onclick = (e) => { if (e.target === userModal) userModal.style.display = 'none'; };
  
  document.querySelectorAll('.edit-user').forEach(btn => {
    btn.onclick = () => {
      const row = btn.closest('tr');
      document.getElementById('modalUserTitle').innerText = 'Edit User';
      document.getElementById('namaUser').value = row.cells[1].innerText;
      document.getElementById('emailUser').value = row.cells[2].innerText;
      userModal.style.display = 'flex';
    };
  });
  
  document.querySelectorAll('.delete-user').forEach(btn => {
    btn.onclick = () => {
      if(confirm('Yakin hapus user ini?')) btn.closest('tr').remove();
    };
  });
</script>
@endpush