<?php session_start();
require_once('../con/con.php');  ?>

<script>
    function home(){
        location.href = "../home.php";
    }
    function signout(){
        location.href = "../signout.php";
    }
    
  

</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<?php


if(!isset($_COOKIE['username'])){
    echo "<script>signout();</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" 
      type="image/png" 
      href="../img/twists.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/home.css">
    <title>Home</title>
</head>
<body class="text-center">
      <div class="container">
          
     
            <form class="form-signin" action="checkin" method="POST">
              <img  src="../img/twists.png" alt="" width="100" height="72">
              <h1 class="h3 mb-3 font-weight-normal">Welcome <?php echo $_COOKIE['username'] ?>!</h1>
              <?php
              if(isset($_GET['regkeyid'])){
                $sql1 = "select * from participant where regkey=".$_GET['regkeyid']." and checkin='no'";

                $sql="update participant set checkin='yes' where regkey='".$_GET['regkeyid']."'";
                $db = new DB();
                $conn = $db->connect();
                $result=$db->get_data($conn,$sql1);
              
                if(mysqli_num_rows($result) > 0){
                  if($db->set_data($conn,$sql)){
                    echo "<h4 style='color:green'> Participant checked In</h4>
                    <script>location.href = 'index'</script>
                    ";
                   }else{
                    echo "<h4 style='color:red'> Participant not found".mysqli_error($conn)."</h4>";
                   }
                }else{
                  echo "<h4 style='color:red'> Participant not found or already Checked in.</h4>";
                }
                
                $db->disconnect($conn);
            }
              ?>
              <label for="inputEmail" class="sr-only">Participant's Key</label>
              <input type="text" name="regkey" class="form-control" placeholder="Participant's Key" required autofocus>
              <br/>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Check In</button>
              <button class="btn btn-lg btn-secondary btn-block"  type="button" onclick="home()">Home</button>
              
         
            </form>
          </div>
          <?php
          if(isset($_POST['regkey'])){
              $sql = "select * from participant where regkey='".$_POST['regkey']."'";
              $db = new DB();
              $conn = $db->connect();
              $result=$db->get_data($conn,$sql);
              $row =mysqli_fetch_assoc($result);
             echo '<script type="text/javascript">
            $(document).ready(function(){
            $("#exampleModal").modal("show");
            });
            function checked(id){
                location.href="/checkin.php?regkeyid="+id
            }
            </script>
            <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Check In</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <h3>Do Youy Want to check in
        '.$row["email"].' ?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="checked('.$_POST['regkey'].')">Check In</button>
      </div>
    </div>
  </div>
</div>';
$db->disconnect($conn);
          }
          
          
         ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>
