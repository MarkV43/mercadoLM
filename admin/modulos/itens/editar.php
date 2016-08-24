<?php
	$id = $_GET['id'];
	if (!empty($_POST)) {
		$sql = "SELECT produtos_id as a FROM
					itens_venda
				WHERE
					id = $id";
		$res = $con->query($sql) or die(__LINE__ . $con->error);
		$p = $res->fetch_array()['a'];
		$qtd = $_POST['qtd'];
		$sql = "SELECT valor FROM produtos WHERE id=$p";
		$res = $con->query($sql) or die(__LINE__ . $con->error);
		$val = $res->fetch_array()['valor'];
		$desc = floor($qtd / 10);
		$val = round($val * ($desc <= 109.5 ? pow(.99, $desc) : 1 / 3), 2);
		$total = round($val * $qtd, 2);
		$sql = "
		UPDATE produtos SET
			quantidade = quantidade - $qtd + (
				SELECT quantidade FROM
					itens_venda
				WHERE
					id = $id
			)
		WHERE
			id = $p";
		$con->query($sql) or die(__LINE__ . $con->error);
		$sql = "
		UPDATE itens_venda SET
			quantidade = " . $qtd . ",
			valor = " . $val . "
		WHERE
			id = " . $id;
		$con->query($sql) or die(__LINE__ . $con->error);
		$sql = "
		SELECT vendas_id FROM
			itens_venda
		WHERE
			id = $id";
		$res = $con->query($sql) or die(__LINE__ . $con->error);
		$l = $res->fetch_array()['vendas_id'];
		$sql = "
		UPDATE vendas v SET
			total = (
				SELECT sum(valor * quantidade) FROM
					itens_venda
				WHERE vendas_id = v.id
			)
		WHERE
			id = " . $l;
		$con->query($sql) or die(__LINE__ . $con->error);
		header("location: index.php?pagina=itens_listar&id=" . $l);
	}
	$sql = "
	SELECT
		p.nome AS n,
		p.valor AS v,
		i.quantidade AS q,
		i.valor AS d,
		p.quantidade AS m
	FROM
		produtos p,
		itens_venda i
	WHERE
		p.id = i.produtos_id
	AND
		i.id = $id";
	$res = $con->query($sql) or die($con->error);
	$linha = $res->fetch_array();
	include "voltar.php"
?>
<form action="" method="post" class="formulario">
	<div class="item-form">
		<h3>Produto: <?= $linha['n'] ?></h3>
		<br><br>
		<h3>Preço por unidade: </h3>
		<label><?= money($linha['v']) ?></label>
		<p style="display: none" id="unit"><?= $linha['v'] ?></p>
		<br>
		<h3>Preço por unidade + desconto: </h3>
		<label id="desc"><?= money($linha['d']) ?></label>
		<br>
		<label for="qtd">Quantidade:</label>
		<input type="number" min="1" step="1" max="<?= $linha['m'] + $linha['q'] ?>" name="qtd" id="qtd"
		       value="<?= $linha['q'] ?>"
		       onchange="updateTotal(this.value)" onkeyup="updateTotal(this.value)" required>
		<br>
		<h2>Total: </h2>
		<label id="total"><?= money($linha['v'] * $linha['q']) ?></label>
	</div>
	<?php include "formulario.php" ?>
</form>

<script>
	var ttl                      = document.getElementById("total"),
	    vlr                      = parseFloat(document.getElementById("unit").innerHTML),
	    des                      = document.getElementById("desc");
	Number.prototype.formatMoney = function (c) { // FUNCAO PRONTA =)
		c = isNaN(c = Math.abs(c)) ? 2 : c;
		var n = this,
		    s = n < 0 ? "-" : "",
		    d = ",",
		    t = " ",
		    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
		    j = (j = i.length) > 3 ? j % 3 : 0;
		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
	function updateTotal(qtd) {
		var total     = vlr,
		    desc      = Math.floor(qtd / 10);
		total *= desc <= 109.5 ? Math.pow(.99, desc) : 1 / 3;
		des.innerHTML = "R$" + total.formatMoney(2);
		ttl.innerHTML = "R$" + (total * qtd).formatMoney(2);
	}
</script>
