<?php
define('SERVER','localhost:3306');
define('USER','user');
define('PASSWORD','123');
define('DB','bookdb');
function connect(){
    $conn=mysqli_connect(SERVER,USER,PASSWORD,DB);
    if(!$conn){
        die('connection failed'.mysqli_connect_error());
    }
    return $conn;
}
function disconnect($conn){
    mysqli_close($conn);
}
function selectAllRounder($conn,$sql){
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row;
}
?>