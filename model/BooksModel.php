<?php
$path = dirname(__DIR__);
require_once($path.'/config/Koneksi.php');

class BooksModel extends Koneksi{
    private $table = 'tb_buku';

    public function getData(){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = 'SELECT * FROM '.$this->table;
            $stmt = $conn->prepare($query); 
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function getDataById($id){
        try {
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM ".$this->table." WHERE id='$id'";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
        catch(PDOException $e) {
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function addData($data){
        $judul   = $data['judul'];
        $pengarang      = $data['pengarang'];
        $kategori       = $data['kategori'];

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO ".$this->table." (judul, pengarang, kategori) 
            VALUES('$judul','$pengarang','$kategori')";
            $conn->exec($query);
            return true;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function updateData($id, $data){
        $judul   = $data['judul'];
        $pengarang      = $data['pengarang'];
        $kategori       = $data['kategori'];

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($judul != ''){
                $query = "UPDATE ".$this->table." set judul='$judul', pengarang='$pengarang', kategori='$kategori' WHERE id='$id'";
            } else{
                $query = "UPDATE ".$this->table." set judul='$judul', pengarang='$pengarang', kategori='$kategori' WHERE id='$id'";
            }

            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->rowCount() > 0 ? true:false;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function deleteData($id){
        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "DELETE FROM ".$this->table." WHERE id='$id'";
            $conn->exec($query);
            return true;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }
}

?>