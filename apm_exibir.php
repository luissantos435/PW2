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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Exibir Contribuidores</title>
<link href="css/estilo.css" type="text/css" rel="stylesheet">
<link href="css/estilo_do_menu.css" type="text/css" rel="stylesheet">
<script language="Javascript">
function confirmacaoP(P) {
     var resposta = confirm("Deseja remover esse registro?");
 
     if (resposta == true) {
          window.location.href = "apm_exibir.php?escolha=2&excluir&Matricula="+P;
     }
}
function confirmacaoA(A) {
     var resposta = confirm("Deseja remover esse registro?");
 
     if (resposta == true) {
          window.location.href = "apm_exibir.php?escolha=3&excluir&Matricula="+A;
     }
}

</script>
<script type="text/javascript" src="js/func.js"></script>
</head>
<style>
main{height:100%;text-align:center;}
tr:nth-child(even){
  background-color:#dddddd;
}
.form{border:groove;border-radius:10px;margin: 10px 10px}
</style>

<body>
	<header>
		<img src="img/logo_etec_2019.png">
	</header>
	<nav style="background-color: #333;">
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php
				if($tipo=="A")
				{
					echo "<li><a href='apm_aluno.php' target='_blank'>Cadastrar Aluno</a></li>
					<li><a href='apm_professor.php' target='_blank'>Cadastrar Professor</a></li>";
				}
			?>
			<li><button type="submit" style="border:0" class="btn" onclick="confirmacaoSair()">Sair</button><li>
			<?php
				if(isset($_GET['sair']))
				{
					unset ($_SESSION['conta']);
        			unset ($_SESSION['senha']);
        			header('location:index.html');
				}
			?>
		</ul>
	</nav>
		<form method="get" action="#" class="form">
				<select name="escolha" style="margin-left:10px">
					<option value="1" disabled selected>Escolha uma Opção</option>
					<option value="2">Professores</option>
					<option value="3">Alunos</option>
				</select>
				<button type="submit" name="ir" class="dropbtn2">Ver Todos</button>
				<label style="padding-left:53.9%"><input type='text' name='busca' placeholder='buscar' style="text-align:right"></label>
            	<button type='submit' name='buscar'>Buscar</button>
            	<label><input type='radio' name="escolha" value="2">Professor<label>
            	<label><input type='radio' name="escolha" value="3">Aluno<label>	
		</form>	
	<?php
		$escolha = $_GET['escolha'];
		
		if($escolha==2)
		{
			$consulta = $conexao->query("SELECT * FROM professores");
			
			echo "<main>
				<table border='1' style='text-align:center;width:100%' align:center width:100%>
				<tr><th colspan='9'><h2>Contribuições Professores</h2</th></tr>
				<tr>
					<th>Matricula</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Celular</th>
					<th>Email</th>
					<th>Data</th>
					<th>Valor</th>
					<th></th>
					<th></th>
			</tr>";
			
			if(isset($_GET['buscar']))
			{
				$valor = $_GET['busca'];
				$comando_sql = "SELECT * FROM professores WHERE Nome LIKE '%$valor%'";
				$consulta = $conexao->query($comando_sql);						
			}
			
			while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr>";
				echo "<td>".$campo['Matricula']."</td>";
				echo "<td>".$campo['Nome']."</td>";
				echo "<td>".$campo['Telefone']."</td>";
				echo "<td>".$campo['Celular']."</td>";
				echo "<td>".$campo['Email']."</td>";
				echo "<td>".$campo['Dia']."</td>";
				echo "<td>".$campo['Valor']."</td>";
				if($tipo=="A")
				{
				echo "<td><a href='apm_edit.php?escolha=2&Matricula={$campo['Matricula']}'><img src='img/edit.png' alt='delete' title='edit'></a></td>";
				echo "<td><a href=\"javascript:func()\" onclick=\"confirmacaoP('{$campo['Matricula']}')\"><img src='img/delete.png' alt='delete' title='excluir'></a></td>";
				}
				echo "</tr>";
			}
			echo "</main>";

			if(isset($_GET['excluir']))
			{	
				$matricula = $_GET['Matricula'];	
				$comando_sql = "DELETE FROM professores WHERE Matricula = :valor";
				$stmt = $conexao->prepare($comando_sql);
				$stmt->bindParam(':valor',$matricula);
				$stmt->execute();
				$rs = $stmt->rowCount();
					
				if($rs)
				{
					echo "<script>alert('Registro apagado com sucesso!');</script>";
					echo "<script>location.href='apm_exibir.php?escolha=2'</script>";	
				}
				else
				{
					echo "<script>alert('Não foi possível excluir!');</script>";
					echo "<script>location.href='apm_exibir.php?escolha=2'</script>";		
				}
			}
		}	
		else if($escolha==3)
		{
			$consulta = $conexao->query("SELECT * FROM aluno");
			
			echo "<main>
				<table border='1' style='text-align:center;width:100%' align='center'>
				<tr><th colspan='8'><h2>Contribuições Alunos</h2></th></tr>
				<tr>
					<th>Matricula</th>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Email</th>
					<th>Data</th>
					<th>Valor</th>
					<th></th>
					<th></th>
			</tr>";
			
			if(isset($_GET['buscar']))
			{
				$valor = $_GET['busca'];
				$comando_sql = "SELECT * FROM aluno WHERE Aluno LIKE '%$valor%'";
				$consulta = $conexao->query($comando_sql);						
			}
			
			while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr>";
				echo "<td>".$campo['Matricula']."</td>";
				echo "<td>".$campo['Aluno']."</td>";
				echo "<td>".$campo['Telefone']."</td>";
				echo "<td>".$campo['Email']."</td>";
				echo "<td>".$campo['Dia']."</td>";
				echo "<td>".$campo['APM']."</td>";
				if($tipo=="A")
				{
				echo "<td><a href='apm_edit.php?escolha=3&Matricula={$campo['Matricula']}'><img src='img/edit.png'></a></td>";
				echo "<td><a href=\"javascript:func()\" onclick=\"confirmacaoA('{$campo['Matricula']}')\"><img src='img/delete.png' alt='delete' title='excluir'></a></td>";
				}
				echo "</tr>";
			}
			echo "</main>";

			if(isset($_GET['excluir']))
			{	
				$matricula = $_GET['Matricula'];	
				$comando_sql = "DELETE FROM aluno WHERE Matricula = :valor";
				$stmt = $conexao->prepare($comando_sql);
				$stmt->bindParam(':valor',$matricula);
				$stmt->execute();
				$rs = $stmt->rowCount();
					
				if($rs)
				{
					echo "<script>alert('Registro apagado com sucesso!');</script>";
					echo "<script>location.href='apm_exibir.php?escolha=3'</script>";	
				}
				else
				{
					echo "<script>alert('Não foi possível excluir!');</script>";
					echo "<script>location.href='apm_exibir.php?escolha=3'</script>";		
				}
			}
		}
		else
		{
			$escolha = 1;
			echo "<main>
					<h1>Escolha uma Opção</h1>
						</main>";
		}
	?>
</body>
</html>