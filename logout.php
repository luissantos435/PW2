<?php
    session_start();
    unset ($_SESSION['conta']);
    unset ($_SESSION['senha']);
    header('location:index.html');
?>