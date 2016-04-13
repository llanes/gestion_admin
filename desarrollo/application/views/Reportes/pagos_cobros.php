    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
          <i class="fa fa-globe"></i>
            {titulo1}
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> {titulo3}</a></li>
            <li class="active">{titulo4}</li>
          </ol>
        </section>
<section class="content" >
          <div class="row">
            <!-- left column -->
            <div class="col-md-12 box box-info" style="height: 500px;">

               <div class="col-md-12">
                 <div class="box ">
                    <div class="box-header" style="text-align:center">
                      <h3 class="box-title">Entrada de Reportes</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" id="pagos_cobros" name="pagos_cobros"  method="POST" target="myIframe" action="">
                    <table class="table table-condensed" >
                    <tbody>
                    <tr>
                      <td colspan="2">
                         <label for="" class="col-xs-1 ">Selecciona</label>
                           <div class="col-xs-3   ">
                                    <select name="selecciona" id="selecciona" class="form-control input-sm" >
                                      <option class="" value="1">Pagos</option>
                                      <option class="" value="2">Cobros Cuotas</option>
                                    </select>
                          </div>
                          <label id="tipo" class="col-xs-1 ">Tipos</label>
                           <div class="col-xs-3   ">
                               <select class="form-control input-sm" name="tipopago" id="tipopago" title="Seleciona tipo_pagos">
                                 <option name="0" value=""></option>
                                 <option name="1" value="Pagos de Empleado">Pagos de Empleado</option>
                                 <option name="2" value="Pago de Agua">Pago de Agua</option>
                                 <option name="3" value="Pago de Luz">Pago de Luz</option>
                                 <option name="4" value="Extras">Extras</option>
                               </select>
                               <select disabled  class="form-control input-sm" name="Tipos_Pagos2" id="Tipos_Pagos2" title="Seleciona tipo_pagos">
                               </select>
                          </div>

                           <label for="" class="col-xs-1 ">Rango</label>
                           <div class="col-xs-3   ">
                                    <select name="rango_dos" id="rango_dos" class="form-control input-sm" >
                                      <option class="natural" value=""></option>
                                      <option class="juridica" value="1">Hoy</option>
                                        <option class="natural" value="2">Ayer</option>
                                          <option class="natural" value="3">Yltimo 7 Dias</option>
                                          <option class="natural" value="4">Este mes</option>
                                          <option class="natural" value="5">Todos</option>
                                    </select>
                          </div>


                      </td>
                      <td style="display: none">
                         <button disabled="disabled" type="submit" class="btn btn-block btn-success btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-television"></i> Pantalla</button>
                      </td>
                    </tr> 
                  <tr>
                    <td colspan="" colspan="" headers=""  width="">
                                <label for="" class="col-xs-1">Inicio</label>
                    <div class="col-md-3">
                         <div class='input-group date' id='datetimepicker_1'>
                            <input  type='text' class="form-control input-sm" id="inicio_dos" name="inicio_dos"  size="16" value="" />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                            </div>
                        </div>
                    </div>
                                 <label for="" class="col-xs-1">Hasta</label>


                    <div class="col-md-3">
                        <div class='input-group date' id='datetimepicker_2'>
                            <input  type='text' class="form-control input-sm" id="fin_dos" name="fin_dos" size="16" value=""  />
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                            </div>
                        </div>
                    </div>

                     <label for="" class="col-xs-2"></label>
                    <div class="col-md-2">
            <button type="submit" formtarget="_blank" id="target" class="btn btn-block btn-primary btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                    </div>


                    </td>
                  </tr>
                </tbody>
              </table>
                   </form>
                    <!-- <iframe name="myIframe" id="iframe" src="" height="500" width="970"></iframe> -->
     
            <!-- <button type="submit" formtarget="_blank" id="target" class="btn btn-block btn-primary btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->


                </div><!-- /.box -->
               </div>
          </div>   <!-- /.row -->
        </section>

<div class="modal fade" id="reportes">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body modal-lg" >
       
      </div>
    </div>
  </div>
</div>
<script>
  // datetime picker end
     $(function () {
            $('#datetimepicker_1').datetimepicker({
                // minDate: new Date(),
                format: 'YYYY-MM-DD',
            });
            $('#datetimepicker_2').datetimepicker({
               // minDate: new Date(),
               format: 'YYYY-MM-DD',
            });
            $("#datetimepicker_1").on("dp.change", function (e) {
                $('#datetimepicker_2').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker_2").on("dp.change", function (e) {
                $('#datetimepicker_1').data("DateTimePicker").maxDate(e.date);
            });
        });
    $(function() {
             var id      = $( "select[name=selecciona]").val();
            if (id == 1) {
                $('#tipopago').show();
                $('#Tipos_Pagos2').hide();
                $('#pagos_cobros').attr('action', "<?= site_url('index.php/Reportes/generar_pagos'); ?>");

            } if (id == 2) {
                $('#tipopago').hide();
                $('#Tipos_Pagos2').show();
                $('#pagos_cobros').attr('action', "<?= site_url('index.php/Reportes/genera_cobros'); ?>");

             }
            $("#selecciona").change(function(){
                  var id      = $( "select[name=selecciona]").val();
                  // alert(id);
                if (id == 1) {
                  $('#tipopago').show();
                  $('#Tipos_Pagos2').hide();
                  $('#pagos_cobros').attr('action', "<?= site_url('index.php/Reportes/generar_pagos'); ?>");
                } if (id == 2) {
                  $('#tipopago').hide();
                  $('#Tipos_Pagos2').show();
                  $('#pagos_cobros').attr('action', "<?= site_url('index.php/Reportes/generar_cobros'); ?>");
                }
            });
    });
</script>
