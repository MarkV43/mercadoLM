<?php
	function money($a){
		return "R$".number_format($a,2,","," ");
	}
	function criptograthPass($userId,$pass){
		return hash("sha512",$userId.$pass);
	}
?>
