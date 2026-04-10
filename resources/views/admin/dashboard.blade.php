@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .status-badge {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .status-badge:hover {
        transform: scale(1.1);
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
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i> Data Siswa
                </a>
                <a class="nav-link" href="#">
                    <i class="fas fa-folder"></i> Kategori
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
                        <i class="fas fa-tachometer-alt"></i> Dashboard Admin/Guru
                    </h2>
                    <div class="text-end">
                        <p class="mb-0 text-muted">{{ auth()->user()->nama }}</p>
                        <small class="badge bg-primary">{{ auth()->user()->role }}</small>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h3>{{ $aspirasis->total() }}</h3>
                            <p>Total Pengaduan</p>
                            <i class="fas fa-clipboard-list fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card warning">
                            <h3>{{ $aspirasis->where('status', 'pending')->count() }}</h3>
                            <p>Pending</p>
                            <i class="fas fa-clock fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card success">
                            <h3>{{ $aspirasis->where('status', 'selesai')->count() }}</h3>
                            <p>Selesai</p>
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card danger">
                            <h3>{{ $aspirasis->where('status', 'ditolak')->count() }}</h3>
                            <p>Ditolak</p>
                            <i class="fas fa-times-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
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

                <!-- Table Card -->
                <div class="card animate__animated animate__fadeIn">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Pengaduan Siswa</h5>
                        <div>
                            <input type="text" 
                                   class="form-control form-control-sm d-inline-block" 
                                   placeholder="🔍 Cari..." 
                                   id="searchInput"
                                   style="width: 200px;">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="aspirasiTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Kategori</th>
                                        <th>Isi</th>
                                        <th>Status</th>
                                        <th>Feedback</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aspirasis as $index => $a)
                                    <tr>
                                        <td>{{ $aspirasis->firstItem() + $index }}</td>
                                        <td>{{ $a->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white rounded-circle me-2" 
                                                     style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                    {{ substr($a->user->nama, 0, 1) }}
                                                </div>
                                                {{ $a->user->nama }}
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">{{ $a->kategori->nama_kategori }}</span></td>
                                        <td>{{ Str::limit($a->isi, 40) }}</td>
                                        <td>
                                            <span class="badge status-badge bg-{{ $a->status == 'selesai' ? 'success' : ($a->status == 'ditolak' ? 'danger' : ($a->status == 'diproses' ? 'info' : 'warning')) }}">
                                                {{ $a->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($a->umpanBalik)
                                                <span class="text-success"><i class="fas fa-check"></i> Ada</span>
                                            @else
                                                <span class="text-muted"><i class="fas fa-times"></i> Belum</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" 
                                                    type="button"
                                                    onclick="openFeedbackModal({{ $a->id }}, '{{ addslashes(Str::limit($a->isi, 50)) }}')">
                                                <i class="fas fa-comment"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete('{{ route('admin.aspirasi.delete', $a->id) }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada pengaduan</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $aspirasis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ✅ GLOBAL FEEDBACK MODAL -->
<div class="modal fade" id="globalFeedbackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="feedbackForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Berikan Feedback</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Pengaduan:</strong> <span id="feedbackContent"></span></p>
                    <textarea name="isi" class="form-control" rows="4" placeholder="Tulis feedback Anda..." required minlength="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // ============================================
    // ✅ GLOBAL FEEDBACK MODAL FUNCTION
    // ============================================
    let feedbackModal = null;
    
    function openFeedbackModal(id, content) {
        console.log('🔵 Opening feedback modal for ID:', id);
        
        // Set form action
        document.getElementById('feedbackForm').action = '/admin/aspirasi/' + id + '/feedback';
        
        // Set content
        document.getElementById('feedbackContent').textContent = content;
        
        // Show modal
        const modalElement = document.getElementById('globalFeedbackModal');
        if (!feedbackModal) {
            feedbackModal = new bootstrap.Modal(modalElement, {
                backdrop: true,
                keyboard: true
            });
        }
        
        feedbackModal.show();
        console.log('🟢 Modal shown');
    }

    // ============================================
    // ✅ CLEANUP WHEN MODAL CLOSES
    // ============================================
    document.getElementById('globalFeedbackModal').addEventListener('hidden.bs.modal', function() {
        console.log('🔴 Modal hidden, cleaning up...');
        setTimeout(function() {
            document.querySelectorAll('.modal-backdrop').forEach(b => {
                b.remove();
                console.log('✅ Backdrop removed');
            });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
            document.body.style.paddingRight = '0';
        }, 300);
    });

    // ============================================
    // ✅ CLOSE BUTTON FIX
    // ============================================
    document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(btn => {
        btn.addEventListener('click', function() {
            console.log('🔴 Close button clicked');
            if (feedbackModal) {
                feedbackModal.hide();
            }
        });
    });

    // ============================================
    // ✅ SEARCH FUNCTIONALITY
    // ============================================
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('#aspirasiTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });

    // ============================================
    // ✅ AUTO HIDE ALERTS
    // ============================================
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);

    // ============================================
    // ✅ CONFIRM DELETE
    // ============================================
    function confirmDelete(url) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }

    // ============================================
    // ✅ FORM SUBMISSION
    // ============================================
    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
        const textarea = this.querySelector('textarea');
        if (textarea.value.length < 5) {
            e.preventDefault();
            alert('Feedback minimal 5 karakter!');
            return false;
        }
        
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Mengirim...';
    });

    // ============================================
    // ✅ EMERGENCY CLOSE (Ctrl+X)
    // ============================================
    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'x') {
            e.preventDefault();
            console.log('🚨 Emergency close triggered!');
            if (feedbackModal) {
                feedbackModal.hide();
            }
            forceCloseAllModals();
        }
    });

    // ============================================
    // ✅ DEBUG ON PAGE LOAD
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        console.log('✅ Page loaded');
        console.log('✅ Bootstrap:', typeof bootstrap);
        console.log('✅ Modal Element:', document.getElementById('globalFeedbackModal'));
    });
