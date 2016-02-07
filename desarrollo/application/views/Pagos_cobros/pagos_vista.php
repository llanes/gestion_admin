    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            {titulo1}
            <small>{titulo2}</small>     
            &nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-sm btn-success" onclick="add_pagos()">   <i class="glyphicon glyphicon-plus"></i> Pagos</button>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3} <i class="fa fa-angle-double-right"></i> {titulo4}</a></li>
          </ol>
        </section>
        <div id="my-tab-content" class="tab-content">
              <section class="content">
                    <table id="table_pagos" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th class ="text-danger" ><i class="fa fa-info"></i>  Descripcion</th>
                          <th class ="text-danger" ><i class="fa fa-bars"></i> Tipo Pagos</th>
                          <th class ="text-danger" ><i class="fa fa-usd"></i>  Monto</th>
                          <th class ="text-danger" ><i class="fa fa-calendar"></i>  Fecha Hora</th>
                          <th class ="text-danger" style="width:125px;"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
        </div>
  <div class="modal fade" id="modal_form_pagos"  tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Pagos</h3>
      </div>
       <div class="alert alert-info" id="pagos_aler" >
        <strong class="title" ></strong>
      </div>
      <div class="modal-body form row">
      <div class="col-md-2"></div>
 <div class="col-md-8">
        <form action="#" id="form_pagos" name="form_pagos" class="form-signin">
                  <input type="hidden" value="" name="idCaja_Pagos" id="idCaja_Pagos" /> 
                       <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr id="transparente">
                                <td >
                                   <strong>Tipo de Pagos</strong>
                                </td>
                                <td>
                                 <span class ="1 text-danger"></span>
                                       <select required class="form-control input-sm" name="Tipos_Pagos" id="Tipos_Pagos" title="Seleciona tipo_pagos">
                                               <option name="0" value=""></option>
                                                <option name="1" value="1">Pagos de Empleado</option>
                                                <option name="2" value="2">Pago de Agua</option>
                                                <option name="3" value="3">Pago de Luz</option>
                                                 <option name="4" value="4">Extras</option>
                                       </select> 
                                </td>
                                 </tr> 
                                    <tr id="empleaddo" class="empleaddo">
                                      <td >
                                        <strong> Empleado </strong>
                                      </td>
                                      <td>
                                        <span class ="2 text-danger"></span>
                                        <div class="form-group has-feedback" id="input_empleado">
                                              <input  type="text" name="Empl" id="Empl" class="form-control" value="" placeholder="escribe una letra" title="Seleciona empleado ">
                                              <input  value="" id="idEmpleado" name="idEmpleado" class="form-control" placeholder="idEmpleado" type="hidden"> 
                                        </div>
                                      </td>
                                       </tr> 
                             <tr id="transparente">
                                <td >
                                  <strong> Descripcion </strong>
                                </td>
                                <td>
                                  <span class ="3 text-danger"></span>
                                  <div class="form-group has-feedback">
                                    <input required  type ="text" id="Descripcion" name="Descripcion" class="form-control input-sm" placeholder="Descripcion" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                                    <span class=""></span>
                                  </div>
                                </td>
                                 </tr> 
                                <tr id="transparente">
                                <td >
                                  <strong>Monto</strong>
                                </td>
                                <td>
                                  <span class ="4 text-danger"></span>
                                  <div class="form-group has-feedback">
                                    <input required  type ="number" id="Monto" name="Monto" class="form-control input-sm" placeholder="Monto" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                                    <!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
                                  </div>
                                </td>
                              </tr> 
                          </tbody>
                        </table>
                      </div>
                 <div class="modal-footer">
                    <button type="submit" id=""  class="btn btn-sm btn-success">
                             <span class="glyphicon glyphicon-floppy-disk"></span> <i class="btnSave"></i>
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
              <div class="col-md-2"></div>
                 </div>
      </div>
    </div>
  </div>

