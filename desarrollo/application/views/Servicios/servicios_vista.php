
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            <button class="btn btn-sm btn-success" onclick="add_Servicios()"><i class="glyphicon glyphicon-plus"></i> Servicios</button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
              <section class="content">
                    <table id="table_servicios" class="table table-striped table-bordered" cellspacing="30" width="100%">
                         <style type="text/css" media="screen">
                         .row{
                            display: block;
                          }
                          </style>
                    <thead>
                        <tr>
                        <th class ="text-danger"><i class="fa fa-list"></i> </th>
                        <th class ="text-danger"><i class="fa fa-server"></i>  Nombre</th>
                          <th class ="text-danger"><i class="fa fa-info"></i> Descripcion</th>
                          <th class ="text-danger"><i class="fa fa-usd"></i>  Conto Total</th>
                                <th  class ="text-danger"style="width:75px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form_servicios" >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title_servicios">Formulario Servicios</h4>
        </div>
       <div class="alert alert-info" id="servicios_aler" >
        <strong class="title" ></strong>
      </div>
        <div class="modal-body form_servicios">
          <form  name="form_servicios" id="form_servicios" class="form-signin" enctype="multipart/form-data">
            <input type="hidden" value="" name="idProducto_Servicio"/>
            <input type="hidden" value="" name="Codigo_Barra"/>  
                <div class="table-responsive">
                  <table class="table table-condensed">
                                     <input    type='hidden' name='idServicio' id='idServicio' class="form-control input-sm" value="<?php echo set_value('idServicio') ?>" placeholder="Nombre" title="Nombre idServicio"/>

                                   <tbody>
                                      <tr id="transparente">
                                         <td  >
                                       <label for="" class="control-label text-danger">Nombre</label>
                                           </td>
                                        <td colspan="">

                                      <span class ="N text-danger"></span>
                                     <input   required type='text' name='servicio' id='servicio' class="form-control " value="<?php echo set_value('servicio') ?>" placeholder="Nombre" title="Nombre servicio"/>
                                      </td>
                                           </tr>
                                         <tr id="transparente">
                                         <td >
                                             <label for="" class="control-label text-danger">Articulos</label>
                                         </td>
                                            <td colspan="" >
                                                <input  type='text' id='autocomplete s' name="nombre_articulo" class="autocomplete form-control input-sm articulo_servicio" value="" placeholder="Nombre del Producto "  title="Buscar"/>
                                                <input  id="id_articulo" name="id_articulo" class="form-control" placeholder="" value="" type="hidden"  />
                                                <input  id="precio_articulo" name="precio_articulo" class="form-control" placeholder="" value="" type="hidden"  />
                                            </td>
                                        <td >
                                             <label for="" class="control-label text-danger">Cantidad</label>
                                         </td>
                                               <td style="width: 90px; text-align:right">
                                                <input  type='text' id='cantidad' name="cantidad" class="form-control input-sm" value="" title="catidad"/>
                                            </td>

                                            <td >
                                                  <button type="button" id="botonenviar"  class="btn btn-info">
                                                                <i class="fa fa-cart-plus"></i> Agregar
                                                  </button>
                                            </td>
                                          </tr>
                                      </tbody>
                                  </table>
                    </div>
<div  id="loader">
<input type="hidden" name="costo_total" id="costo_total" value="<?php echo number_format($this->cart->total(),0,'','') ?>">



















</div>
          </form>
        </div>
      </div>
    </div>
  </div>
 <div class="modal fade" id="ver_articulos" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button " class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title_ver_articulos"></h3>

      </div>
      <div class="modal-body form" id="reset">
      <fieldset title="Step 3" class="step" id="default-step-2" style="display: block;">
       <table class="table table-hover">
          <thead>
            <tr>
              <th><label class="col-lg-3 control-label">Descripcion</label></th>
              <th><label class="col-lg-3 control-label">Costo</label></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td ><p class="form-control-static descripcion" id="descripcion"></p></td>
              <td><p class="form-control-static costo" id="costo"></p></td>
            </tr>
          </tbody>
        </table>
        
     </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
