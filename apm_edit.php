<?php
    session_start();
    if((!isset($_SESSION['conta'])==true) and (!isset($_SESSION['senha'])==true))
    {
        unset ($_SESSION['conta']);
        unset ($_SESSION['senha']);
        header('location:index.html');
	}
	date_default_timezone_set('America/Sao_Paulo');
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
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Formulario de Edição</title>
	<link href="css/estilo.css" type="text/css" rel="stylesheet">
	<link href="css/estilo_do_menu.css" type="text/css" rel="stylesheet">
</head>
<style type="text/css">
fieldset{text-align:center; margin:0 30% 10px;}
form{text-align:center;}
main{text-align:center;background-color:#444;color:#fff}
</style>
<?php
$escolha = $_GET['escolha'];
$matricula = $_GET['Matricula'];
$conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');
if($escolha==3)
{
	$sql = "SELECT * FROM aluno WHERE Matricula =?";
	$consulta = $conexao->prepare($sql);
	$consulta->bindParam(1,$matricula);
	$consulta->execute();
	while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
	{
	echo
	"<body>
		<header>
			<img src='img/logo_etec_2019.png'>
		</header>
		<main>
			<h1>Cadastro de Colaborador: ALUNO</h1><br>
			<fieldset>
				<form method='get' action='apm_alter_alun.php?'>
					<p>Numero da Matricula:</p>
					<p><input type='number' required name='matricula' size='11' value='".$campo['Matricula']."'></label></p>
					<p><label>Nome Completo do Aluno:</p>
					<p><input type='text' name='aluno' required size='50' value='".$campo['Aluno']."'></label></p>
					<p><label>Telefone:</p>
					<p><input type='tel' name='telefone' required size='13' value='".$campo['Telefone']."'></label></p>
					<p><label>E-Mail:</p>
					<p><input type='email' name='email' required size='50' value='".$campo['Email']."'></label></p>
					<p><label>Data:</p>
					<p><input type='date' name='data' required size='11' value='".$campo['Dia']."'></label></p>
					<p><label>Contribuição APM:</p>
					<p><input type='number' name='valor' size='5' value='".$campo['APM']."'></label></p>
					<button type='submit' name='edit'>Alterar</button>
				</form>
			</fieldset>
		</main>
	</body>";
	}
}
else if($escolha==2)
{
	$sql = "SELECT * FROM professores WHERE Matricula =?";
	$consulta = $conexao->prepare($sql);
	$consulta->bindParam(1,$matricula);
	$consulta->execute();
	while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
	{
	echo "
	<body>
		<header>
			<img src='img/logo_etec_2019.png'>
		</header>
		<main>
			<h1>Cadastro de Colaborador: PROFESSOR</h1><br>
			<fieldset>
				<form method='get' action='apm_alter_prof.php?'>
					<p><label>Numero da Matricula:</p>
					<p><input type='number' required name='matricula' size='11' value='".$campo['Matricula']."'></p>
					<p><label>Nome Completo do Aluno:</p>
					<p><input type='text' name='professor' required size='50' value='".$campo['Nome']."'></label></p>
					<p><label>Telefone:
					<input type='tel' name='telefone' required size='13' placeholder='(00)0000-0000' value='".$campo['Telefone']."'></label>
					<label>Celular:
					<input type='tel' name='celular' required size='13' placeholder='(00)90000-0000' value='".$campo['Celular']."'></label></p>
					<p><label>E-Mail:</p>
					<p><input type='email' name='email' required size='50' placeholder='juaozinho@exemplo.com' value='".$campo['Email']."'></label></p>
					<p><label>Data:</p>
					<p><input type='date' name='data' required size='11' value='".$campo['Dia']."'></label></p>
					<p><label>Contribuição APM:</p>
					<p><input type='number' name='valor' size='5' value='".$campo['Valor']."'></label></p>
					<button type='submit' name='edit'>Alterar</a>
				</form>
			</fieldset>
		</main>
	</body>";
	}
}	
?>
</html>