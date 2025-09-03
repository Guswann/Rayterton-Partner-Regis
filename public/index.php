<?php
require '../backend/dbconnection.php';

// --- Insert Data ---
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
    <title>Data Institusi Partner</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post">
        <h2>Tambah Data Partner</h2>
        <input type="text" name="kode_institusi_partner" placeholder="Kode Institusi Partner">
        <input type="text" name="nama_institusi" placeholder="Nama Institusi">
        <input type="text" name="nama_partner" placeholder="Nama Partner">
        <input type="email" name="email" placeholder="Email (primary key)" required>
        <input type="password" name="password" placeholder="Password">
        <textarea name="referral_awal" placeholder="Referral Awal"></textarea>
        <textarea name="profil_jaringan" placeholder="Profil Jaringan"></textarea>
        <textarea name="segment_industri_fokus" placeholder="Segment Industri Fokus"></textarea>
        <input type="text" name="promo_suggestion" placeholder="Promo Suggestion (4 huruf)">
        <input type="text" name="ACTIVE_STATUS" placeholder="Status Aktif (1/0)">
        <input type="number" name="discount_pct" placeholder="Discount (%)">
        <input type="submit" name="submit" value="Simpan">
    </form>

    <h2>Data Institusi Partner</h2>
    <table>
        <tr>
            <th>Kode Institusi</th>
            <th>Nama Institusi</th>
            <th>Nama Partner</th>
            <th>Email</th>
            <th>Password</th>
            <th>Referral Awal</th>
            <th>Profil Jaringan</th>
            <th>Segment Industri Fokus</th>
            <th>Promo Suggestion</th>
            <th>Status Aktif</th>
            <th>Discount (%)</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM rtn_ac_institusi_partner ORDER BY nama_institusi ASC");
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $val) {
                    echo "<td>" . htmlspecialchars($val ?? '', ENT_QUOTES, 'UTF-8') . "</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='11' style='text-align:center;'>Belum ada data</td></tr>";
        }
        ?>
    </table>
</body>

</html>
<?php $conn->close(); ?>