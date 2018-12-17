<?php

    require_once('../controller/UsersController.php');
    $user = new UsersController();

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $user->delete($id);
    } else{
        $result = false;
        echo json_encode($result);
    }

?>