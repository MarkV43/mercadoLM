<?php
	$id = $_GET['id'];
	if (!empty($_POST)) {
		$senha_nova = $_POST['nov'];
		$senha_conf = $_POST['con'];
		$sql = "SELECT senha FROM funcionarios WHERE id = $id";
		$senha_banc = $con->query($sql)->fetch_array()['senha'];
		if ($_SESSION['admin'])
			$senha_velh = $senha_banc;
		else
			$senha_velh = criptograthPass($id, $_POST['ant']);
		if ($senha_banc == $senha_velh) {
			if ($senha_banc != criptograthPass($id, $senha_nova)) {
				if ($senha_nova == $senha_conf) {
					$sql = "UPDATE funcionarios SET senha = '" . criptograthPass($id, $senha_nova) . "' WHERE id = $id";
					$con->query($sql) or die($con->error);
					header("location: ?pagina=funcionarios_listar");
				} else {
					echo "<script>alert('As senhas não coincidem')</script>";
				}
			} else {
				echo "<script>alert('A senha antiga é igual a nova')</script>";
			}
		} else
			echo "<script>alert('A senha antiga não coincide com a velha')</script>";
	}
	include "voltar.php";
?>
<form action="" method="post" class="formulario">
	<?=
		!$_SESSION['admin'] ? '<div class="item-form">
		<label for="ant">Senha Antiga: </label>
		<input type="password" id="ant" name="ant" required>
	</div>' : '';
	?>
	<div class="item-form">
		<label for="nov">Senha Nova: </label>
		<input type="password" id="nov" name="nov" required onkeyup="confirmPass()">
	</div>
	<div class="item-form">
		<label for="con">Senha Nova: </label>
		<input type="password" id="con" name="con" required onkeyup="confirmPass()">
	</div>
	<?php include "formulario.php" ?>
</form>
<script type="text/javascript">
	var s1      = document.getElementById("senha1"),
	    s2      = document.getElementById("senha2"),
	    submit  = document.getElementById("submit"),
	    subText = submit.className;
	function confirmPass() {
		if (s1.value == s2.value) {
			submit.className = subText;
			submit.setAttribute("type", "submit");
		} else {
			submit.className = subText + " disabled";
			submit.setAttribute("type", "button");
		}
	}
</script>