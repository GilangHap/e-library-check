<!-- resources/views/peminjaman/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary fw-bold">Peminjaman Saya</h1>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card mb-4 border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('icons/user-avatar.svg') }}" alt="User" class="rounded-circle me-3" width="60">
                        <div>
                            <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                            <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <hr>
                    <ul class="nav flex-column nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="#dipinjam" data-bs-toggle="tab">
                                <i class="bi bi-book me-2"></i>Sedang Dipinjam
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#antri" data-bs-toggle="tab">
                                <i class="bi bi-hourglass-split me-2"></i>Dalam Antrian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#riwayat" data-bs-toggle="tab">
                                <i class="bi bi-clock-history me-2"></i>Riwayat Peminjaman
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Statistik Peminjaman</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Total Dipinjam</span>
                        <span class="fw-bold">{{ $totalPinjam ?? '0' }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Peminjaman Aktif</span>
                        <span class="fw-bold">{{ $activePinjam ?? '0' }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span>Dalam Antrian</span>
                        <span class="fw-bold">{{ $queuedPinjam ?? '0' }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="tab-content">
                <!-- Tab Sedang Dipinjam -->
                <div class="tab-pane fade show active" id="dipinjam">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Buku Sedang Dipinjam</h3>
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" placeholder="Cari buku..." id="searchDipinjam">
                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    
                    @if(isset($dipinjam) && count($dipinjam) > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach($dipinjam as $pinjam)
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{ $pinjam->buku->gambar ?? asset('images/book-placeholder.png') }}" 
                                                     class="img-fluid rounded-start h-100 object-fit-cover" 
                                                     alt="{{ $pinjam->buku->judul }}">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title text-truncate">{{ $pinjam->buku->judul }}</h5>
                                                    <p class="card-text mb-1 text-muted">{{ $pinjam->buku->penulis }}</p>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="badge bg-primary me-2">Dipinjam</div>
                                                        <small class="text-muted">{{ $pinjam->tanggal_pinjam->format('d M Y') }}</small>
                                                    </div>
                                                    <p class="card-text mb-1">
                                                        <small class="text-danger">
                                                            <i class="bi bi-calendar-x me-1"></i>Jatuh tempo: {{ $pinjam->tanggal_kembali->format('d M Y') }}
                                                        </small>
                                                    </p>
                                                    <p class="card-text mb-0">
                                                        <small class="text-muted">
                                                            <i class="bi bi-geo-alt me-1"></i>{{ $pinjam->buku->lokasi }}
                                                        </small>
                                                    </p>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#perpanjangModal{{ $pinjam->id }}">
                                                            <i class="bi bi-arrow-clockwise me-1"></i>Perpanjang
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            @if(isset($dipinjam) && method_exists($dipinjam, 'links'))
                                {{ $dipinjam->links() }}
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                            <div>
                                Anda tidak memiliki buku yang sedang dipinjam saat ini.
                                <a href="{{ route('katalog.index') }}" class="alert-link ms-2">Lihat Katalog</a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Tab Dalam Antrian -->
                <div class="tab-pane fade" id="antri">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Buku Dalam Antrian</h3>
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" placeholder="Cari buku..." id="searchAntri">
                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    
                    @if(isset($antri) && count($antri) > 0)
                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach($antri as $antre)
                                <div class="col">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="row g-0">
                                            <div class="col-md-4">
                                                <img src="{{ $antre->buku->gambar ?? asset('images/book-placeholder.png') }}" 
                                                     class="img-fluid rounded-start h-100 object-fit-cover" 
                                                     alt="{{ $antre->buku->judul }}">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title text-truncate">{{ $antre->buku->judul }}</h5>
                                                    <p class="card-text mb-1 text-muted">{{ $antre->buku->penulis }}</p>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="badge bg-warning text-dark me-2">Menunggu</div>
                                                        <small class="text-muted">Diajukan: {{ $antre->tanggal_request->format('d M Y') }}</small>
                                                    </div>
                                                    <p class="card-text mb-1">
                                                        <small class="text-muted">
                                                            <i class="bi bi-people me-1"></i>Posisi antrian: {{ $antre->posisi_antrian }}
                                                        </small>
                                                    </p>
                                                    <p class="card-text mb-0">
                                                        <small class="text-muted">
                                                            <i class="bi bi-geo-alt me-1"></i>{{ $antre->buku->lokasi }}
                                                        </small>
                                                    </p>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#batalModal{{ $antre->id }}">
                                                            <i class="bi bi-x-circle me-1"></i>Batalkan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            @if(isset($antri) && method_exists($antri, 'links'))
                                {{ $antri->links() }}
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                            <div>
                                Anda tidak memiliki buku dalam antrian saat ini.
                                <a href="{{ route('katalog.index') }}" class="alert-link ms-2">Lihat Katalog</a>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Tab Riwayat Peminjaman -->
                <div class="tab-pane fade" id="riwayat">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Riwayat Peminjaman</h3>
                        <div class="input-group" style="max-width: 300px;">
                            <input type="text" class="form-control" placeholder="Cari buku..." id="searchRiwayat">
                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    
                    @if(isset($riwayat) && count($riwayat) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Buku</th>
                                        <th scope="col">Tanggal Pinjam</th>
                                        <th scope="col">Tanggal Kembali</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($riwayat as $history)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ $history->buku->gambar ?? asset('images/book-placeholder.png') }}" 
                                                         alt="{{ $history->buku->judul }}" 
                                                         class="rounded me-3" width="50" height="70">
                                                    <div>
                                                        <h6 class="mb-0">{{ $history->buku->judul }}</h6>
                                                        <small class="text-muted">{{ $history->buku->penulis }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $history->tanggal_pinjam->format('d M Y') }}</td>
                                            <td>{{ $history->tanggal_kembali_aktual->format('d M Y') }}</td>
                                            <td>
                                                @if($history->status === 'tepat_waktu')
                                                    <span class="badge bg-success">Tepat Waktu</span>
                                                @elseif($history->status === 'terlambat')
                                                    <span class="badge bg-danger">Terlambat</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ $history->status }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="bi bi-three-dots"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('katalog.show', $history->buku->id) }}">
                                                                <i class="bi bi-eye me-2"></i>Detail Buku
                                                            </a>
                                                        </li>
                                                        <li>
                                                            @if(isset($history->ulasan))
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#lihatUlasanModal{{ $history->id }}">
                                                                    <i class="bi bi-chat-left-text me-2"></i>Lihat Ulasan
                                                                </a>
                                                            @else
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#tambahUlasanModal{{ $history->id }}">
                                                                    <i class="bi bi-chat-left-text me-2"></i>Tambah Ulasan
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('peminjaman.pinjam-lagi', $history->buku->id) }}">
                                                                <i class="bi bi-arrow-repeat me-2"></i>Pinjam Lagi
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            @if(isset($riwayat) && method_exists($riwayat, 'links'))
                                {{ $riwayat->links() }}
                            @endif
                        </div>
                    @else
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                            <i class="bi bi-info-circle-fill me-2 fs-4"></i>
                            <div>
                                Anda belum memiliki riwayat peminjaman buku.
                                <a href="{{ route('katalog.index') }}" class="alert-link ms-2">Lihat Katalog</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Perpanjang -->
