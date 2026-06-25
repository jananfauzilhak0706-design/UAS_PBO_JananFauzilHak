<?php
// Panggil berkas induk
require_once 'Mahasiswa.php';

// SUBCLASS: MahasiswaMandiri
class MahasiswaMandiri extends Mahasiswa {
    // Properti Tambahan Spesifik Anak
    private $golonganUkt;
    private $namaWali;

    public function __construct($dataRow) {
        // Meneruskan data global ke constructor class induk (Mahasiswa)
        parent::__construct($dataRow);
        
        // Pemetaan atribut spesifik dari kolom database
        $this->golonganUkt = isset($dataRow['golongan_ukt']) ? $dataRow['golongan_ukt'] : 0;
        $this->namaWali    = isset($dataRow['nama_wali']) ? $dataRow['nama_wali'] : '-';
    }

    /**
     * Metode Query Spesifik untuk Mahasiswa Jalur Mandiri
     * @param mysqli $db - Objek koneksi database
     * @return array - Kumpulan objek MahasiswaMandiri
     */
    public static function getDaftarMandiri($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'";
        $result = $db->query($query);
        
        $kumpulanObjek = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Mengonversi baris tabel menjadi objek dari kelas ini sendiri
                $kumpulanObjek[] = new self($row);
            }
        }
        return $kumpulanObjek;
    }

    // Mengimplementasikan metode abstrak dari kelas induk (sementara return default)
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal;
    }

    // Mengimplementasikan metode abstrak dari kelas induk
    public function tampilkanSpesifikasiAkademik() {
        echo "<strong>— Detail Skema Mandiri —</strong><br>";
        echo "Golongan UKT: " . $this->golonganUkt . "<br>";
        echo "Nama Wali   : " . $this->namaWali . "<br>";
    }
}