<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Kategori;

class AspirasiSeeder extends Seeder
{
    public function run(): void
    {
        $siswa = Siswa::first();
        $kategori = Kategori::first();

        if ($siswa && $kategori) {
            Aspirasi::create([
                'nis' => '12345',
                'siswa_id' => $siswa->id,
                'kategori_id' => $kategori->id,
                'judul' => 'Rusaknya Meja Belajar',
                'kelas' => 'X-A',
                'lokasi' => 'Kelas X-A',
                'keterangan' => 'Meja belajar rusak dan perlu perbaikan segera',
                'status' => 'pending'
            ]);

            Aspirasi::create([
                'nis' => '12345',
                'siswa_id' => $siswa->id,
                'kategori_id' => $kategori->id,
                'judul' => 'AC Tidak Berfungsi',
                'kelas' => 'XI-B',
                'lokasi' => 'Laboratorium Komputer',
                'keterangan' => 'AC di lab komputer tidak dingin',
                'status' => 'diproses'
            ]);

            Aspirasi::create([
                'nis' => '12345',
                'siswa_id' => $siswa->id,
                'kategori_id' => $kategori->id,
                'judul' => 'Lampu Rusak',
                'kelas' => 'XII-C',
                'lokasi' => 'Perpustakaan',
                'keterangan' => 'Beberapa lampu di perpustakaan mati',
                'status' => 'selesai'
            ]);
        }
    }
}
