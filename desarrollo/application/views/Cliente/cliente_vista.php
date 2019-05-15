    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            <button class="btn btn-sm btn-success" onclick="add_cliente()"><i class="glyphicon glyphicon-plus"></i> Cliente</button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
        <div id="my-tab-content" class="tab-content">
              <section class="content" >
                    <table id="table_cliente" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class ="text-danger"><i class="fa fa-user"></i>  Nombre</th>
                          <th class ="text-danger"><i class="fa fa-user-plus"></i>  Apellidos</th>
                          <th class ="text-danger"><i class="fa fa-road"></i>  Direccion</th>
                          <th class ="text-danger"><i class="fa fa-newspaper-o"></i>  Cedula/R-U-C</th>
                          <th class ="text-danger"><i class="fa fa-mobile"></i> Telefono</th>
                          <th class ="text-danger"><i class="fa fa-envelope"></i> Correo</th>
                          <th class ="text-danger" style="width:125px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Cliente</h3>
      </div>
       <div class="alert alert-info" id="cliente_aler" >
        <strong class="title" ></strong>
      </div>
      <div class="modal-body form">

        <form action="#" id="form" class="form-signin">
          <input type="hidden" value="" name="idCliente"/> 
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
                            <span class=""></span>
                          </div>
                        </td>
                        <td >
                          <a> Apellidos </a>
                        </td>
                        <td>
                          <span class ="A text-danger"></span>
                          <div class="form-group has-feedback">
                            <input   type ="text" id="Apellidos" name="Apellidos" class="form-control " placeholder="Apellidos" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                            <span class="glyphicon glyphicon-ok form-control-feedback"></span>
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
                            <span class=""></span>
                          </div>
                        </td>
                             <td >
                          <a> DNI R-U-C</a>
                        </td>
                        <td>
                          <span class ="C_R text-danger"></span>
                          <div class="form-group has-feedback">
                              <input required  type ="text" id="ci_ruc" name="ci_ruc" class="form-control" placeholder="cedua o ruc" title="ingrese Cedula o R-U-C" pattern="[0-9]{5,15}" maxlength="15"  autofocus  >
                             <span class=""></span>
                          </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Telefono </a>
                        </td>
                        <td>
                            <span class ="T text-danger"></span>
                            <div class="form-group has-feedback">
                                <input required   type ="text" id="Telefono" name="Telefono" class="form-control" placeholder="Telefono" size='45'   title="ingrese telefono" pattern="[0-9]{10,15}" min="10" maxlength="15"  autofocus  >
                              <span class=""></span>
                            </div>
                        </td>

                        <td >
                          <a> Correo </a>
                        </td>
                        <td>
                              <span class ="E text-danger"></span>
                            <div class="form-group has-feedback">
                              <input required   type ="Email" id="Email" name="Email" class="form-control" placeholder="Correo" title="ejemplo@correo.com" onfocus="autofocus" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus  >
                              <span class=""></span>
                            </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Usuario </a>
                        </td>
                        <td>
                        <span class ="U text-danger"></span>
                        <div class="form-group has-feedback">
                          <input   type ="text" id="usuario" name="usuario" class="form-control" onfocus="autofocus" autocomplete="off"  placeholder="Usuario" pattern="[A-Za-z ]{3,100}"   >
                          <span class=""></span>
                        </div>
                        </td>
                        <td >
                          <a> Contraseña </a>
                        </td>
                        <td>
                        <span class ="P text-danger"></span>
                        <div class="form-group has-feedback">
                               <input    type ="password" id="password" name="password" class="form-control" onfocus="autofocus" autocomplete="off"  placeholder="Contraseña"   pattern="(?=.*[a-z]).{6,}"  >
                          <span class=""></span>
                        </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Confirmar </a>
                        </td>
                        <td>
                         <span class ="PF text-danger"></span>
                        <div class="form-group has-feedback" id="PF">
                            <input    type ="password" id="passconf" name="passconf" class="form-control" onfocus="autofocus" autocomplete="off"  placeholder="Repetir Contraseña"  pattern="(?=.*[a-z]).{6,}">
                          <span class=""></span>
                        </div>
                        </td>
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

