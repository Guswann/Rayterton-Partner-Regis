<?php
require '../backend/dbconnection.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Partner</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Data Institusi Partner</h2>
    <p><a href="input.php">+ Tambah Data</a></p>
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
