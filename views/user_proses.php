<?php 

    require_once('../controller/UsersController.php');
    $user = new UsersController();
    if(isset($_POST['action'])){
        $action = $_POST['action'];
    } else{
        return;
    }

    if($action == 'simpan'){
        $data = json_decode($_POST['data']);
        $data = [
            'nama'        => $data->nama,
            'email'       => $data->email,
            'usernames'   => $data->usernames,
            'password'    => $data->password
        ];
        $user->add($data);
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $data = json_decode($_POST['data']);
        $new_data = [
            'nama'        => $data->nama,
            'email'       => $data->email,
            'usernames'   => $data->usernames,
            'password'    => $data->password
        ];

        $user->update($id, $new_data);
    }
?>