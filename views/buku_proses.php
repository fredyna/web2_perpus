<?php 

    require_once('../controller/BooksController.php');
    $buku = new BooksController();
    if(isset($_POST['action'])){
        $action = $_POST['action'];
    } else{
        return;
    }

    if($action == 'simpan'){
        $data = json_decode($_POST['data']);
        $data = [
            'judul'      => $data->judul,
            'pengarang'  => $data->pengarang,
            'kategori'   => $data->kategori
        ];
        $buku->add($data);
    }

    if($action == 'update'){
        $id = $_POST['id'];
        $data = json_decode($_POST['data']);
        $new_data = [
            'judul'      => $data->judul,
            'pengarang'  => $data->pengarang,
            'kategori'   => $data->kategori
        ];

        $buku->update($id, $new_data);
    }
?>