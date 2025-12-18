<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Skripsi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => bcrypt('atmin1234'),
        ]);

        // Create dosen users and records
        $dosen_users = [
            [
                'name' => 'Dr. Ari Santoso',
                'email' => 'ari.santoso@example.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Dr. Lina Putri',
                'email' => 'lina.putri@example.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Prof. Budi Hartono',
                'email' => 'budi.hartono@example.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Dr. Siti Rahayu',
                'email' => 'siti.rahayu@example.test',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ],
        ];

        $dosen_data = [
            [
                'nama' => 'Dr. Ari Santoso',
                'nip' => '19870101 200101 1 001',
                'spesialisasi' => 'Sistem Informasi',
            ],
            [
                'nama' => 'Dr. Lina Putri',
                'nip' => '19781212 199901 2 002',
                'spesialisasi' => 'Kecerdasan Buatan',
            ],
            [
                'nama' => 'Prof. Budi Hartono',
                'nip' => '19690505 198901 1 003',
                'spesialisasi' => 'Basis Data',
            ],
            [
                'nama' => 'Dr. Siti Rahayu',
                'nip' => '19800815 200601 2 004',
                'spesialisasi' => 'Jaringan Komputer',
            ],
        ];

        // Create dosen records
        $dosens = [];
        foreach ($dosen_users as $key => $user_data) {
            $user = User::create($user_data);
            $dosens[] = Dosen::create([
                'user_id' => $user->id,
                ...$dosen_data[$key],
            ]);
        }

        // Create student users (for mahasiswa)
        $mahasiswa_users = [
            [
                'name' => 'Andi Pratama',
                'email' => 'andi.pratama@example.test',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nur@example.test',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Roni Wijaya',
                'email' => 'roni.wijaya@example.test',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Dina Kusuma',
                'email' => 'dina.kusuma@example.test',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Fajar Hermawan',
                'email' => 'fajar.hermawan@example.test',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
            [
                'name' => 'Nisa Rahmatika',
                'email' => 'nisa.rahmatika@example.test',
                'password' => bcrypt('password'),
                'role' => 'user',
            ],
        ];

        $mahasiswa_data = [
            [
                'nama' => 'Andi Pratama',
                'nim' => '2023001',
                'angkatan' => '2023',
            ],
            [
                'nama' => 'Siti Nurhaliza',
                'nim' => '2023002',
                'angkatan' => '2023',
            ],
            [
                'nama' => 'Roni Wijaya',
                'nim' => '2023003',
                'angkatan' => '2023',
            ],
            [
                'nama' => 'Dina Kusuma',
                'nim' => '2023004',
                'angkatan' => '2023',
            ],
            [
                'nama' => 'Fajar Hermawan',
                'nim' => '2024001',
                'angkatan' => '2024',
            ],
            [
                'nama' => 'Nisa Rahmatika',
                'nim' => '2024002',
                'angkatan' => '2024',
            ],
        ];

        // Create mahasiswa records
        $mahasiswas = [];
        foreach ($mahasiswa_users as $key => $user_data) {
            $user = User::create($user_data);
            $mahasiswas[] = Mahasiswa::create([
                'user_id' => $user->id,
                ...$mahasiswa_data[$key],
            ]);
        }

        // Create skripsi records (one per mahasiswa)
        $skripsi_titles = [
            'Sistem Informasi Akademik Berbasis Web',
            'Penerapan Machine Learning untuk Prediksi Kelulusan',
            'Aplikasi Pengelolaan Inventaris dengan QR Code',
            'Platform E-Learning Interaktif Berbasis Android',
            'Sistem Rekomendasi Konten Video Menggunakan Collaborative Filtering',
            'Chatbot Customer Service Berbasis NLP',
        ];

        $skripsi_descriptions = [
            'Implementasi modul pendaftaran, penilaian, dan pelaporan akademik mahasiswa.',
            'Menggunakan model supervised untuk memprediksi kelulusan mahasiswa berdasarkan data historis.',
            'Aplikasi berbasis web untuk pengelolaan barang dengan sistem QR Code dan reporting real-time.',
            'Platform pembelajaran online dengan fitur interaktif untuk peserta didik tingkat sekolah menengah.',
            'Sistem rekomendasi video berdasarkan preferensi pengguna menggunakan teknik collaborative filtering.',
            'Chatbot cerdas untuk menangani pertanyaan pelanggan secara otomatis menggunakan Natural Language Processing.',
        ];

        $statuses = ['pending', 'ongoing', 'completed'];

        foreach ($mahasiswas as $key => $mahasiswa) {
            Skripsi::create([
                'mahasiswa_id' => $mahasiswa->id,
                'dosen_id' => $dosens[$key % count($dosens)]->id,
                'judul' => $skripsi_titles[$key],
                'deskripsi' => $skripsi_descriptions[$key],
                'status' => $statuses[$key % count($statuses)],
            ]);
        }
    }
}
