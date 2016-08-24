<?php
	if (!empty($_POST)) {
		$categorias = $_POST['categorias'];
		$nome = $_POST['nome'];
		$valor = Conversor::realUsuarioParaBanco($_POST['valor']);
		$quantidade = $_POST['quant'];
		$isUpl = $_POST['upload'];
		if($isUpl){
			$isFto = !empty($_FILES['fotoUpl']['name']);
			if ($isFto):
				$img_sufx = stristr($_FILES['fotoUpl']['name'], ".");
			endif;
		} else {
			$isFto = !empty($_POST['fotoUrl']);
			if($isFto):
				$img_info = pathinfo($_POST['fotoUrl']);
				$img_sufx = ".".explode("?",$img_info['extension'])[0];
			endif;
		}
		if($isFto)
			$nome_img = md5(uniqid(microtime(true),true)) . $img_sufx;
		$sql = "INSERT INTO produtos (nome, valor, quantidade, categorias_id) VALUE ('$nome', '$valor', '$quantidade', '$categorias')";
		$res = $con->query($sql) or die($con->error);
		if ($isFto) {
			$sql = "UPDATE produtos SET foto = '$nome_img' WHERE id = ".$con->insert_id;
			$con->query($sql) or die($con->error);
			$path = "imagens/produtos/".$nome_img;
			if($isUpl)
				move_uploaded_file($_FILES['fotoUpl']['tmp_name'], $path);
			else {
				copy($_POST['fotoUrl'],$path);
			}
		}
		if ($res == 1) {
			header('location: index.php?pagina=produtos_listar');
		} else {
			echo "<h1>Erro ao cadastrar o produto</h1>";
		}
	}
	include "voltar.php" ?>
<form action="" method="post" class="formulario" enctype="multipart/form-data">

	<div class="item-form">

		<?php
			//Montagem do sql para selecao dos dados da categoria
			$sql = "SELECT id, nome FROM categorias ORDER BY nome";
			$res = $con->query($sql) or die($con->error);
		?>

		<label for="cat">Categoria: </label>
		<select name="categorias" id="cat" required>
			<option value="">Selecione uma categoria</option>
			<?php while ($cat = mysqli_fetch_array($res)) { ?>
				<option value="<?php echo $cat['id']; ?>"><?php echo $cat['nome']; ?></option>
			<?php } ?>
		</select>
	</div>

	<div class="item-form">
		<label for="nome">Nome: </label>
		<input type="text" name="nome" id="nome" placeholder="Digite o nome do produto" required>
	</div>

	<div class="item-form">
		<label for="valor">Valor: </label>
		<input type="text" class="mascaraReal" name="valor" id="valor" placeholder="Digite o valor deste produto" required>
	</div>

	<div class="item-form">
		<label for="quant">Quantidade: </label>
		<input type="text" name="quant" id="quant" placeholder="Digite a quantidade deste produto" required class="mascaraInteiro">
	</div>

	<div class="item-form">
		<fieldset>
			<legend>Foto</legend>
			<label><input type="radio" name="upload" id="upl" value="1" checked>
			Upload do arquivo</label>
			<input type="file" name="fotoUpl" onfocus="document.getElementById('upl').checked=true">
			<br>
			<label><input type="radio" name="upload" id="url" value="0">
			Inserir por link</label>
			<input type="url" name="fotoUrl" onfocus="document.getElementById('url').checked=true">
		</fieldset>
	</div>

	<?php include "formulario.php" ?>
</form>
<script>document.getElementById("upl").checked=true</script>
