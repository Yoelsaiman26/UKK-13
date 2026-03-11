<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>LAPORAN ASPIRASI SARANA SEKOLAH</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .text-center {
            text-align: center;
        }
        .no-wrap {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN ASPIRASI SARANA SEKOLAH</h1>
        <p>Periode: {{ $bulan }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center no-wrap">No</th>
                <th class="no-wrap">Pelapor</th>
                <th class="no-wrap">Kategori</th>
                <th>Judul</th>
                <th class="no-wrap">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($aspirasis as $index => $aspirasi)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $aspirasi->siswa->nama ?? '-' }}</td>
                <td>{{ $aspirasi->kategori->nama ?? '-' }}</td>
                <td>{{ $aspirasi->judul }}</td>
                <td>{{ $aspirasi->status == 'pending' ? 'Diproses' : ($aspirasi->status == 'approved' ? 'Selesai' : 'Ditolak') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
