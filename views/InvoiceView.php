<?php
require_once "models/InvoiceModel.php";

    class InvoiceView
    {
        function showInvoice()
        {
            $Connection = new Connection();
            $InvoiceModel = new InvoiceModel($Connection);
            $array_invoice = $InvoiceModel->fetchInvoice();
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
                                <h3 class="card-title">Informaci&oacute;n de facturas</h3>
                                <button class="btn btn-primary float-sm-right" id="add_client" name="add_client" onclick="getFormInvoice()">
                                <i class="nav-item fas fa-plus-circle"></i>
                                    &nbsp;Crear factura
                                </button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>c&oacute;digo de factura</th>
                                    <th>cliente</th>
                                    <th>fecha creaci&oacute;n</th>
                                    <th>total</th>
                                    <th>Acci&oacute;n</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach ($array_invoice as $object_invoice) {
                                            $cod_factura = $object_invoice->cod_factura;
                                            $documento = $object_invoice->documento;
                                            $cod_cliente = $object_invoice->cod_cliente;
                                            $fecha = $object_invoice->fecha;
                                            $descuento = $object_invoice->descuento;
                                            $total = $object_invoice->total;
                                            if ($total == "") {
                                                $total = 0;
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $cod_factura;?></td>
                                                <td><?php echo $documento;?></td>
                                                <td><?php echo $fecha;?></td>
                                                <td><?php echo $total;?></td>
                                                <td style="text-align: center;">
                                                <i class="fas fa-receipt" style="cursor:pointer;" title="Agregar ventas a la factura" onclick="getFormDetail(<?php echo $cod_factura?>)"></i> &nbsp;
                                                <i class="fas fa-eye" style="cursor:pointer;" title="Consultar factura a detalle" onclick="showInvoiceDetail(<?php echo $cod_factura?>)"></i> &nbsp;
                                                <i class="fas fa-edit" style="cursor:pointer;" title="Modificar factura" onclick="getClient('<?php echo $cod_factura?>');"></i>
                                                </td>
                                            </tr>
                                            <?php
                                        }                                
                                    ?>                  
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>c&oacute;digo de factura</th>
                                    <th>cliente</th>
                                    <th>fecha creaci&oacute;n</th>
                                    <th>total</th>
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

                    <div id="invoice_detail" class="modal" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div id="my_invoice_detail" class="modal-body">


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
                    <!-- Page specific script -->
                    <script src="js/invoice.js"></script>
                    <!-- javascript propio -->
                    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
                    <!-- javascript sweetalert -->
                </body>
                </html>
            <?php
        }
        function addInvoice($id_cliente)
        {
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de registro</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="addInvoice">
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="documento">Documento del cliente</label>
                            <input type="search" autocomplete="off" class="form-control" name="documento" id="documento" list="clientes" maxlength="10" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                            <datalist id="clientes">
                            <?php
                            foreach($id_cliente AS $clientes)
                            {
                                $nombre = $clientes->nombre;
                                $documento = $clientes->documento;
                                ?>
                                <option value=<?php echo $documento?>><?php echo $nombre;?></option>
                                <?php
                            }
                            ?>
                            </datalist>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addInvoice()">Registrar</button>                  
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            </div>
            <?php
        }

        function addDetail($id_producto, $cod_factura)
        {
            
            ?>
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-tittle">Formulario de compra</h3>
                </div>
                <!-- form start -->
                <form action="" class="form-horizontal" id="addDetail">
                    <div class="card-body">
                    <div class="form-group col-md-12" hidden>
                            <label for="cod_factura">C&oacute;digo de factura</label>
                            <input type="number" autocomplete="off" id="cod_factura" name="cod_factura" class="form-control" value="<?php echo $cod_factura?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="ordinal">Ordinal de la venta</label>
                            <input type="number" autocomplete="off" id="ordinal" name="ordinal" class="form-control" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="producto">Nombre del producto</label>
                            <input type="search" autocomplete="off" class="form-control" name="producto" id="producto" list="productos">
                            <datalist id="productos">
                            <?php
                            foreach($id_producto AS $productos)
                            {
                                $cod_producto = $productos->cod_producto;
                                $nombre_producto = ucwords(strtolower($productos->nombre_producto));
                                ?>
                                <option value="<?php echo $nombre_producto;?>"></option>
                                <?php
                            }
                            ?>
                            </datalist>
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad de productos</label>
                            <input type="number" autocomplete="off" id="cantidad" name="cantidad" class="form-control" maxlength="4" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                        <div class="form-group">
                            <label for="descuento">Descuento de la compra</label>
                            <input type="number" id="descuento" name="descuento" class="form-control" maxlength="2" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                    <button type="button" class="btn btn-info float-md-right" id="register" name="register" onclick="addDetail()">Registrar</button>                  
                    </div>
                    <!-- /.card-footer -->
                </form>
                </div>
            </div>
            <?php
        }

        function showInvoiceDetail($array_venta)
        {
            $cod_factura = $array_venta[0]->cod_factura;
            $fecha_factura = $array_venta[0]->fecha;
            $nombre = ucwords(strtolower($array_venta[0]->nombre));
            $apellido = ucwords(strtolower($array_venta[0]->apellido));
            $celular = $array_venta[0]->celular;
            $email = ucwords(strtolower($array_venta[0]->email));
            ?>
            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="imp1"> 
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i><b>Gestor</b>Empresarial, Inc.
                    <small class="float-right">Date: <?php echo $fecha_factura?></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>Gestor, Inc.</strong><br>
                    Am&eacute;rica l&aacute;tina, Colombia<br>
                    Oca&ntilde;a, Norte de Santander<br>
                    Phone: +57 3164547947<br>
                    Email: jsperezr@ufpso.edu.co
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong><?php echo $nombre . ' ' . $apellido?></strong><br>
                    Am&eacute;rica l&aacute;tina, Colombia<br>
                    Oca&ntilde;a, Norte de Santander<br>
                    Phone: +57 <?php echo $celular?><br>
                    Email: <?php echo $email?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #<?php echo $cod_factura?></b><br>
                  <br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                      <th>Cantidad</th>
                      <th>Producto</th>
                      <th>Description</th>
                      <th>Precio unitario</th>
                      <th>Descuento</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach ($array_venta as $detalle) 
                        {
                            $ordinal = $detalle->ordinal;
                            $cantidad = $detalle->cantidad;
                            $producto = $detalle->nombre_producto;
                            $descripcion = $detalle->descripcion;
                            $precio_venta = $detalle->precio_venta;
                            $valor_descuento = $detalle->valor_descuento;
                            $descuento = $detalle->descuento;
                            $subtotal = $detalle->subtotal;
                            $total = $detalle->total;

                            ?>
                            <tr>
                                <td><?php echo $ordinal?></td>
                                <td><?php echo $cantidad?></td>
                                <td><?php echo $producto?></td>
                                <td><?php echo $descripcion?></td>
                                <td>$ <?php echo $precio_venta?></td>
                                <td><?php echo $valor_descuento?></td>
                                <td>$ <?php echo $subtotal?></td>
                            </tr>
                            <?php
                            
                        }
                    ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="dist/img/credit/visa.png" alt="Visa">
                  <img src="dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="dist/img/credit/american-express.png" alt="American Express">
                  <img src="dist/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Importe adecuado: <?php echo $fecha_factura?></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Descunto total:</th>
                        <td>$ <?php echo $descuento?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$ <?php echo $total?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="#" onclick="javascript:imprim1(imp1)" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
            <?php
        }
    }
?>