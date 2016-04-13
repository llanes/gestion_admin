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
               <div class="col-md-1">
               </div>
               <div class="col-md-10">
                 <div class="box ">
                    <div class="box-header" style="text-align:center">
                      <h3 class="box-title">Entrada de Reportes</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

 <form role="form" id="al_pre" name="al_pre"  method="POST" target="myIframe" action="<?= site_url('index.php/Reportes/generar_caja'); ?>">
  <table class="table table-condensed" >
    <tbody>
    <tr>
    <td colspan="">
                 <label for="" class="col-xs-2 ">Rango</label>
                 <div class="col-xs-4   ">
                          <select name="rango_caja" id="rango_caja" class="form-control input-sm" >
                            <option class="" value=""></option>
                            <option class="" value="1">Hoy</option>
                              <option class="" value="2">Ayer</option>
                                <option class="" value="3">Yltimo 7 Dias</option>
                                <option class="" value="4">Este mes</option>
                                <option class="" value="5">Todos</option>
                          </select>
                </div>

    </td>
            <td style="display: none">
<button disabled="disabled" type="submit" class="btn btn-block btn-success btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-television"></i> Pantalla</button>

        </td>
    </tr> 
      <tr>
        <td colspan="" colspan="" headers=""  width="">
                    <label for="" class="col-xs-2">Inicio</label>
        <div class="col-md-4">
             <div class='input-group date' id='datetimepicker_caja'>
                <input  type='text' class="form-control input-sm" id="inicio_caja" name="inicio_caja"  size="16" value="" />
                <div class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                </div>
            </div>
        </div>
                     <label for="" class="col-xs-2">Hasta</label>


        <div class="col-md-4">
            <div class='input-group date' id='datetimepicker_caja2'>
                <input  type='text' class="form-control input-sm" id="fin_caja" name="fin_caja" size="16" value=""  />
                <div class="input-group-btn">
                    <button type="button" class="btn btn-sm btn-info date-set"><i class="fa fa-calendar"></i></button>
                </div>
            </div>
        </div>


        </td>


        <td >
<button type="submit" formtarget="_blank" id="target" class="btn btn-block btn-primary btn-fla pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>

        </td>

      </tr>
    </tbody>
  </table>

                    </form>
                    <!-- <iframe name="myIframe" id="iframe" src="" height="500" width="970"></iframe> -->

                </div><!-- /.box -->
               </div>
              <div class="col-md-1">



            </div><!--/.col (left) -->
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
            $('#datetimepicker_caja').datetimepicker({
                // minDate: new Date(),
                format: 'YYYY-MM-DD',
            });
            $('#datetimepicker_caja2').datetimepicker({
               // minDate: new Date(),
               format: 'YYYY-MM-DD',
            });
            $("#datetimepicker_caja").on("dp.change", function (e) {
                $('#datetimepicker_caja2').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker_caja2").on("dp.change", function (e) {
                $('#datetimepicker_caja').data("DateTimePicker").maxDate(e.date);
            });
        });
     $(function() {
          // $('#al_pre').submit(function(e) {
        //           $.ajax({
        //                   type : 'POST',
        //                   url : "<?php echo site_url('index.php/Reportes/generar_al_pre'); ?>", // octengo la url del formulario
        //                   data: $(this).serialize(), // serilizo el formulario
        //                   success : function(data) {
        //                     if (data == '"Campos vacios"' || data == '"Falta Inicio"' ) {
        //                       swal('Error',data);
        //                     }else{
        //                        $('#reportes').modal('show');
        //                        $('#al_pre')[0].reset(); // reset form on modal

        //                     }

        //                  },
        //                   // código a ejecutar si la petición falla;
        //                   error : function(xhr, status) {
        //                       alert('Disculpe, existió un problema');
        //                       console.log('error(jqXHR, textStatus, errorThrown)');
        //                   },
        //               });
        // })
     });


</script>
