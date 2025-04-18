<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $dipinjam = [
            (object)[
                'id' => 1,
                'buku' => (object)[
                    'id' => 101,
                    'judul' => 'Laskar Pelangi',
                    'penulis' => 'Andrea Hirata',
                    'gambar' => asset('images/books/laskar-pelangi.jpg'),
                    'lokasi' => 'Rak A-21'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(10),
                'tanggal_kembali' => \Carbon\Carbon::now()->addDays(4),
            ],
            (object)[
                'id' => 2,
                'buku' => (object)[
                    'id' => 245,
                    'judul' => 'Bumi Manusia',
                    'penulis' => 'Pramoedya Ananta Toer',
                    'gambar' => asset('images/books/bumi-manusia.jpg'),
                    'lokasi' => 'Rak C-15'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(7),
                'tanggal_kembali' => \Carbon\Carbon::now()->addDays(7),
            ],
            (object)[
                'id' => 3,
                'buku' => (object)[
                    'id' => 312,
                    'judul' => 'Filosofi Teras',
                    'penulis' => 'Henry Manampiring',
                    'gambar' => asset('images/books/filosofi-teras.jpg'),
                    'lokasi' => 'Rak B-08'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(5),
                'tanggal_kembali' => \Carbon\Carbon::now()->addDays(9),
            ]
        ];

        // Books in queue
        $antri = [
            (object)[
                'id' => 4,
                'buku' => (object)[
                    'id' => 198,
                    'judul' => 'Pulang',
                    'penulis' => 'Tere Liye',
                    'gambar' => asset('images/books/pulang.jpg'),
                    'lokasi' => 'Rak D-03'
                ],
                'tanggal_request' => \Carbon\Carbon::now()->subDays(3),
                'posisi_antrian' => 2
            ],
            (object)[
                'id' => 5,
                'buku' => (object)[
                    'id' => 427,
                    'judul' => 'Perahu Kertas',
                    'penulis' => 'Dee Lestari',
                    'gambar' => asset('images/books/perahu-kertas.jpg'),
                    'lokasi' => 'Rak A-07'
                ],
                'tanggal_request' => \Carbon\Carbon::now()->subDays(1),
                'posisi_antrian' => 4
            ]
        ];

        // Borrowing history
        $riwayat = [
            (object)[
                'id' => 6,
                'buku' => (object)[
                    'id' => 154,
                    'judul' => 'Laut Bercerita',
                    'penulis' => 'Leila S. Chudori',
                    'gambar' => asset('images/books/laut-bercerita.jpg'),
                    'lokasi' => 'Rak C-11'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(35),
                'tanggal_kembali_aktual' => \Carbon\Carbon::now()->subDays(21),
                'status' => 'tepat_waktu',
                'ulasan' => (object)[
                    'rating' => 4,
                    'komentar' => 'Novel yang sangat menyentuh dan membuka mata tentang peristiwa sejarah yang sering dilupakan. Narasi yang kuat dan karakter yang mendalam.',
                    'created_at' => \Carbon\Carbon::now()->subDays(20)
                ]
            ],
            (object)[
                'id' => 7,
                'buku' => (object)[
                    'id' => 275,
                    'judul' => 'Ayah',
                    'penulis' => 'Andrea Hirata',
                    'gambar' => asset('images/books/ayah.jpg'),
                    'lokasi' => 'Rak B-15'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(45),
                'tanggal_kembali_aktual' => \Carbon\Carbon::now()->subDays(31),
                'status' => 'tepat_waktu',
                'ulasan' => null
            ],
            (object)[
                'id' => 8,
                'buku' => (object)[
                    'id' => 389,
                    'judul' => 'Tentang Kamu',
                    'penulis' => 'Tere Liye',
                    'gambar' => asset('images/books/tentang-kamu.jpg'),
                    'lokasi' => 'Rak D-09'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(60),
                'tanggal_kembali_aktual' => \Carbon\Carbon::now()->subDays(40),
                'status' => 'terlambat',
                'ulasan' => (object)[
                    'rating' => 5,
                    'komentar' => 'Salah satu buku terbaik dari Tere Liye. Alur cerita yang menakjubkan dan penuh kejutan. Sangat direkomendasikan untuk dibaca.',
                    'created_at' => \Carbon\Carbon::now()->subDays(39)
                ]
            ],
            (object)[
                'id' => 9,
                'buku' => (object)[
                    'id' => 412,
                    'judul' => 'Hujan',
                    'penulis' => 'Tere Liye',
                    'gambar' => asset('images/books/hujan.jpg'),
                    'lokasi' => 'Rak A-17'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(90),
                'tanggal_kembali_aktual' => \Carbon\Carbon::now()->subDays(76),
                'status' => 'tepat_waktu',
                'ulasan' => (object)[
                    'rating' => 4,
                    'komentar' => 'Cerita yang indah dan mengharukan. Tere Liye berhasil membangun karakter yang berkesan dan membuat saya tidak bisa berhenti membaca.',
                    'created_at' => \Carbon\Carbon::now()->subDays(75)
                ]
            ],
            (object)[
                'id' => 10,
                'buku' => (object)[
                    'id' => 178,
                    'judul' => 'Rentang Kisah',
                    'penulis' => 'Gita Savitri Devi',
                    'gambar' => asset('images/books/rentang-kisah.jpg'),
                    'lokasi' => 'Rak B-22'
                ],
                'tanggal_pinjam' => \Carbon\Carbon::now()->subDays(120),
                'tanggal_kembali_aktual' => \Carbon\Carbon::now()->subDays(106),
                'status' => 'tepat_waktu',
                'ulasan' => null
            ]
        ];

        // Statistics
        $totalPinjam = 8;
        $activePinjam = 3;
        $queuedPinjam = 2;

        // Authentication data
        $user = [
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@email.com'
        ];

        // Routes
        $routes = [
            'katalog.index' => '/katalog',
            'katalog.show' => '/katalog/show/',
            'peminjaman.perpanjang' => '/peminjaman/perpanjang/',
            'peminjaman.batalkan' => '/peminjaman/batalkan/',
            'peminjaman.pinjam-lagi' => '/peminjaman/pinjam-lagi/',
            'ulasan.store' => '/ulasan/store'
        ];

        return view('peminjaman.index', compact('dipinjam', 'antri', 'riwayat', 'totalPinjam', 'activePinjam', 'queuedPinjam'));
    }
}
