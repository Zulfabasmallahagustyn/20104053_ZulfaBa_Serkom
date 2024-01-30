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
    <title>View Hasil Beasiswa</title>
</head>
<body>
    <?php
    // Sertakan file konfigurasi
    require_once "config.php";
    // Ambil data dari database
    $sql = "SELECT * FROM beasiswa";
    $result = $conn->query($sql);
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
        <!-- Judul halaman view hasil beasiswa -->
        <h2>View Hasil Beasiswa</h2>
        <!-- Table view hasil beasiswa -->
        <table>
            <tr>
                <!-- Kolom Nama -->
                <th>Nama</th>
                <!-- Kolom Email -->
                <th>Email</th>
                <!-- Kolom Nomor HP -->
                <th>Nomor HP</th>
                <!-- Kolom Semester -->
                <th>Semester</th>
                <!-- Kolom IPK -->
                <th>IPK</th>
                <!-- Kolom Pilihan Beasiswa -->
                <th>Pilihan Beasiswa</th>
                <!-- Kolom Berkas -->
                <th>Berkas</th>
                <!-- Kolom Status Ajuan -->
                <th>Status Ajuan</th>
            </tr>

            <?php
            // Array untuk menyimpan jumlah mahasiswa berdasarkan jenis beasiswa
            $academicCount = 0;
            $nonAcademicCount = 0;

            // Periksa apakah ada data yang diambil dari database
            if ($result->num_rows > 0) {
                // Loop untuk menampilkan setiap baris data dalam tabel
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row["nama"]}</td>
                            <td>{$row["email"]}</td>
                            <td>{$row["no_hp"]}</td>
                            <td>{$row["semester"]}</td>
                            <td>{$row["ipk"]}</td>
                            <td>{$row["beasiswa"]}</td>
                            <td>{$row["berkas"]}</td>
                            <td>{$row["status_ajuan"]}</td>
                        </tr>";

                    // Hitung jumlah mahasiswa berdasarkan jenis beasiswa
                    if ($row["beasiswa"] === "Akademik") {
                        $academicCount++;
                    } elseif ($row["beasiswa"] === "Non-Akademik") {
                        $nonAcademicCount++;
                    }
                }
            } else {
                // Jika tidak ada data, tampilkan pesan
                echo "<tr><td colspan='8'>Tidak ada data</td></tr>";
            }
            ?>

            <!-- Chart Lingkaran -->
            <div style="width: 400px; height: 400px; margin: 0 auto;">
                <canvas id="pieChart"></canvas>
            </div>
        </table>
    </div>

    <!-- Sisipkan Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Inisialisasi data untuk chart
        var data = {
            labels: ['Akademik', 'Non-Akademik'],
            datasets: [{
                label: 'Jumlah Mahasiswa Berdasarkan Beasiswa',
                data: [<?php echo $academicCount; ?>, <?php echo $nonAcademicCount; ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)'
                ],
                borderWidth: 1
            }]
        };

        // Konfigurasi chart
        var options = {
            responsive: true,
            maintainAspectRatio: false
        };

        // Mendapatkan elemen canvas
        var ctx = document.getElementById('pieChart').getContext('2d');

        // Membuat chart lingkaran
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    </script>
</body>
</html>
