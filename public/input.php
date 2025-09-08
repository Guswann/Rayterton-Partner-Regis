<?php
require '../backend/dbconnection.php';

// Proses insert
if (isset($_POST['submit'])) {
    $jenis_partner = $_POST['jenis_partner'];

    // Hash password biar aman
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($jenis_partner == "institution") {
        // Insert ke tabel institusi
        $stmt = $conn->prepare("INSERT INTO rtn_ac_institusi_partner 
            (kode_institusi_partner, nama_institusi, nama_partner, email, password, referral_awal, profil_jaringan, segment_industri_fokus, promo_suggestion, ACTIVE_STATUS, discount_pct) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $active_status = "1";
        $discount_pct = 0;

        $stmt->bind_param(
            "ssssssssssi",
            $_POST['kode_institusi_partner'],
            $_POST['nama_institusi'],
            $_POST['nama_partner'],
            $_POST['email'],
            $password,
            $_POST['referral_awal'],
            $_POST['profil_jaringan'],
            $_POST['segment_industri_fokus'],
            $_POST['promo_suggestion'],
            $active_status,
            $discount_pct
        );
    } else {
        // Insert ke tabel individual
        $stmt = $conn->prepare("INSERT INTO rtn_ac_promocodes
            (promo_code, nama_lengkap, email, password, referral_awal, profil_jaringan, segment_industri_fokus, promo_suggestion, ACTIVE_YN, discount_pct) 
            VALUES (?,?,?,?,?,?,?,?,?,?)");

        $active_yn = "1";
        $discount_pct = 0;

        $stmt->bind_param(
            "sssssssssi",
            $_POST['promo_code'],
            $_POST['nama_lengkap'],
            $_POST['email'],
            $password,
            $_POST['referral_awal'],
            $_POST['profil_jaringan'],
            $_POST['segment_industri_fokus'],
            $_POST['promo_suggestion'],
            $active_yn,
            $discount_pct
        );
    }

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
    <div class="container">
        <h1 class="title">Daftar Partner</h1>
        <p class="subtitle">
            Lengkapi formulir singkat berikut. Kami akan menghubungi Anda untuk langkah berikutnya.
        </p>

        <div class="grid">
            <!-- FORM -->
            <div class="card form-card">
                <form method="post">
                    <div class="form-group">
                        <label>Jenis Partner</label>
                        <select name="jenis_partner" required>
                            <option value="">-- Pilih Jenis Partner --</option>
                            <option value="individual">Individual</option>
                            <option value="institution">Institution</option>
                        </select>
                    </div>

                    <!-- Institution Fields -->
                    <div class="form-row">
                        <div class="form-group">
                            <label>Kode Institusi / Promo Code</label>
                            <input type="text" name="kode_institusi_partner" placeholder="Untuk Institution">
                            <input type="text" name="promo_code" placeholder="Untuk Individual">
                        </div>
                        <div class="form-group">
                            <label>Nama Institusi / Nama Lengkap</label>
                            <input type="text" name="nama_institusi" placeholder="Nama Institusi">
                            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email (Mandatory)</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>Whatsapp</label>
                            <input type="text" name="nama_partner" placeholder="+62xxxxxxxxxxx (untuk institusi)">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Profil & Jaringan</label>
                        <textarea name="profil_jaringan" placeholder="Ceritakan singkat profil & jaringan Anda"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Segment/Industri Fokus</label>
                        <input type="text" name="segment_industri_fokus" placeholder="Pemerintah, Keuangan, Distribusi, dsb.">
                    </div>

                    <div class="form-group">
                        <label>Promo Suggestion (code referral)</label>
                        <input type="text" name="promo_suggestion">
                    </div>

                    <div class="form-group">
                        <label>Referral Awal</label>
                        <input type="text" name="referral_awal" placeholder="Nama/Perusahaan (opsional)">
                    </div>

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
            </div>
        </div>
    </div>
</body>
</html>
