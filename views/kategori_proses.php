<?php 

    require_once('../controller/KategoriController.php');
    $kategori = new KategoriController();
    if(isset($_POST['action'])){
        $action = $_POST['action'];
    } else{
        return;
    }

    if($action == 'simpan'){
        $data = json_decode($_POST['data']);
        $data = [
            'kategori'  => $data->kategori
        ];
        $kategori->add($data);
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $data = json_decode($_POST['data']);
        $new_data = [
            'kategori' => $data->kategori
        ];

        $kategori->update($id, $new_data);
    }
?>