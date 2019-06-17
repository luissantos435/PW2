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
        $codigo=$campo['codigo'];
        $foto=$campo['foto'];
    }
    if(isset($_POST['enviar']))
    {
        $arquivo=$_FILES['arquivo'];
        $nome=$_FILES['arquivo']['name'];
        $extensao=explode(".",$nome);
        $nome_final=md5(time()).".".$extensao[1];
        $pasta="fotos/";
        if(move_uploaded_file($arquivo['tmp_name'],$pasta.$nome_final))
        {
            $envio = $conexao->query("UPDATE conta SET foto='$nome_final' WHERE codigo='$codigo'");
            echo "<script>alert('Foto Atualizada');</script>";
			echo "<script>location.href='index.php'</script>";
        }

    }

?>
<html>    
<body>
    <fieldset style="text-align:center;margin:10% 35%">
        <form action='#' method='post' enctype="multipart/form-data">
            <img src="fotos/<?php echo "$foto"; ?>" id="visualizarImagem" style="border:groove;padding:5px;width:100px;height:124px;padding:5px;"><br>
            <input type="file" name="arquivo" style="padding:5px" id="arquivo"><br>
            <script>
                function carregarImagem()
                {
                    if(this.files && this.files[0]){
                        var file = new FileReader();
                        file.onload = function(e)
                        {
                            document.getElementById("visualizarImagem").src = e.target.result;
                        };
                        file.readAsDataURL(this.files[0]);
                    }
                }
                document.getElementById("arquivo").addEventListener("change", carregarImagem, false); 
            </script>
            <button type="submit" name="enviar" style="padding:5px">Enviar</button>
        </form>
    </fieldset>
</body>
<html>