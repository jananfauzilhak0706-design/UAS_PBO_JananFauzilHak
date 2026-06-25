<?php
require_once 'Mahasiswa.php';

class MahasiswaMandiri extends Mahasiswa {
    private $golonganUkt;
    private $namaWali;

    public function __construct($dataRow) {
        parent::__construct($dataRow);
        $this->golonganUkt = isset($dataRow['golongan_ukt']) ? $dataRow['golongan_ukt'] : 0;
        $this->namaWali    = isset($dataRow['nama_wali']) ? $dataRow['nama_wali'] : '-';
    }

    public static function getDaftarMandiri($db) {
        $query = "SELECT * FROM tabel_mahasiswa WHERE jenis_pembiayaan = 'Mandiri'";
        $result = $db->query($query);
        
        $kumpulanObjek = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kumpulanObjek[] = new self($row);
            }
        }
        return $kumpulanObjek;
    }

    /**
     * [Tahap 5] Overriding: Menghitung total tagihan Mahasiswa Mandiri
     */
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal + 100000;
    }

    public function tampilkanSpesifikasiAkademik() {
        echo "<strong>— Detail Skema Mandiri —</strong><br>";
        echo "Golongan UKT: " . $this->golonganUkt . "<br>";
        echo "Nama Wali   : " . $this->namaWali . "<br>";
    }
}