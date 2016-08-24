<?php
	$venda = $_GET['id'];
	if (!empty($_POST)) {
		$qtd = $_POST['qtd'];
		$pro = $_POST['prod'];
		$sql = "SELECT valor FROM produtos WHERE id=$pro";
		$res = $con->query($sql);
		$valor = $res->fetch_array()['valor'];
		$desc = floor($qtd / 10);
		$valor *= $desc <= 109.5 ? pow(.99, $desc) : .3;
		$sql = "INSERT INTO itens_venda(vendas_id,produtos_id,valor,quantidade) VALUE (" . $venda . "," .
		       $pro . "," . $valor . "," . $_POST['qtd'] . ")";
		$con->query($sql) or die($con->error);
		$sql = "UPDATE vendas SET total=(SELECT sum(valor*quantidade) FROM itens_venda WHERE vendas_id=$venda) WHERE id=$venda";
		$con->query($sql) or die($con->error);
		header("location: index.php?pagina=itens_listar&id=$venda");
	}
	include "voltar.php"
?>
<form action="" method="post" class="formulario">
	<div class="item-form">
		<label for="prod">Produto: </label>
		<select name="prod" id="prod" onchange="change(this.value)" required>
			<option value="">Selecione o produto</option>
			<?php
				$sql = "SELECT id,nome,quantidade AS qtd,valor FROM produtos";
				$res = $con->query($sql) or die(mysqli_error($con));
				$qtds = [];
				$vals = [];
				while ($l = $res->fetch_array()):
					$qtds[$l['id']] = $l['qtd'];
					$vals[$l['id']] = $l['valor'];
					?>
					<option
						value="<?= $l['id'] ?>"><?= $l['nome'] . " - " . money($l['valor']) ?></option>
				<?php endwhile ?>
		</select>
	</div>
	<p style="display: none" id="qtds"><?= json_encode($qtds) ?></p>
	<p style="display: none" id="vals"><?= json_encode($vals) ?></p>
	<div class="item-form">
		<label for="qtd">Quantidade: </label>
		<input type="number" min="1" value="1" max="1" id="qtd" name="qtd"
		       placeholder="Digite a quantidade do produto desejada"
		       onchange="updateTotal(this.value)" onkeyup="updateTotal(this.value)" required>
	</div>
	<div class="item-form">
		<label>Total: </label>
		<p id="p"></p>
	</div>
	<?php include "formulario.php" ?>
</form>
<script type="text/javascript">
	var qtd  = document.getElementById("qtd"),
	    out  = document.getElementById("p"),
	    sub  = document.getElementById("sub"),
	    prod = document.getElementById("prod"),
	    qtds = JSON.parse(document.getElementById("qtds").innerHTML),
	    vals = JSON.parse(document.getElementById("vals").innerHTML);

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
	function change(id) {
		qtd.setAttribute("max", qtds[id]);
		updateTotal(qtd.value);
	}
	function updateTotal(qtd) {
		qtd           = parseInt(qtd);
		var val       = vals[prod.value],
		    total     = val * qtd,
		    desc      = Math.floor(qtd / 10);
		total *= desc <= 109.5 ? Math.pow(.99, desc) : 1 / 3;
		out.innerHTML = "R$" + total.formatMoney(2);
		sub.value     = val;
	}
</script>