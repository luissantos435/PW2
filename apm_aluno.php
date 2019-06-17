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
?>
	<?php
		date_default_timezone_set('America/Sao_Paulo');
		if(isset($_GET['cadastrar']))
		{
			try{
				$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
				$matricula=$_GET['matricula'];
				$aluno=$_GET['aluno'];
				$tel=$_GET['telefone'];
				$email=$_GET['email'];
				$data = date('Y-m-d', strtotime($_GET['data']));
				$apm=$_GET['valor'];
				$sql="insert into aluno (Matricula,Aluno,Telefone,Email,Dia,APM) values (:parametro1,:parametro2,:parametro3,:parametro4,:parametro5,:parametro6)";
				$stmt = $conexao->prepare($sql);
				$stmt->bindParam(':parametro1',$matricula);
				$stmt->bindParam(':parametro2',$aluno);
				$stmt->bindParam(':parametro3',$tel);
				$stmt->bindParam(':parametro4',$email);
				$stmt->bindParam(':parametro5',$data);
				$stmt->bindParam(':parametro6',$apm);
				$resultado = $stmt->execute();
				if($resultado)
				{
					echo "<script>alert('Envio com Sucesso');</script>";
				}else
				{
					echo var_dump($stmt->errorInfo());
				}
				
			}
			catch(PDOException $e){
				echo "ERRO:".$e->getMessage();
			}
		}
	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario Aluno</title>
	<link href="css/estilo.css" type="text/css" rel="stylesheet">
	<link href="css/estilo_do_menu.css" type="text/css" rel="stylesheet">
</head>
<style type="text/css">
fieldset{text-align:center; margin:0 30% 10px;}
form{text-align:center;}
main{text-align:center;background-color:#444;color:#fff}
</style>
<body>
	<header>
		<img src="img/logo_etec_2019.png">
	</header>
	<main>
		<h1>Cadastro de Colaborador: ALUNO</h1><br>
		<fieldset>
			<form method="get" action="#">
				<p><label>Numero da Matricula:</p>
				<p><input type="number" required name="matricula" size="11" value="#"></label></p>
				<p><label>Nome Completo do Aluno:</p>
				<p><input type="text" name="aluno" required size="50"></label></p>
				<p><label>Telefone:</p>
				<p><input type="tel" name="telefone" required size="13"></label></p>
				<p><label>E-Mail:</p>
				<p><input type="email" name="email" required size="50"></label></p>
				<p><label>Data:</p>
				<p><input type="date" name="data" required size="11"></label></p>
				<p><label>Contribuição APM:</p>
				<p><input type="number" name="valor" size="5"></label></p>
				<button type="submit" name="cadastrar">Matricular</button>
			</form>
		</fieldset>
    </main>
</body>
</html>
