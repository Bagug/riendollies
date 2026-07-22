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
            border: 1px solid #000;
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

    <h2>LAPORAN PENYEWAAN</h2>

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
                <th>Kode</th>
                <th>Nama Pelanggan</th>
                <th>Nama Layanan</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($penyewaans as $item)

                <tr>

                    <td class="text-center">{{ $loop->iteration }}</td>

                    <td class="text-center">{{ $item->kode_penyewaan }}</td>

                    <td class="text-center">{{ $item->pelanggan->nama }}</td>

                    <td>
                        @foreach($item->detailPenyewaans as $detail)
                            {{ $detail->nama_layanan }} ({{ $detail->qty }}x)@if(!$loop->last)<br>@endif
                        @endforeach
                    </td>

                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_acara)->format('d/m/Y') }}</td>

                    <td class="text-center">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <br>

    <strong>Total Pendapatan :</strong>
    Rp {{ number_format($totalPendapatan, 0, ',', '.') }}

</body>

</html>