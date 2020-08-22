<?php

class ControladorCategorias
{
	/*=================================================
        Crear categorías    
    =================================================*/

    static public function ctrCrearCategoria()
    {
    	if(isset($_POST["nuevaCategoria"]))
    	{
    		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"]))
    		{
    			$tabla = "tcategorias";
    			$datos = $_POST["nuevaCategoria"];

    			$respuesta = ModeloCategorias::mdlIngresarCategoria($tabla, $datos);      

    			if($respuesta == "ok")
    			{
    				echo '<script>

						swal({

								type: "success",
								title: "¡La categoría ha sido guardada correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "categorias";
							}

						});


					</script>';
    			}

    		}
    		else
    		{
    			echo '<script>

						swal({

								type: "error",
								title: "¡La categoría no puede ir vacia o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result) => {
									if(result.value)
									{
										window.location = "categorias";
									}
							});


					</script>';
    		}
    	}
    }

	/*=================================================
        Mostrar categorías    
    =================================================*/

    static public function ctrMostrarCategorias($item, $valor)
    {
    	$tabla = "tcategorias";

    	$respuesta = ModeloCategorias::mdlMostrarCategorias($tabla, $item, $valor);

    	return $respuesta;

    }


	/*=================================================
        Editar categorías    
    =================================================*/

    static public function ctrEditarCategoria()
    {
    	if(isset($_POST["editarCategoria"]))
    	{
    		if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"]))
    		{
    			$tabla = "tcategorias";
    			$datos = array("nom_categoria" => $_POST["editarCategoria"],
    							"id" => $_POST["idCategoria"]);

    			$respuesta = ModeloCategorias::mdlEditarCategoria($tabla, $datos);      

    			if($respuesta == "ok")
    			{
    				echo '<script>

						swal({

								type: "success",
								title: "¡La categoría ha sido cambiada correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "categorias";
							}

						});


					</script>';
    			}

    		}
    		else
    		{
    			echo '<script>

						swal({

								type: "error",
								title: "¡La categoría no puede ir vacia o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false
								}).then((result) => {
									if(result.value)
									{
										window.location = "categorias";
									}
							});


					</script>';
    		}
    	}
    }

   	/*=================================================
        Borrar categorías    
    =================================================*/ 

    static public function ctrBorrarCategoria()
    {
    	if(isset($_GET["idCategoria"]))
    	{
    		$tabla = "tcategorias";
    		$datos = $_GET["idCategoria"];

    		$respuesta = ModeloCategorias::mdlBorrarCategoria($tabla, $datos);

    		if($respuesta == "ok")
    		{
    			echo '<script>

						swal({

								type: "success",
								title: "¡La categoría ha sido borrada correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "categorias";
							}

						});


					</script>';
    		}

    	}
    }

}




?>  