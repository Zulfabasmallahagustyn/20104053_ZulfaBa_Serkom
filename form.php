<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Set karakter encoding ke UTF-8 -->
    <meta charset="UTF-8">
    <!-- Atur tampilan responsif untuk perangkat berbagai ukuran -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Sisipkan file CSS untuk mengatur tata letak dan gaya halaman -->
    <link rel="stylesheet" href="style.css">
    <!-- Judul halaman web -->
    <title>Form Daftar Beasiswa</title>
</head>
<body>
    <?php
     // Sertakan file konfigurasi
    require_once "config.php";
    // Asumsikan IPK
    $random_ipk = number_format(rand(250, 400) / 100, 1);
    define("IPK", $random_ipk)
    ?>

    <!-- Bagian menu navigasi -->
    <div class="menu">
        <!-- Judul halaman utama -->
        <h1>Pendaftaran Beasiswa</h1>
        <!-- Daftar menu navigasi -->
        <ul>
            <!-- Tautan ke halaman Pilihan Beasiswa -->
            <li><a href="beasiswa.php">Pilihan Beasiswa</a></li>
            <!-- Tautan ke halaman Form Daftar Beasiswa -->
            <li><a href="form.php">Form Daftar Beasiswa</a></li>
            <!-- Tautan ke halaman View Hasil Beasiswa -->
            <li><a href="view.php">View Hasil Beasiswa</a></li>
        </ul>
    </div>
    
    <!-- Bagian konten utama-->
    <div class="content">
        <!-- Judul halaman daftar beasiswa -->
        <h2>Form Daftar Beasiswa</h2>
        <!-- Form daftar beasiswa -->
        <form action="process.php" method="post" enctype="multipart/form-data">
            <!-- Input Nama wajib diisi -->
            <label for="nama">Nama:</label>
            <input type="text" name="nama" required>
            <!-- Input Email wajib diisi -->
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <!-- Input Nomor HP wajib diisi -->
            <label for="no_hp">Nomor HP:</label>
            <input type="number" name="no_hp" required>
            <!-- Pilihan Semester Saat Ini wajib dipilih -->
            <label for="semester">Semester Saat Ini:</label>
            <select name="semester" required>
                <?php
                // Loop untuk membuat pilihan semester
                for ($i = 1; $i <= 8; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <!-- Input IPK (otomatis terisi) -->
            <label for="ipk">IPK Terakhir:</label>
            <input type="text" name="ipk" value="<?= $random_ipk; ?>" readonly>
            <!-- Pilihan Jenis Beasiswa wajib dipilih dinonaktifkan jika IPK kurang dari 3 -->
            <label for="beasiswa">Pilihan Beasiswa:</label>
            <select name="beasiswa" required <?= ($random_ipk < 3) ? 'disabled' : ''; ?>>
                <option value="Akademik">Beasiswa Akademik</option>
                <option value="Non-Akademik">Beasiswa Non-Akademik</option>
            </select>
            <!-- Upload Berkas wajib diupload dinonaktifkan jika IPK kurang dari 3 -->
            <label for="berkas">Upload Berkas:</label>
            <input type="file" name="berkas" required <?= ($random_ipk < 3) ? 'disabled' : ''; ?>>
            <!-- Tombol Submit dinonaktifkan jika IPK kurang dari 3 -->
            <input type="submit" value="Daftar" <?= ($random_ipk < 3) ? 'disabled' : ''; ?>>
            <!-- Tombol Batal -->
            <input type="button" value="Batal" onclick="window.location.href='index.php';">
        </form>
    </div>
</body>
</html>
