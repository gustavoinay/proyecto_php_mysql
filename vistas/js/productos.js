/*=================================================
	Cargar la tabla dinámica de productos   
=================================================*/

$.ajax({

	url: "ajax/datatable-productos.ajax.php",
	success:function(respuesta)
	{
		console.log("respuesta", respuesta);
	}

})

$('.tablaProductos').DataTable({

	"ajax": "ajax/datatable-productos.ajax.php"	

});