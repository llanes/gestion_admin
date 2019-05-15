    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            <button class="btn btn-sm btn-success" onclick="add_empleado()"><i class="glyphicon glyphicon-plus"></i> Empleado</button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
        <div id="my-tab-content" class="tab-content">
              <section class="content">
                    <table id="table_" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <style type="text/css" media="screen">
                                            .roww{
                                            display: block;
                                            }
                                            </style>
                      <thead>
                        <tr>
                           <th class  ="text-danger"><i class="fa fa-user"></i>  Nombre</th>
                           <th class  ="text-danger"><i class="fa fa-user-plus"></i>  Apellidos</th>
                           <th class  ="text-danger"><i class="fa fa-road"></i>  Direccion</th>
                           <th class  ="text-danger"><i class="fa fa-mobile"></i> Telefono</th>
                           <th class  ="text-danger"><i class="fa fa-envelope"></i> Sueldo</th>
                           <th class  ="text-danger"><i class="fa fa-key"></i>  Cargo</th>
                           <th  class ="text-danger"style="width:125px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>

<!--                       <tfoot>
                        <tr>
                   <th>Nombre</th>
                          <th>Apellidos</th>
                          <th>Direccion</th>
                          <th>Telefono</th>
                          <th>Email</th>
                          <th>Action</th>
                        </tr>
                      </tfoot> -->
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form_empleado" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Empleado</h3>
      </div>
       <div class="alert alert-info" id="empleadao_aler" >
        <strong class="title empleado_title" ></strong>
      </div>
      <div class="modal-body form">
        <form action="#" id="form_empleado" class="form-signin">
          <input type="hidden" value="" name="idEmpleado"/> 
             <div class="table-responsive">
                <table class="table table-striped" i>
                  <tbody>
                     <tr id="transparente">
                        <td >
                          <a> Nombres </a>
                        </td>
                        <td>
                        <span class ="N text-danger"></span>
                        <div class="form-group has-feedback">
                          <input required  type ="text" id="Nombres" name="Nombres" class="form-control " placeholder="Nombres" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        </td>
                        <td >
                          <a> Apellidos </a>
                        </td>
                        <td>
                        <span class ="A text-danger"></span>
                        <div class="form-group has-feedback">
                          <input   type ="text" id="Apellidos" name="Apellidos" class="form-control " placeholder="Apellidos" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                          <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Direccion </a>
                        </td>
                        <td>
                        <span class ="D text-danger"></span>
                        <div class="form-group has-feedback">
                            <input required  type ="text" id="Direccion" name="Direccion" class="form-control" placeholder="Direccion" size='45' title="ingrese Direccion" pattern="[A-Za-z ]{5,50}" maxlength="50"  autofocus  >
                          <span class="glyphicon glyphicon-road form-control-feedback"></span>
                        </div>
                        </td>
                        <td >
                          <a> Telefono </a>
                        </td>
                        <td>
                            <span class ="T text-danger"></span>
                        <div class="form-group has-feedback">
                            <input required   type ="text" id="Telefono" name="Telefono" class="form-control" placeholder="Telefono" size='45'   title="ingrese telefono" pattern="[0-9]{10,15}" min="10" maxlength="15"  autofocus  >
                          <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                        </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Sueldo </a>
                        </td>
                        <td>
                          <span class ="S text-danger"></span>
                        <div class="form-group has-feedback">
                          <input required   type ="text" id="Sueldo" name="Sueldo" class="form-control" placeholder="Sueldo" title="Precio" onfocus="autofocus" pattern="[0-9]{3,10}" autofocus  >
                          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        </td>
                        <td >
                          <a> Cargo </a>
                        </td>
                        <td>
                        <span class ="C text-danger"></span>
                        <div class="form-group has-feedback">
                          <input    type ="text" id="Cargo" name="Cargo" class="form-control" placeholder="cargo" title="cargo" onfocus="autofocus" pattern="[A-Za-z ]{5,50}" autofocus  >
                          <span class="glyphicon glyphicon-compressed form-control-feedback"></span>
                        </div>
                        </td>
                      </tr> 
                     </tr>
                  </tbody>
                </table>
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

