<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Admin Table</h2>
        <div class="text-end mb-3">
            <a href="tambah.php" class="btn btn-primary btn-sm">Tambah Data</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Nama Pemesan</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Waktu Pelaksanaan</th>
                    <th scope="col">Jumlah Peserta</th>
                    <th scope="col">Pelayanan Paket</th>
                    <th scope="col">Harga Paket</th>
                    <th scope="col">Jumlah Tagihan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Hubungkan ke database
                require "config.php";
                // var_dump($_POST);
                // Fungsi delete
                if(isset($_GET['delete'])) {
                    $id = $_GET['delete'];
                    // Menampilkan pesan konfirmasi menggunakan JavaScript
                    echo "<script>
                            var confirmDelete = confirm('Apakah Anda yakin ingin menghapus data ini?');
                            if (confirmDelete) {
                                // Jika user mengonfirmasi, hapus data dari database dan redirect
                                window.location.href = 'admin.php?confirm_delete=$id';
                            } else {
                                // Jika user membatalkan, kembali ke halaman admin
                                window.location.href = 'admin.php';
                            }
                        </script>";
                }

                // Fungsi untuk menghapus data setelah konfirmasi
                if(isset($_GET['confirm_delete'])) {
                    $id = $_GET['confirm_delete'];
                    // Hapus data dari database
                    mysqli_query($conn, "DELETE FROM pemesanan WHERE id=$id");
                    // Redirect kembali ke halaman ini setelah berhasil menghapus
                    header('location:admin.php');
                    exit(); // Pastikan untuk keluar dari skrip setelah redirect
                }

                // Query untuk mengambil data dari tabel pesanan
                $query = "SELECT * FROM pemesanan";
                $result = mysqli_query($conn, $query);

                // Periksa apakah query berhasil dieksekusi
                if ($result) {
                    // Tampilkan data dalam tabel
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nomorTlp'] . "</td>";
                        echo "<td>" . $row['waktuPelaksanaan'] . "</td>";
                        echo "<td>" . $row['jumlahPeserta'] . "</td>";
                        // var_dump($row['pelayananPaket']); 
                        echo "<td>" . $row['pelayananPaket'] . "</td>";
                        echo "<td>" . $row['hargaPaketPerjalanan'] . "</td>";
                        echo "<td>" . $row['jumlahTagihan'] . "</td>";
                        echo '<td>
                        <a href="detail.php?id=' . $row["id"] . '" class="btn btn-info btn-sm">Detail</a>
                        <a href="edit.php?id=' . $row["id"] . '" class="btn btn-primary btn-sm">Edit</a>
                        <a href="admin.php?delete=' . $row["id"] . '" class="btn btn-danger btn-sm">Delete</a>
                      </td>';
                echo "</tr>";
                        echo "</tr>";
                    }
                } else {
                    // Tampilkan pesan jika query tidak berhasil dieksekusi
                    echo "<tr><td colspan='8'>Data tidak tersedia.</td></tr>";
                }

                // Tutup koneksi database
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
