    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            <!-- <button class="btn btn-sm btn-success" onclick="add_cliente()"><i class="glyphicon glyphicon-plus"></i> Cliente</button> -->
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
        <div id="my-tab-content" class="tab-content">
              <section class="content" >
                    <table id="table_empresa" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                           <th class ="text-danger"><i class="fa fa-user"></i>  Nombre</th>
                           <!--                    <th class ="text-danger"><i class="fa fa-user-plus"></i>  Apellidos</th> -->
                           <th class ="text-danger"><i class="fa fa-road"></i>  Direccion</th>
                           <th class ="text-danger"><i class="fa fa-mobile"></i> Telefono</th>
                           <th class ="text-danger"><i class="fa fa-envelope"></i> Correo</th>
                           <th class ="text-danger"><i class="fa fa-newspaper-o"></i>  R.U.C</th>
                           <th class ="text-danger" style="width:125px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form_empresa" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Empresa</h3>
      </div>
       <div class="alert alert-info" id="empresa_aler" >
        <strong class="title" ></strong>
      </div>
      <div class="modal-body form">

        <form action="#" id="from_empresa" name="from_empresa" class="form-signin">
          <input type="hidden" value="" name="idEmpresa"/> 
                       <div class="table-responsive">
                <table class="table table-striped" i>
                  <tbody>
                     <tr id="transparente">
                        <td >
                          <a> Nombre </a>
                        </td>
                        <td>
                          <span class ="N text-danger"></span>
                          <div class="form-group has-feedback">
                            <input required  type ="text" id="Nombre" name="Nombre" class="form-control input-sm" placeholder="" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                            <span class=""></span>
                          </div>
                        </td>
                        <td >
                          <a> Descripcion </a>
                        </td>
                        <td>
                          <span class ="DI text-danger"></span>
                          <div class="form-group has-feedback">
                            <input   type ="text" id="Descripcion" name="Descripcion" class="form-control input-sm" placeholder="" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                            <!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
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
                              <input required  type ="text" id="Direccion" name="Direccion" class="form-control input-sm" placeholder="" size='45' title="ingrese Direccion" pattern="[A-Za-z ]{5,50}" maxlength="50"  autofocus  >
                            <span class=""></span>
                          </div>
                        </td>
                             <td >
                          <a> Telefono</a>
                        </td>
                        <td>
                          <span class ="T text-danger"></span>
                          <div class="form-group has-feedback">
                              <input required  type ="text" id="Telefono" name="Telefono" class="form-control input-sm" placeholder="" title="ingrese Telefono" pattern="[0-9]{5,15}" maxlength="15"  autofocus  >
                             <span class=""></span>
                          </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Correo </a>
                        </td>
                        <td>
                              <span class ="CO text-danger"></span>
                            <div class="form-group has-feedback">
                              <input required   type ="Email" id="Email" name="Email" class="form-control input-sm" placeholder="" title="ejemplo@correo.com" onfocus="autofocus" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus  >
                              <span class=""></span>
                            </div>
                        </td>
                                                <td >
                          <a> R.U.C</a>
                        </td>
                        <td>
                            <span class ="RU text-danger"></span>
                            <div class="form-group has-feedback">
                                <input required   type ="text" id="R_U_C" name="R_U_C" class="form-control input-sm" placeholder="" size='45'   title="ingrese CEDULA RUC"  min="10" maxlength="15"  autofocus  >
                              <span class=""></span>
                            </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Timbrado </a>
                        </td>
                        <td>
                        <span class ="TI text-danger"></span>
                        <div class="form-group has-feedback">
                          <input required  type ="text" id="Timbrado" name="Timbrado" class="form-control input-sm" onfocus="autofocus"   placeholder=""    >
                          <span class=""></span>
                        </div>
                        </td>                        
                        <td >
                          <a> Series </a>
                        </td>
                        <td>
                        <span class ="SE text-danger"></span>
                        <div class="form-group has-feedback">
                          <input required  type ="text" id="Series" name="Series" class="form-control input-sm" onfocus="autofocus"   placeholder=""   >
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

