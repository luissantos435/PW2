<?php
    session_start();
    if((!isset($_SESSION['conta'])==true) and (!isset($_SESSION['senha'])==true))
    {
        unset ($_SESSION['conta']);
        unset ($_SESSION['senha']);
        header('location:index.html');
    }
	$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
    $usuario=$_SESSION['conta'];

    $consulta = $conexao->query("SELECT * FROM conta WHERE usuario='$usuario'");

    while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
    {
		$tipo=$campo['tipo'];
    }
    if($tipo!="A")
    {
        unset ($_SESSION['conta']);
        unset ($_SESSION['senha']);
        header('location:index.html');
    }
	else
	{
		date_default_timezone_set('America/Sao_Paulo');
		$matricula=$_GET['matricula'];
		$professor=$_GET['professor'];
		$cel=$_GET['celular'];
		$tel=$_GET['telefone'];
		$email=$_GET['email'];
		$data = date('Y-m-d', strtotime($_GET['data']));
		$apm=$_GET['valor'];
		$sql = "UPDATE professores SET Nome = ?, Telefone = ?, Celular = ?, Email = ?,  Dia = ?, Valor = ? WHERE Matricula = ? ";
		$stmt = $conexao->prepare($sql);
		$stmt->bindParam(1,$professor);
		$stmt->bindParam(2,$tel);
		$stmt->bindParam(3,$cel);
		$stmt->bindParam(4,$email);
		$stmt->bindParam(5,$data);
		$stmt->bindParam(6,$apm);
		$stmt->bindParam(7,$matricula);
		$resultado = $stmt->execute();
		if($resultado)
		{	
			echo "<script>alert('Alterado com Sucesso');</script>";
			echo "<script>location.href='apm_exibir.php?escolha=2'</script>";
		}
		else
		{
			echo var_dump($stmt->errorInfo());
		}
	}
?>