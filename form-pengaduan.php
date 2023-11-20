<?php
include 'templates/header2.php';
require 'function.php';
if (isset($_POST['submit'])) {
    if (insertPengaduan($_POST) > 0) {
        echo "<script>alert('Data pengaduan Anda berhasil terkirim.'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Data pengaduan Anda gagal terkirim.'); window.location='form-pengaduan.php';</script>";
    }
}

$query = mysqli_query($conn, "SELECT max(id) as kodeTerbesar FROM pengaduan");
$r = mysqli_fetch_array($query);
$kodeBarang = $r['kodeTerbesar'];

// mengambil angka dari kode barang terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kodeBarang, 4, 4);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;

// membentuk kode barang baru
// perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
// misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
// angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG
$huruf = "NP";
$kodeBarang = $huruf . sprintf("%04s", $urutan);
?>
<h1 style="margin-top: -40px;">Sistem Informasi Pengaduan Dan Gangguan SIMRS</h1>
<form action="" method="POST">
    <div class="form-row p-3">
        <div class="form-group">
            <label for="id">Nomor Pengaduan</label>
            <input type="text" name="id" id="id" class="form-control" value="<?= $kodeBarang; ?>" style="cursor: default;" readonly>
            <p class="text-sm"><span style="color: red;">*</span>Harap catat nomor pengaduan (nomor pengaduan digunakan untuk melihat status pengajuan perbaikan).</p>
            <div>
                <div class="form-group">
                    <label for="nama">NIP/NITK</label>
                    <input type="text" name="nip" id="nip" class="form-control" required>
                    <label for="nama">Nama Pelapor</label>
                    <input type="text" name="nama" id="nama" class="form-control" required>
                    <label for="telpon">Nomor WhatApp Pelapor</label>
                    <input type="text" name="telpon" id="telpon" class="form-control" required>
                    <div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan Pelapor</label>
                            <input type="text" name="jabatan" id="jabatan" class="form-control" required>
                            <div>
                                <div class="form-group">
                                    <label for="dept">Instalasi/Unit Kerja</label>
                                    <input type="text" name="dept" id="dept" class="form-control" required>
                                    <div>
                                        <div class="form-group">
                                            <label for="nama_barang">Nama Barang</label>
                                            <select id="month" name="nama_barang" id="nama_barang" class="custom-select mb-3" required>
                                                <option selected disabled>Pilih Perangkat </option>
                                                <option value="Hardware">Hardware</option>
                                                <option value="Software">Software</option>
                                            </select>
                                            <div>
                                                <div class="form-group">
                                                    <label for="ket">Keterangan</label>
                                                    <textarea name="ket" id="ket" class="form-control" required></textarea>
                                                    <div>
                                                        <button class="btn btn-outline-success mt-3 mr-3" type="submit" name="submit" style="width: 100px;"><span class="fas fa-paper-plane mr-2"></span>Kirim</button>
                                                        <button class="btn btn-outline-success mt-3 mr-3" type="reset" name="reset" style="width: 100px;"><span class="fa fa-undo mr-2"></span>Reset</button>
                                                        <a href="index.php" class="btn btn-outline-success mt-3 mr-3" type="submit" name="submit" style="width: 100px;"><span class="fa fa-check mr-2"></span>Status</a>

                                                        <!-- <button class="btn btn-outline-success mt-3 mr-3" type="reset" name="reset" style="width: 100px;"><span class="fas fa-paper-undo mr-2"></span>Reset Form</button>
                                                        <a href="index.php" class="btn btn-outline-danger mt-3 mr-3" type="submit" name="submit" style="width: 100px;"><span class="fas fa-check mr-1"></span>Cek Status</button> -->
                                                    </div>
</form>

<?php
include 'templates/footer.php';
?>
