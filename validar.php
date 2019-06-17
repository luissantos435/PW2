<?php
    session_start();
    $conta=$_POST['conta'];
    $senha=$_POST['senha'];
    
    $criptS=md5($senha);

    $conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
    $comando_sql="SELECT * FROM conta WHERE usuario = ? AND senha = ?";
    $busca = $conexao->prepare($comando_sql);
    $busca->bindParam(1,$conta);
    $busca->bindParam(2,$criptS);
    $busca->execute();
    
    if ($busca->rowCount()>0)
    {
        $_SESSION['conta']=$conta;
        $_SESSION['senha']=$senha;
        header('location:index.php');
    }
    else
    {
        unset ($_SESSION['conta']);
        unset ($_SESSION['senha']);
        header('location:index.html');
    }
?>