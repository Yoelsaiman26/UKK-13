<?php

namespace App\Imports;

use App\Models\Aspirasi;
use App\Models\Siswa;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class AspirasiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Find siswa by name
        $siswa = Siswa::where('nama', $row['pelapor'])->first();
        
        // Find kategori by name
        $kategori = Kategori::where('nama', $row['kategori'])->first();
        
        // Translate status back to English
        $status = $this->translateStatusToEnglish($row['status']);
        
        return new Aspirasi([
            'siswa_id' => $siswa->id ?? null,
            'kategori_id' => $kategori->id ?? null,
            'judul' => $row['judul'],
            'deskripsi' => $row['deskripsi'] ?? '',
            'status' => $status,
            'created_at' => $this->parseDate($row['tanggal']),
            'updated_at' => now(),
        ]);
    }

    private function translateStatusToEnglish($status)
    {
        $statusMap = [
            'Menunggu' => 'pending',
            'Selesai' => 'approved',
            'Ditolak' => 'rejected',
            'Diproses' => 'approved'
        ];
        
        return $statusMap[$status] ?? 'pending';
    }

    private function parseDate($date)
    {
        try {
            return Carbon::createFromFormat('d/m/Y', $date);
        } catch (\Exception $e) {
            return now();
        }
    }
}
