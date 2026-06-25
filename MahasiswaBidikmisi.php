<?php
// Panggil berkas induk
require_once 'Mahasiswa.php';

// SUBCLASS: MahasiswaBidikmisi
class MahasiswaBidikmisi extends Mahasiswa {
    // Properti Tambahan Spesifik Anak
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct($dataRow) {
        parent::__construct($dataRow);
        
        // Pemetaan atribut spesifik dari kolom database
        $this->nomorKipKuliah  = isset($dataRow['nomor_kip_kuliah']) ? $dataRow['nomor_kip_kuliah'] : '-';
        $this->danaSakuSubsidi = isset($dataRow['dana_saku_subsidi']) ? $dataRow['dana_saku_subsidi'] : 0;
    }

    /**
     * Metode Query Spesifik untuk Mahasiswa Jalur Bidikmisi
     * @param mysqli $db - Objek koneksi database
     * @return array - Kumpulan objek MahasiswaBidikmisi
     */
    public static function getDaftarBidikmisi($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Bidikmisi'";
        $result = $db->query($query);
        
        $kumpulanObjek = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kumpulanObjek[] = new self($row);
            }
        }
        return $kumpulanObjek;
    }

    // Mengimplementasikan metode abstrak dari kelas induk
    public function hitungTagihanSemester() {
        return 0;
    }

    // Mengimplementasikan metode abstrak dari kelas induk
    public function tampilkanSpesifikasiAkademik() {
        echo "<strong>— Detail Skema Bidikmisi —</strong><br>";
        echo "No. KIP Kuliah   : " . $this->nomorKipKuliah . "<br>";
        echo "Subsidi Saku/Bln : Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.') . "<br>";
    }
}