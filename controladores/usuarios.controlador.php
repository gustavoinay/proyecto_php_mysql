<?php

	class ControladorUsuarios
	{
		/*==========================================================
		ingreso de usuarios
		==========================================================*/

		public function ctrIngresoUsuario()
		{
			if(isset($_POST["ingUsuario"]))
			{
				if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"]))
				{

					$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tabla = "tusuarios";
					$item = "usuario";
					$valor = $_POST["ingUsuario"];

					$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

					if(is_array($respuesta)){
						if($respuesta["usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar)
						{
							if($respuesta["estado"] == 1)
							{
							//	var_dump($respuesta["usuario"]);
							//	var_dump($respuesta);
							//	die();
								/*echo '<br><div class="alert alert-success">Bienvenido al sistema</div>';*/

								$_SESSION["iniciarSesion"] = "ok";
								$_SESSION["id"] = $respuesta["id"];
								$_SESSION["nombre"] = $respuesta["nombre"];
								$_SESSION["usuario"] = $respuesta["usuario"];
								$_SESSION["foto"] = $respuesta["foto"];
								$_SESSION["perfil"] = $respuesta["perfil"];

								/*==========================================================
									registrar fecha para saber el ultimo login
								==========================================================*/

								 date_default_timezone_set('America/Guatemala');

								 $fecha = date('Y-m-d');
								 $hora = date('H:i:s');

								 $fechaActual = $fecha.' '.$hora;

								 $item1 = "ultimo_login";
								 $valor1 = $fechaActual;

								 $item2 = "id";
								 $valor2 = $respuesta["id"];

								 $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

								 var_dump($ultimoLogin);
								 //die();

								 if($ultimoLogin == "ok")
								 {
								 	echo '<script>
										window.location = "inicio";
									  </script>';
								 }


							}
							else
							{
								echo '<br> <div class="alert alert-danger"> El usuario aún no está activado</div>';
							}

						}
						else
						{

							echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
						}
					}
					else
					{
						echo '<br><div class="alert alert-danger">El usuario no existe, vuelve a intentarlo</div>';
					}
				}
			}


		}

		/*==========================================================
		registro de  usuarios
		==========================================================*/

		static public function ctrCrearUsuario()
		{
			if(isset($_POST["nuevoUsuario"])) //Solo si viene del formulario (variable nuevoUsuario)
			{

				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
					preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
					) //validar con expresion regular el nombre de usuario
				{

					/*==========================================================
						Validar Imagen
					==========================================================*/

					$ruta = "";

					if(isset($_FILES["nuevaFoto"]["tmp_name"]))
					{

						list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

						$nuevoAncho  = 500;
						$nuevoAlto = 500;

					/*==========================================================
						Creamos el directorio en donde se va a guardar la imagen
					==========================================================*/

						$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];

						if(!file_exists($directorio))
						{
							mkdir($directorio, 0755); // 0755 permisos de lectura escritura
						}

					/*==========================================================
						De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
					==========================================================*/

						if($_FILES["nuevaFoto"]["type"] == "image/jpeg")
						{
							/*==========================================================
								Guardamos la imagen en el directorio
							==========================================================*/

							//$aleatorio = mt_rand(100, 999);

							// $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

							$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$_POST["nuevoUsuario"].".jpg";

							$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

							//$aleatorio = null;


						}

						if($_FILES["nuevaFoto"]["type"] == "image/png")
						{
							/*==========================================================
								Guardamos la imagen en el directorio
							==========================================================*/

							//$aleatorio = mt_rand(100, 999);

							// $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

							$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$_POST["nuevoUsuario"].".png";

							$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

							//$aleatorio = null;


						}


						//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));
					}


					$tabla = "tusuarios";

					$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$datos = array( "nombre" => $_POST["nuevoNombre"],
								    "usuario" => $_POST["nuevoUsuario"],
								    "password" => $encriptar,
								    "perfil" => $_POST["nuevoPerfil"],
									"foto" => $ruta);

					$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);

					if($respuesta == "ok")
					{
						echo '<script>

						swal({

								type: "success",
								title: "¡El usuario ha sido guardado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "usuarios";
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
								title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "usuarios";
							}

						});


					</script>';
				}
			}
		}

		/*==========================================================
			Mostrar usuario
		==========================================================*/

		static public function ctrMostrarUsuarios($item, $valor)
		{
			$tabla = "tusuarios";
			$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

			return $respuesta;
		}

		/*==========================================================
			Editar usuario
		==========================================================*/

		static public function ctrEditarUsuario()
		{
			if(isset($_POST["editarUsuario"]))
			{
				if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) //validar con expresion regular el nombre de usuario
				{
					/*==========================================================
						Validar Imagen
					==========================================================*/

					$ruta = $_POST["fotoActual"];

					if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"]))
					{

						list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

						$nuevoAncho  = 500;
						$nuevoAlto = 500;

					/*==========================================================
						Creamos el directorio en donde se va a guardar la imagen
					==========================================================*/

						$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					/*==========================================================
						Primero preguntamos si existe otra imagen en la db
					==========================================================*/

						if(!empty($_POST["fotoActual"]))
						{
							unlink($_POST["fotoActual"]);
						}
						else
						{
							 mkdir($directorio, 0755); // 0755 permisos de lectura escritura
						}

						// if(!file_exists($directorio))
						// {
						// 	mkdir($directorio, 0755); // 0755 permisos de lectura escritura
						// }

					/*==========================================================
						De acuerdo al tipo de imagen aplicamos las funciones por defecto de php
					==========================================================*/

						if($_FILES["editarFoto"]["type"] == "image/jpeg")
						{
							/*==========================================================
								Guardamos la imagen en el directorio
							==========================================================*/

							//$aleatorio = mt_rand(100, 999);

							// $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$_POST["editarUsuario"].".jpg";

							$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagejpeg($destino, $ruta);

							//$aleatorio = null;


						}

						if($_FILES["editarFoto"]["type"] == "image/png")
						{
							/*==========================================================
								Guardamos la imagen en el directorio
							==========================================================*/

							//$aleatorio = mt_rand(100, 999);

							// $ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";

							$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$_POST["editarUsuario"].".png";

							$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

							$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

							imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

							imagepng($destino, $ruta);

							//$aleatorio = null;


						}


						//var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));
					}

					$tabla = "tusuarios";

					if($_POST["editarPassword"] != "")
					{
						if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

							$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						}
						else
						{
							echo '<script>

									swal({

											type: "error",
											title: "¡La contraseña no puede ir vacia o llevar caracteres especiales!",
											showConfirmButton: true,
											confirmButtonText: "Cerrar",
											closeOnConfirm: false

									}).then((result) => {

										if(result.value)
										{
											window.location = "usuarios";
										}

									});


								</script>';

						}
					}
					else
					{
						$encriptar = $passwordActual;
					}

					$datos = array( "nombre" => $_POST["editarNombre"],
								    "usuario" => $_POST["editarUsuario"],
								    "password" => $encriptar,
								    "perfil" => $_POST["editarPerfil"],
									"foto" => $ruta);

					$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

					if($respuesta == "ok")
					{
						echo '<script>

						swal({

								type: "success",
								title: "¡El usuario ha sido editado correctamente!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "usuarios";
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
								title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
								showConfirmButton: true,
								confirmButtonText: "Cerrar",
								closeOnConfirm: false

						}).then((result) => {

							if(result.value)
							{
								window.location = "usuarios";
							}

						});


					</script>';

				}

			}
		}

		/*==========================================================
		borrar  usuarios
		==========================================================*/

		 static public function ctrBorrarUsuario()
		 {
		 	if(isset($_GET["idUsuario"]))
		 	{
		 		$tabla = "tusuarios";
		 		$datos = $_GET["idUsuario"];

		 		if($_GET["fotoUsuario"] != "")
		 		{
		 			unlink($_GET["fotoUsuario"]);
		 			rmdir('vistas/img/usuarios/'.$_GET["usuario"]);
		 		}

		 		$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

		 		if($respuesta == "ok")
				{
					echo '<script>
						swal({

							type: "success",
							title: "¡El usuario ha sido borrado correctamente!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar",
							closeOnConfirm: false
						}).then((result) => {
							if(result.value)
							{
								window.location = "usuarios";
							}
						});

					</script>';

				}

		 	}

		 }


	}

?>
