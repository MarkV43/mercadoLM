<h1 class="titulo"><?=
($sufx == "alt_senha" ?
	"Alterando Senha de "
:
	ucfirst(substr($sufx, 0, strlen($sufx) - 1)) . "ndo ").
($tipo == "itens" ?
	'Produtos na Venda'
:
	($tipo == "formas_pagamento" ?
		'Forma' .
		($sufx != "editar"
		&&
		$sufx != "cadastrar" ?
			's'
		:
			'') .
		' de Pagamento'
	:
	ucfirst(str_replace("na", "ná", substr($tipo, 0, strlen($tipo)
	-
	($sufx == "editar"
	||
	$sufx == "cadastrar" ?
		1
	:
		0)))))) .
	($sufx == "editar"
	 ||
	 $tipo == "itens"
	 &&
	 $sufx == "cadastrar"
	 ||
	 $sufx == "alt_senha" ?
		" de código " . $_GET['id']
	:
		'') ?></h1>
<?php if ($sufx != "listar") { ?>
	<a href="?pagina=<?= $tipo ?>_listar<?= $tipo == "itens" ? '&id=' . $_GET['id'] : '' ?>"
	   class="btn btn-default voltar"><span>Voltar</span></a>
<?php } elseif ($sufx == "listar") { ?>
	<a href="index.php?pagina=<?= $tipo ?>_cadastrar"
	   class="btn btn-default avancar"><span>Novo(a) <?= ($tipo == "formas_pagamento" ? 'Forma de Pagamento' :
				($tipo == "itens" ? "Venda" : substr(ucfirst($tipo), 0, strlen($tipo) - 1))) ?></span></a>
<?php } ?>
