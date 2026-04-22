<?php

class datauser {
    private $host = 'locahost';
    private $user = 'user';
    private $pw = '1deA050806';
    private $deb = 'users';

    public $conn;
    public function __construct() {
    $this->conn = new mysqli(
        $this->host,
        $this->user,
        $this->pw,
        $this->deb
    );
    if ($this->conn->connect_error) {
         die("koneksi gagal".$this->conn->connect_error);
    }
    }
}

?>