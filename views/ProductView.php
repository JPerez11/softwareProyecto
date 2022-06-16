<?php
    require_once "models/ProductModel.php";
    class ProductView
    {

        function showProduct()
        {
            $Connection = new Connection();
            $ProductModel = new ProductModel($Connection);
            $array_products = $ProductModel->fetchPorduct();
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
                            <button class="btn btn-primary float-md-right" id="form_product" name="form_product" onclick="getFormProduct()">
                                	<i class="nav-item fas fa-plus-circle"></i>
                                &nbsp;Registrar producto
                            </button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio venta</th>
                                <th>Precio compra</th>
                                <th>descripci&oacute;n</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($array_products as $object_product) {
                                        $cod_producto = $object_product->cod_producto;
                                        $nombre_producto = ucwords(strtolower($object_product->nombre_producto));
                                        $precio_venta = $object_product->precio_venta;                                        
                                        $precio_compra = $object_product->precio_compra;
                                        $descripcion = ucwords(strtolower($object_product->descripcion));
                                        ?>
                                        <tr>
                                            <td><?php echo $nombre_producto;?></td>
                                            <td><?php echo $precio_venta;?></td>
                                            <td><?php echo $precio_compra;?></td>
                                            <td><?php echo $descripcion;?></td>
                                            <td style="text-align: center;"><i class="fas fa-edit" style="cursor:pointer;" onclick="getProduct('<?php echo $cod_producto?>');"></i>
                                            </td>
                                        </tr>
                                        <?php
                                    }                                
                                ?>                  
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Producto</th>
                                <th>Precio venta</th>
                                <th>Precio compra</th>
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
                <!-- Toastr -->
                <script src="plugins/toastr/toastr.min.js"></script>
                <!-- Page specific script -->
                <script src="js/product.js"></script>
                <!-- javascript propio -->
                <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                <!-- javascript sweetalert -->           
            </body>
            </html>
            <?php
        }

        function addProduct()
        {
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de registro</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="addProduct">
                    <div class="card-body">
                    <div class="form-group">
                            <label for="nombre_producto">Nombre del producto</label>
                            <input type="text" autocomplete="off" id="nombre_producto" name="nombre_producto" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta">Precio de venta</label>
                            <input type="number" autocomplete="off" id="precio_venta" name="precio_venta" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="precio_compra">Precio de compra</label>
                            <input type="number" autocomplete="off" id="precio_compra" name="precio_compra" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripci&oacute;n</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addProduct()">Registrar</button>                  
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            </div>
            <?php
        }
        function updateProduct($array_product)
        {   
            $cod_producto = $array_product[0]->cod_producto;
            $nombre_producto = $array_product[0]->nombre_producto;
            $precio_venta = $array_product[0]->precio_venta;
            $precio_compra = $array_product[0]->precio_compra;
            $descripcion = $array_product[0]->descripcion;

            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de actualizaci&oacute;n</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="updateProduct">
                <div class="card-body">
                    <div class="form-group row" hidden>
                        <label for="cod_producto" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="text" autocomplete="off" class="form-control" id="cod_producto" name="cod_producto" maxlength="100" value="<?php echo $cod_producto;?>">
                        </div>
                    </div>
                    <div class="form-group">
                            <label for="nombre_producto">Nombre del producto</label>
                            <input type="text" autocomplete="off" id="nombre_producto" name="nombre_producto" class="form-control" value="<?php echo $nombre_producto;?>">
                        </div>
                        <div class="form-group">
                            <label for="precio_venta">Precio de venta</label>
                            <input type="text" autocomplete="off" id="precio_venta" name="precio_venta" class="form-control" value="<?php echo $precio_venta;?>">
                        </div>
                        <div class="form-group">
                            <label for="precio_compra">Precio de compra</label>
                            <input type="text" autocomplete="off" id="precio_compra" name="precio_compra" class="form-control" value="<?php echo $precio_compra;?>">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripci&oacute;n</label>
                            <textarea id="descripcion" name="descripcion" class="form-control" rows="4" ><?php echo $descripcion;?></textarea>
                        </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="updateProduct()">Actualizar</button>                  
                </div>
                <!-- /.card-footer -->
                </form>
            </div>
            <?php
        }
    }


?>
