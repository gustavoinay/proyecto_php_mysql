<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos
{

	/*=================================================
		Mostrar la tabla de productos   
	=================================================*/

	public function mostrarTablaProductos()
	{
		$item = null;

		$valor = null;

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor);

		//var_dump($productos);
		
		$botones = "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";	

		$datosJson = '{
					  "data": [';
					  for($i = 0; $i < count($productos); $i++)
					  {
					  	$imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

					  	$datosJson .= '[
									      "'.($i+1).'",
									      "'.$imagen.'",
									      "'.$productos[$i]["codigo"].'",
									      "'.$productos[$i]["descripcion"].'",
									      "TALADROS",
									      "'.$productos[$i]["stock"].'",
									      "'.$productos[$i]["precio_compra"].'",
									      "'.$productos[$i]["precio_venta"].'",
									      "'.$productos[$i]["letra"].'",
									      "'.$productos[$i]["fecha"].'",
									      "'.$botones.'"
								      ],';
					  }  

					  $datosJson = substr($datosJson, 0, -1);  

					  $datosJson .= ']
					}';
					    
		echo $datosJson;

	}

}

/*=================================================
	Activar la tabla de productos   
=================================================*/

$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();






?>