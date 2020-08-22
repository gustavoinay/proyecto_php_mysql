  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Administrar Categorías
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Categorías</li>
      </ol>
    </section>


    <section class="content">


      <div class="box">
        <div class="box-header with-border">

          <button class="btn btn-primary" class="agregarCategoria" data-toggle="modal" data-target="#modalAgregarCategoria">
            Agregar Categoría
          </button>

        </div>

        <div class="box-body">
          
          <table class="table table-bordered table-striped dt-responsive tablas">
            
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Categorías</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <tbody>

              <?php

                $item = null;
                $valor = null;  

                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                //var_dump($categorias);

                foreach($categorias as $key => $value)
                {
                  echo '<tr>

                          <td>'.($key + 1).'</td>
                          <td class="text-uppercase">'.$value["nom_categoria"].'</td>
                          <td>
                            <div class="btn-group">
                              <button class="btn btn-warning btnEditarCategoria" idCategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>
                              <button class="btn btn-danger btnEliminarCategoria" idCategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>
                            </div>
                          </td>
                        </tr>';
                }
              ?>

            </tbody>
          </table>

        </div>
 
      </div>

    </section>

  </div>
<!-- /.content-wrapper -->

<!--=================================================
modal agregar categoría
=================================================-->


<div id="modalAgregarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=================================================
        cabeza del modal
        =================================================-->


        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Categoría</h4>
        
        </div>
        
        <!--=================================================
        cuerpo del modal
        =================================================-->

        <div class="modal-body">
        
          <div class="box-body">
            <!-- Entrada para el nombre -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="nuevaCategoria" id="nuevaCategoria" placeholder="Ingresar Categoría" required>

              </div>

            </div>  

          </div>

        </div>
        
        <!--=================================================
        pie del modal
        =================================================-->
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" id="guardarCategoria">Guardar categoría</button>
        
        </div>

        <?php

          $crearCategoria = new ControladorCategorias();
          $crearCategoria -> ctrCrearCategoria();

        ?>

      </form>
    
    </div>

  </div>
</div>

<!--=================================================
modal editar categoría
=================================================-->


<div id="modalEditarCategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=================================================
        cabeza del modal
        =================================================-->


        <div class="modal-header" style="background: #3c8dbc; color: white;">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar Categoría</h4>
        
        </div>
        
        <!--=================================================
        cuerpo del modal
        =================================================-->

        <div class="modal-body">
        
          <div class="box-body">
            <!-- Entrada para el nombre -->
            <div class="form-group">
              
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input-lg" name="editarCategoria" id="editarCategoria" required>

                <input type="hidden" name="idCategoria" id="idCategoria" required>

              </div>

            </div>  

          </div>

        </div>
        
        <!--=================================================
        pie del modal
        =================================================-->
        
        <div class="modal-footer">
        
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>
        
        </div>

        <?php

          $editarCategoria = new ControladorCategorias();
          $editarCategoria -> ctrEditarCategoria();

        ?>

      </form>
    
    </div>

  </div>
</div>

<?php

  $borrarCategoria = new ControladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();

?>