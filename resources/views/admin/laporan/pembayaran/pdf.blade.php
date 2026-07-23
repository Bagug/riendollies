<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background: #eeeeee;
        }
    </style>

</head>

<body>

    <h2>LAPORAN PEMBAYARAN</h2>

    <p style="text-align:center; margin-top:-5px;">
        Periode :
        @if($startDate && $endDate)
            {{ \Carbon\Carbon::parse($startDate)->translatedFormat('d F Y') }}
            s.d.
            {{ \Carbon\Carbon::parse($endDate)->translatedFormat('d F Y') }}
        @else
            Semua Periode
        @endif
    </p>

    <table>

        <thead>

            <tr>
                <th>No</th>
                <th>Kode Penyewaan</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Pembayaran</th>
                <th>Total Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Progres Penyewaan</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($pembayarans as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->penyewaan->kode_penyewaan }}</td>

                    <td>{{ $item->penyewaan->pelanggan->nama }}</td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_pembayaran)->format('d/m/Y') }}
                    </td>

                    <td>
                        Rp {{ number_format($item->penyewaan->total_harga, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $item->status_verifikasi }}
                    </td>

                    <td>

                        @if($item->status_verifikasi == 'Menunggu Verifikasi')

                            Menunggu Verifikasi

                        @elseif($item->status_verifikasi == 'Ditolak')

                            Ditolak

                        @elseif($item->penyewaan->status == 'Disetujui')

                            Belum Selesai

                        @elseif($item->penyewaan->status == 'Selesai')

                            Selesai

                        @else

                            {{ $item->penyewaan->status }}

                        @endif

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <br>

    <strong>Total Pembayaran Terverifikasi :</strong>
    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}

    <p>
        <strong>Jumlah Data :</strong>
        {{ $pembayarans->count() }}
    </p>



</body>

</html>