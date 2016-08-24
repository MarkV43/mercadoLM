<?php
	$id = intval($_GET['id']);
	if (!empty($_POST)) {
		$novo_nome = $_POST['nome'];
		$novo_valor = Conversor::realUsuarioParaBanco($_POST['valor']);
		$nova_quant = $_POST['quant'];
		$nova_categoria = $_POST['categoria'];
		$isUpl = $_POST['upload'];
		if ($isUpl) {
			$foto = !empty($_FILES['foto']['name']);
			if ($foto) {
				$img_sufx = stristr($_FILES['foto']['name'], ".");
			}
		} else {
			$foto = !empty($_POST['fotoUrl']);
			if ($foto) {
				$img_info = pathinfo($_POST['fotoUrl']);
				$img_sufx = "." . explode("?", $img_info['extension'])[0];
				$sql = "SELECT foto FROM produtos WHERE id = $id";
				$res = $con->query($sql);
				$imagem = $res->fetch_array()['foto'];
			}
		}
		if ($foto)
			$nome_img = md5(uniqid(microtime(true), true)) . $img_sufx;
		$sql = "UPDATE produtos SET nome='$novo_nome', valor='$novo_valor', quantidade='$nova_quant', categorias_id='$nova_categoria'" .
		       ($foto ? ", foto='$nome_img'" : '') . " WHERE id=$id";
		$res = $con->query($sql) or die($con->error);
		if ($foto) {
			$path = "imagens/produtos/" . $nome_img;
			unlink("imagens/produtos/" . $imagem);
			if ($isUpl)
				move_uploaded_file($_FILES['foto']['tmp_name'], "imagens/produtos/" . $nome_img);
			else {
				copy($_POST['fotoUrl'], $path);
			}
		}
		echo $sql;
		if ($res == 1) {
			header('location: index.php?pagina=produtos_listar');
		}
	}
	$sql = "SELECT nome, valor, quantidade, categorias_id FROM produtos WHERE id=$id";
	$res = $con->query($sql) or die($con->error);
	$linha = mysqli_fetch_array($res);
	$nome = $linha['nome'];
	$valor = $linha['valor'];
	$quantidade = $linha['quantidade'];
	$categorias_id = $linha['categorias_id'];
	include "voltar.php"
?>
<form action="" method="post" class="formulario" enctype="multipart/form-data">
	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" name="nome" id="nome" value="<?= $nome ?>">
	</div>

	<div class="item-form">
		<label for="valor">Valor: </label>
		<input type="text" step="0.01" name="valor" id="valor" value="<?= $valor ?>" class="mascaraReal">
	</div>

	<div class="item-form">
		<label for="quant">Quantidade: </label>
		<input type="text" name="quant" id="quant" value="<?= $quantidade ?>" class="mascaraInteiro">
	</div>
	<div class="item-form">
		<?php
			//Montagem do sql para selecao dos dados da categoria
			$sql = "SELECT id, nome FROM categorias ORDER BY nome";
			$resCategorias = $con->query($sql) or die($con->error);
		?>
		<label for="cat">Categoria: </label>
		<select name="categoria" id="cat" required>
			<option value="">Selecione uma categoria</option>
			<?php while ($categoria = mysqli_fetch_array($resCategorias)) { ?>
				<option <?php if ($categorias_id == $categoria['id']) echo "selected" ?>
					value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="item-form">
		<?php
			$sql = "SELECT foto FROM produtos WHERE id = $id";
			$res = $con->query($sql) or die($con->error);
			$foto = $res->fetch_array()['foto'];
			if ($foto) {
				?>
				Foto antiga:<br>
				<img src="imagens/produtos/<?= $foto ?>">
			<?php } ?>
		<fieldset>
			<legend>Foto</legend>
			<label><input type="radio" name="upload" id="upl" value="1" checked>
				Upload do arquivo</label>
			<input type="file" name="foto" onfocus="document.getElementById('upl').checked=true">
			<br>
			<label><input type="radio" name="upload" id="url" value="0">
				Inserir por link</label>
			<input type="url" name="fotoUrl" onfocus="document.getElementById('url').checked=true">
		</fieldset>
	</div>

	<?php include "formulario.php" ?>
</form>
