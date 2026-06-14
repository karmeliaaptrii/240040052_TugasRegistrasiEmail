<?php

include "koneksi.php";

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$nama = $_POST['nama'];
$email = $_POST['email'];

mysqli_query(
    $koneksi,
    "INSERT INTO peserta(nama,email)
     VALUES('$nama','$email')"
);

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();

    $mail->Host = 'smtp.gmail.com';

    $mail->SMTPAuth = true;

    $mail->Username = 'karmeliaaptrii13@gmail.com';

    $mail->Password = 'gpbubqiotrzxuwst';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;

    $mail->setFrom(
        'karmeliaaptrii13@gmail.com',
        'Sistem Registrasi'
    );

    $mail->addAddress($email, $nama);

    $mail->isHTML(true);

    $mail->Subject = 'Konfirmasi Pendaftaran';

    $mail->Body = "
        <h2>Pendaftaran Berhasil</h2>

        Halo <b>$nama</b>,

        <br><br>

        Terima kasih telah melakukan pendaftaran.

        <br><br>

        Data Anda telah berhasil tersimpan.
    ";

    $mail->send();

    echo "
    <h2>Registrasi Berhasil</h2>
    <p>Email konfirmasi berhasil dikirim.</p>
    <a href='index.php'>Kembali</a>
    ";

} catch (Exception $e) {

    echo "
    Registrasi berhasil disimpan,
    tetapi email gagal dikirim.
    <br><br>
    Error :
    ".$mail->ErrorInfo;
}
?>