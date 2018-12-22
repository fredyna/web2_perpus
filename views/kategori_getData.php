<?php
$table = 'tb_kategori';
$primaryKey = 'id';
 
$columns = array(
    array( 'db' => 'id', 'dt' => 0 ),
    array( 'db' => 'kategori','dt' => 1 ),
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