<?php

	class Conexion{
		static public function conectar()
		{
			$link = new PDO("mysql:host=localhost;dbname=id14370475_dbpos",
							"id14370475_dbposu",
							"@-Q%&]l@%f[Y6eR+");
			$link->exec("set names utf8");

			return $link;
		}
	}

?>
