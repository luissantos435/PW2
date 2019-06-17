<?php
    if(isset($_GET['Cadastrar']))
    {
    $conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');

    $conta = $_GET['conta'];
    $senha = $_GET['senha'];
    $nome = $_GET['nome'];
    $tipo = "M";
    
    $criptS = md5($senha);

    $sql="INSERT into conta (usuario,senha,nome,tipo) values (:par1,:par2,:par3,:par4)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':par1',$conta);
    $stmt->bindParam(':par2',$criptS);
    $stmt->bindParam(':par3',$nome);
    $stmt->bindParam(':par4',$tipo);
    $resultado = $stmt->execute();
		if($resultado)
		{
            echo "<script>alert('Cadastrado com Sucesso');</script>";
            echo "<script>location.href='index.html'</script>";
        }
        else
		{
            echo "<script>alert('Erro ao Cadastrar');</script>";
        }
    }
?>
<!doctype HTML>
<html>
<head>
<title>Cadastrar</title>
</head>
<style>
    fieldset{
        margin:10% 30%;
        text-align:center;
        border-style:groove;
        border-radius: 10px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }
    body{
            background-color: aliceblue;
        }
    footer{
        font-size: 10px;
        height: 10px;
        text-align: right;
        padding-top: 31px;
    }  
</style>
<body>
    <fieldset>
        <legend><h1>Formulario de Cadastro</h1></legend>
        <form method="get" action="#">
            <p><label>Usuario:<input type="text" name="conta"></label><p>
            <p><label>Senha:<input type="password" name="senha"></label><p>
            <p><label>Nome:<input type="text" name="nome"></label><p>
            <button type="submit" name="Cadastrar">Cadastrar</button>
            <p><a href="index.html">cancelar</a></p>
        </form>
    </fieldset>
    <footer>
        Desenvolvido por Luis Gustavo
    </footer>
</body>
</html>