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
<!doctype html>
<html>
<head>
<title>Administrar Contas</title>
<head>
<style>
main{border:groove;border-radius:10px}
tr:nth-child(even){
  background-color:#dddddd;
}
table{border-radius:10px}
</style>
<body>
    <main>
        <?php
            $consulta = $conexao->query("SELECT * FROM conta");
			
			echo "<main>
				<table border='1' style='text-align:center;width:100%' align='center'>
				<tr><th colspan='8'><h2>Contas Cadastradas</h2></th></tr>
				<tr>
					<th>Cod</th>
					<th>Foto</th>
					<th>Usuario</th>
					<th>Senha</th>
					<th>Nome</th>
					<th>Tipo</th>
					<th></th>
					<th></th>
			</tr>";
			
			while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
			{
				echo "<tr>";
				echo "<td>".$campo['codigo']."</td>";
				echo "<td><img src='fotos/".$campo['foto']."' style='border:groove;padding:5px;width:64px;height:88px;'></td>";
				echo "<td>".$campo['usuario']."</td>";
				echo "<td>".$campo['senha']."</td>";
				echo "<td>".$campo['nome']."</td>";
                echo "<td>".$campo['tipo']."</td>";
                echo "<td><a href='apm_conta.php?editar&codigo={$campo['codigo']}'><img src='img/edit.png' title='editar'></a></td>";
                echo "<td><a href='apm_conta.php?excluir&codigo={$campo['codigo']}'><img src='img/delete.png' alt='delete' title='excluir'></a></td>";
                echo "</tr>";
            }
            
                if(isset($_GET['excluir']))
                {	
                    $codigo = $_GET['codigo'];	
                    $comando_sql = "DELETE FROM conta WHERE codigo = :valor";
                    $stmt = $conexao->prepare($comando_sql);
                    $stmt->bindParam(':valor',$codigo);
                    $stmt->execute();
                    $rs = $stmt->rowCount();
                        
                    if($rs)
                    {
                        echo "<script>alert('Registro apagado com sucesso!');</script>";
                        echo "<script>location.href='apm_conta.php?'</script>";	
                    }
                    else
                    {
                        echo "<script>alert('Não foi possível excluir!');</script>";
                        echo "<script>location.href='apm_conta.php?'</script>";		
                    }
                }
                if(isset($_GET['editar']))
                {
                    $codigo = $_GET['codigo'];
                    $consulta = $conexao->query("SELECT * FROM conta WHERE codigo = $codigo");

                    while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
                    {
                        echo "
                        <fieldset>
                            <form action='#' method='get'>
                                <label>Usuario: ".$campo['usuario']."</label>
                                <label>Nome: ".$campo['nome']."</label>
                                <label><select name='tipo'>
                                    <option selected disabled>Selecione</option>
                                    <option value='A'>Admin</option>
                                    <option value='M'>Membro</option>
                                </select></label>
                                <label><button name='edit' value='".$campo['codigo']."'>Alterar</button></label>
                            </form>
                        </fieldset>";
                    }
                }
                if(isset($_GET['edit']))
                {
                    $codigo = $_GET['edit'];
                    $tipo=$_GET['tipo'];
                    $sql = "UPDATE conta SET tipo=? WHERE codigo = ?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bindParam(1,$tipo);
                    $stmt->bindParam(2,$codigo);
                    $resultado = $stmt->execute();
                    if($resultado)
                    {	
                        echo "<script>alert('Alterado com Sucesso');</script>";
                        echo "<script>location.href='apm_conta.php?'</script>";
                    }
                    else
                    {
                        echo var_dump($stmt->errorInfo());
                    }
                }
        ?>
    </main>
</body>
</html>
