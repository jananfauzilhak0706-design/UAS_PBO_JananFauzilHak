<?php
require_once 'Mahasiswa.php';

class MahasiswaBidikmisi extends Mahasiswa {
    private $nomorKipKuliah;
    private $danaSakuSubsidi;

    public function __construct($dataRow) {
        parent::__construct($dataRow);
        $this->nomorKipKuliah  = isset($dataRow['nomor_kip_kuliah']) ? $dataRow['nomor_kip_kuliah'] : '-';
        $this->danaSakuSubsidi = isset($dataRow['dana_saku_subsidi']) ? $dataRow['dana_saku_subsidi'] : 0;
    }

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

    /**
     * [Tahap 5] Overriding: Menghitung total tagihan Mahasiswa Bidikmisi
     */
    public function hitungTagihanSemester() {
        return 0;
    }

    public function tampilkanSpesifikasiAkademik() {
        echo "<strong>— Detail Skema Bidikmisi —</strong><br>";
        echo "No. KIP Kuliah   : " . $this->nomorKipKuliah . "<br>";
        echo "Subsidi Saku/Bln : Rp " . number_format($this->danaSakuSubsidi, 0, ',', '.') . "<br>";
    }
}