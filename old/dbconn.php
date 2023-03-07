<?php
function dbconn(){
    $conn=mysqli_connect("sql300.epizy.com","epiz_33274841","thogtOMEwhKSu6W","epiz_33274841_hms");
    if(!$conn)
        die("FAILED TO CONNECT TO DATABASE".mysqli_connect_error());
    return $conn;
}
?>