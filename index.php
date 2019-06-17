<?php
    session_start();
    if((!isset($_SESSION['conta'])==true) and (!isset($_SESSION['senha'])==true))
    {
        unset ($_SESSION['conta']);
        unset ($_SESSION['senha']);
        header('location:index.html');
    }
    $usuario=$_SESSION['conta'];

    $conexao = new PDO('mysql:host=localhost:3307;dbname=banco_apm','root','usbw');

    $consulta = $conexao->query("SELECT * FROM conta WHERE usuario='$usuario'");

    while($campo = $consulta->fetch(PDO::FETCH_ASSOC))
    {
        $nome=$campo['nome'];
        $tipo=$campo['tipo'];
        $foto=$campo['foto'];
    }
?>
<!doctype html>
<html>
<head>
    <title>Home</title>
    <link href="css/estilo.css" type="text/css" rel="stylesheet">
    <link href="css/estilo_do_menu.css" type="text/css" rel="stylesheet">
    <script type="text/javascript" src="js/func.js"></script>
</head>
<style>
label{font-size:15px;}
</style>
<body>
    <header>
        <img src="img/logo_etec_2019.png">
    </header>
    <nav style="background-color: #333;">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="apm_exibir.php?escolha=1">Exibir Cadastrados</a></li>
            <?php
            if($tipo=="A")
            {
            echo "<li><a href='apm_aluno.php' target='_blank'>Cadastrar Aluno</a></li>
            <li><a href='apm_professor.php' target='_blank'>Cadastrar Professor</a></li>
            <li><a href='apm_conta.php' target='_blank'>Administrar Contas</a></li>";
            }
            ?>
            <li><button type="submit" style="border:0" class="btn" onclick="confirmacaoSair()">Sair</button><li>
        </ul>
    </nav>
    <main style="height:300px;">
        <div style="text-align:center;margin:30px 45%;border:groove">
        <?php
            echo "<div>
                <img src='fotos/$foto' style='border:groove;padding:5px;width:100px;height:124px;'><br>
                <a href='envio_foto.php'>Adicionar ou Trocar foto</a><br>
                <label>Nome: $nome</label> <br>
                <label>Tipo de conta: $tipo</label> 
                </div>";
        ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>