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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Partner List</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Registered Partner List</h1>
        <p class="subtitle">Below is the list of partners who have registered in the system.</p>

        <!-- Button to input.php -->
        <div class="button-group" style="margin-bottom:20px;">
            <a href="input.php" class="btn primary">+ Add Partner</a>
        </div>

        <!-- Filter Dropdown -->
        <form method="get" style="margin-bottom:20px;">
            <label for="filter"><b>Filter by Partner Type:</b></label>
            <select name="filter" id="filter" onchange="this.form.submit()">
                <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>All</option>
                <option value="individual" <?= $filter === 'individual' ? 'selected' : '' ?>>Individual</option>
                <option value="institution" <?= $filter === 'institution' ? 'selected' : '' ?>>Institution</option>
            </select>
        </form>

        <!-- Partner List Table -->
        <div class="card info-card partner-list">
            <table class="partner-table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
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
                                        <?= htmlspecialchars($p['jenis'] === 'individual' ? 'Individual' : 'Institution') ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="text-align:center;">No partner data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
