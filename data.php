<?php

header('Content-Type: application/json');

include('mysqli.php');
include('configdbtest.php');
$dateshow = $_GET['data'];
$newDate = $dateshow;


//connect db
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "error".$conn->connect_errno;
    exit();
} else {
    //wait for query all data
    $data = array();
    $resQuery = pare_mysqli_prepare($conn,"SELECT * FROM admin_testtec.data WHERE `calendar`= '".$newDate."' ORDER BY `id` ASC;",null);
    foreach ($resQuery as $row) {
        $data[] = $row;
    }
    echo json_encode($data);
    pare_mysqli_close($resQuery);

    // $resQuery = pare_mysqli_prepare($conn,'SELECT i1, i2, i3 FROM admin_testtec.data WHERE date ="2021-04-01";', null);
}
$conn -> close();
?>