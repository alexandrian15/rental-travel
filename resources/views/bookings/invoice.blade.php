<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Booking</title>

    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
            color:#333;
        }

        .header{
            text-align:center;
            margin-bottom:30px;
        }

        .title{
            font-size:28px;
            font-weight:bold;
            color:#16a34a;
        }

        .invoice{
            width:100%;
            border-collapse:collapse;
            margin-top:20px;
        }

        .invoice td{
            padding:12px;
            border:1px solid #ddd;
        }

        .label{
            background:#f3f4f6;
            width:40%;
            font-weight:bold;
        }

        .total{
            font-size:22px;
            color:#16a34a;
            font-weight:bold;
        }

        .status{
            margin-top:25px;
            text-align:center;
            font-size:18px;
            color:white;
            background:#16a34a;
            padding:10px;
        }

        .footer{
            margin-top:40px;
            text-align:center;
            color:#777;
            font-size:12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">
            INVOICE PEMBAYARAN
        </div>

        <p>
            Bukti Pembayaran Rental Mobil
        </p>
    </div>

    <table class="invoice">

        <tr>
            <td class="label">Nomor Booking</td>
            <td>
                BK-{{ str_pad($booking->id,6,'0',STR_PAD_LEFT) }}
            </td>
        </tr>

        <tr>
            <td class="label">Nama Pemesan</td>
            <td>{{ $booking->nama_pemesan }}</td>
        </tr>

        <tr>
            <td class="label">Mobil</td>
            <td>{{ $booking->car?->nama_mobil ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label">Tanggal Mulai</td>
            <td>{{ $booking->tanggal_mulai }}</td>
        </tr>

        <tr>
            <td class="label">Tanggal Selesai</td>
            <td>{{ $booking->tanggal_selesai }}</td>
        </tr>

        <tr>
            <td class="label">Total Pembayaran</td>
            <td class="total">
                Rp {{ number_format($booking->total_harga,0,',','.') }}
            </td>
        </tr>

    </table>

    <div class="status">
        PEMBAYARAN LUNAS
    </div>

    <div class="footer">
        Dicetak pada {{ now()->format('d M Y H:i') }}
        <br>
        Terima kasih telah menggunakan layanan kami.
    </div>

</body>
</html>