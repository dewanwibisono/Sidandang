<?php
include 'templates/header.php';

?>
<h1 class="display-5">Sistem Informasi Pengaduan Dan Gangguan SIMRS</h1>
<p class="lead">Jangan ambil pusing! Sampaikan kepada kami.</p>
<div class="jumbotron-search">
    <p class="lead mt-2">Ajukan pengaduan Anda</p>
    <a href="form-pengaduan.php" class="btn btn-primary sub-button"><span class="fas fa-chevron-right mr-2"></span>Disini</a>
</div>
<br>
<br>
<br>
<br>
<br>

<div class="jumbotron-search">
    <form action="search.php" method="POST">
        <p class="lead" style="margin-bottom: -1px;">Cek status pengaduan Anda</p>
        <input type="text" name="keyword" id="keyword" placeholder="Masukkan nomor pengaduan Anda disini">
        <button type="submit" class="btn btn-primary search-button" value="cari"><span class="fas fa-search mr-2"></span>Cek</button>
    </form>
</div>
<?php
include 'templates/footer.php';
?>
