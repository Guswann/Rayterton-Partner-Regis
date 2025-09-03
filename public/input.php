<?php
require '../backend/dbconnection.php';

// Proses insert
if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("INSERT INTO rtn_ac_institusi_partner 
        (kode_institusi_partner, nama_institusi, nama_partner, email, password, referral_awal, profil_jaringan, segment_industri_fokus, promo_suggestion, ACTIVE_STATUS, discount_pct) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param(
        "ssssssssssi",
        $_POST['kode_institusi_partner'],
        $_POST['nama_institusi'],
        $_POST['nama_partner'],
        $_POST['email'],
        $_POST['password'],
        $_POST['referral_awal'],
        $_POST['profil_jaringan'],
        $_POST['segment_industri_fokus'],
        $_POST['promo_suggestion'],
        $_POST['ACTIVE_STATUS'],
        $_POST['discount_pct']
    );

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Data Partner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <form method="post">
            <h2>Tambah Data Partner</h2>
            <div class="form-grid">
                <input type="text" name="kode_institusi_partner" placeholder="Kode Institusi Partner">
                <input type="text" name="nama_institusi" placeholder="Nama Institusi">

                <input type="text" name="nama_partner" placeholder="Nama Partner">
                <input type="email" name="email" placeholder="Email (primary key)" required>

                <input type="password" name="password" placeholder="Password">
                <input type="text" name="promo_suggestion" placeholder="Promo Suggestion (4 huruf)">

                <textarea name="referral_awal" placeholder="Referral Awal" class="form-full"></textarea>
                <textarea name="profil_jaringan" placeholder="Profil Jaringan" class="form-full"></textarea>
                <textarea name="segment_industri_fokus" placeholder="Segment Industri Fokus" class="form-full"></textarea>

                <input type="text" name="ACTIVE_STATUS" placeholder="Status Aktif (1/0)">
                <input type="number" name="discount_pct" placeholder="Discount (%)">

                <input type="submit" name="submit" value="Simpan" class="form-full">
            </div>
            <p><a href="index.php">← Lihat Data</a></p>
        </form>
    </div>
</body>
</html>
