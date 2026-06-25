<?php
require_once 'Mahasiswa.php';

class MahasiswaPrestasi extends Mahasiswa {
    private $namaInstansiBeasiswa;
    private $minimalIpkSyarat;

    public function __construct($dataRow) {
        parent::__construct($dataRow);
        $this->namaInstansiBeasiswa = isset($dataRow['nama_instansi_beasiswa']) ? $dataRow['nama_instansi_beasiswa'] : '-';
        $this->minimalIpkSyarat     = isset($dataRow['minimal_ipk_syarat']) ? $dataRow['minimal_ipk_syarat'] : 0.00;
    }

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

    /**
     * [Tahap 5] Overriding: Menghitung total tagihan Mahasiswa Prestasi
     */
    public function hitungTagihanSemester() {
        return $this->tarifUktNominal * 0.25;
    }

    public function tampilkanSpesifikasiAkademik() {
        echo "<strong>— Detail Skema Prestasi —</strong><br>";
        echo "Sponsor Beasiswa : " . $this->namaInstansiBeasiswa . "<br>";
        echo "Syarat Minimal IPK: " . $this->minimalIpkSyarat . "<br>";
    }
}