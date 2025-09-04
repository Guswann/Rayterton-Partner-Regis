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
    <title>Daftar Partner</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- MAIN CONTENT -->
    <div class="container">
        <h1 class="title">Daftar Partner</h1>
        <p class="subtitle">
            Lengkapi formulir singkat berikut. Kami akan menghubungi Anda untuk langkah berikutnya.
        </p>

        <div class="grid">
            <!-- FORM -->
            <div class="card form-card">
                <form method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Jenis Partner</label>
                            <input type="text" name="kode_institusi_partner" >
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap / Institusi</label>
                            <input type="text" name="nama_institusi">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email (Mandatory)</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Whatsapp (Mandatory)</label>
                            <input type="text" name="nama_partner" placeholder="+62xxxxxxxxxxx">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Profil & Jaringan</label>
                        <textarea name="profil_jaringan" placeholder="Ceritakan singkat profil & jaringan Anda"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Segment/Industri Fokus (opsional)</label>
                        <input type="text" name="segment_industri_fokus" placeholder="mis. Pemerintah, Keuangan, Distribusi, Kesehatan, dsb.">
                    </div>

                    <div class="form-group">
                        <label>Promo Suggestion (code referral)</label>
                        <input type="text" name="promo_suggestion" placeholder="">
                    </div>

                    <div class="form-group">
                        <label>Referral Awal (opsional)</label>
                        <input type="text" name="referral_awal" placeholder="Nama/Perusahaan (jika sudah ada)">
                    </div>

                    <!-- <div class="form-row">
                        <div class="form-group">
                            <label>Status Aktif (1/0)</label>
                            <input type="text" name="ACTIVE_STATUS" placeholder="1 / 0">
                        </div>
                        <div class="form-group">
                            <label>Discount (%)</label>
                            <input type="number" name="discount_pct" placeholder="0">
                        </div>
                    </div> -->

                    <div class="button-group">
                        <button type="submit" name="submit" class="btn primary">Kirim Pendaftaran</button>
                        <button type="button" class="btn secondary">WhatsApp Kami</button>
                    </div>
                </form>
            </div>

            <!-- INFO BOX -->
            <div class="card info-card">
                <h2>Apa yang Terjadi Setelah Mendaftar?</h2>
                <ol>
                    <li>Verifikasi data & kesesuaian training.</li>
                    <li>Kick-off call: pemaparan produk & proses referral.</li>
                    <li>Pemberian kode/link referral unik, materi promosi, dan kontak PIC.</li>
                </ol>
                <p class="note">
                    Kami juga menyediakan sesi enablement (produk & proses) bagi tim Anda.
                </p>

                <table>
                    <thead>
                    <tr>
                        <th>Aspek</th>
                        <th>Individual</th>
                        <th>Institution</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Skema Komisi</td>
                        <td>Persentase per deal</td>
                        <td>Persentase & opsi tier</td>
                    </tr>
                    <tr>
                        <td>Dukungan</td>
                        <td>Materi & presales</td>
                        <td>Joint marketing & enablement</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
