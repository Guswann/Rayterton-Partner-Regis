<?php
require '../backend/dbconnection.php';

// Ambil filter dari URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';

// Query institusi
$institusiQuery = "SELECT kode_institusi_partner AS kode, nama_institusi AS nama, email, 'Institution' AS jenis 
                   FROM rtn_ac_institusi_partner";
if ($filter === 'institution') {
    $institusiResult = $conn->query($institusiQuery);
} elseif ($filter === 'all') {
    $institusiResult = $conn->query($institusiQuery);
}

// Query individual
$individualQuery = "SELECT promo_code AS kode, nama_lengkap AS nama, email, 'Individual' AS jenis 
                    FROM rtn_ac_promocodes";
if ($filter === 'individual') {
    $individualResult = $conn->query($individualQuery);
} elseif ($filter === 'all') {
    $individualResult = $conn->query($individualQuery);
}

// Gabungkan hasil
$partners = [];
if (isset($institusiResult) && $institusiResult) {
    while ($row = $institusiResult->fetch_assoc()) {
        $partners[] = $row;
    }
}
if (isset($individualResult) && $individualResult) {
    while ($row = $individualResult->fetch_assoc()) {
        $partners[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>List Partner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">List Partner Terdaftar</h1>
        <p class="subtitle">Berikut daftar partner yang sudah mendaftar pada sistem.</p>

        <!-- Tombol ke input.php -->
        <div class="button-group" style="margin-bottom:20px;">
            <a href="input.php" class="btn primary">+ Tambah Partner</a>
        </div>

        <!-- Filter Dropdown -->
        <form method="get" style="margin-bottom:20px;">
            <label for="filter"><b>Filter Jenis Partner:</b></label>
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>Semua</option>
                <option value="individual" <?= $filter === 'individual' ? 'selected' : '' ?>>Individual</option>
                <option value="institution" <?= $filter === 'institution' ? 'selected' : '' ?>>Institution</option>
            </select>
        </form>

        <!-- Tabel List -->
        <div class="card info-card partner-list">
            <table class="partner-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jenis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($partners) > 0): ?>
                        <?php foreach ($partners as $p): ?>
                            <tr>
                                <td><?= htmlspecialchars($p['kode']) ?></td>
                                <td><?= htmlspecialchars($p['nama']) ?></td>
                                <td><?= htmlspecialchars($p['email']) ?></td>
                                <td>
                                    <span class="badge <?= strtolower($p['jenis']) ?>">
                                        <?= htmlspecialchars($p['jenis']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">Belum ada data partner</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
