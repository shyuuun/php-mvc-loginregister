<?php 
require_once(__DIR__.'/includes/session-functions.php');
require_once(__DIR__.'/includes/alert-functions.php');

?>

<?php 
    if(isset($_SESSION["first_name"])) {
        echo 'Welcome' , $_SESSION["first_name"];
?>      <a href="/logout.php">Logout</a>
<?php   } else { 
        echo 'Welcome Guest';
    }?>


