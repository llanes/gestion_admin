<div class="content-wrapper">
        <!-- Content Header (Page header) -->
                <section class="panel-default">
                          <header class="panel-heading">
                              <ul class="nav nav-tabs nav-justified">
                                  <li class="active" id="cobrar">
                                      <a data-toggle="tab" href="#Cobranzas">
                                      <i class="fa fa-money"></i>
                                      <i class="renombre">Relacion de Recibos</i>
                                      </a>
                                  </li>
                                  <li class="" id="lista_cobrados">
                                      <a data-toggle="tab" href="#Cobrados">
                                 <i class="fa fa-list"></i>
                                      Cuotas Cobradas</a>
                                  </li>
                                  <li></li>
                                  <li></li>
                                  <li></li>
                                   <li class="disabled">
                                              <a> {titulo1}</a>
                                  </li >
                                  <li class="disabled" >
                                      <a ><i class="fa fa-dashboard"></i>
                                      {titulo3}
                                      <i class="fa fa-angle-double-right"></i>
                                      {titulo4}</a>
                                   </li>
                              </ul>
                          </header>
                          <div class="panel-body">
                              <div id="" class="tab-content">
                                  <div id="Cobranzas" class="tab-pane active">
                                    <div id="my-tab-content" class="tab-content">
                                          <section class="content panel panel-success panel-body">
                                              <table id="table_Cobranzas" class="table table-striped table-bordered">
                                                <thead>
                                                  <tr class="success">
                                                    <th class ="text-danger" style="width:125px;"><i class="fa fa-list-ol"></i>  Cantidad Cuota</th>
                                                    <th class ="text-danger" ><i class="fa fa-user"></i> Cliente</th>
                                                    <th class ="text-danger" ><i class="fa fa-usd"></i>  Monto Total</th>
                                                     <th class ="text-danger" ><i class="fa fa-usd"></i>  Monto Peniente</th>
                                                    <th class ="text-danger" style="width:120px;"><i class="fa fa-cogs"></i> Accion</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                              </table>
                                        </section><!-- /.content -->
                                  </div>
                                  </div>
                                  <div id="Cobrados" class="tab-pane">
                                    <div id="my-tab-content" class="tab-content">
                                          <section class="content panel panel-success panel-body">
                                              <table id="table_Cobrados" class="table table-striped table-bordered">
                                                <thead>
                                                  <tr class="success">
                                                    <th class ="text-danger" ><i class="fa fa-th-list"></i>  Cuota N°</th>
                                                     <th class ="text-danger" ><i class="fa fa-th-list"></i>  Recibo N°</th>
                                                    <th class ="text-danger" ><i class="fa fa-user"></i> Cliente</th>
                                                    <th class ="text-danger" ><i class="fa fa-usd"></i>  Importe</th>
                                                    <th class ="text-danger" ><i class="fa fa-calendar"></i>  Fecha Pago</th>
                                                    <th class ="text-danger" ><i class="fa fa-calendar"></i>   Feca Vencimento</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                              </table>
                                        </section><!-- /.content -->
                                  </div>
                                  </div>
                                  <div id="Listado_cobrar" class="tab-pane">
                                    <div id="my-tab-content" class="tab-content">
                                          <section class="content panel panel-success panel-body">
                                              <table id="table_Listado_cobrar" class="table table-striped table-bordered">
                                                <thead>
                                                  <tr class="success">
                                                    <th class ="text-danger" ><i class="fa fa-th-list"></i>  Cuota N°</th>
                                                    <th class ="text-danger" ><i class="fa fa-th-list"></i>  Recibo N°</th>
                                                    <th class ="text-danger" ><i class="fa fa-user"></i> Cliente</th>
                                                    <th class ="text-danger" ><i class="fa fa-usd"></i>  Importe</th>
                                                    <th class ="text-danger" ><i class="fa fa-calendar"></i>   Feca Vencimento</th>
                                                    <th class ="text-danger" style="width:125px;"><i class="fa fa-cogs"></i> Acciones</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                              </table>
                                        </section><!-- /.content -->
                                  </div>
                                  </div>

                               </div>
                          </div>
                </section>
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="modal_form_cobrar" >
    <div class="modal-dialog ">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 style="text-align: center" class="modal-title"></h4>
      </div>
      <div class="alert alert-info" id="cobros_aler" >
        <strong class="title" ></strong>
      </div>
      <div class="modal-body form">
        <form action="#" name="form" id="form_cobrar" class="">
          <input type="hidden" value="" id="idCredito" name="idCredito"/>
          <input type="hidden" value="" id="Estado_Pago" name="Estado_Pago"/>  
              <div <div class="row"> 
               <div class="col-md-8 col-md-offset-2 table-responsive">
                <table class="table table-striped" i>
                  <tbody>
                     <tr id="transparente">
                       <td style="width: 110px;">
                           <label for="" class="control-label text-danger">Nombre Cliente</label>
                        </td>
                        <td style="text-align:left width: 210px;">
                          <div class="form-group has-feedback">
                            <div id="nombre"></div>
                          </div>
                        </td>
                     </tr>
                     <tr id="transparente">
                       <td style="width: 110px; ">
                           <label for="" class="control-label text-danger">Monto a Pagar</label>
                        </td>
                        <td style="width: 210px;">
                          <span class ="C text-danger"></span>
                          <div class="form-group has-feedback">
                            <input   type ="hidden" id="Importe" name="Importe" class="form-control " placeholder="Importe" size='45' title="Importe" pattern="[0-9]{1,10}"  >
                            <div id="Imp"></div>
                          </div>
                        </td>
                      </tr> 
                      <tr id="transparente" class="transparente">
                       <td style="width: 110px;">
                       <br>
                            <label for="" class="control-label text-danger">Descripcion</label>
                        </td>
                        <td style="">
                                  <div class="form-group has-feedback " id="reset_Des">
                                      <label for="" class="control-label"></label>
                                      <div class="">
                                          <textarea required maxlength="50"  name='Descripcion' id='Descripcion' class="form-control " rows="2" placeholder="" title="Descripcion " autofocus></textarea>
                                      </div>
                                      <span class="glyphicon form-control-feedback" id="yty" aria-hidden="true"></span>
                                      <div class="help-block with-errors" id="12"></div>
                                    </div>
                        </td>
                      </tr> 
                  </tbody>
                </table>
              </div>
              </div>
         <div class="modal-footer">
            <button type="submit" id="btnSave"  class="btn btn-sm btn-success">
                     <span class="glyphicon glyphicon-floppy-disk"></span> Cobrar
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
  <!-- fin <div class="content-wrapper"> -->
</div>

