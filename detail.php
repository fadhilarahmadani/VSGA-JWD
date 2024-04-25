<?php
// Hubungkan ke database
require "config.php";

// Periksa apakah ada parameter ID yang diterima melalui URL
if(isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Query untuk mengambil data berdasarkan ID
    $query = "SELECT * FROM pemesanan WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Periksa apakah query berhasil dieksekusi
    if($result) {
        // Ambil data dari hasil query
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}

// Tutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Detail Data</h2>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Pemesan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nomorTlp" class="form-label">Nomor HP</label>
            <input type="number" class="form-control" id="nomorTlp" name="nomorTlp" value="<?php echo $data['nomorTlp']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="waktuPelaksanaan" class="form-label">Waktu Pelaksanaan</label>
            <input type="date" class="form-control" id="waktuPelaksanaan" name="waktuPelaksanaan" value="<?php echo $data['waktuPelaksanaan']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jumlahPeserta" class="form-label">Jumlah Peserta</label>
            <input type="number" class="form-control" id="jumlahPeserta" name="jumlahPeserta" value="<?php echo $data['jumlahPeserta']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="pelayananPaket" class="form-label">Pelayanan Paket</label>
            <input type="text" class="form-control" id="pelayananPaket" name="pelayananPaket" value="<?php echo $data['pelayananPaket']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="hargaPaketPerjalanan" class="form-label">Harga Paket</label>
            <input type="number" class="form-control" id="hargaPaketPerjalanan" name="hargaPaketPerjalanan" value="<?php echo $data['hargaPaketPerjalanan']; ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jumlahTagihan" class="form-label">Jumlah Tagihan</label>
            <input type="number" class="form-control" id="jumlahTagihan" name="jumlahTagihan" value="<?php echo $data['jumlahTagihan']; ?>" readonly>
        </div>
        <a href="admin.php" class="btn btn-primary">Kembali</a>
    </div>
</body>
</html>
