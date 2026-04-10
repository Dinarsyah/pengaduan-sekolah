@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="sidebar-brand">
                <i class="fas fa-graduation-cap"></i> Area Siswa
            </div>
            <nav class="nav flex-column">
                <a class="nav-link active" href="{{ route('siswa.dashboard') }}">
                    <i class="fas fa-home"></i> Dashboard
                </a>
                <a class="nav-link" href="#riwayat" onclick="document.getElementById('riwayat').scrollIntoView()">
                    <i class="fas fa-history"></i> Riwayat
                </a>
                <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </nav>
            <form id="logout-form" action="{{ route('siswa.logout') }}" method="POST" style="display: none;">@csrf</form>
        </div>

        <!-- Content -->
        <div class="col-md-10 content-wrapper">
            <div class="content">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">
                        <i class="fas fa-user-graduate"></i> Dashboard Siswa
                    </h2>
                    <div class="text-end">
                        <p class="mb-0 text-muted">{{ auth()->user()->nama }}</p>
                        <small class="badge bg-success">Siswa</small>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="row">
                    <!-- Form Card -->
                    <div class="col-md-4">
                        <div class="card animate__animated animate__fadeInLeft">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="fas fa-pen-fancy"></i> Buat Pengaduan</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('siswa.aspirasi.store') }}" method="POST" id="aspirasiForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-folder"></i> Kategori
                                        </label>
                                        <select name="kategori_id" class="form-select" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoris as $k)
                                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">
                                            <i class="fas fa-comment-alt"></i> Isi Pengaduan
                                        </label>
                                        <textarea name="isi" 
                                                    class="form-control" 
                                                    rows="5" 
                                                    placeholder="Jelaskan pengaduan Anda secara detail..." 
                                                    required
                                                    id="isiInput"></textarea>
                                        <small class="text-muted" id="charCount">0 karakter</small>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-paper-plane"></i> Kirim Pengaduan
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Info Card -->
                        <div class="card mt-3 animate__animated animate__fadeInLeft" style="animation-delay: 0.2s;">
                            <div class="card-body">
                                <h6><i class="fas fa-info-circle"></i> Tips Pengaduan</h6>
                                <ul class="small mb-0">
                                    <li>Jelaskan dengan detail</li>
                                    <li>Sertakan bukti jika ada</li>
                                    <li>Gunakan bahasa yang sopan</li>
                                    <li>Tunggu feedback dari guru</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- History Card -->
                    <div class="col-md-8" id="riwayat">
                        <div class="card animate__animated animate__fadeInRight">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-history"></i> Riwayat Pengaduan Saya</h5>
                                <span class="badge bg-primary">{{ $aspirasis->count() }} Pengaduan</span>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Kategori</th>
                                                <th>Isi</th>
                                                <th>Status</th>
                                                <th>Feedback</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($aspirasis as $a)
                                            <tr>
                                                <td>{{ $a->created_at->format('d M Y') }}</td>
                                                <td><span class="badge bg-info">{{ $a->kategori->nama_kategori }}</span></td>
                                                <td>{{ Str::limit($a->isi, 40) }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $a->status == 'selesai' ? 'success' : ($a->status == 'ditolak' ? 'danger' : ($a->status == 'diproses' ? 'info' : 'warning')) }}">
                                                        <i class="fas fa-circle small"></i> {{ $a->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    @if($a->umpanBalik)
                                                        <button class="btn btn-sm btn-success" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#feedbackView{{ $a->id }}">
                                                            <i class="fas fa-eye"></i> Lihat
                                                        </button>

                                                        <!-- Feedback View Modal -->
                                                        <div class="modal fade" id="feedbackView{{ $a->id }}" tabindex="-1">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Feedback dari Guru</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="mb-2"><strong>Tanggal:</strong> {{ $a->umpanBalik->created_at->format('d M Y, H:i') }}</p>
                                                                        <hr>
                                                                        <p>{{ $a->umpanBalik->isi }}</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="text-muted"><em>Belum ada feedback</em></span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center py-5">
                                                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                                                    <p class="text-muted">Belum ada pengaduan</p>
                                                    <button class="btn btn-primary" onclick="document.querySelector('textarea').focus()">
                                                        <i class="fas fa-plus"></i> Buat Pengaduan Pertama
                                                    </button>
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
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Character counter
    document.getElementById('isiInput').addEventListener('input', function() {
        document.getElementById('charCount').textContent = this.value.length + ' karakter';
    });

    // Form validation with SweetAlert
    document.getElementById('aspirasiForm').addEventListener('submit', function(e) {
        const isi = document.getElementById('isiInput').value;
        if (isi.length < 10) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Peringatan!',
                text: 'Isi pengaduan minimal 10 karakter'
            });
        }
    });

    // Auto hide alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.remove('show');
            setTimeout(() => alert.remove(), 300);
        });
    }, 5000);
</script>
@endsection
