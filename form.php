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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Form Daftar Beasiswa</title>
</head>
<body>
    <?php
     // Sertakan file konfigurasi
    require_once "config.php";
    // Dapatkan IPK
    if (isset($_POST['ipk'])) { $ipk = $_POST['ipk']; } else { $ipk = ''; };
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
            <input id="nama" type="text" name="nama" required>
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
            <!-- Input IPK -->
            <label for="ipk">IPK Terakhir:</label>
            <input type="number" name="ipk" id="ipk" value="<?= $ipk; ?>" readonly required>
            <!-- Pilihan Jenis Beasiswa wajib dipilih dinonaktifkan jika IPK kurang dari 3 -->
            <label for="beasiswa">Pilihan Beasiswa:</label>
            <select name="beasiswa" id="beasiswa" required disabled>
                <option value="Akademik">Beasiswa Akademik</option>
                <option value="Non-Akademik">Beasiswa Non-Akademik</option>
            </select>
            <!-- Upload Berkas wajib diupload dinonaktifkan jika IPK kurang dari 3 -->
            <label for="berkas">Upload Berkas:</label>
            <input type="file" name="berkas" id="berkas" required disabled>
            <!-- Tombol Submit dinonaktifkan jika IPK kurang dari 3 -->
            <input type="submit" value="Daftar" id="submit" disabled>
            <!-- Tombol Batal -->
            <input type="button" value="Batal" onclick="window.location.href='index.php';">

            <script>
            // Script dijalankan saat halaman sudah siap ditampilkan.
            $(document).ready(function() {
                // Run this function every time the IPK value changes
                    $('#ipk').change(function() {
                        // Get the IPK value from the input field
                        var ipk = $(this).val();
                    
                        if (ipk > 3) {
                            // Move the focus to the "Jenis Beasiswa" field
                            $('#beasiswa').focus();
                        }
                    });
                // Menangani input dari user pada elemen dengan id 'nama' ketika terjadi event 'input'
                $('#nama').on('input', function() {

                    // Mengambil nilai input dari elemen dengan id 'nama' yang diinputkan oleh user.
                    var nama = $(this).val();

                    // Melakukan ajax request ke server menggunakan fungsi ajax() dengan mengirim data berupa nama yang diinputkan oleh user pada form pendaftaran.
                    $.ajax({
                        url: 'get_ipk.php',
                        type: 'post',
                        data: {
                            nama: nama
                        },


                        // Ketika ajax request sukses, script akan mengambil nilai ipk yang diterima dari server dan memasukkan nilai tersebut ke dalam elemen dengan id 'ipk'. Jika nilai ipk kurang dari 3, maka tombol 'beasiswa', 'berkas', dan 'daftar' akan dinonaktifkan dengan menggunakan fungsi prop(). Jika nilai ipk lebih atau sama dengan 3, maka tombol-tombol tersebut akan diaktifkan kembali.
                        success: function(response) {
                            $('#ipk').val(response);
                            if (response < 3) {
                                $('#beasiswa').prop('disabled', true);
                                $('#berkas').prop('disabled', true);
                                $('#submit').prop('disabled', true);
                            } else {
                                $('#beasiswa').prop('disabled', false);
                                $('#berkas').prop('disabled', false);
                                $('#submit').prop('disabled', false);
                            }
                        }
                    });
                });
            });
        </script>
        </form>
    </div>
</body>
</html>
