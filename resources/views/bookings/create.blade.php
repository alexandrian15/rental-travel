<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Booking Mobil</title>

<meta name="csrf-token" content="{{ csrf_token() }}">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

html,
body{
    overflow-x:hidden;
}

body{
    background:#f3f4f6;
    min-height:100vh;
}

.container{
    max-width:1200px;
    margin:auto;
    width:100%;
    padding:0 15px;
}

.booking-card{
    background:white;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 15px 40px rgba(0,0,0,.08);
    display:grid;
    grid-template-columns:1fr 1.2fr;
    width:100%;
    margin-top:40px;
}

.car-section,
.form-section{
    min-width:0;
}

.car-section{
    background:#111827;
    color:white;
    padding:30px;
}

@media(max-width:1200px){
    .booking-card{
        grid-template-columns:1fr 1fr;
    }
    .car-section{
        padding:25px;
    }
    .form-section{
        padding:30px;
    }
}

.car-image{
    width:100%;
    height:280px;
    object-fit:cover;
    border-radius:16px;
}

.car-title{
    font-size:30px;
    font-weight:700;
    margin-top:20px;
}

.car-price{
    margin-top:10px;
    font-size:22px;
    color:#fbbf24;
    font-weight:600;
}

.car-info{
    margin-top:15px;
    color:#d1d5db;
}

.form-section{
    padding:40px;
}

.form-section h1{
    margin-bottom:25px;
    font-size:36px;
}

