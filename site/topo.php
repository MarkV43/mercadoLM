<!-- INICIO DO TOPO DO SITE -->
<header>
	<div id="imagem-topo" onclick="window.open('index.php','_self')">
		<!--<div class="usercard">
			Bem vindo, <?/*= $_SESSION['usuar'] */?>.<br>
			<a href="logout.php">Logout</a>
		</div>
		<?php /*if ($_SESSION['foto'] != "sem-foto") { */?>
			<img src="imagens/funcionarios/<?/*= $_SESSION['foto'] */?>" height="54" style="margin-top: 5px !important">
		--><?php /*} */?>
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
		}
	?>
	<nav>
		<ul>
			<li><a <?= $pag == 1 ? '' : 'href="?pagina=inicio"' ?> class="<?= $pag == 1 ? "active" : '' ?>">Inicio</a></li>
			<li><a <?= $pag == 2 ? '' : 'href="?pagina=cidades_listar"' ?> class="<?= $pag == 2 ? 'active' : '' ?>">Produtos</a></li>
			<li><a <?= $pag == 3 ? '' : 'href="?pagina=formas_pagamento_listar"' ?> class="<?= $pag == 3 ? 'active' : '' ?>">Lojas</a></li>

<!--			<li><a <?/*= $pag == 4 ? '' : 'href="?pagina=cargos_listar"' */?> class="<?/*= $pag == 4 ? 'active' : '' */?>">Cargos</a></li>
			<li><a <?/*= $pag == 5 ? '' : 'href="?pagina=categorias_listar"' */?> class="<?/*= $pag == 5 ? 'active' : '' */?>">Categorias</a></li>
			<li><a <?/*= $pag == 6 ? '' : 'href="?pagina=produtos_listar"' */?> class="<?/*= $pag == 6 ? 'active' : '' */?>">Produtos</a></li>-->

		</ul>

	</nav>
</header>
<!-- FIM DO TOPO DO SITE -->