<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/BooksModel.php');

    class BooksController{

        public function getAll(){
            $buku = new BooksModel();
            $data = $buku->getData();
            return $data;
        }

        public function getAllJson(){
            $buku = new BooksModel();
            $result = $buku->getData();
            $data = [];
            while($row = $result->fetch())
            {
                $data[] = $row;
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        }

        public function getById($id){
            $buku = new BooksModel();
            $result = $buku->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $buku = new BooksModel();
            $save = $buku->addData($data);
            if($save){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }

        public function update($id, $data){
            $buku = new BooksModel();
            $update = $buku->updateData($id, $data);
            if($update){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }

        public function delete($id){
            $buku = new BooksModel();
            $delete = $buku->deleteData($id);
            if($delete){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }
    }

?>