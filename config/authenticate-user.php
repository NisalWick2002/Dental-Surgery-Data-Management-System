<?php if (!session_id()) session_start();
if (!isset($_SESSION['authenticated'])) {
    header("Location:login.php");
    die();
}

?>