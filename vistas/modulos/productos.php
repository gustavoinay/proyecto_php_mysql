  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Administrar Productos
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar productos</li>
      </ol>
    </section>


    <section class="content">  


      <div class="box">
        <div class="box-header with-border">

          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
            Agregar Producto
          </button>

        </div>

        <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablaProductos">
            
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Descripción</th> 
                <th>Categoría</th>
                <th>Stock</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Letra</th>
                <th>fecha</th>
                <th>Acciones</th>
              </tr>
            </thead>

          </table>

        </div>
 
      </div>

    </section>

  </div>

<!--=================================================
modal agregar producto
=================================================-->


<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=================================================
        cabeza del modal
        =================================================-->


        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Producto</h4>
        
        </div>
        
        <!--=================================================
        cuerpo del modal
        =================================================-->

        <div class="modal-body">
        
          <div class="box-body">
            <!-- Entrada para el código -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Código" required>

              </div>

            </div>  
            <!-- Entrada para la descripción -->
              <div class="form-group">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                  <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar Descripción" required>

                </div>

               </div> 

             <!-- Entrada seleccionar categoría -->
              <div class="form-group">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select class="form-control input-lg" name="nuevaCategoria">
                    
                    <option value="">Seleccionar categoría</option>
                    <option value="Accesorios">Accesorios</option>
                    <option value="Casual">Casual</option>
                    <option value="Importado">Importados</option>
    
                  </select>

                </div>

              </div>  

             <!-- Entrada para stock -->
              <div class="form-group">
              
                <div class="input-group">
                  
                  <span class="input-group-addon"><i class="fa fa-check"></i></span>

                  <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Ingresar Stock" required>

                </div>

               </div> 

             <!-- Entrada para precio compra -->
              <div class="form-group row">

                <div class="col-xs-6">
              
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                    <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio de compra" required>

                  </div>

                </div>      

               <!-- Entrada para precio venta -->
                <div class="col-xs-6">

                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                    <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio de venta " required>

                  </div>

                  <br>
                 
                  <!-- Checkbox para pocentaje -->
                  <div class="col-xs-6">

                    <div class="form-group">

                      <label>

                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar porcentaje

                      </label>

                    </div>
                                      
                  </div>

                  <!-- Entrada para pocentaje -->
                  <div class="col-xs-6" style="padding: 0">

                    <div class="input-group">

                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                      
                    </div>
                    
                  </div>

                </div>

              </div>               

            <!-- Entrada subir foto -->
              <div class="form-group">
              
                <div class="panel">SUBIR IMAGEN</div>
                
                <input type="file" id="nuevaImagen" name="nuevaImagen">
                <p class="help-block">Peso máximo de la imagen 2 MB</p>
                <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail" width="100px" alt="foto del producto">

              </div>  

            </div>

          </div>
        
        <!--=================================================
        pie del modal
        =================================================-->
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar producto</button>
        
        </div>

      </form>
    
    </div>

  </div>
</div>
