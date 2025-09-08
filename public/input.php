<?php
require '../backend/dbconnection.php';

// Proses insert
if (isset($_POST['submit'])) {
    $jenis_partner = $_POST['jenis_partner'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($jenis_partner == "institution") {
        // Insert ke tabel institusi_partner
        $stmt = $conn->prepare("INSERT INTO institusi_partner 
            (kode_institusi_partner, nama_institusi, nama_partner, whatsapp, email, password, profil_jaringan, segment_industri_fokus, promo_suggestion, referral_awal, active_status, discount_pct) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        $active_status = 1;
        $discount_pct = 0;

        $stmt->bind_param(
            "ssssssssssii",
            $_POST['kode_institusi_partner'],
            $_POST['nama_institusi'],
            $_POST['nama_partner'],
            $_POST['whatsapp'],
            $_POST['email'],
            $password,
            $_POST['profil_jaringan'],
            $_POST['segment_industri_fokus'],
            $_POST['promo_suggestion'],
            $_POST['referral_awal'],
            $active_status,
            $discount_pct
        );
    } else {
        // Insert ke tabel individual_promocodes
        $stmt = $conn->prepare("INSERT INTO individual_promocodes
            (promo_code, nama_lengkap, whatsapp, email, password, profil_jaringan, segment_industri_fokus, promo_suggestion, referral_awal, active_yn, discount_pct) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $active_yn = 1;
        $discount_pct = 0;

        $stmt->bind_param(
            "ssssssssssi",
            $_POST['promo_code'],
            $_POST['nama_lengkap'],
            $_POST['whatsapp'],
            $_POST['email'],
            $password,
            $_POST['profil_jaringan'],
            $_POST['segment_industri_fokus'],
            $_POST['promo_suggestion'],
            $_POST['referral_awal'],
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Partner Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script>
        function toggleFields() {
            const partnerType = document.querySelector('select[name="jenis_partner"]').value;
            const institutionFields = document.querySelectorAll('.institution-only');
            const individualFields = document.querySelectorAll('.individual-only');

            if (partnerType === 'individual') {
                institutionFields.forEach(field => {
                    field.style.display = 'none';
                    // Kosongkan dan nonaktifkan field agar tidak dikirim
                    if (field.tagName === 'INPUT' || field.tagName === 'TEXTAREA') {
                        field.value = '';
                    }
                });
                individualFields.forEach(field => {
                    field.style.display = 'block';
                });
            } else if (partnerType === 'institution') {
                individualFields.forEach(field => {
                    field.style.display = 'none';
                    if (field.tagName === 'INPUT' || field.tagName === 'TEXTAREA') {
                        field.value = '';
                    }
                });
                institutionFields.forEach(field => {
                    field.style.display = 'block';
                });
            } else {
                // Jika belum memilih
                individualFields.forEach(field => field.style.display = 'none');
                institutionFields.forEach(field => field.style.display = 'none');
            }
        }

        // Jalankan saat halaman dimuat dan saat ganti tipe
        document.addEventListener('DOMContentLoaded', function() {
            toggleFields(); // Sembunyikan semua saat load
            document.querySelector('select[name="jenis_partner"]').addEventListener('change', toggleFields);
        });
    </script>
    <style>
        .individual-only,
        .institution-only {
            display: none;
        }

        .form-row {
        display: flex;
        gap: 20px; /* Jarak antar kolom: 20px (bisa diatur) */
        margin-bottom: 15px;
        flex-wrap: wrap; /* Agar responsive di mobile */
        }

        .form-group {
            flex: 1;
            min-width: 200px; /* Minimal lebar agar tidak terlalu kecil di mobile */
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
            font-size: 0.95rem;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: 'Inter', sans-serif;
        }

        .button-group {
            margin-top: 20px;
            text-align: right;
        }

        .btn {
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        .btn.primary {
            background-color: #0056b3;
            color: white;
        }

        .btn.secondary {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Partner Registration</h1>
        <p class="subtitle">
            Complete the short form below. We will contact you for the next steps.
        </p>

        <div class="grid">
            <!-- FORM -->
            <div class="card form-card">
                <form method="post">
                    <div class="form-group">
                        <label>Partner Type</label>
                        <select name="jenis_partner" required>
                            <option value="">-- Select Partner Type --</option>
                            <option value="individual">Individual</option>
                            <option value="institution">Institution</option>
                        </select>
                    </div>
                    

                    <!-- Row: Institution Code & Name (side by side) -->
                    <div class="form-row">
                        <div class="form-group institution-only">
                            <label>Institution Code</label>
                            <input type="text" name="kode_institusi_partner" placeholder="...." required>
                        </div>
                        <div class="form-group institution-only">
                            <label>Institution Name</label>
                            <input type="text" name="nama_institusi" placeholder="Company or Institution Name" required>
                        </div>
                    </div>

                    <!-- Row: Partner Name (full width, di bawah) -->
                    <div class="form-row">
                        <div class="form-group institution-only">
                            <label>Partner Name (PIC)</label>
                            <input type="text" name="nama_partner" placeholder="Person in charge (PIC)" required>
                        </div>
                    </div>

                    <!-- Row: Promo Code & Full Name (untuk Individual) -->
                    <div class="form-row">
                        <div class="form-group individual-only">
                            <label>Promo Code</label>
                            <input type="text" name="promo_code" placeholder="...." required>
                        </div>
                        <div class="form-group individual-only">
                            <label>Full Name</label>
                            <input type="text" name="nama_lengkap" placeholder="Your Full Name" required>
                        </div>
                    </div>

                    <!-- Contact Info (Email & WhatsApp - berdampingan) -->
                    <div class="form-row">
                        <div class="form-group">
                            <label>Email (Mandatory)</label>
                            <input type="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label>WhatsApp Number</label>
                            <input type="text" name="whatsapp" placeholder="+62 812-3456-7890" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label>Profile & Network</label>
                        <textarea name="profil_jaringan" placeholder="Briefly describe your profile and network" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Industry Focus / Segment</label>
                        <input type="text" name="segment_industri_fokus" placeholder="e.g. Government, Finance, Education">
                    </div>

                    <div class="form-group">
                        <label>Promo Suggestion (Referral Code)</label>
                        <input type="text" name="promo_suggestion" placeholder="Suggested referral code">
                    </div>

                    <div class="form-group">
                        <label>Referred By (Optional)</label>
                        <input type="text" name="referral_awal" placeholder="Partner name or company (if any)">
                    </div>

                    <div class="button-group">
                        <button type="submit" name="submit" class="btn primary">Submit Registration</button>
                        <!-- <button type="button" class="btn secondary">Contact Us on WhatsApp</button> -->
                    </div>
                </form>
            </div>

            <!-- INFO BOX -->
            <div class="card2 info-card">
                <h2>What Happens After Registration?</h2>
                <ol>
                    <li>Data verification and training alignment.</li>
                    <li>Kick-off call: product overview and referral process.</li>
                    <li>Issuance of unique referral link/code, promotional materials, and PIC contact.</li>
                </ol>
            </div>
        </div>
    </div>
</body>

<script>
    function toggleFields() {
        const partnerType = document.querySelector('select[name="jenis_partner"]').value;
        const institutionFields = document.querySelectorAll('.institution-only input, .institution-only textarea');
        const individualFields = document.querySelectorAll('.individual-only input, .individual-only textarea');

        if (partnerType === 'individual') {
            // Hide institution fields
            institutionFields.forEach(field => {
                field.parentElement.style.display = 'none';
                field.required = false;
                field.value = '';
            });
            // Show individual fields
            individualFields.forEach(field => {
                field.parentElement.style.display = 'block';
                field.required = true;
            });
        } else if (partnerType === 'institution') {
            // Hide individual fields
            individualFields.forEach(field => {
                field.parentElement.style.display = 'none';
                field.required = false;
                field.value = '';
            });
            // Show institution fields
            institutionFields.forEach(field => {
                field.parentElement.style.display = 'block';
                field.required = true;
            });
        } else {
            // Jika belum pilih
            institutionFields.forEach(field => {
                field.parentElement.style.display = 'none';
                field.required = false;
            });
            individualFields.forEach(field => {
                field.parentElement.style.display = 'none';
                field.required = false;
            });
        }
    }
</script>

</html>