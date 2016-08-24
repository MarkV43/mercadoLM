<td class="cellE">
	<a href="?pagina=<?= $tipo ?>_editar&id=<?= $linha['id'] ?>">Editar</a>
</td>
<td class="cellD">
	<?php
		if ($tipo == "funcionarios" && $_SESSION['id'] == $linha['id'])
			echo "<a style='cursor: not-allowed !important;'>Excluir</a>";
		else
			echo "<a href='?pagina={$tipo}_excluir&id={$linha['id']}'>Excluir</a>";
	?>
</td>
