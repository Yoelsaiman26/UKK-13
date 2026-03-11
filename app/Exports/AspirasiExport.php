<?php

namespace App\Exports;

use App\Models\Aspirasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AspirasiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Aspirasi::with(['siswa', 'kategori'])
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Pelapor',
            'Kategori',
            'Judul',
            'Status'
        ];
    }

    public function map($aspirasi): array
    {
        return [
            $aspirasi->created_at->format('d/m/Y'),
            $aspirasi->siswa->nama ?? '-',
            $aspirasi->kategori->nama ?? '-',
            $aspirasi->judul,
            $this->translateStatus($aspirasi->status)
        ];
    }

    private function translateStatus($status)
    {
        $statusMap = [
            'pending' => 'Menunggu',
            'approved' => 'Selesai',
            'rejected' => 'Ditolak'
        ];
        
        return $statusMap[$status] ?? $status;
    }
}
