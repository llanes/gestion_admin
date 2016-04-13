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
        <div id="my-tab-content" class="tab-content panel-body">
              <section class="content panel panel-success panel-body">
                    <table id="table_pagos" class="table table-striped table-bordered" >
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
                <form id="form_pagos"  class="form-signin" role="form" data-toggle="validator">
                    <input type="hidden" value="" name="idCaja_Pagos" id="idCaja_Pagos" /> 
                    <input  value="" id="idEmpleado" name="idEmpleado" class="form-control" placeholder="idEmpleado" type="hidden"> 
                    <input  value="" id="ver" name="ver" class="form-control" placeholder="idEmpleado" type="hidden"> 
                         <div class="table-responsive">
                          <table class="table">
                            <tbody>
                              <tr id="transparente">
                                  <td  style="width:120px;">
                                  <br>
                                     <strong>Tipo de Pagos</strong>
                                  </td>
                                  <td >
                                   <div class="form-group has-feedback " id="resetear1">
                                      <label for="" class="control-label"></label>
                                      <div class="">
                                        <select required class="form-control input-sm" name="Tipos_Pagos" id="Tipos_Pagos" title="Seleciona tipo_pagos" autofocus>
                                                 <option name="0" value="" autofocus> </option>
                                                  <option name="1" value="1">Pagos de Empleado</option>
                                                  <option name="2" value="2">Pago de Agua</option>
                                                  <option name="3" value="3">Pago de Luz</option>
                                                   <option name="4" value="4">Extras</option>
                                         </select> 
                                      </div>
                                      <span class="glyphicon form-control-feedback" id="re1" aria-hidden="true"></span>
                                      <div class="help-block with-errors" id="11"></div>
                                    </div>
                                  </td>
                                   </tr> 
                                      <tr id="empleaddo" class="empleaddo">
                                      <td >
                                      <br>
                                          <strong> Empleado </strong>
                                        </td>
                                        <td>
                                       <div class="form-group has-feedback" id="resetear2">
                                      <label for="" class="control-label"></label>
                                      <div class="">
                                                <input required type="text" name="Empl" id="Empl" class="form-control " value="" placeholder="escribe una letra" title="Seleciona empleado ">
                                      </div>
                                      <span class="glyphicon form-control-feedback" id="re2" aria-hidden="true"></span>
                                      <div class="help-block with-errors" id="2"></div>
                                    </div>
                                        </td>
                                         </tr> 
                               <tr id="transparente">
                                  <td >
                                    <br>
                                      <label for="" class="control-label">Descripcion</label>

                                  </td>
                                  <td>
                                    <div class="form-group has-feedback" id="resetear3">
                                      <label for="" class="control-label"></label>
                                      <div class="">
                                         <input required  maxlength="35"  type ="text" id="Descripcion" name="Descripcion" class="form-control input-sm" placeholder="Descripcion" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50"  autofocus   >
                                      </div>
                                      <span class="glyphicon form-control-feedback" id="re3" aria-hidden="true"></span>
                                      <div class="help-block with-errors" id="3"></div>
                                    </div>
                                  </td>
                                   </tr> 
                                  <tr id="transparente">
                                  <td >
                                    <br>
                                    <strong>Monto</strong>
                                  </td>
                                  <td >
                                    <div class="form-group has-feedback " id="resetear4">
                                      <label for="" class="control-label"></label>
                                      <div class="">
                                      <input required  type ="text" id="Monto" name="Monto" class="form-control input-sm" placeholder="Monto" title="ingrese "  pattern="[0-9]{0,11}" maxlength="11"  autofocus   >
                                      </div>
                                      <span class="glyphicon form-control-feedback" id="re4" aria-hidden="true"></span>
                                      <div class="help-block with-errors" id="4"></div>
                                    </div>
                                  </td>
                                </tr> 
                            </tbody>
                          </table>
                        </div>
                   <div class="modal-footer">
                      <button type="submit" id="sub" class="btn btn-sm btn-success  " >
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