@if(isset($dipinjam))
    @foreach($dipinjam as $pinjam)
        <div class="modal fade" id="perpanjangModal{{ $pinjam->id }}" tabindex="-1" aria-labelledby="perpanjangModalLabel{{ $pinjam->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="perpanjangModalLabel{{ $pinjam->id }}">Perpanjang Peminjaman</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <img src="{{ $pinjam->buku->gambar ?? asset('images/book-placeholder.png') }}" alt="{{ $pinjam->buku->judul }}" class="img-fluid mb-3" style="max-height: 200px;">
                            <h5>{{ $pinjam->buku->judul }}</h5>
                            <p class="text-muted">{{ $pinjam->buku->penulis }}</p>
                        </div>
                        
                        <div class="mb-3">
                            <p><strong>Tanggal Pinjam:</strong> {{ $pinjam->tanggal_pinjam->format('d M Y') }}</p>
                            <p><strong>Jatuh Tempo Saat Ini:</strong> {{ $pinjam->tanggal_kembali->format('d M Y') }}</p>
                            <p><strong>Jatuh Tempo Setelah Perpanjangan:</strong> {{ $pinjam->tanggal_kembali->addDays(7)->format('d M Y') }}</p>
                        </div>
                        
                        <div class="alert alert-warning" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            Perpanjangan hanya dapat dilakukan satu kali. Setelah perpanjangan, buku harus dikembalikan sesuai tanggal jatuh tempo.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('peminjaman.perpanjang', $pinjam->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Perpanjang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- Modal Batalkan Antrian -->
@if(isset($antri))
    @foreach($antri as $antre)
        <div class="modal fade" id="batalModal{{ $antre->id }}" tabindex="-1" aria-labelledby="batalModalLabel{{ $antre->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="batalModalLabel{{ $antre->id }}">Batalkan Antrian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-4">
                            <img src="{{ $antre->buku->gambar ?? asset('images/book-placeholder.png') }}" alt="{{ $antre->buku->judul }}" class="img-fluid mb-3" style="max-height: 200px;">
                            <h5>{{ $antre->buku->judul }}</h5>
                            <p class="text-muted">{{ $antre->buku->penulis }}</p>
                        </div>
                        
                        <p>Apakah Anda yakin ingin membatalkan permintaan peminjaman untuk buku ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <form action="{{ route('peminjaman.batalkan', $antre->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Ya, Batalkan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif

<!-- Modal Tambah Ulasan -->
@if(isset($riwayat))
    @foreach($riwayat as $history)
        @if(!isset($history->ulasan))
            <div class="modal fade" id="tambahUlasanModal{{ $history->id }}" tabindex="-1" aria-labelledby="tambahUlasanModalLabel{{ $history->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahUlasanModalLabel{{ $history->id }}">Tambah Ulasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('ulasan.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" name="peminjaman_id" value="{{ $history->id }}">
                                <input type="hidden" name="buku_id" value="{{ $history->buku->id }}">
                                
                                <div class="text-center mb-4">
                                    <img src="{{ $history->buku->gambar ?? asset('images/book-placeholder.png') }}" alt="{{ $history->buku->judul }}" class="img-fluid mb-3" style="max-height: 150px;">
                                    <h5>{{ $history->buku->judul }}</h5>
                                    <p class="text-muted">{{ $history->buku->penulis }}</p>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Rating</label>
                                    <div class="rating-stars d-flex justify-content-center mb-3">
                                        <div class="star-rating">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="rating{{ $history->id }}-{{ $i }}" name="rating" value="{{ $i }}" required>
                                                <label for="rating{{ $history->id }}-{{ $i }}"><i class="bi bi-star-fill"></i></label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="komentar{{ $history->id }}" class="form-label">Komentar</label>
                                    <textarea class="form-control" id="komentar{{ $history->id }}" name="komentar" rows="4" placeholder="Bagikan pengalaman membaca Anda..." required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="modal fade" id="lihatUlasanModal{{ $history->id }}" tabindex="-1" aria-labelledby="lihatUlasanModalLabel{{ $history->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="lihatUlasanModalLabel{{ $history->id }}">Ulasan Anda</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-4">
                                <img src="{{ $history->buku->gambar ?? asset('images/book-placeholder.png') }}" alt="{{ $history->buku->judul }}" class="img-fluid mb-3" style="max-height: 150px;">
                                <h5>{{ $history->buku->judul }}</h5>
                                <p class="text-muted">{{ $history->buku->penulis }}</p>
                            </div>
                            
                            <div class="mb-3 text-center">
                                <div class="d-flex justify-content-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $history->ulasan->rating)
                                            <i class="bi bi-star-fill text-warning fs-4 mx-1"></i>
                                        @else
                                            <i class="bi bi-star fs-4 mx-1 text-muted"></i>
                                        @endif
                                    @endfor
                                </div>
                                <small class="text-muted">Dikirim pada {{ $history->ulasan->created_at->format('d M Y') }}</small>
                            </div>
                            
                            <div class="card border-0 bg-light mb-3">
                                <div class="card-body">
                                    <p class="mb-0">{{ $history->ulasan->komentar }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endif

@push('styles')
<style>
    /* Custom card hover effect */
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1) !important;
    }
    
    /* Custom nav pills styling */
    .nav-pills .nav-link {
        border-radius: 8px;
        color: #6c757d;
        padding: 10px 15px;
        margin-bottom: 8px;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link:hover {
        background-color: rgba(13, 110, 253, 0.05);
        color: #0d6efd;
    }
    
    .nav-pills .nav-link.active {
        background-color: #0d6efd;
        color: white;
        box-shadow: 0 4px 8px rgba(13, 110, 253, 0.2);
    }
    
    /* Custom status badge styling */
    .badge {
        padding: 6px 10px;
        font-weight: 500;
    }
    
    /* Star rating */
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
    }
    
    .star-rating input {
        display: none;
    }
    
    .star-rating label {
        color: #ddd;
        font-size: 24px;
        margin: 0 2px;
        cursor: pointer;
    }
    
    .star-rating :checked ~ label {
        color: #ffb700;
    }
    
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffb700;
    }
    
    /* Table hover effect */
    .table-hover tbody tr {
        transition: background-color 0.2s ease;
    }
    
    /* Pagination styling */
    .pagination {
        --bs-pagination-active-bg: #0d6efd;
        --bs-pagination-active-border-color: #0d6efd;
    }
    
    /* Object fit for book covers */
    .object-fit-cover {
        object-fit: cover;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Search functionality for dipinjam tab
        const searchDipinjam = document.getElementById('searchDipinjam');
        if (searchDipinjam) {
            searchDipinjam.addEventListener('input', function(e) {
                const searchText = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('#dipinjam .card');
                
                cards.forEach(card => {
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    const author = card.querySelector('.text-muted').textContent.toLowerCase();
                    
                    if (title.includes(searchText) || author.includes(searchText)) {
                        card.closest('.col').style.display = 'block';
                    } else {
                        card.closest('.col').style.display = 'none';}
                });
            });
        }
        
        // Search functionality for antri tab
        const searchAntri = document.getElementById('searchAntri');
        if (searchAntri) {
            searchAntri.addEventListener('input', function(e) {
                const searchText = e.target.value.toLowerCase();
                const cards = document.querySelectorAll('#antri .card');
                
                cards.forEach(card => {
                    const title = card.querySelector('.card-title').textContent.toLowerCase();
                    const author = card.querySelector('.text-muted').textContent.toLowerCase();
                    
                    if (title.includes(searchText) || author.includes(searchText)) {
                        card.closest('.col').style.display = 'block';
                    } else {
                        card.closest('.col').style.display = 'none';
                    }
                });
            });
        }
        
        // Search functionality for riwayat tab
        const searchRiwayat = document.getElementById('searchRiwayat');
        if (searchRiwayat) {
            searchRiwayat.addEventListener('input', function(e) {
                const searchText = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#riwayat tbody tr');
                
                rows.forEach(row => {
                    const title = row.querySelector('h6').textContent.toLowerCase();
                    const author = row.querySelector('small').textContent.toLowerCase();
                    
                    if (title.includes(searchText) || author.includes(searchText)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        }
        
        // Countdown untuk buku yang akan jatuh tempo
        document.querySelectorAll('[data-countdown]').forEach(el => {
            const target = new Date(el.getAttribute('data-countdown')).getTime();
            
            const countdown = setInterval(() => {
                const now = new Date().getTime();
                const distance = target - now;
                
                if (distance < 0) {
                    clearInterval(countdown);
                    el.innerHTML = '<span class="text-danger">Jatuh tempo!</span>';
                    return;
                }
                
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                el.innerHTML = `${days} hari lagi`;
                
                if (days <= 3) {
                    el.classList.add('text-danger');
                    el.classList.add('fw-bold');
                }
            }, 1000);
        });
        
        // Toast notification untuk peminjaman yang akan jatuh tempo
        const toastTrigger = document.getElementById('liveToastBtn');
        const toastLiveExample = document.getElementById('liveToast');
        
        if (toastTrigger && toastLiveExample) {
            // Show toast automatically if there are books due soon
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample);
            setTimeout(() => {
                toastBootstrap.show();
            }, 1500);
            
            toastTrigger.addEventListener('click', () => {
                toastBootstrap.show();
            });
        }
        
        // Active tab management with URL parameter
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        
        if (activeTab) {
            const tab = document.querySelector(`a[href="#${activeTab}"]`);
            if (tab) {
                const tabInstance = new bootstrap.Tab(tab);
                tabInstance.show();
            }
        }
        
        // Update URL when tab changes
        const tabs = document.querySelectorAll('a[data-bs-toggle="tab"]');
        tabs.forEach(tab => {
            tab.addEventListener('shown.bs.tab', function (event) {
                const targetId = event.target.getAttribute('href').substring(1);
                const url = new URL(window.location.href);
                url.searchParams.set('tab', targetId);
                window.history.pushState({}, '', url);
            });
        });
        
        // Initialize tooltips
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        
        // Initialize popovers
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl));
    });
    
    // Fungsi untuk filter berdasarkan status
    function filterByStatus(status) {
        const rows = document.querySelectorAll('#riwayat tbody tr');
        
        if (status === 'semua') {
            rows.forEach(row => {
                row.style.display = 'table-row';
            });
            return;
        }
        
        rows.forEach(row => {
            const rowStatus = row.querySelector('.badge').textContent.toLowerCase().replace(/\s+/g, '_');
            
            if (rowStatus === status) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>
@endpush
@endsection