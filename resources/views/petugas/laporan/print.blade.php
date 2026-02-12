<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman - Pinjamdulu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .stats {
            margin-bottom: 30px;
            display: flex;
            gap: 40px;
            justify-content: center;
        }
        .stat {
            text-align: center;
        }
        .stat-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #0066cc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 40px;
            text-align: right;
            font-size: 12px;
        }
        @media print {
            body {
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PEMINJAMAN ALAT</h1>
        <p>Pinjamdulu - Sistem Manajemen Peminjaman Alat</p>
        <p>Tanggal Cetak: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>

    <div class="stats">
        <div class="stat">
            <div class="stat-label">Total Peminjaman</div>
            <div class="stat-value">{{ $totalPeminjaman }}</div>
        </div>
        <div class="stat">
            <div class="stat-label">Total Pengembalian</div>
            <div class="stat-value">{{ $totalPengembalian }}</div>
        </div>
        <div class="stat">
            <div class="stat-label">Total Denda</div>
            <div class="stat-value">Rp {{ number_format($totalDenda, 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Peminjam</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Tgl Peminjaman</th>
                <th>Status</th>
                <th>Tgl Kembali</th>
                <th>Kondisi</th>
                <th>Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($peminjamans as $key => $peminjaman)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $peminjaman->user->name }}</td>
                    <td>{{ $peminjaman->alat->nama }}</td>
                    <td>{{ $peminjaman->jumlah }}</td>
                    <td>{{ $peminjaman->tanggal_peminjaman->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($peminjaman->status) }}</td>
                    <td>{{ $peminjaman->pengembalian?->tanggal_pengembalian?->format('d-m-Y') ?? '-' }}</td>
                    <td>{{ $peminjaman->pengembalian?->kondisi_alat ? ucfirst($peminjaman->pengembalian->kondisi_alat) : '-' }}</td>
                    <td>
                        @if($peminjaman->pengembalian && $peminjaman->pengembalian->denda > 0)
                            Rp {{ number_format($peminjaman->pengembalian->denda, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        <p>Tanggal: {{ now()->format('d-m-Y H:i:s') }}</p>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>
