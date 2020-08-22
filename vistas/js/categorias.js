/*=================================================
	Editar Categoria    
=================================================*/
$(document).on("click", ".btnEditarCategoria", function()
//$(".btnEditarCategoria").click(function()
{
	var idCategoria = $(this).attr("idCategoria");

	var datos = new FormData();
	datos.append("idCategoria", idCategoria);

	$.ajax({

		url: "ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta)
		{
			$("#editarCategoria").val(respuesta["nom_categoria"]);
			$("#idCategoria").val(respuesta["id"]); 
			// console.log("respuesta", respuesta);
		}

	})

})

/*=================================================
	Revisar si ya existe la categoría
=================================================*/

$("#nuevaCategoria").change(function()
{
	$(".alert").remove();

	var usuario = $(this).val();

	var desahabilitoBoton = document.getElementById('guardarCategoria');

	desahabilitoBoton.disabled = true;	

	var datos = new FormData();
	datos.append("validarCategoria", usuario);

	$.ajax({

		url: "ajax/categorias.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function(respuesta)
		{
			//console.log("respuesta", respuesta);
			if(respuesta)
			{
				desahabilitoBoton.disabled = true;
				
				$("#nuevaCategoria").parent().after('<div class="alert alert-warning">Esta categoría ya existe en la base de datos</div>');
				//$("#nuevaCategoria").before('<div class="alert alert-warning">Esta categoría ya existe en la base de datos</div>');
				$("#nuevaCategoria").val("");
				//var desahabilitoBoton = document.getElementById('guardarCategoria');

			}
			else
			{
				desahabilitoBoton.disabled = false;
			}
		}

	})

})

/*=================================================
	Dehabilitar boton para validar que no exista la categoría    
=================================================*/
$(document).on("click", ".agregarCategoria", function()
{
	var desahabilitoBoton = document.getElementById('guardarCategoria');

	desahabilitoBoton.disabled = true;	
})


/*=================================================
	Eliminar Categoria    
=================================================*/

$(document).on("click", ".btnEliminarCategoria", function()
{

	var idCategoria = $(this).attr("idCategoria");

	swal({

		title: '¿Está seguro de borrar la categoría?',
		text: "¡Si no lo está puede cancelar la acción!",
		type: 'warning',
		showCancelButton: true,
		confirmBUttonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Cancelar',
		confirmBUttonText: 'Sí, borrar categoría!'
	}).then((result)=>{

			if(result.value)
			{
				window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
			}

		})

})



