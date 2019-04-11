<?php
function login(){
    $sql="select password from login where username='".$_POST['username_login']."'";
    $conn=connect();
    $row=selectAllRounder($conn,$sql);
    if($_POST['password_login']==$row['password']){
        $_SESSION['username']=$_POST['username_login'];
        require('views/home.php');
    }else{
        require('views/login.php');
        echo 'credentail invalid';
    }
    disconnect($conn);
}
function next_previous(){
    $rowsPerPage = 1;
    $conn=connect();
    $pagecount=selectAllRounder($conn,'select count(*) from books');
    if(isset($_GET['id']))
        $pageNum = $_GET['id'];
    else
        $pageNum = 1;

    if($pageNum==0){
        $pageNum=$pagecount['count(*)']-1;
    }else if($pageNum==$pagecount['count(*)']){
        $pageNum=1;
    }
    if($pageNum){
        $PreviousPageNumber = $pageNum - 1;
        $NextPageNumber = $pageNum + 1;        
        echo '<a href="?id='. $PreviousPageNumber .'">Previous</a>&nbsp;';
        echo '<a href="?id='. $NextPageNumber .'">Next</a><br>';
    }
    $sql='select Book_name,ISBN,Author,Book_type,No_pages,Description,image_name from books as b inner join booktype as bt on b.Book_type_id=bt.Book_type_id limit '.$pageNum.',1';
    disconnect($conn);
    return $sql;
}
function get_all_books($sql){
    $conn=connect();
    $row=selectAllRounder($conn,$sql);
    echo "<table>";
    foreach ($row as $key => $value) {
        if($key=='image_name'){
            echo "<tr><td></td><td>";
            echo "<img src='images/".$value."'></td></tr>";
        }else{
            echo "<tr><td>".$key."</td><td>";
            echo $value."</td></tr>";
        }
        
    }
    disconnect($conn);
}
?>