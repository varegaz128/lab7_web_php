<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Mini Project & Eksperimen Mandiri - Lab 7</title>
</head>
<body>

    <h1>Mini Project & Eksperimen Mandiri - Lab 7</h1>
    <hr>

    <!-- ================= MINI PROJECT ================= -->
    <h2>F. Mini Project — Aplikasi Formulir Data Mahasiswa</h2>
    <?php
    $data = null;
    $error = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit_mini"])) {
        $nama = trim($_POST["nama"] ?? "");
        $nim = trim($_POST["nim"] ?? "");
        $prodi = trim($_POST["prodi"] ?? "");
        $semesterInput = $_POST["semester"] ?? "";
        $email = trim($_POST["email"] ?? "");

        if ($nama === "") $error[] = "Nama wajib diisi.";
        if ($nim === "") $error[] = "NIM wajib diisi.";
        if ($prodi === "") $error[] = "Program studi wajib diisi.";
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = "Format email tidak valid.";
        }
        if (!ctype_digit((string)$semesterInput) ||
        (int)$semesterInput < 1 || (int)$semesterInput > 14) {
            $error[] = "Semester harus berupa angka 1–14.";
        }
        if (!$error) {
            $data = compact("nama", "nim", "prodi", "email");
            $data["semester"] = (int)$semesterInput;
        }
    }
    ?>

    <!-- Tampilan Form Mini Project -->
    <?php if (!empty($error)): ?>
        <div style="color: red;">
            <ul>
                <?php foreach ($error as $err): ?>
                    <li><?= htmlspecialchars($err) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nama: <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>"></label><br><br>
        <label>NIM: <input type="text" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>"></label><br><br>
        <label>Program Studi: <input type="text" name="prodi" value="<?= htmlspecialchars($_POST['prodi'] ?? '') ?>"></label><br><br>
        <label>Semester: <input type="number" name="semester" value="<?= htmlspecialchars($_POST['semester'] ?? '') ?>"></label><br><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"></label><br><br>
        <button type="submit" name="submit_mini">Kirim Data Mahasiswa</button>
    </form>

    <?php
    if ($data) {
        echo "<h3>Ringkasan Data Mahasiswa:</h3>";
        echo "Nama: " . htmlspecialchars($data['nama']) . "<br>";
        echo "NIM: " . htmlspecialchars($data['nim']) . "<br>";
        echo "Program Studi: " . htmlspecialchars($data['prodi']) . "<br>";
        echo "Semester: " . $data['semester'] . "<br>";
        echo "Email: " . htmlspecialchars($data['email']) . "<br>";
    }
    ?>

    <hr>

    <!-- ================= EKSPERIMEN MANDIRI ================= -->
    <h2>G. Eksperimen Mandiri</h2>
    
    <h3>1. Perhitungan Rata-Rata Nilai</h3>
    <?php
    $tugasExp = 80;
    $utsExp = 85;
    $uasExp = 90;
    $rataRata = ($tugasExp + $utsExp + $uasExp) / 3;
    echo "Nilai Tugas: $tugasExp, UTS: $utsExp, UAS: $uasExp<br>";
    echo "Rata-rata: " . number_format($rataRata, 2);
    ?>

    <h3>2. Pencarian GET dari Array Data</h3>
    <form method="GET" action="">
        <label>Cari Mahasiswa: <input type="text" name="cari_mhs" value="<?= htmlspecialchars($_GET['cari_mhs'] ?? '') ?>"></label>
        <button type="submit">Cari</button>
    </form>
    <?php
    $daftarMhs = ["Andi", "Budi", "Siti", "Dewi", "Rahmat"];
    if (isset($_GET["cari_mhs"]) && $_GET["cari_mhs"] !== "") {
        $keywordMhs = trim($_GET["cari_mhs"]);
        echo "Hasil pencarian untuk '<strong>" . htmlspecialchars($keywordMhs) . "</strong>':<ul>";
        $ditemukan = false;
        foreach ($daftarMhs as $m) {
            if (stripos($m, $keywordMhs) !== false) {
                echo "<li>" . htmlspecialchars($m) . "</li>";
                $ditemukan = true;
            }
        }
        if (!$ditemukan) {
            echo "<li>Data tidak ditemukan.</li>";
        }
        echo "</ul>";
    }
    ?>

    <h3>3. Function Format Harga Rupiah</h3>
    <?php
    function formatRupiah($angka) {
        return "Rp" . number_format($angka, 0, ",", ".");
    }
    echo formatRupiah(2500000);
    ?>

    <h3>4. Validasi NIM Angka & Panjang Tertentu (Contoh: 10 digit)</h3>
    <?php
    $pesanNim = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["cek_nim"])) {
        $inputNim = trim($_POST["input_nim"]);
        if (!ctype_digit($inputNim) || strlen($inputNim) !== 10) {
            $pesanNim = "NIM tidak valid! Harus berupa angka persis 10 digit.";
        } else {
            $pesanNim = "NIM valid: " . htmlspecialchars($inputNim);
        }
    }
    ?>
    <form method="POST">
        <label>NIM (10 Digit): <input type="text" name="input_nim"></label>
        <button type="submit" name="cek_nim">Validasi NIM</button>
    </form>
    <p><?= $pesanNim ?></p>

    <h3>5. Tombol Reset Form</h3>
    <form method="POST">
        <label>Contoh Input: <input type="text" name="contoh"></label>
        <button type="submit">Kirim</button>
        <button type="reset">Reset Form</button>
    </form>
    <p><em>Perbedaan: Tombol Reset membersihkan input di browser secara client-side, sedangkan pemrosesan ulang melibatkan server.</em></p>

</body>
</html>