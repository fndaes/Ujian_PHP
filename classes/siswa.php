<?php
class Siswa
{
    public $nama;
    public $kelas;
    private $nilai;
    public function __construct($nama, $kelas, $nilai)
    {
        $this->nama = $nama;
        $this->kelas = $kelas;
        $this->nilai = $nilai;
    }
    public function getNilai()
    {
        return $this->nilai;
    }
    public function predikat()
    {
        $nilai = $this->getNilai();
        if ($nilai >= 85) {
            return "A";
        } elseif ($nilai >= 75) {
            return "B";
        } elseif ($nilai >= 60) {
            return "C";
        } else {
            return "D";
        }
    }
    public function lulus()
    {
        return $this->getNilai() >= 75;
    }
}
