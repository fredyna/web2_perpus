<?php
$table = 'users';
$primaryKey = 'id';
 
$columns = array(
    array( 'db' => 'usernames','dt' => 0 ),
    array( 'db' => 'nama','dt' => 1 ),
    array( 'db' => 'email','dt' => 2 ),
    array( 'db' => 'id', 'dt' => 3 ),
);
 
$sql_details = array(
    'user' => 'root',
    'pass' => '',
    'db'   => 'tugas_perpus',
    'host' => 'localhost'
);
require('ssp.class.php');
 
echo json_encode(
    SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns )
);