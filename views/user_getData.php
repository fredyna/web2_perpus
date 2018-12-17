<?php
$table = 'tb_user';
$primaryKey = 'id';
 
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'usernames','dt' => 1 ),
    array( 'db' => 'nama','dt' => 2 ),
    array( 'db' => 'email','dt' => 3 ),
);
 
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'tugas_perpus',
    'host' => 'localhost'
);
require('../library/ssp.class.php');
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);