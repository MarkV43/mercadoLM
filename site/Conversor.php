<?php
	/**
	 * Classe com métodos estáticos para conversão de dados
	 */
	class Conversor
	{
		/**
		 * Função para converter a data de usuário para data de banco de dados
		 * Converte data dia/mes/ano em ano-mes-dia
		 *
		 * @param string $data
		 *
		 * @return string
		 */
		public static function dataUsuarioParaBanco($data)
		{
			$vetorData = explode("/", $data);
			$vetorDataInvertido = array_reverse($vetorData);
			return implode("-", $vetorDataInvertido);
		}
		/**
		 * Função para converter a data de banco de dados para data de usuário
		 * Converte data ano-mes-dia em dia/mes/ano
		 *
		 * @param string $data
		 *
		 * @return string
		 */
		public static function dataBancoParaUsuario($data)
		{
			$vetorData = explode("-", $data);
			$vetorDataInvertido = array_reverse($vetorData);
			return implode("/", $vetorDataInvertido);
		}
		/**
		 * Função para converter número real de usuário para real de banco de dados
		 * Converte 1.200,00 em 1200.00
		 *
		 * @param string $numero
		 *
		 * @return float
		 */
		public static function realUsuarioParaBanco($numero)
		{
			//Substituir o separador de milhar . por nada
			$numero = explode(" ",$numero)[1];
			$numero = str_replace(".", "", $numero);
			//Substituir o sepador de decimal , por .
			$numero = str_replace(",", ".", $numero);
			return $numero;
		}
		/**
		 * Função para converter número real de banco de dados para real de usuário
		 * Converte 1200.00 em 1.200,00
		 *
		 * @param float  $numero
		 * @param string $prefix
		 *
		 * @return string com número no formato de usuário
		 */
		public static function realBancoParaUsuario(
			$numero,
			$prefix = "R$ "
		) {
			return $prefix . number_format($numero, 2, ",", ".");
		}
	}
?>