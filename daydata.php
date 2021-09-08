<?php

header('Content-Type: application/json');

include('mysqli.php');
include('configdbtest.php');


//connect db
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "error".$conn->connect_errno;
    exit();
} else {
    //wait for query all data
    $mdata = array();
    $resQuery = pare_mysqli_prepare($conn,"SELECT `calendar` ,sum(`kwh`) as sum_kwh from admin_testtec.data group by `calendar`;",null);
    foreach ($resQuery as $row) {
        $mdata[] = $row;
    }
    echo json_encode($mdata);
    pare_mysqli_close($resQuery);

    // $resQuery = pare_mysqli_prepare($conn,'SELECT i1, i2, i3 FROM admin_testtec.data WHERE date ="2021-04-01";', null);
}
$conn -> close();
?>