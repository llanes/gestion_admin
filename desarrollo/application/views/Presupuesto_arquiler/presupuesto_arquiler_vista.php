<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            {titulo1}
            <small>{titulo2}</small>     
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
        <section class='content'>
          <div class="row">
             <div class="box box-primary"> 
                <!-- /////////////////////// -->
               <form class="form-horizontal" method="post" name="formulario" id="formulario" role="form" action="<?php echo base_url('index.php/Presupuesto_arquiler/agregar_carrito') ?>">
                    <div class="container" >
                              <!-- cabecera cliente -->
                              <div class="table-responsive col-xs-7">
                                <table class="table"  >
                                    <tr>
                                      <td colspan="" colspan="" headers="" height="10" width="">
                                           <label for="" class="col-xs-1">Cliente</label>
                                         <div class="col-xs-4">
                                               <span class ="cli text-danger"></span>
                                              <input required  type='text' id='autocomplete busqueda_cliente' name="Nombres" class="autocomplete form-control input-sm busqueda_cliente" value="<?php echo set_value('Nombres');?>" placeholder="Nombre del Cliente "  title="Seleciona Categoriaa"/>
                                              <input  id="idCliente" name="idCliente" class="form-control" placeholder="idCliente" value="<?php echo set_value('idCliente');?>" type="hidden"  />
                                        </div>
                                        <label for="" class="col-xs-2 ">C.I/R.U.C</label>
                                         <div class="col-xs-4">
                                              <span class ="cli text-danger"></span>
                                              <input required  type="number" step="any" id='autocomplete busqueda_cliente2' name="ci_ruc" class="autocomplete form-control input-sm busqueda_cliente2" value="<?php echo set_value('ci_ruc');?>" placeholder="Cedula-R.U.C"  title="Seleciona Categoriaa"/>
                                              <input  id="idCliente2" name="idCliente2" class="form-control" placeholder="idCliente2" value="<?php echo set_value('idCliente2');?>" type="hidden"  />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="" colspan="" headers="" hheight="10" width="">
                                                  <label for="" class="col-xs-1">Fecha</label>
                                                   <div class="col-xs-4">
                                                      <input required type="date" class="form-control input-sm" name="" value="" placeholder="">
                                                  </div>
                                                   <label for="" class="col-xs-2">Devolucion</label>
                                                   <div class="col-xs-4">
                                                      <input required type="date" class="form-control input-sm" name="" value="" placeholder="">
                                                  </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="" colspan="" headers="" height="10" width="" style="text-align:left">
                                                   <label for="" class="col-xs-1 ">Tipo</label>
                                                   <div class="col-xs-4">
                                                            <select name="natural_juridica" id="tipo" class="form-control input-sm" required="required">
                                                              <option class="natural" value="1">Natural</option>
                                                              <option class="juridica" value="2">Juridica</option>
                                                            </select>
                                                  </div>
                                                   <label for="" class="col-xs-2">Articulos</label>
                                                   <span class ="pro text-danger"></span>
                                                   <div class="col-xs-4">
                                                       <input  type='text' id='autocomplete busqueda_producto Nombre' name="Nombre" class="autocomplete form-control input-sm busqueda_producto" value="<?php echo set_value('Nombre');?>" placeholder="Nombre del Producto "  title="Buscar"/>
                                                        <input required id="idProducto_Servicio" name="idProducto_Servicio" class="form-control" placeholder="idProducto_Servicio" value="<?php echo set_value('idProducto_Servicio');?>" type="hidden"  />
                                                  </div>
                                      </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="responsive col-md-4">
                                                                     <div class="panel panel-primary">
                                                                          <div class="text-center panel-heading">
                                                                          R.U.C  Nº 599944467-5
                                                                        </div>
                                                                          <div id="boleta" class="text-danger text-center">
                                                                          Boleta de Venta
                                                                          </div>
                                                                          <div id="factura" class="text-danger text-center">
                                                                          Factura
                                                                          </div>
                                                                                  <div class="form-group">
                                                                                      <div class="col-md-6 col-md-offset-0 text-danger text-center">
                                                                                      Serie
                                                                                            <input type="text" class="form-control input-sm" value="001" disabled>
                                                                                      </div>
                                                                                      <div class="col-md-6 col-md-offset-0 text-danger text-center">
                                                                                        Nº Timbrado
                                                                                             <input type="text" class="form-control input-sm" value="5000-666-899" disabled>
                                                                                      </div>
                                                                                  </div>
                                                                       </div>
                              </div>
                            <!-- //////ciere cliente cabecera////////////////// -->
                            <!-- apertura buscador producto -->
                            <div class="table-responsive col-xs-11" >  
                                <table  class="table " >
                                    <tr>
                                      <td>
                                          <label for  ="" class="control-label text-danger">Precio</label>
                                      </td>
                                      <td colspan="" rowspan="" headers="">
                                          <div class  ="">
                                               <input disabled style="border: none;" type ="text" id="Precio_Unitario1" name="Precio_Unitario1" value="" class="input-sm" placeholder="" >
                                              <input type ="hidden" id="Precio_Unitario" name="Precio_Unitario" value="" class="form-control input-sm" placeholder="" >
                                          </div>
                                      </td>
                                      <td>
                                          <label for  ="" class="control-label text-danger">Stock</label>
                                      </td>
                                      <td colspan="" rowspan="" headers="">
                                          <div class  ="col-xs-3">
                                             <input disabled style="border: none;" type ="text" id="Cantidad_stock1" name="Cantidad_stock1" value="" class="input-sm" placeholder="" >
                                             <input type ="hidden" id="stock" name="stock" value="" class="form-control input-sm" placeholder="" >
                                          </div>
                                      </td>
                                      <td>
                                          <label for  ="" class="control-label text-danger">Cantidad</label>
                                      </td>
                                      <td colspan="" rowspan="" headers="">
                                        <span class ="can text-danger"></span>
                                          <div class="col-xs-6" id="max">
                                            <input type ="number" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="" pattern="{10,15}" placeholder="">
                                          </div>
                                      </td>
                                      <td>
                                          <label for  ="" class="control-label text-danger">Inpuesto</label>
                                      </td>
                                      <td colspan="" rowspan="" headers="">
                                                  <div class  ="">
                                                      <select name="opciones[inpuesto]" id="opciones_input" class="form-control input-sm di " >
                                                             <option value="10">10 %</option>
                                                          <option value="5">5 %</option>
                                                        </select>
                                                  </div>
                                      </td>
                                      <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      </td>
                                     <td colspan="" rowspan="" headers="" style="text-align:right">
                                              <button type="button" id="agregar_carrito"  class="btn btn-sm btn-info">
                                                    <i class="fa fa-cart-plus"></i> Agregar
                                            </button>
                                     </td>
                                    </tr>
                                </table>
                            </div>
                            <!-- cierre buscaador producto -->
                            <!-- carrito item -->
                       <div class="col-lg-11 col-md-offset-0 " id="detalle" >  

