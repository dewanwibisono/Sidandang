<?php
$db_host = "10.10.40.181";
$db_user = "root";
$db_pass = "";
$db_name = "sipekerba";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function insertPengaduan($data)
{
    global $conn;
    date_default_timezone_set('Asia/Jakarta');
    $id = $data['id'];
    $nk = htmlspecialchars($data["nip"]);
    $np = htmlspecialchars($data["nama"]);
    $tlp = htmlspecialchars($data["telpon"]);
    $jp = htmlspecialchars($data["jabatan"]);
    $dp = htmlspecialchars($data["dept"]);
    $nb = htmlspecialchars($data["nama_barang"]);
    $ket = mysqli_real_escape_string($conn, $data["ket"]);
    $status = "Sedang diajukan";
    $ket_petugas = "-";
    $tgl_lapor = date("Y-m-d");

    mysqli_query($conn, "INSERT INTO pengaduan VALUES('$id','$nk', '$np','$tlp', '$jp', '$dp', '$nb', '$ket', '$status', '$ket_petugas', NOW())");
    $text = "Pengaduan Dengan No.Tiket  : " . $id . " NIP/NITK  : " . $nk . " Nama Pengadu  : " . $np . "  Nomor WhatsApp Pengadu   : " . $tlp . "    Unit Kerja/Instalasi  : " . $dp . "  Dengan Keterangan Keluhan    : " . $ket . "  Silahkan segera di proses, Terimakasih!";
    file_get_contents("https://api.telegram.org/bot6619274555:AAFFSr7SpD_ewmwPnOfJGTH34u0iDl_hloM/sendMessage?chat_id=798436254&text=" . $text);
    return mysqli_affected_rows($conn);
}

function registrasi($data)
{
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $name = htmlspecialchars($data["name"]);
    $nip = htmlspecialchars($data["nip"]);
    $img = "default.jpg";
    $status = "0";

    $cek = mysqli_query($conn, "SELECT username, user_id FROM user WHERE username = '$username' OR user_id = '$nip'");

    if (mysqli_fetch_assoc($cek)) {
        echo "<script>alert('Username $username or NIP $nip was already registered!');</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($conn, "INSERT INTO user VALUES('$nip', '$username', '$password', '$name', '$img', '$status')");

    return mysqli_affected_rows($conn);
}

function updatePass($data)
{
    global $conn;

    $id = $data['id'];
    $password_baru = mysqli_real_escape_string($conn, $data["password_baru"]);
    $password_baru = password_hash($password_baru, PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE user SET password='$password_baru' WHERE user_id='$id'");

    return mysqli_affected_rows($conn);
}

function updatePengaduan($data)
{
    global $conn;

    $id = $data['id'];
    $status = $data['status'];
    $ket_petugas = $data['ket_petugas'];
    mysqli_query($conn, "UPDATE pengaduan SET status = '$status', ket_petugas='$ket_petugas' WHERE id='$id'");

    $text = "Pengaduan Dengan No.Tiket  : " . $id . "  Dengan Keterangan dari petugas    : " . $ket_petugas . " Status :" . $status . ", Terimakasih!";
    file_get_contents("https://api.telegram.org/bot6619274555:AAFFSr7SpD_ewmwPnOfJGTH34u0iDl_hloM/sendMessage?chat_id=798436254&text=" . $text);

    return mysqli_affected_rows($conn);
}

function updatePhoto($data)
{
    global $conn;

    $id = $_SESSION['login']['user_id'];

    $rand = rand();
    $ekstensi =  array('png', 'jpg', 'jpeg');
    $filename = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    if (!in_array($ext, $ekstensi)) {
        echo "<script>alert('Ekstensi tidak diperbolehkan atau Anda belum memilih file apapun.'); window.location='profil.php';</script>";
    } else {
        if ($ukuran < 2044070) {
            $xx = $rand . '_' . $filename;
            move_uploaded_file($_FILES['foto']['tmp_name'], '../assets/img/profile/' . $rand . '_' . $filename);

            mysqli_query($conn, "UPDATE user SET img = '$xx' WHERE user_id='$id'");
        } else {
            echo "<script>alert('Size file terlalu beasr! Size yang diperbolehkan tidak melebihi 2 MB.'); window.location='profil.php';</script>";
        }
    }
    return mysqli_affected_rows($conn);
}

function deleteUser($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM user WHERE user_id = '$id'");
    return mysqli_affected_rows($conn);
}

function deletePengaduan($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pengaduan WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

function searchPengaduan($keyword)
{
    global $conn;
    $data = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id = '$keyword'");
    return mysqli_affected_rows($conn);
}
