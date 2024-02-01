<?php
// Kode ini digunakan untuk mengimpor file konfigurasi yang berisi informasi untuk menghubungkan ke database.
require_once 'config.php';

// Mendapatkan nilai variabel nama yang dikirim melalui metode POST dari file JavaScript.
$nama = $_POST['nama'];

// Membuat query untuk mengambil nilai ipk dari tabel data di database berdasarkan nama yang diterima dari file JavaScript.
$query = "SELECT ipk FROM data WHERE nama='$nama'";

// Menjalankan query pada database menggunakan koneksi database yang dibuat sebelumnya. Hasil dari query disimpan di variabel $result.
$result = mysqli_query($conn, $query);


// Mengecek apakah ada baris yang ditemukan dari hasil query. Jika ada, maka nilai ipk akan diambil dari baris pertama hasil query dan dikirim kembali ke file JavaScript untuk ditampilkan. Jika tidak ada, maka string kosong akan dikirim kembali ke file JavaScript.
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    echo $row['ipk'];
} else {
    echo "";
}

// Menutup koneksi database yang dibuat sebelumnya untuk menghemat sumber daya server.
mysqli_close($conn);
