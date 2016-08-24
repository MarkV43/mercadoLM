<!-- INICIO DO TOPO DO SITE -->
<header>
	<div id="imagem-topo" onclick="window.open('index.php','_self')">
		<div class="usercard">
			Bem vindo, <?= $_SESSION['usuar'] ?>.<br>
			<a href="logout.php">Logout</a>
		</div>
		<?php if ($_SESSION['foto'] != "sem-foto") { ?>
			<img src="imagens/funcionarios/<?= $_SESSION['foto'] ?>" height="54" style="margin-top: 5px !important">
		<?php } ?>
	</div>
	<!--adicionar classe active e retirar clique da pagina atual-->
	<?php
		$pag = substr($pagina, 0, 3);
		switch ($pag) {
			case "ini":
				$pag = 1;
				break;
			case "cid":
				$pag = 2;
				break;
			case "for":
				$pag = 3;
				break;
			case "car":
				$pag = 4;
				break;
			case "cat":
				$pag = 5;
				break;
			case "pro":
				$pag = 6;
				break;
			case "cli":
				$pag = 7;
				break;
			case "fun":
				$pag = 8;
				break;
			case "ite":
			case "ven":
				$pag = 9;
				break;
		}
	?>
	<nav>
		<ul>
			<li><a <?= $pag == 1 ? '' : 'href="?pagina=inicio"' ?> class="<?= $pag == 1 ? "active" : '' ?>">Inicio</a></li>
			<li><a <?= $pag == 2 ? '' : 'href="?pagina=cidades_listar"' ?>
                    class="<?= $pag == 2 ? 'active' : '' ?>">Cidades</a></li>
			<li><a <?= $pag == 3 ? '' : 'href="?pagina=formas_pagamento_listar"' ?>
                    class="<?= $pag == 3 ? 'active' : '' ?>">Formas
                    Pagamento</a></li>

			<li><a <?= $pag == 4 ? '' : 'href="?pagina=cargos_listar"' ?>
                    class="<?= $pag == 4 ? 'active' : '' ?>">Cargos</a></li>
			<li><a <?= $pag == 5 ? '' : 'href="?pagina=categorias_listar"' ?>
                    class="<?= $pag == 5 ? 'active' : '' ?>">Categorias</a></li>
			<li><a <?= $pag == 6 ? '' : 'href="?pagina=produtos_listar"' ?>
                    class="<?= $pag == 6 ? 'active' : '' ?>">Produtos</a></li>

			<li><a <?= $pag == 7 ? '' : 'href="?pagina=clientes_listar"' ?>
                    class="<?= $pag == 7 ? 'active' : '' ?>">Clientes</a></li>
			<li><a <?= $pag == 8 ? '' : 'href="?pagina=funcionarios_listar"' ?>
                    class="<?= $pag == 8 ? 'active' : '' ?>">Funcionários</a></li>
			<li><a <?= $pag == 9 ? '' : 'href="?pagina=vendas_listar"' ?>
                    class="<?= $pag == 9 ? 'active' : '' ?>">Vendas</a></li>
		</ul>

	</nav>
</header>
<!-- FIM DO TOPO DO SITE -->