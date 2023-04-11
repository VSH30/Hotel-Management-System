<?php
function dbconn(){
    $conn=mysqli_connect("","","","");
    if(!$conn)
        die("FAILED TO CONNECT TO DATABASE".mysqli_connect_error());
    return $conn;
}
?>