.form-group{
    margin-bottom:18px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

.form-control{
    width:100%;
    padding:14px;
    border:1px solid #d1d5db;
    border-radius:12px;
    font-size:15px;
}

.form-control:focus{
    outline:none;
    border-color:#ef4444;
}

.summary-card{
    margin-top:25px;
    border:1px solid #e5e7eb;
    border-radius:16px;
    padding:20px;
    background:#fafafa;
}

.summary-title{
    font-size:18px;
    font-weight:700;
    margin-bottom:15px;
}

.summary-row{
    display:flex;
    justify-content:space-between;
    margin-bottom:12px;
    color:#4b5563;
}

.summary-total{
    display:flex;
    justify-content:space-between;
    margin-top:15px;
    padding-top:15px;
    border-top:2px dashed #d1d5db;
    font-size:24px;
    font-weight:700;
    color:#dc2626;
}

.badge{
    background:#dcfce7;
    color:#166534;
    padding:5px 10px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.checkout-btn{
    width:100%;
    margin-top:25px;
    padding:16px;
    border:none;
    border-radius:14px;
    background:#dc2626;
    color:white;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:.3s;
}

.checkout-btn:hover{
    background:#b91c1c;
}



.alert{
    background:#dcfce7;
    color:#166534;
    padding:15px;
    border-radius:12px;
    margin-bottom:20px;
}

.error{
    color:red;
    font-size:13px;
    margin-top:5px;
}

@media(max-width:768px){
    .booking-card{
        grid-template-columns:1fr;
    }
    .car-section{
        text-align:center;
        padding:25px;
    }
    .form-section{
        padding:25px;
    }
    .form-section h1{
        font-size:28px;
    }
}

/* Additional small-screen tweaks */
@media (max-width:640px){
    .container{padding:12px}
    .booking-card{border-radius:18px}
    .car-section{padding:18px}
    .car-image{height:200px}
    .car-title{font-size:20px}
    .car-price{font-size:18px}
    .form-section{padding:20px}
    .form-section h1{font-size:28px}
    .form-control{padding:12px}
    .summary-card{padding:12px}
    .summary-title{font-size:16px}
    .summary-total{font-size:20px}
    .checkout-btn{padding:12px;font-size:15px}
}

.back-fixed{
        position:;
        top:18px;
        left:18px;
        z-index:50;
        background:#dc2626;
        color:#fff;
        padding:10px 16px;
        border-radius:14px;
        border:none;
        font-weight:700;
        cursor:pointer;
    }

    .back-fixed:hover{background:#b91c1c}

    @media (max-width:640px){
        .back-fixed{top:12px;left:12px;padding:8px 12px;border-radius:10px}
    }
    
</style>
</head>
<body>



<div class="container">
    @if(!request()->is('/'))
                    <button onclick="history.back()" class="back-fixed">Kembali</button>
                @endif


@if(session('success'))
<div class="alert">
    {{ session('success') }}
</div>
@endif

<div class="booking-card">

    {{-- KIRI --}}
    <div class="car-section">

        @if($car->gambar)
            <img
                src="{{ asset('storage/'.$car->gambar) }}"
                class="car-image"
                alt="{{ $car->nama_mobil }}">
        @else
            <img
                src="https://via.placeholder.com/600x400?text=Mobil"
                class="car-image">
        @endif

        <div class="car-title">
            {{ $car->nama_mobil }}
        </div>

        <div class="car-price">
            Rp {{ number_format($car->harga_dasar,0,',','.') }}/hari
        </div>

        <div class="car-info">
            Plat Nomor : {{ $car->plat_nomor }}
        </div>

        <div class="car-info">
            Stok : {{ $car->stok }} Unit
        </div>

    </div>

    {{-- KANAN --}}
    <div class="form-section">

            <h1>Booking Mobil</h1>

        <form
            action="{{ route('bookings.store',$car->id) }}"
            method="POST">

            @csrf

            <div class="form-group">
                <label>Nama Pemesan</label>
                <input
                    type="text"
                    name="nama_pemesan"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input
                    type="date"
                    id="tanggal_mulai"
                    name="tanggal_mulai"
                    class="form-control"
                    required>
            </div>

            <div class="form-group">
                <label>Tanggal Selesai</label>
                <input
                    type="date"
                    id="tanggal_selesai"
                    name="tanggal_selesai"
                    class="form-control"
                    required>
            </div>

            <div class="summary-card">

                <div class="summary-title">
                    Ringkasan Pembayaran
                </div>

                <div class="summary-row">
                    <span>Mobil</span>
                    <span>{{ $car->nama_mobil }}</span>
                </div>

                <div class="summary-row">
                    <span>Harga / Hari</span>
                    <span>
                        Rp {{ number_format($car->harga_dasar,0,',','.') }}
                    </span>
                </div>

                <div class="summary-row">
                    <span>Lama Sewa</span>
                    <span id="jumlahHari">
                        0 Hari
                    </span>
                </div>

                <div class="summary-row">
                    <span>Status Harga</span>
                    <span class="badge" id="statusHarga">
                        Normal
                    </span>
                </div>

                <div class="summary-total">
                    <span>Total</span>
                    <span id="totalHarga">
                        Rp 0
                    </span>
                </div>

            </div>

            <button
                type="submit"
                class="checkout-btn">

                Lanjut Pembayaran

            </button>

        </form>

    </div>

</div>

</div>

<script>

const mulai = document.getElementById('tanggal_mulai');
const selesai = document.getElementById('tanggal_selesai');

async function hitungHarga(){

    if(!mulai.value || !selesai.value){
        return;
    }

    let start = new Date(mulai.value);
    let end = new Date(selesai.value);

    let hari =
        Math.ceil(
            (end - start) /
            (1000*60*60*24)
        ) + 1;

    document.getElementById('jumlahHari')
        .innerText = hari + ' Hari';

    try{

        const response = await fetch(
            '/booking/hitung/{{ $car->id }}',
            {
                method:'POST',
                headers:{
                    'Content-Type':'application/json',
                    'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
                },
                body:JSON.stringify({
                    tanggal_mulai: mulai.value,
                    tanggal_selesai: selesai.value
                })
            }
        );

        const data = await response.json();

        document.getElementById(
            'totalHarga'
        ).innerText =
        'Rp ' +
        Number(data.harga)
        .toLocaleString('id-ID');

    }catch(error){

        console.log(error);

    }

}

mulai.addEventListener(
    'change',
    hitungHarga
);

selesai.addEventListener(
    'change',
    hitungHarga
);

fetch('/car/{{ $car->id }}/unavailable-dates')
.then(res => res.json())
.then(dates => {

    flatpickr("#tanggal_mulai", {
        minDate: "today",
        disable: dates
    });

    flatpickr("#tanggal_selesai", {
        minDate: "today",
        disable: dates
    });

});
    document.getElementById('mobileToggler')?.addEventListener('click', function(){
        document.getElementById('mobileMenu').classList.toggle('show');
    });
</script>

</body>
</html>
