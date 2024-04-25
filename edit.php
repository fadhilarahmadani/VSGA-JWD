<?php
require "config.php"; // Hubungkan ke file konfigurasi database Anda

// Ambil ID dari URL
$id = $_GET['id'];

// Query untuk mengambil data berdasarkan ID
$query = "SELECT * FROM pemesanan WHERE id = '$id'";
$result = mysqli_query($conn, $query);

// Periksa apakah query berhasil dieksekusi
if($result) {
    // Ambil data dari hasil query
    $data = mysqli_fetch_assoc($result);
    
    // Ambil nilai pelayananPaket dari database
    $pelayananPaket = explode(',', $data['pelayananPaket']);
} else {
    echo "Error: " . mysqli_error($conn);
    exit();
}

// Jika tombol "Update" diklik
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap ID dari POST
    $id = $_POST['id'];

    // Tangkap data dari POST
    $nama = $_POST['nama'];
    $nomorTlp = $_POST['nomorTlp'];
    $waktuPelaksanaan = $_POST['waktuPelaksanaan'];
    $jumlahPeserta = $_POST['jumlahPeserta'];
    $pelayananPaket = implode(',', $_POST['pelayananPaket']);
    $hargaPaketPerjalanan = $_POST['hargaPaketPerjalanan'];
    $jumlahTagihan = $_POST['jumlahTagihan'];

    // Query untuk melakukan update data
    $sql = "UPDATE pemesanan SET nama='$nama', nomorTlp='$nomorTlp', waktuPelaksanaan='$waktuPelaksanaan', jumlahPeserta='$jumlahPeserta', pelayananPaket='$pelayananPaket', hargaPaketPerjalanan='$hargaPaketPerjalanan', jumlahTagihan='$jumlahTagihan' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman admin setelah update berhasil
        header("Location: admin.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit Data</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <!-- Gunakan input hidden untuk menyimpan ID -->
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pemesan</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>">
            </div>
            <div class="mb-3">
                <label for="nomorTlp" class="form-label">Nomor HP</label>
                <input type="number" class="form-control" id="nomorTlp" name="nomorTlp" value="<?php echo $data['nomorTlp']; ?>">
            </div>
            <div class="mb-3">
                <label for="waktuPelaksanaan" class="form-label">Waktu Pelaksanaan</label>
                <input type="date" class="form-control" id="waktuPelaksanaan" name="waktuPelaksanaan" value="<?php echo $data['waktuPelaksanaan']; ?>">
            </div>
            <div class="mb-3">
                <label for="jumlahPeserta" class="form-label">Jumlah Peserta</label>
                <input type="number" class="form-control" id="jumlahPeserta" name="jumlahPeserta" value="<?php echo $data['jumlahPeserta']; ?>">
            </div>
            <div class="mb-3">
                <label for="pelayananPaket" class="form-label">Pelayanan Paket</label>
                <div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Penginapan" <?php echo in_array("Penginapan", $pelayananPaket) ? "checked" : ""; ?> name="pelayananPaket[]" id="penginapan">
                        <label class="form-check-label" for="penginapan">Penginapan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Transportasi" <?php echo in_array("Transportasi", $pelayananPaket) ? "checked" : ""; ?> name="pelayananPaket[]" id="transportasi">
                        <label class="form-check-label" for="transportasi">Transportasi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="Makanan" <?php echo in_array("Makanan", $pelayananPaket) ? "checked" : ""; ?> name="pelayananPaket[]" id="makanan">
                        <label class="form-check-label" for="makanan">Makanan</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="hargaPaketPerjalanan" class="form-label">Harga Paket</label>
                <input type="number" class="form-control" id="hargaPaketPerjalanan" name="hargaPaketPerjalanan" value="<?php echo $data['hargaPaketPerjalanan']; ?>">
            </div>
            <div class="mb-3">
                <label for="jumlahTagihan" class="form-label">Jumlah Tagihan</label>
                <input type="number" class="form-control" id="jumlahTagihan" name="jumlahTagihan" value="<?php echo $data['jumlahTagihan']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
