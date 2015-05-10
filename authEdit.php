<?php
session_start();
if (isset($_SESSION['user'])) {
    $_SESSION['id'] = $_GET['id'];
    if ($_SESSION['user'] == $_SESSION['id']) {
        header("Location:./configPessoa.php");
    } else {
        header("Location:./perfilPessoa.php");
    }
} else {
    header("Location:./index.php");
}
?>