@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('styles')
<style>
    .kategori-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="sidebar-brand">
                <i class="fas fa-school"></i> Pengaduan Sekolah
            </div>
            <nav class="nav flex-column">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link active" href="{{ route('admin.kategori.index') }}">
                    <i class="fas fa-folder"></i> Kelola Kategori
                </a>
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> Data Siswa
                </a>
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>

        <!-- Content -->
        <div class="col-md-10 content-wrapper">
            <div class="content">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-folder"></i> Kelola Kategori Aspirasi
                    </h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKategoriModal">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Kategori Table -->
                <div class="kategori-card animate__animated animate__fadeIn">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    <th>Jumlah Aspirasi</th>
                                    <th>Dibuat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategoris as $index => $k)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <span class="badge bg-info">{{ $k->nama_kategori }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary">{{ $k->aspirasis_count }} Aspirasi</span>
                                    </td>
                                    <td>{{ $k->created_at->format('d M Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" 
                                                onclick="editKategori({{ $k->id }}, '{{ $k->nama_kategori }}')">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" 
                                                onclick="deleteKategori({{ $k->id }}, '{{ $k->nama_kategori }}', {{ $k->aspirasis_count }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                                        <p class="text-muted">Belum ada kategori</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Kategori Modal -->
<div class="modal fade" id="addKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Fasilitas Sekolah" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Kategori Modal -->
<div class="modal fade" id="editKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editKategoriForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="editNamaKategori" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function editKategori(id, nama) {
        document.getElementById('editKategoriForm').action = '/admin/kategori/' + id;
        document.getElementById('editNamaKategori').value = nama;
        
        const modal = new bootstrap.Modal(document.getElementById('editKategoriModal'));
        modal.show();
    }

    function deleteKategori(id, nama, count) {
        if (count > 0) {
            alert('Kategori tidak dapat dihapus karena masih digunakan dalam ' + count + ' aspirasi');
            return;
        }
        
        if (confirm('Yakin ingin menghapus kategori "' + nama + '"?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/kategori/' + id;
            
            const csrf = document.createElement('input');
            csrf.type = 'hidden';
            csrf.name = '_token';
            csrf.value = '{{ csrf_token() }}';
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            form.appendChild(csrf);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Cleanup modal backdrop
    document.querySelectorAll('.modal').forEach(modal => {
        modal.addEventListener('hidden.bs.modal', function() {
            setTimeout(function() {
                document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = 'auto';
            }, 300);
        });
    });
</script>
@endsection
