<?php
// Sertakan file konfigurasi
require_once "config.php";

// Periksa apakah permintaan adalah metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai dari formulir
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $no_hp = $_POST["no_hp"];
    $semester = $_POST["semester"];
    $beasiswa = $_POST["beasiswa"];
    $ipk = $_POST["ipk"];
    
    // Setel status ajuan ke "Belum diverifikasi"
    $status_ajuan = "Belum diverifikasi";

    // Proses upload berkas
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["berkas"]["name"]);

    move_uploaded_file($_FILES["berkas"]["tmp_name"], $target_file);

    // Simpan data ke database
    $sql = "INSERT INTO beasiswa (nama, email, no_hp, semester, ipk, beasiswa, berkas, status_ajuan)
            VALUES ('$nama', '$email', '$no_hp', '$semester', '$ipk', '$beasiswa', '$target_file', '$status_ajuan')";

    // Periksa apakah query berhasil dieksekusi
    if ($conn->query($sql) === TRUE) {
        // Redirect ke halaman tampilan
        header("Location: view.php");
    } else {
        // Tampilkan pesan kesalahan jika query gagal dieksekusi
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Tutup koneksi database
    $conn->close();
}
?>
