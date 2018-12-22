<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/KategoriModel.php');

    class KategoriController{

        public function getAll(){
            $kategori = new KategoriModel();
            $data = $kategori->getData();
            return $data;
        }

        public function getAllJson(){
            $kategori = new KategoriModel();
            $result = $kategori->getData();
            $data = [];
            while($row = $result->fetch())
            {
                $data[] = $row;
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        }

        public function getById($id){
            $kategori = new KategoriModel();
            $result = $kategori->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $kategori = new KategoriModel();
            $save = $kategori->addData($data);
            if($save){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }

        public function update($id, $data){
            $kategori = new KategoriModel();
            $update = $kategori->updateData($id, $data);
            if($update){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }

        public function delete($id){
            $kategori = new KategoriModel();
            $delete = $kategori->deleteData($id);
            if($delete){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }
    }

?>