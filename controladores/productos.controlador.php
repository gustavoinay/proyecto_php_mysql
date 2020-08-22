<?php

class ControladorProductos
{

	/*=================================================
        Mostrar productos    
    =================================================*/

    static public function ctrMostrarProductos($item, $valor)
    {
    	$tabla = "tproductos";

    	$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

    	return $respuesta;
    }

}


?>  