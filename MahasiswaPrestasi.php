<?php
// Panggil berkas induk
require_once 'Mahasiswa.php';

// SUBCLASS: MahasiswaPrestasi
class MahasiswaPrestasi extends Mahasiswa {
    // Properti Tambahan Spesifik Anak
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct($dataRow) {
        parent::__construct($dataRow);
        
        // Pemetaan atribut spesifik dari kolom database
        $this->namaInstansiBeasiswa = isset($dataRow['nama_instansi_beasiswa']) ? $dataRow['nama_instansi_beasiswa'] : '-';
        $this->minimalIpkSyarat     = isset($dataRow['minimal_ipk_syarat']) ? $dataRow['minimal_ipk_syarat'] : 0.00;
    }

    /**
     * Metode Query Spesifik untuk Mahasiswa Jalur Prestasi
     * @param mysqli $db - Objek koneksi database
     * @return array - Kumpulan objek MahasiswaPrestasi
     */
    public static function getDaftarPrestasi($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Prestasi'";
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
        return $this->tarifUktNominal;
    }

    // Mengimplementasikan metode abstrak dari kelas induk
    public function tampilkanSpesifikasiAkademik() {
        echo "<strong>— Detail Skema Prestasi —</strong><br>";
        echo "Sponsor Beasiswa : " . $this->namaInstansiBeasiswa . "<br>";
        echo "Syarat Minimal IPK: " . $this->minimalIpkSyarat . "<br>";
    }
}