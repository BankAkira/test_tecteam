<?php 

include('mysqli.php');
include('configdbtest.php');

//connect db
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_errno) {
    echo "error".$conn->connect_errno;
    exit();
} else {
    //wait for quuery
    pare_mysqli_prepare_and_close(
        $conn,'INSERT INTO `admin_testtec`.`data` (`date`, `time`, `powerused`, `v1`, `v2`, `v3`, `i1`, `i2`, `i3`, `p1`, `p2`, `p3`, `pf`, `hz`, `kwh`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);','sssssssssssssss',
        $_GET['date'],$_GET['time'],$_GET['powerused'],$_GET['v1'],$_GET['v2'],$_GET['v3'],$_GET['i1'],$_GET['i2'],$_GET['i3'],$_GET['p1'],$_GET['p2'],$_GET['p3'],$_GET['pf'],$_GET['hz'],$_GET['kwh']);
    echo 'ok';
// https://bankakira.work/testtec/recvdat.php?date=20%2F3%2F2021&time=23%3A30&powerused=0.01&v1=233.5&v2=233.7&v3=232.4&i1=0.32&i2=0.31&i3=0.31&p1=0&p2=0&p3=10&pf=0.12&hz=50.01&kwh=0.0025
    
}

?>