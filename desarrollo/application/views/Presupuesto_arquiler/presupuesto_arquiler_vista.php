<div class="content-wrapper">
        <!-- Content Header (Page header) -->
                <section class="panel panel-success">
                          <header class="panel-heading">
                              <ul class="nav nav-tabs">
                                  <li class="active" id="presupuesto1">
                                      <a data-toggle="tab" href="#presupuesto_alquiler">
                                      <i class="fa fa-calculator"></i>
                                      Crear Presupuesto Alquiler</a>
                                  </li>
                                  <li class="" id="lista_presus">
                                      <a data-toggle="tab" href="#listados_presupuesto">
                                      <i class="fa fa-list"></i>
                                      Administrar Presupuesto </a>
                                  </li>
                                  <li class="" id="lista_alqui">
                                      <a data-toggle="tab" href="#listados_alquiler">
                                      <i class="fa fa-list"></i>
                                      Administrar Alquiler</a>
                                  </li>
                                  <li>

                                  </li>
                                   <li class="">
                                      <a>{titulo1}</a>
                                  </li>
                                  <li ><a>
                                      <i class="fa fa-dashboard"></i> {titulo3}  {titulo4}
                                  </a></li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div id="" class="tab-content">
 <div id="presupuesto_alquiler" class="tab-pane active">  
                          <!-- comienzo de presupuesto -->
        <section class=''>
          <div class="row">
             <div class=""> 
                <!-- /////////////////////// -->
               <form class="form-horizontal" method="post" name="formulario" id="formulario" role="form" action="#" >
               <input type="hidden" name="fecha_expedicion" id="fecha_expedicion" value="<?php echo date("Y-m-d");?>">
                    <div class="container" >
                               <!-- cabecera cliente -->
                                 <div class="col-xs-7">
                                <table class="table"  >

                                    <tr>
                                      <td colspan="" colspan="" headers="" height="10" width="">
                                           <label for="" class="col-xs-1">Cliente</label>
                                         <div class="col-xs-4">
                                               <span class ="cli text-danger"></span>
                                              <input required  type='text' id='autocomplete busqueda_cliente' name="Nombres" class="autocomplete form-control input-sm busqueda_cliente" value="" placeholder="Nombre del Cliente "  title="Seleciona Categoriaa"/>
                                              <input  id="idCliente" name="idCliente" class="form-control" placeholder="idCliente" value="{idCliente}" type="hidden"  />
                                        </div>
                                        <label for="" class="col-xs-2 ">C.I/R.U.C</label>
                                         <div class="col-xs-4">
                                              <span class ="cli text-danger"></span>
                                              <input required  type="number" step="any" id='autocomplete busqueda_cliente2' name="ci_ruc" class="autocomplete form-control input-sm busqueda_cliente2" value="" placeholder="Cedula-R.U.C"  title="Seleciona Categoriaa"/>
                                              <input  id="idCliente2" name="idCliente2" class="form-control" placeholder="idCliente2" value="<?php echo set_value('idCliente2');?>" type="hidden"  />
                                        </div>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td colspan="" colspan="" headers="" hheight="10" width="">
                                                  <label for="" class="col-xs-1">Entrega</label>
                                      <div class="col-md-4">
                                           <div class='input-group date' id='datetimepicker6'>
                                              <!-- <input required type="text" id="Fecha_Pre_Arqui" name="Fecha_Pre_Arqui" class="form-control input-sm " readonly="" size="16" value=""> -->
                                              <input required type='text' class="form-control input-sm" id="Fecha_Pre_Arqui" name="Fecha_Pre_Arqui"  size="16" value=""/>
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                                              </div>
                                          </div>
                                      </div>
                                                   <label for="" class="col-xs-2">Devolucion</label>


                                      <div class="col-md-4">
                                          <div class='input-group date' id='datetimepicker7'>
                                              <!-- <input required type="text" id="Fecha_Devolucion" name="Fecha_Devolucion" class="form-control input-sm " readonly="" size="16"> -->
                                              <input required type='text' class="form-control input-sm" id="Fecha_Devolucion" name="Fecha_Devolucion" size="16" value=""/>
                                              <div class="input-group-btn">
                                                  <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                                              </div>
                                          </div>
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
                                                  <label for="" class="col-xs-2">Servicios</label>
                                                   <div class="col-xs-4">
                                              <input
                                              required
                                              type='text' 
                                              id='autocomplete busqueda_servicio' 
                                              data-id=''
                                              name="Nombres_servicios" 
                                              class="autocomplete form-control input-sm busqueda_servicio" 
                                              value="" 
                                              placeholder="Busqueda...."  
                                              title="Seleciona Categoriaa"/>
                                              <input  id="idServicio" name="idServicio" class="form-control" placeholder="idServicio" value="" type="hidden"  />

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
                                <table  class="table ">
                                             <input type ="hidden" id="stock" name="stock" value="" class="form-control input-sm" placeholder="" >
                                              <input type ="hidden" id="Precio_Unitario" name="Precio_Unitario" value="" class="form-control input-sm" placeholder="" >
                                    <tr>
                                    <td colspan="" rowspan="" headers="" style="width: 60px;" >
                                       <label for="" class="control-label text-danger">Articulos</label>
                                    </td>
                                    <td colspan="" rowspan="" headers="" style="width: 180px; ">
                                       <input  type='text' id='autocomplete busqueda_producto Nombre' name="Nombre" class="autocomplete form-control input-sm busqueda_producto" value="<?php echo set_value('Nombre');?>" placeholder="Nombre del Articulo "  title="Buscar"/>
                                       <input required id="idProducto_Servicio" name="idProducto_Servicio" class="form-control" placeholder="idProducto_Servicio" value="<?php echo set_value('idProducto_Servicio');?>" type="hidden"  />
                                    </td>

                                      <td style="width: 140px;">
                                          <label for  ="" class="control-label text-danger">Precio</label> : 
                                          <label id="Precio_Unitario1" name="Precio_Unitario1"  class="control-label text-info"></label>
                                      </td>
                                         <td style="width: 80px; text-align:right ">
                                            <label for  ="" class="control-label text-danger">Descunto</label>
                                        </td>
                                        <td style="width: 110px; ">
                                        <div class  ="">
                                                  <div class="checkbox">
                                                    <label id="max">
                                                    </label>
                                                  </div>
                                        </td>
                                      <td style="width: 90px; text-align:right">
                                        <label for  ="" class="control-label text-danger">Cantidad</label>
                                      </td>
                                      <td colspan="" rowspan="" headers="" style="width: 90px; ">
                                          <div class="" id="max">
                                            <input type ="number" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="" pattern="{10,15}" placeholder="">
                                          </div>
                                      </td>
                                      <td style="width: 90px; text-align:right ">
                                          <label for  ="" class="control-label text-danger">Inpuesto</label>
                                      </td>
                                      <td style="width: 90px; ">
                                                  <div class  ="">
                                                      <select name="opciones[inpuesto]" id="opciones_input" class="form-control input-sm di " >
                                                             <option value="10">10 %</option>
                                                          <option value="5">5 %</option>
                                                        </select>
                                                  </div>
                                      </td>
                                      <!-- <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      </td> -->
                                     <td colspan="" rowspan="" headers="" style="width: 110px; text-align:right">
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