</script>
@endsection
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('styles')
<style>
    .status-badge {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .status-badge:hover {
        transform: scale(1.1);
    }
    
    .filter-panel {
        background: linear-gradient(135deg, #f8f9fc 0%, #e3e6f0 100%);
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .filter-panel h5 {
        color: #4e73df;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .filter-panel .form-control,
    .filter-panel .form-select {
        border-radius: 8px;
        font-size: 0.9rem;
    }
    
    .filter-panel .btn {
        border-radius: 8px;
        font-size: 0.9rem;
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
                <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="nav-link" href="{{ route('admin.kategori.index') }}">
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
                        <i class="fas fa-tachometer-alt"></i> Dashboard Admin/Guru
                    </h2>
                    <div class="text-end">
                        <p class="mb-0 text-muted">{{ auth()->user()->nama }}</p>
                        <small class="badge bg-primary">{{ auth()->user()->role }}</small>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stats-card">
                            <h3>{{ $aspirasis->total() }}</h3>
                            <p>Total Pengaduan</p>
                            <i class="fas fa-clipboard-list fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card warning">
                            <h3>{{ $aspirasis->where('status', 'pending')->count() }}</h3>
                            <p>Pending</p>
                            <i class="fas fa-clock fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card success">
                            <h3>{{ $aspirasis->where('status', 'selesai')->count() }}</h3>
                            <p>Selesai</p>
                            <i class="fas fa-check-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stats-card danger">
                            <h3>{{ $aspirasis->where('status', 'ditolak')->count() }}</h3>
                            <p>Ditolak</p>
                            <i class="fas fa-times-circle fa-2x opacity-50"></i>
                        </div>
                    </div>
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

                <!-- ✅ FILTER PANEL (BARU) -->
                <div class="filter-panel animate__animated animate__fadeIn">
                    <h5><i class="fas fa-filter"></i> Filter Aspirasi</h5>
                    <form action="{{ route('admin.aspirasi.filter') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-2">
                                <label class="form-label small">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Bulan</label>
                                <select name="bulan" class="form-select">
                                    <option value="">Semua Bulan</option>
                                    <option value="1" {{ request('bulan') == '1' ? 'selected' : '' }}>Januari</option>
                                    <option value="2" {{ request('bulan') == '2' ? 'selected' : '' }}>Februari</option>
                                    <option value="3" {{ request('bulan') == '3' ? 'selected' : '' }}>Maret</option>
                                    <option value="4" {{ request('bulan') == '4' ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ request('bulan') == '5' ? 'selected' : '' }}>Mei</option>
                                    <option value="6" {{ request('bulan') == '6' ? 'selected' : '' }}>Juni</option>
                                    <option value="7" {{ request('bulan') == '7' ? 'selected' : '' }}>Juli</option>
                                    <option value="8" {{ request('bulan') == '8' ? 'selected' : '' }}>Agustus</option>
                                    <option value="9" {{ request('bulan') == '9' ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ request('bulan') == '10' ? 'selected' : '' }}>Oktober</option>
                                    <option value="11" {{ request('bulan') == '11' ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ request('bulan') == '12' ? 'selected' : '' }}>Desember</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Tahun</label>
                                <select name="tahun" class="form-select">
                                    <option value="">Semua Tahun</option>
                                    <option value="2026" {{ request('tahun') == '2026' ? 'selected' : '' }}>2026</option>
                                    <option value="2025" {{ request('tahun') == '2025' ? 'selected' : '' }}>2025</option>
                                    <option value="2024" {{ request('tahun') == '2024' ? 'selected' : '' }}>2024</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Siswa</label>
                                <select name="siswa_id" class="form-select">
                                    <option value="">Semua Siswa</option>
                                    @foreach($siswas as $s)
                                        <option value="{{ $s->id }}" {{ request('siswa_id') == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Kategori</label>
                                <select name="kategori_id" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($kategoris as $k)
                                        <option value="{{ $k->id }}" {{ request('kategori_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label small">Status</label>
                                <select name="status" class="form-select">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                            </div>
                            <div class="col-md-12 text-end">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fas fa-search"></i> Filter
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Table Card -->
                <div class="card animate__animated animate__fadeIn">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Pengaduan Siswa</h5>
                        <div>
                            <input type="text" 
                                   class="form-control form-control-sm d-inline-block" 
                                   placeholder="🔍 Cari..." 
                                   id="searchInput"
                                   style="width: 200px;">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="aspirasiTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Siswa</th>
                                        <th>Kategori</th>
                                        <th>Isi</th>
                                        <th>Status</th>
                                        <th>Feedback</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($aspirasis as $index => $a)
                                    <tr>
                                        <td>{{ $aspirasis->firstItem() + $index }}</td>
                                        <td>{{ $a->created_at->format('d M Y, H:i') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-primary text-white rounded-circle me-2" 
                                                     style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                                    {{ substr($a->user->nama, 0, 1) }}
                                                </div>
                                                {{ $a->user->nama }}
                                            </div>
                                        </td>
                                        <td><span class="badge bg-info">{{ $a->kategori->nama_kategori }}</span></td>
                                        <td>{{ Str::limit($a->isi, 40) }}</td>
                                        <td>
                                            <span class="badge status-badge bg-{{ $a->status == 'selesai' ? 'success' : ($a->status == 'ditolak' ? 'danger' : ($a->status == 'diproses' ? 'info' : 'warning')) }}"
                                                  data-bs-toggle="modal" 
                                                  data-bs-target="#statusModal{{ $a->id }}">
                                                {{ $a->status }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($a->umpanBalik)
                                                <span class="text-success"><i class="fas fa-check"></i> Ada</span>
                                            @else
                                                <span class="text-muted"><i class="fas fa-times"></i> Belum</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" 
                                                    type="button"
                                                    onclick="openFeedbackModal({{ $a->id }}, '{{ addslashes(Str::limit($a->isi, 50)) }}')">
                                                <i class="fas fa-comment"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" 
                                                    onclick="confirmDelete('{{ route('admin.aspirasi.delete', $a->id) }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- Status Modal -->
                                    <div class="modal fade" 
                                         id="statusModal{{ $a->id }}" 
                                         tabindex="-1" 
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.aspirasi.status', $a->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Ubah Status</h5>
                                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <select name="status" class="form-select" required>
                                                            <option value="pending" {{ $a->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="diproses" {{ $a->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                            <option value="selesai" {{ $a->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                            <option value="ditolak" {{ $a->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-5">
                                            <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada pengaduan</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $aspirasis->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Global Feedback Modal -->
<div class="modal fade" id="globalFeedbackModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="feedbackForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Berikan Feedback</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Pengaduan:</strong> <span id="feedbackContent"></span></p>
                    <textarea name="isi" class="form-control" rows="4" placeholder="Tulis feedback Anda..." required minlength="5"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Feedback
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let feedbackModal = null;
    
    function openFeedbackModal(id, content) {
        document.getElementById('feedbackForm').action = '/admin/aspirasi/' + id + '/feedback';
        document.getElementById('feedbackContent').textContent = content;
        
        const modalElement = document.getElementById('globalFeedbackModal');
        if (!feedbackModal) {
            feedbackModal = new bootstrap.Modal(modalElement);
        }
        feedbackModal.show();
    }

    document.getElementById('globalFeedbackModal').addEventListener('hidden.bs.modal', function() {
        setTimeout(function() {
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
        }, 300);
    });

    document.getElementById('searchInput').addEventListener('keyup', function() {
        const value = this.value.toLowerCase();
        const rows = document.querySelectorAll('#aspirasiTable tbody tr');
        rows.forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
        });
    });

    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);

    function confirmDelete(url) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }

    document.getElementById('feedbackForm').addEventListener('submit', function(e) {
        const textarea = this.querySelector('textarea');
        if (textarea.value.length < 5) {
            e.preventDefault();
            alert('Feedback minimal 5 karakter!');
            return false;
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'x') {
            e.preventDefault();
            if (feedbackModal) feedbackModal.hide();
            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
            document.body.classList.remove('modal-open');
            document.body.style.overflow = 'auto';
        }
    });
</script>
@endsection
