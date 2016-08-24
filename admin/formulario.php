<div class="control-form">
	<input type="submit" id="submit" value="Enviar" class="btn btn-success">
	<?php if ($sufx == "editar")
		echo '<a href="" id="submit" class="btn btn-warning">Resetar</a>';
	else
		echo '<input type="reset" value="Limpar" class="btn btn-warning">'?>
</div>