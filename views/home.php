<?php
echo "<h1>Hi! User ".$_SESSION['username']."</h1>";
?>
<button type="submit" onclick="signout()">signout</button>
<br>
<?php 
$sql=next_previous();
get_all_books($sql);
?>

<script>
function signout(){
    location='index.php?page=signout';
}
</script>