<?php
    $path = dirname(__DIR__);
    require_once($path.'/model/UsersModel.php');

    class UsersController{

        public function getAll(){
            $user = new UsersModel();
            $data = $user->getData();
            return $data;
        }

        public function getAllJson(){
            $user = new UsersModel();
            $result = $user->getData();
            $data = [];
            while($row = $result->fetch())
            {
                $data[] = $row;
            }

            return json_encode($data, JSON_PRETTY_PRINT);
        }

        public function getById($id){
            $user = new UsersModel();
            $result = $user->getDataById($id);
            $rows = [];
            while($row = $result->fetch())
            {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }

        public function add($data){
            $user = new UsersModel();
            $save = $user->addData($data);
            if($save){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }

        public function update($id, $data){
            $user = new UsersModel();
            $update = $user->updateData($id, $data);
            if($update){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }

        public function delete($id){
            $user = new UsersModel();
            $delete = $user->deleteData($id);
            if($delete){
                $result = true;
            } else{
                $result = false;
            }

            echo json_encode($result);
        }
    }

?>