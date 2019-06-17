function confirmacaoSair() {
     var resposta = confirm("Realmente deseja Sair?");
 
     if (resposta == true) {
          window.location.href = "logout.php";
     }
}