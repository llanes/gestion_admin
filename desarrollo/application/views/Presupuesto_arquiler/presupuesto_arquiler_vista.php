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
                                   <li class="disabled">
                                      <a>{titulo1}</a>
                                  </li>
                                  <li class="disabled"><a>
                                      <i class="fa fa-dashboard"></i> {titulo3}  {titulo4}
                                  </a></li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div id="" class="tab-content">
 <div id="presupuesto_alquiler"  class="tab-pane active">  
                          <!-- comienzo de presupuesto -->
    <div class="modal fade bs-example-modal-lg" id="snnip">
          <div style="text-align: center">
            <br><br><br><br><br><br><br><br><br><br><br><br>
             <h1 class="text-danger">Procesando....</h1>
            <p class="text-danger"><i class="fa fa-spinner fa-spin fa-5x"></i></p>
          </div>
    </div>
      <section class=''>
          <div class="roww">
             <div  style="height: 300px;  "> 
                <!-- /////////////////////// -->
               <form class="form-horizontal" method="post" name="formulario" id="formulario" target="myIframe"  action="<?= site_url('index.php/Reportes/reporte_presipuesro'); ?>">
               <input type="hidden" name="fecha_expedicion" id="fecha_expedicion" value="<?php echo date("Y-m-d");?>">
                           <!-- cabecera cliente -->
                            <input type="hidden" name="controlbutton" id="controlbutton" value="0">
                             <div class="col-xs-8">
                            <table class="table table-condensed"  >

                                <tr>
                                  <td colspan="" colspan="" headers="" height="10" width="">
                                       <label for="" class="col-xs-2">Cliente</label>
                                     <div class="col-xs-4">
                                           <span class ="cli text-danger"></span>
                                          <input required  maxlength="20"  type='text' id='autocomplete busqueda_cliente' name="Nombres" class="autocomplete form-control input-sm busqueda_cliente" value="" placeholder="Nombre del Cliente "  title="Seleciona "/>
                                          <input  id="idCliente" name="idCliente" class="form-control" placeholder="idCliente" value="{idCliente}" type="hidden"  />
                                          
                                    </div>
                                    <label for="" class="col-xs-2 ">C.I/R.U.C</label>
                                     <div class="col-xs-4">
                                          <span class ="cli text-danger"></span>
                                          <input required  type="number" step="any" id='autocomplete busqueda_cliente2' name="ci_ruc" class="autocomplete form-control input-sm busqueda_cliente2" value="" placeholder="Cedula-R.U.C"  title="Seleciona "/>
                                          <input  id="idCliente2" name="idCliente2" class="form-control" placeholder="idCliente2" value="<?php echo set_value('idCliente2');?>" type="hidden"  />
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="" colspan="" headers="" hheight="10" width="">
                                              <label for="" class="col-xs-2">Entrega</label>
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
                                  <td style="text-align:left">
                                               <label for="" class="col-xs-2 ">Tipo</label>
                                               <div class="col-xs-4">
                                                        <select name="natural_juridica" id="tipo" class="form-control input-sm" required="required">
                                                          <option class="natural" value="1">Natural</option>
                                                          <option class="juridica" value="2">Juridica</option>
                                                        </select>
                                              </div>
                                              <label for="" class="col-xs-2">Servicios</label>
                                               <div class="col-xs-4">
                                          <input  maxlength="22"
                                          required
                                          type='text' 
                                          id='autocomplete busqueda_servicio' 
                                          data-id=''
                                          name="Nombres_servicios" 
                                          class="autocomplete form-control input-sm busqueda_servicio" 
                                          value="" 
                                          placeholder="Servicio Nombre"  
                                          title="Seleciona"/>
                                          <input  id="idServicio" name="idServicio" class="form-control" placeholder="idServicio" value="" type="hidden"  />

                                               </div>

                                  </td>
                                </tr>
                                <tr>
                                  <td style="text-align:left">
                                               <label for="" class="col-xs-2 ">Direccion </label>
                                               <div class="col-xs-4">
                                                 <textarea id="Direccion_evento" maxlength="100" name="Direccion_evento" class="form-control input-sm" placeholder="Direccion Evento" rows="1" required="required"></textarea>
                                              </div>
                                              <label for="" class="col-xs-2 "></label>
                                              <label for="" class="col-xs-4 "><a class="btn btn-block btn-social btn-sm btn-default" onclick="mapa(0);">
                    <i class="fa fa-map-marker"></i> Direccion Mapa
                  </a> </label>
                                  </td>
                                </tr>
                            </table>
                            </div>
                            <div class="responsive col-md-4">
                                                                     <div class="panel panel-primary">
                                                                     {formula}
                                                                          <div class="text-center panel-heading">
                                                                          R.U.C  Nº {R_U_D}
                                                                        </div>
                                                                          <div id="boleta" class="text-danger text-center">
                                                                          <H4>Boleta de Venta</H4>
                                                                          </div>
                                                                          <div id="factura" class="text-danger text-center">
                                                                          <H4>Factura</H4>
                                                                          </div>
                                                                            <input type="hidden" name="boleta_factura" id='boleta_factura' value="" placeholder="" >
                                                                                  <div class="form-group">
                                                                                      <div class="col-md-6 col-md-offset-0 text-danger text-center">
                                                                                      Serie
                                                                                            <input type="text" name="series" class="form-control input-sm" value="{Series}-{Series}" disabled>
                                                                                      </div>
                                                                                      <div class="col-md-6 col-md-offset-0 text-danger text-center">
                                                                                        Nº Timbrado
                                                                                             <input type="text" name="timbrado" class="form-control input-sm" value="{Timbrado}" disabled>
                                                                                      </div>
                                                                                  </div>
                                                                          {/formula}
                                                                       </div>
                            </div>
                            <!-- //////ciere cliente cabecera////////////////// -->
                            <!-- apertura buscador producto -->
                            <div class="table-responsive col-xs-12" >  
                                <table  class="table ">
                                             <input type ="hidden" id="stock" name="stock" value="" class="form-control input-sm" placeholder="" >
                                              <input type ="hidden" id="Precio_Unitario" name="Precio_Unitario" value="" class="form-control input-sm" placeholder="" >
                                    <tr>
                                    <td colspan="" rowspan="" headers="" style="width: 60px;" >
                                       <label for="" class="control-label text-danger">Articulos</label>
                                    </td>
                                    <td colspan="" rowspan="" headers="" style="width: 180px; ">
                                       <input maxlength="22" type='text' id='autocomplete busqueda_producto Nombre' name="Nombre" class="autocomplete form-control input-sm busqueda_producto" value="<?php echo set_value('Nombre');?>" placeholder="Nombre del Articulo "  title="Buscar"/>
                                       <input required id="idProducto_Servicio" name="idProducto_Servicio" class="form-control" placeholder="idProducto_Servicio" value="<?php echo set_value('idProducto_Servicio');?>" type="hidden"  />
                                    </td>

                                      <td style="width: 140px;">
                                          <label for  ="" class="control-label text-danger">Precio</label> : 
                                          <label id="Precio_Unitario1" name="Precio_Unitario1"  class="control-label text-info"></label>
                                      </td>
                                         <td style="width: 80px; text-align:right ">
                                            <label for  ="" class="control-label text-danger">Descuento</label>
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
                                            <input type ="text" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="5" pattern="[0-9]{0,6}" placeholder="">
                                          </div>
                                      </td>
                                      <td style="width: 90px; text-align:right ">
                                          <label for  ="" class="control-label text-danger">Impuesto</label>
                                      </td>
                                      <td style="width: 90px; ">
                                                  <div class  ="">
                                                      <select name="opciones[inpuesto]" id="opciones_input" class="form-control input-sm di " >
                                                             <option value="10">10 %</option>
                                                          <option value="5">5 %</option>
                                                      z  </select>
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
    <!-- modal dd alquiler -->
      <div class="modal fade" id="modal_form_alquiler">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 style="text-align: center" class="modal-title">Alquiler</h4>
            </div>
            <div class="modal-body">
              <div <div class="roww"> 
               <div class="col-md-12 col-md-offset-0 table-responsive">
                <table class="table" >
                  <tbody>
                     <tr id="transparente">
                        <td >
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Tipo de Pago</label>
                                <div class="col-lg-5">
                                        <select name="credi_cont" id="credi_cont" class="form-control">
                                          <option value="1">Contado</option>
                                          <option value="2">Credito</option>
                                        </select>
                                </div>
                            </div>
                        </td>
                    </tr> 
                    <tr id="transparente">
                        <td>
                            <div class="form-group cuotas">
                                <label class="col-lg-4 control-label">Cantidad Cuotas</label>
                                <div class="col-lg-5">
                                    <select name="cuota" id="cuota" class="form-control">
                                          <option value="2">2</option>
                                          <option value="4">4</option>
                                          <option value="6">6</option>
                                          <option value="8">8</option>
                                          <option value="12">12</option>
                                    </select>
                                </div>
                            </div>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              </div>
            </div>
         <div class="modal-footer">

            <button type="submit" id="btnSave" onclick="add_alquiler()" class="btn btn-sm btn-success">
                     <span class="glyphicon glyphicon-floppy-disk"></span> Alquilar
            </button>&nbsp;&nbsp;&nbsp;
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" >
                     <span class="glyphicon glyphicon-floppy-remove"></span> Cancelar
             </button>
          </div>
          </div>
        </div>
      </div></h4>
    <!-- fin modal alquiler -->
      <!-- modal error -->
        <div class="modal fade bs-example-modal-lg" id="modal_error">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title center">Detalles articulo no disponible</h4>
            </div>
            <div class="x_panel">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-hover" align="center">
                      <tbody id='item_error'>

                      </tbody>
                    </table>
                  </div><!-- /.table-responsive -->
                </div><!-- /.box-body -->
            </div>
            </div>
            <div class="modal-footer">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
      <!-- fin modal error -->
      <div class="modal fade bs-example-modal-lg" id="modal-id-mapa">
        <div class="modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title center">Direccion Evento</h4>
            </div>
            <div class="x_panel">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_content">
                                            <br>  
                                    <!-- Smart Wizard -->

                                    <div id="wizard" class="form_wizard wizard_horizontal col-md-12  col-sm-12 col-xs-12 ">
                                    <p style="text-align: center"> Encuentra las coordenadas moviendo por el mapa</p>
                                        <ul class="wizard_steps anchor">
                                            <li>
                                             Paso 1<br>
                                                <a  class="done" isdone="1" rel="1">
                                                    <span class="step_no">1</span>
                                                    <span class="step_descr">
                                           
                                            <p>Arrastrar y soltar el amplio   mapa para la ubicación</p>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                             Paso 2<br>
                                                <a  class="done" isdone="1" rel="2">
                                                    <span class="step_no">2</span>
                                                    <span class="step_descr">
                                            <p>Zoom o doble click para una mayor   precisión</p>
                                        </span>
                                                </a>
                                            </li>
                                            <li>
                                             Paso 3<br>
                                                <a  class="done" isdone="1" rel="3">
                                                    <span class="step_no">3</span>
                                                    <span class="step_descr">
                                            <p>Arrastrar y soltar el marcador    para localizar el lugar</p>
                                        </span>
                                                </a>
                                            </li>
                                        </ul>
                                    <!-- End SmartWizard Content -->
                                </div>
                            </div>
                        </div>
                      </div>
              <!-- mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm -->
              <div id='mapaload'>
               </div>
              <!-- mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm -->

            </div>
            <div class="modal-footer">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- carrito item -->
                       <div class="col-lg-12 col-md-offset-0 " id="detalle"  >

