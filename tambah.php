<?php
require "config.php";

// Periksa apakah formulir telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $nama = $_POST['nama'];
    $nomorTlp = $_POST['nomorTlp'];
    $waktuPelaksanaan = $_POST['waktuPelaksanaan'];
    $jumlahPeserta = $_POST['jumlahPeserta'];

    // Inisialisasi variabel pelayananPaket
    $pelayananPaket = "";

    // Periksa apakah pilihan pelayananPaket telah dipilih
    if (isset($_POST['pelayananPaket'])) {
        $pelayananPaket = implode(',', $_POST['pelayananPaket']);
    }

    $hargaPaketPerjalanan = $_POST['hargaPaketPerjalanan'];
    $jumlahTagihan = $_POST['jumlahTagihan'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO pemesanan (nama, nomorTlp, waktuPelaksanaan, jumlahPeserta, pelayananPaket, hargaPaketPerjalanan, jumlahTagihan)
    VALUES ('$nama', '$nomorTlp', '$waktuPelaksanaan', $jumlahPeserta, '$pelayananPaket', '$hargaPaketPerjalanan', '$jumlahTagihan')";

    if ($conn->query($sql) === TRUE) {
        echo "Pemesanan berhasil disimpan";
        // Redirect ke halaman admin setelah pesanan berhasil disimpan
        header("Location: admin.php");
        exit(); // Pastikan untuk keluar dari skrip setelah redirect
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesan Paket Wisata</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .border-ca {
            border-color: #ffb6b6 !important;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card border-ca">
            <div class="card-body">
                <h2 class="card-title text-center" style="color: #19006b;">Form Pemesan Paket Wisata</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Pemesanan</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="nomorTlp" class="form-label">Nomor Telp/HP</label>
                        <input type="number" class="form-control" id="nomorTlp" name="nomorTlp">
                    </div>
                    <div class="mb-3">
                        <label for="waktuPelaksanaan" class="form-label">Waktu Pelaksanaan Perjalanan</label>
                        <input type="date" class="form-control" id="waktuPelaksanaan" name="waktuPelaksanaan">
                    </div>
                    <div class="mb-3">
                        <label for="jumlahPeserta" class="form-label">Jumlah Peserta</label>
                        <input type="number" class="form-control" id="jumlahPeserta" name="jumlahPeserta">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pelayanan Paket Perjalanan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelayananPaket[]" value="Penginapan" id="penginapan">
                            <label class="form-check-label" for="penginapan">Penginapan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelayananPaket[]" value="Transportasi" id="transportasi">
                            <label class="form-check-label" for="transportasi">Transportasi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pelayananPaket[]" value="Makanan" id="makanan">
                            <label class="form-check-label" for="makanan">Makanan</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="hargaPaketPerjalanan" class="form-label">Harga Paket Perjalanan</label>
                        <input type="number" class="form-control" id="hargaPaketPerjalanan" name="hargaPaketPerjalanan">
                    </div>
                    <div class="mb-3">
                        <label for="jumlahTagihan" class="form-label">Jumlah Tagihan</label>
                        <input type="number" class="form-control" id="jumlahTagihan" name="jumlahTagihan">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="tambah.php" class="btn btn-danger">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
