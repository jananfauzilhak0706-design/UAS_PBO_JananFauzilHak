<?php
// 1. Mengaktifkan error reporting untuk mempermudah debugging jika ada kesalahan typo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Import file koneksi dan seluruh komponen kelas OOP Mahasiswa
require_once 'koneksi.php';
require_once 'Mahasiswa.php';
require_once 'MahasiswaMandiri.php';
require_once 'MahasiswaBidikmisi.php';
require_once 'MahasiswaPrestasi.php';

// 3. Instansiasi koneksi database dan ambil objek koneksinya
$database = new Koneksi();
$dbConnection = $database->getConn(); 

// 4. SOLUSI REVISI: Mengambil data secara dinamis & terkelompok langsung lewat method subclass (Tahap 4)
$listMandiri   = MahasiswaMandiri::getDaftarMandiri($dbConnection);
$listBidikmisi = MahasiswaBidikmisi::getDaftarBidikmisi($dbConnection);
$listPrestasi  = MahasiswaPrestasi::getDaftarPrestasi($dbConnection);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UAS PBO - Dashboard Registrasi UKT Mahasiswa</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { display: flex; height: 100vh; background-color: #f1f5f9; color: #334155; }
        
        /* --- SIDEBAR STYLE --- */
        .sidebar { width: 260px; background-color: #1e293b; color: #fff; display: flex; flex-direction: column; }
        .sidebar .brand { padding: 24px 20px; text-align: center; font-size: 18px; font-weight: bold; background-color: #0f172a; letter-spacing: 1px; }
        .sidebar .brand span { color: #3b82f6; }
        .sidebar .menu { list-style: none; padding: 20px 0; flex-grow: 1; }
        .sidebar .menu li a { display: block; padding: 15px 25px; color: #94a3b8; text-decoration: none; font-size: 14px; border-left: 4px solid transparent; }
        .sidebar .menu li a.active { background-color: #334155; color: #fff; border-left-color: #3b82f6; }

        /* --- MAIN CONTENT --- */
        .main-content { flex-grow: 1; display: flex; flex-direction: column; overflow-y: auto; }
        .header { background-color: #fff; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
        .content-body { padding: 40px; }
        
        /* --- KATEGORI TITLE --- */
        .section-title { font-size: 16px; font-weight: bold; margin: 35px 0 15px 0; padding-bottom: 8px; border-bottom: 2px solid #e2e8f0; display: flex; align-items: center; gap: 10px; }
        .title-mandiri { color: #e11d48; }
        .title-bidikmisi { color: #059669; }
        .title-prestasi { color: #2563eb; }

        /* --- CARD INTERFACE VIEW (DINAMIS) --- */
        .grid-mahasiswa { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
        .card-mhs { background-color: #fff; padding: 22px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border-top: 5px solid #3b82f6; display: flex; flex-direction: column; justify-content: space-between; }
        
        .card-mandiri { border-top-color: #e11d48; }
        .card-bidikmisi { border-top-color: #059669; }
        .card-prestasi { border-top-color: #2563eb; }

        .info-block { font-size: 14px; line-height: 1.7; margin-bottom: 14px; }
        .spesifik-box { background-color: #f8fafc; padding: 12px; border-radius: 8px; border: 1px solid #e2e8f0; font-size: 13px; color: #475569; margin-bottom: 15px; line-height: 1.6; }
        .tagihan-total { font-size: 14px; font-weight: bold; color: #1e293b; padding-top: 12px; border-top: 1px dashed #e2e8f0; display: flex; justify-content: space-between; align-items: center; }
        .tagihan-total span { color: #ef4444; font-size: 15px; }
        .tagihan-gratis { color: #059669 !important; font-size: 14px !important; background: #d1fae5; padding: 2px 8px; border-radius: 4px; }
    </style>
</head>
<body>

    <aside class="sidebar">
        <div class="brand">SIAKAD<span>_UAS</span></div>
        <ul class="menu">
            <li><a href="index.php" class="active">📊 Dashboard UKT Mahasiswa</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <header class="header">
            <div>
                <h1 style="font-size: 20px;">Registrasi & Pembayaran Kuliah</h1>
                <p style="font-size: 12px; color: #64748b; margin-top: 2px;">Data Mahasiswa TI-1D Terpusat</p>
            </div>
            <div style="font-weight: 600; color: #475569; font-size: 14px;">Semester Genap 2026</div>
        </header>

        <div class="content-body">

            <div class="section-title title-mandiri">🔴 Kategori: Mahasiswa Mandiri (Reguler + Biaya Praktikum)</div>
            <div class="grid-mahasiswa">
                <?php if (empty($listMandiri)): ?>
                    <p style="color: #94a3b8; font-style: italic; font-size: 14px;">Tidak ada data mahasiswa skema Mandiri.</p>
                <?php else: ?>
                    <?php foreach ($listMandiri as $mhs): ?>
                        <div class="card-mhs card-mandiri">
                            <div class="info-block">
                                <?php $mhs->infoDasarMahasiswa(); ?>
                            </div>
                            <div class="spesifik-box">
                                <?php $mhs->tampilkanSpesifikasiAkademik(); ?>
                            </div>
                            <div class="tagihan-total">
                                Total Tagihan: <span>Rp <?php echo number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="section-title title-bidikmisi">🟢 Kategori: Mahasiswa Bidikmisi / KIP-Kuliah (Subsidi Negara)</div>
            <div class="grid-mahasiswa">
                <?php if (empty($listBidikmisi)): ?>
                    <p style="color: #94a3b8; font-style: italic; font-size: 14px;">Tidak ada data mahasiswa skema Bidikmisi.</p>
                <?php else: ?>
                    <?php foreach ($listBidikmisi as $mhs): ?>
                        <div class="card-mhs card-bidikmisi">
                            <div class="info-block">
                                <?php $mhs->infoDasarMahasiswa(); ?>
                            </div>
                            <div class="spesifik-box">
                                <?php $mhs->tampilkanSpesifikasiAkademik(); ?>
                            </div>
                            <div class="tagihan-total">
                                Total Tagihan: <span class="tagihan-gratis">Gratis (Lunas Negara)</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>


            <div class="section-title title-prestasi">🔵 Kategori: Mahasiswa Prestasi (Potongan Beasiswa 75%)</div>
            <div class="grid-mahasiswa">
                <?php if (empty($listPrestasi)): ?>
                    <p style="color: #94a3b8; font-style: italic; font-size: 14px;">Tidak ada data mahasiswa skema Prestasi.</p>
                <?php else: ?>
                    <?php foreach ($listPrestasi as $mhs): ?>
                        <div class="card-mhs card-prestasi">
                            <div class="info-block">
                                <?php $mhs->infoDasarMahasiswa(); ?>
                            </div>
                            <div class="spesifik-box">
                                <?php $mhs->tampilkanSpesifikasiAkademik(); ?>
                            </div>
                            <div class="tagihan-total">
                                Total Tagihan: <span>Rp <?php echo number_format($mhs->hitungTagihanSemester(), 0, ',', '.'); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>
    </main>

</body>
</html>