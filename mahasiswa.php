<?php
class Mahasiswa {
    protected $nim, $nama;

    function setData($nim, $nama){
        $this->nim = $nim;
        $this->nama =$nama;
    }

    public function getNim() {
        return $this->nim;
    }
    public function getNama() {
        return $this->nama;
    }
}

?>