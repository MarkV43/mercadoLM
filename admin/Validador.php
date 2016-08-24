<?php

	/**
	 * Classe com métodos estáticos para validação de dados
	 */
	class Validador
	{

		/**
		 * Função que verifica se a variável está vazia
		 *
		 * @param mixed $var
		 *
		 * @return bool
		 */
		public static function ehNulo($var)
		{
			return $var == "";
		}

		/**
		 * Função que verifica se o número é real
		 *
		 * @param mixed $numero
		 *
		 * @return bool
		 */
		public static function ehReal($numero)
		{
			return is_float($numero);
		}


		/**
		 * Função que verifica se o número é inteiro
		 *
		 * @param mixed $numero
		 *
		 * @return bool
		 */
		public static function ehInteiro($numero)
		{
			return is_int($numero);
		}


		/**
		 * Função que verifica se a data está no formato de usuário dia/mes/ano
		 *
		 * @param string $data
		 *
		 * @return bool
		 */
		public static function ehDataUsuario($data)
		{
			//Veriicar se existe a barra
			if (strpos($data, "/") != 0) {
				//Tranformar a string data em um vetor de 3 posições
				$vetorData = explode("/", $data);

				//Verificar se o vetor possui 3 osições
				if (count($vetorData) == 3) {
					$dia = $vetorData[0]; //Extrair o dia
					$mes = $vetorData[1]; //Extrair o mes
					$ano = $vetorData[2]; //Extrair o ano
					//Verificar se a data é válida
					$verifica = checkdate($mes, $dia, $ano);
				} else {
					$verifica = false;
				}

			} else {
				$verifica = false;
			}
			return $verifica;
		}

		/**
		 * Função que verifica se a data está no formato de usuário dia/mes/ano
		 *
		 * @param string $email
		 *
		 * @return bool
		 */
		public static function ehEmail($email)
		{
			//Verificar se o e-mail é válido
			$verifica = filter_var($email, FILTER_VALIDATE_EMAIL);

			//Verificar se as quantidades estão de acordo com o padrão
			return $verifica;
		}
	}

?>