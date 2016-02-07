    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            <button class="btn btn-sm btn-success" onclick="add_stock()"><i class="glyphicon glyphicon-plus"></i> Stock</button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
        <div id="my-tab-content" class="tab-content">
              <section class="content">
                    <table id="table_stock" class="table table-striped table-bordered" cellspacing="0" width="100%">
                         <style type="text/css" media="screen">
                         .row{
                            display: block;
                          }
                          </style>
                      <thead>
                        <tr>
                          <th class ="text-danger"><i class="fa fa-archive"></i>  Nombre</th>
                          <th class ="text-danger"><i class="fa fa-usd"></i>  Precio Unitario</th>
                          <th class ="text-danger"><i class="fa fa-cc"></i> Stock</th>
                          <th  class ="text-danger"style="width:75px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form_stock" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Stock</h3>
      </div>
      <div class="alert alert-info" id="stock_aler" >
        <strong class="title" ></strong>
      </div>
      <div class="modal-body form">
        <form action="#" name="form" id="form_stock" class="">
          <input type="hidden" value="" name="idStock"/> 
              <input type="hidden" value="" name="idStock"/> 
              <div <div class="row"> 
               <div class="col-md-8 col-md-offset-2 table-responsive">
                <table class="table table-striped" i>
                  <tbody>
                     <tr id="transparente">
                        <td >
                          <a> Productos </a>
                        </td>
                        <td>
                          <span class ="N text-danger"></span>
                          <div class="form-group has-feedback">
                                   <input required type='text' id='autocomplete servicio_select' name="Nombre" class="form-control    servicio_select" value="<?php echo set_value('Nombre');?>" placeholder="escribe una letra"  title="Seleciona Nombre"/>
                                  <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                                   <input required id="idProducto_Servicio" name="idProducto_Servicio" class="form-control" placeholder="idProducto_Servicio" value="<?php echo set_value('idProducto_Servicio');?>" type="hidden"  />
                          </div>
                        </td>
                     </tr>
                     <tr id="transparente">
                        <td >
                          <a> Cantidad </a>
                        </td>
                        <td>
                          <span class ="A text-danger"></span>
                          <div class="form-group has-feedback">
                            <input required  type ="text" id="Cantidad_stock" name="Cantidad_stock" class="form-control " placeholder="Cantidad" size='45' title="ingrese Cantidad" pattern="[0-9]{1,10}" min="1" maxlength="10"  autofocus   >
                            <!-- <span class="glyphicon glyphicon-user form-control-feedback"></span> -->
                          </div>
                        </td>
                      </tr> 
                      <tr id="transparente" class="transparente">
                        <td >
                          <a> Disponible</a>
                        </td>
                        <td>
                         <div class="form-group has-feedback">
                         <span class="badge bg-red"></span>
                         <span class="badge bg-green"></span>
                         <span class="badge bg-blue"></span>

                          </div>
                        </td>
                      </tr> 
                  </tbody>
                </table>
              </div>
              </div>
         <div class="modal-footer">
            <button type="submit" id="btnSave"  class="btn btn-sm btn-success">
                     <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
            </button>&nbsp;&nbsp;&nbsp;     
            <button type="reset"  class="btn btn-sm btn-info">
                    <i class="fa fa-refresh "></i> Limpiar
            </button>
             <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal" >
                     <span class="glyphicon glyphicon-floppy-remove"></span> Cancelar
             </button>     
          </div>


           </form>
       </div>
      </div>
    </div>
  </div>

