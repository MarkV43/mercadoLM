<?php
	/*session_start();
	if (!isset($_SESSION['logad']) || !$_SESSION['logad'])
		include "login.php";
	//Incluir a conexão com banco de dados*/
	include 'conexao.php';
	include 'funcoes.php';
	include 'Conversor.php';
	date_default_timezone_set("America/Sao_Paulo");
	//Resgatar página da URL
	//Verificar se existe o parametro na URL
	if (isset($_GET['pagina'])) {
		$pagina = $_GET['pagina'];
	} else {
		//Se não existir o parametro pagina na URL
		$pagina = "inicio";
	}
	if (!stristr($pagina, "formas_pagamento")) {
		$tipo = stristr($pagina, "_", 1);
		$sufx = substr(stristr($pagina, "_"), 1);
	} else {
		$tipo = "formas_pagamento";
		$sufx = substr(stristr($pagina, "o_"), 2);
	}
	if ($pagina != "inicio" && !file_exists("modulos/$tipo/$sufx.php"))
			$pagina = "inicio";
?>

<!Doctype html>
<html lang="pt-br">
<head>
	<title>Mercado PW</title>
	<meta charset="utf8">


	<!-- Framework JQuery -->
	<script src="js/jquery-1.12.4.min.js"></script>

	<!--  Plugin para mascara monetária -->
	<script src="js/jquery.maskMoney.js"></script>

	<!-- Plugin para mascara para data -->
	<script src="js/maskedinput.min.js"></script>

	<!-- Configuração para máscara monetária -->
	<script type="text/javascript">
		$(function () {
			$(".mascaraReal").maskMoney({
				symbol    : 'R$ ',
				showSymbol: true,
				thousands : '.',
				decimal   : ',',
				symbolStay: true
			});


			$(".mascaraInteiro").maskMoney({
				symbol    : '',
				precision : 0,
				showSymbol: false,
				thousands : '.',
				decimal   : ',',
				symbolStay: false
			});
		});

		$(document).ready(function () {
			<!-- Configuração da máscara para data e telefone -->
			$(".mascaraData").mask("99/99/9999", {placeholder: "dd/mm/aaaa"});
			$(".mascaraTelefone").mask("(99) 9999-9999");
			$(".mascaraCEP").mask("99.999-999");
			$(".mascaraHora").mask("99:99:99", {placeholder: "hh:mm:ss"});
		});

	</script>


	<!-- Chamada do CSS -->

	<link rel="stylesheet" href="css/estilo.css">
</head>

<body>

<?php
	//Incluir topo do site
	include 'topo.php';
?>

<!-- INICIO DO CONTEÚDO DO SITE -->
<section id="conteudo-principal">

	<?php include $pagina == "inicio" ? "inicio.php" : "modulos/$tipo/$sufx.php"; ?>

</section>
<!-- FIM DO CONTEÚDO DO SITE -->

<?php
	//Incluir rodapé do site
	include 'rodape.php';
?>

</body>

</html>

