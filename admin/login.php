<?php
	if (basename($_SERVER['REQUEST_URI']) == "login.php")
		header("location: index.php");
	$erro = 0;
	if (!empty($_POST)) {
		include "conexao.php";
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$sql = "SELECT id, nome, adm, senha, coalesce(data_nascimento,'0') AS nasc, coalesce(foto,'sem-foto') AS foto FROM funcionarios WHERE email = '$email'";
		$res = $con->query($sql) or die($con->error);
		if ($con->affected_rows) {
			$lnh = $res->fetch_array();
			include "funcoes.php";
			$snh = criptograthPass($lnh['id'], $senha);
			if ($snh == $lnh['senha']) {
				$_SESSION['logad'] = 1;
				$_SESSION['usuar'] = $lnh['nome'];
				$_SESSION['admin'] = $lnh['adm'];
				$_SESSION['id'] = $lnh['id'];
				$_SESSION['foto'] = $lnh['foto'];
				$_SESSION['nasc'] = $lnh['nasc'];
				$_SESSION['comemorado'] = false;
				header("Refresh: 0");
			} else
				$erro = 1;
		} else
			$erro = 1;
	}
?>
	<!Doctype html>
	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
		<title>Login MPW</title>
	</head>
	<body>
	<form method="post" action="" class="formulario">
		<h2 style="width: 100%; text-align: center; margin-top: 0">Login</h2>
		<?php
			if ($erro)
				echo "<h5 style='color: red'>Login ou senha incorretos</h5>"
		?>
		<table style="width: 99.5%;">
			<tr>
				<div style="width: 100%; display: -webkit-flex; display: flex;">
					<td><label for="email">E-mail: </label></td>
					<td style="width: 100%;"><input type="text" name="email" id="email" style="width: 100%"></td>
				</div>
			</tr>
			<tr>
				<div style="width: 100%; display: -webkit-flex; display: flex;">
					<td><label for="senha">Senha: </label></td>
					<td><input type="password" name="senha" id="senha" style="width: 100%;"></td>
				</div>
			</tr>
		</table>
		<div class="control-form">
			<input type="submit" value="Entrar">
		</div>

	</form>
	</body>
	</html>
<?php die() ?>