<?php
class Mahasiswa{
    //list of property
    
    protected $nim, $nama;

    function setData($nim, $nama){
        $this->nim = $nim;
        $this->nama =$nama;
    }

    function getData(){
        $mhs  = ['nim' =>$this->nim , 'nama' =>$this->nama];
        return $mhs;
    }

    function printData($data = null){
        if(!is_null($data)){
            foreach($data as $key => $value){
                echo "<h1>",$value, "</h1>";
            }
            echo"<br>";
        }
    }
}

?>