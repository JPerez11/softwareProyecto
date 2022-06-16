<?php
require_once "models/SupplyModel.php";
class SupplyView
{
    function showSupply()
    {
        $Connection = new Connection();
        $SupplyModel = new SupplyModel($Connection);
        $array_inventory = $SupplyModel->fetchSupply();
        ?>
            <!DOCTYPE html>
            <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <!-- Google Font: Source Sans Pro -->
                <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
                <!-- Font Awesome -->
                <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
                <!-- DataTables -->
                <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
                <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
                <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
                  <!-- BS Stepper -->
                <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
                <!-- Theme style -->
                <link rel="stylesheet" href="dist/css/adminlte.min.css">
                <!-- Libreria sweetalert -->
                <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
                <!-- Stilos del menu -->
                <link rel="stylesheet" href="css/menu.css">

                <title>Proyecto | Gestor empresarial</title>
            </head>
            <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
                    <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-12">
                        <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informaci&oacute;n de inventario</h3>
                            <button class="btn btn-primary float-md-right" id="form_product" name="form_product" onclick="getFormSupply()">
                              <i class="nav-item fas fa-plus-circle"></i>
                                &nbsp;Registrar suministro
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio venta</th>
                                <th>Precio compra</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>descripci&oacute;n</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($array_inventory as $object_inventory) {
                                        $cod_producto = $object_inventory->cod_producto;
                                        $nombre_producto = ucwords(strtolower($object_inventory->nombre_producto));
                                        $cantidad = $object_inventory->cantidad;
                                        $precio_venta = $object_inventory->precio_venta;                                        
                                        $precio_compra = $object_inventory->precio_compra;
                                        $fecha = $object_inventory->fecha;
                                        $nif = $object_inventory->nif;
                                        $nombre_proveedor = ucwords(strtolower($object_inventory->nombre));
                                        $descripcion = ucwords(strtolower($object_inventory->descripcion));
                                        ?>
                                        <tr>
                                            <td><?php echo $nombre_producto;?></td>
                                            <td><?php echo $cantidad;?></td>
                                            <td><?php echo $precio_venta;?></td>
                                            <td><?php echo $precio_compra;?></td>
                                            <td><?php echo $fecha;?></td>
                                            <td><?php echo $nombre_proveedor;?></td>
                                            <td><?php echo $descripcion;?></td>
                                            <td style="text-align: center;"><i class="fas fa-edit" style="cursor:pointer;" onclick="getSupply('<?php echo $cod_producto . ':' . $nif . ':' . $fecha?>');"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }                                
                                ?>                  
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio venta</th>
                                <th>Precio compra</th>
                                <th>Fecha</th>
                                <th>Proveedor</th>
                                <th>descripci&oacute;n</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                </section>

                <div id="my_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-info">
                                <h5 class="modal-title" id="modal_tittle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div id="my_modal_content" class="modal-body">


                            </div>
                        </div>
                    </div>
                </div>
                <!-- jQuery -->
                <script src="plugins/jquery/jquery.min.js"></script>
                <!-- Bootstrap 4 -->
                <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
                <!-- DataTables  & Plugins -->
                <script src="plugins/datatables/jquery.dataTables.min.js"></script>
                <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
                <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
                <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
                <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
                <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
                <script src="plugins/jszip/jszip.min.js"></script>
                <script src="plugins/pdfmake/pdfmake.min.js"></script>
                <script src="plugins/pdfmake/vfs_fonts.js"></script>
                <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
                <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
                <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
                <!-- AdminLTE App -->
                <script src="dist/js/adminlte.min.js"></script>
                <!-- AdminLTE for demo purposes -->
                <script src="dist/js/demo.js"></script>
                <!-- bs-custom-file-input -->
                <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
                <!-- BS-Stepper -->
                <script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
                <!-- Page specific script -->
                <script src="js/supply.js"></script>
                <!-- javascript propio -->
                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                <!-- javascript sweetalert -->           
            </body>
            </html>
        <?php
    }

    function addSupply()
    {
        $Connection = new Connection();
        $SupplyModel = new SupplyModel($Connection);
        $id_provider = $SupplyModel->idProvider();
        $id_producto = $SupplyModel->idProduct();
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-tittle">Formulario de registro</h3>
          </div>
              <!-- form start -->
              <form action="" class="form-horizontal" id="addSupply">
                <div class="card-body">
                <div class="form-group row">
                    <label for="nombre_producto" class="col-sm-12 col-form-label">Productos disponibles</label>
                  </div>
                  <div class="col-md-12">
                    <input type="search" autocomplete="off" class="form-control" name="nombre_producto" id="nombre_producto" list="productos">
                    <datalist id="productos">
                    <?php
                      foreach($id_producto AS $productos)
                      {
                          $cod_producto = $productos->cod_producto;
                          $nombre_producto = ucwords(strtolower($productos->nombre_producto));
                          ?>
                          <option><?php echo $nombre_producto;?></option>
                          <?php
                      }
                    
                    ?>
                    </datalist>
                  </div>
                  <div class="form-group row">
                      <label for="nif" class="col-sm-2 col-form-label">Proveedores</label>
                      <div class="col-md-12">
                        <select class="custom-select" name="nif" id="nif">
                          <option selected value="">Seleccione el proveedor</option>
                          <?php
                            foreach($id_provider as $providers)
                            {
                              $nif = $providers->nif;
                              $nombre = ucwords(strtolower($providers->nombre));
                              ?>
                              <option value=<?php echo $nif;?>><?php echo $nombre;?></option>
                              <?php
                            }
                            ?>
                        </select>
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                      <div class="col-sm-12">
                        <input type="number" autocomplete="off" class="form-control" id="cantidad" name="cantidad" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addSupply()">Registrar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
        <?php
    }

    function getSupply($array_supply)
    {   
        $cod_producto = $array_supply[0]->cod_producto;
        $nombre_producto = ucwords(strtolower($array_supply[0]->nombre_producto));
        $nombre = ucwords(strtolower($array_supply[0]->nombre));
        $nif = $array_supply[0]->nif;
        $fecha = $array_supply[0]->fecha;
        $cantidad = $array_supply[0]->cantidad;
        $precio_compra = $array_supply[0]->precio_compra;
        ?>
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-tittle">Formulario de actualizaci&oacute;n</h3>
          </div>
              <!-- form start -->
              <form action="" class="form-horizontal" id="updateSupply">
                <div class="card-body">
                <div class="form-group row" hidden>
                    <div class="col-sm-10">
                      <input type="text" autocomplete="off" class="form-control" id="cod_producto" name="cod_producto" maxlength="9" value="<?php echo $cod_producto;?>">
                      <input type="text" autocomplete="off" class="form-control" id="nif" name="nif" maxlength="9" value="<?php echo $nif;?>">
                      <input type="text" autocomplete="off" class="form-control" id="fecha" name="fecha" maxlength="9" value="<?php echo $fecha;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <h3>Actualizar el producto <?php echo $nombre_producto?> suministrado por <?php echo $nombre?></h3>
                  </div>
                  <div class="form-group row">
                    <label for="cantidad" class="col-sm-2 col-form-label">Cantidad</label>
                    <div class="col-sm-10">
                      <input type="number" autocomplete="off" class="form-control" id="cantidad" name="cantidad" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="<?php echo $cantidad;?>">
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="updateSupply()">Actualizar</button>                  
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
        </div>
        <?php
    }

}


?>