<?php
$path = dirname(__DIR__);
require_once($path.'/config/Koneksi.php');

class KategoriModel extends Koneksi{
    private $table = 'tb_kategori';

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
        $kategori  = $data['kategori'];

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "INSERT INTO ".$this->table." (kategori) 
            VALUES('$kategori')";
            $conn->exec($query);
            return true;
        } catch(PDOException $e){
            // echo "Error: " . $e->getMessage();
            return false;
        }
        $conn = null;
    }

    public function updateData($id, $data){
        $kategori   = $data['kategori'];

        try{
            $conn = new PDO("mysql:host=$this->server;dbname=$this->db", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if($kategori != ''){
                $query = "UPDATE ".$this->table." set kategori ='$kategori' WHERE id='$id'";
            } else{
                $query = "UPDATE ".$this->table." set kategori ='$kategori' WHERE id='$id'";
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