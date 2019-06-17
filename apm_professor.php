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
				$professor=$_GET['professor'];
				$tel=$_GET['telefone'];
				$cel=$_GET['celular'];
				$email=$_GET['email'];
				$data = date('Y-m-d', strtotime($_GET['data']));
				$apm=$_GET['valor'];
				$sql="insert into professores (Matricula,Nome,Email,Telefone,Celular,Dia,Valor) values (:parametro1,:parametro2,:parametro3,:parametro4,:parametro5,:parametro6,:parametro7)";
				$stmt = $conexao->prepare($sql);
				$stmt->bindParam(':parametro1',$matricula);
				$stmt->bindParam(':parametro2',$professor);
				$stmt->bindParam(':parametro3',$email);
				$stmt->bindParam(':parametro4',$tel);
				$stmt->bindParam(':parametro5',$cel);
				$stmt->bindParam(':parametro6',$data);
				$stmt->bindParam(':parametro7',$apm);
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
				echo "ERRO:".$e->getMessenge();
			}
		}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cadastro de Professor</title>
<link href="css/estilo.css" type="text/css" rel="stylesheet">
<link href="css/estilo_do_menu.css" type="text/css" rel="stylesheet">
</head>
<style>
fieldset{text-align:center; margin:0px 30% 10px;}
form{text-align:center;}
main{text-align:center;background-color:#444;color:#fff}
</style>
<body>
	<header>
		<img src="img/logo_etec_2019.png">
	</header>
	<main>
		<h1>Cadastro de Colaborador: PROFESSOR</h1><br>
		<fieldset>
			<form method="get" action="#">
				<p><label>Numero da Matricula:</p>
				<p><input type="number" required name="matricula" size="11" value="#"></label></p>
				<p><label>Nome Completo do Aluno:</p>
				<p><input type="text" name="professor" required size="50"></label></p>
				<p><label>Telefone:
				<input type="tel" name="telefone" required size="13" placeholder="(00)0000-0000"></label>
				<label>Celular:
				<input type="tel" name="celular" required size="13" placeholder="(00)90000-0000"></label></p>
				<p><label>E-Mail:</p>
				<p><input type="email" name="email" required size="50" placeholder="juaozinho@exemplo.com"></label></p>
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