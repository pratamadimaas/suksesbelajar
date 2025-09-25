<!DOCTYPE html>
<html>
<head>
    <title>Laporan Ujian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

    <h1>Laporan Hasil Ujian</h1>
    <p>Tanggal Cetak: {{ \Carbon\Carbon::now()->format('d M Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Peserta</th>
                <th>Paket Ujian</th>
                <th>Nilai</th>
                <th>Waktu Selesai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ujians as $ujian)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $ujian->user->name ?? 'User Tidak Ditemukan' }}</td>
                <td>{{ $ujian->paket->name ?? 'Paket Tidak Ditemukan' }}</td>
                <td>{{ number_format($ujian->nilai, 2) }}</td>
                <td>{{ \Carbon\Carbon::parse($ujian->updated_at)->format('d M Y H:i:s') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Tidak ada data ujian yang ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>