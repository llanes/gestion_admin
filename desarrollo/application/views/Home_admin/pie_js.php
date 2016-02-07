
 
    <!-- datetimepicker-->
    <script src="<?php echo base_url();?>admin_stilo/pikear/js/moment.js"></script>
    <script src="<?php echo base_url();?>admin_stilo/pikear/es.js"></script>
    <script src="<?php echo base_url();?>admin_stilo/pikear/js/bootstrap-datetimepicker.js"></script>
    <!-- autocomplete -->
    <script src="<?php echo base_url();?>admin_stilo/js/jquery.autocomplete.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>admin_stilo/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
   <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>admin_stilo/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>admin_stilo/dist/js/demo.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>admin_stilo/alert/sweetalert.min.js" type="text/javascript"></script>
    <!-- datatables -->
    <script src="<?php echo base_url('admin_stilo/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('admin_stilo/datatables/js/dataTables.bootstrap.js')?>"></script>
    <!-- bootstrap-checkbox -->
    <script src="<?php echo base_url('bower_components/bootstrap-checkbox/dist/js/bootstrap-checkbox.js')?>"></script>
    <script src="<?php echo base_url('bower_components/underscore/underscore-min.js')?>"></script>
    <script src="<?php echo base_url('bower_components/bootstrap-calendar/js/calendar.js')?>"></script>
<script>
$(function() {
    $('#cliente_vista').hide();
    $("#empleado_vista").hide();
    $("#productos_vista").hide();
    //$("#stock_vista").hide();
    $("#presupuesto_vista").hide();
    $("#servicios_vista").hide();
    $("#caja_vista").hide();
    $("#pagos_vista").hide();
    $("#cobros_vista").hide();
    $("#agenda_vista").hide();
    $("#conte_repo").hide();
    


    $("#refrescar,#administsdad").click(function(){
        $('#cliente_vista').hide();
        $("#empleado_vista").hide();
        $("#productos_vista").hide();
        //$("#stock_vista").hide();
        $("#presupuesto_vista").hide();
        $("#servicios_vista").hide();
        $("#caja_vista").hide();
        $("#pagos_vista").hide();
        $("#cobros_vista").hide();
        $("#agenda_vista").hide();
        $("#conte_repo").show();
    });
});
$(function () {
        $("#agenda").click(function(){
        $('#agenda_vista').show();
        $("#conte_repo,#cliente_vista,#cobros_vista,#pagos_vista,#caja_vista,#servicios_vista,#presupuesto_vista,#stock_vista,#home,#empleado_vista,#productos_vista").hide();
        $("#agenda_vista").load('<?php echo base_url("index.php/Agenda")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

        $("#cliente").click(function(){
        $('#cliente_vista').show();
        $("#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#caja_vista,#servicios_vista,#presupuesto_vista,#stock_vista,#home,#empleado_vista,#productos_vista").hide();
        $("#cliente_vista").load('<?php echo base_url("index.php/Cliente")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

        $("#empleado").click(function(){
        $('#empleado_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#presupuesto_vista,#home,#cliente_vista,#productos_vista,#caja_vista').hide();
        $("#empleado_vista").load('<?php echo base_url("index.php/Empleado")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

         $("#productos").click(function(){
        $('#productos_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#presupuesto_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
        $("#productos_vista").load('<?php echo base_url("index.php/Productos")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

         $("#Stock").click(function(){
        $('#stock_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#presupuesto_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
        $("#stock_vista").load('<?php echo base_url("index.php/Stock")?>');
        $('.acor,.acor_pa').hide();
        });

         $("#servicios").click(function(){
        $('#servicios_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#presupuesto_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
        $("#servicios_vista").load('<?php echo base_url("index.php/Servicios")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

         $("#presupuesto").click(function(){
        $('#presupuesto_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
        $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

         $("#caja").click(function(){
        $('#caja_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#presupuesto_vista').hide();
        $("#caja_vista").load('<?php echo base_url("index.php/Caja")?>');
        $('.acor,.acor_pa,.admi').hide();
        });

         $("#Pagos").click(function(){
        $('#pagos_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#caja_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#presupuesto_vista').hide();
        $("#pagos_vista").load('<?php echo base_url("index.php/Pagos")?>');
        $('.acor').hide();
        });

         $("#Cobros").click(function(){
        $('#cobros_vista').show();
        $('#conte_repo,#agenda_vista,#pagos_vista,#caja_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#presupuesto_vista').hide();
        $("#cobros_vista").load('<?php echo base_url("index.php/Cobros")?>');
        $('.acor').hide();
        });
});
        $(function() {
            $("#Alquiler_Presupuesto").click(function(){
                $('#empresa_vista,#stock_vista,#home,.r2,.r3,.r4,.r5,.r6,.r7,.r8').hide();
                $('.r1').show();
                $(".r1").load('<?php echo base_url("index.php/Reportes/reporte_uno")?>');
            });

            $("#r2").click(function(){
                $('.r2').show();
                $('#empresa_vista,#stock_vista,.r1,.r3,.r4,.r5,.r6,.r7,.r8,#home').hide();
                $(".r2").load('<?php echo base_url("index.php/Reportes/reporte_dos")?>');
            });

            $("#r3").click(function(){
                $('.r3').show();
                $('#empresa_vista,#stock_vista,.r2,.r1,.r4,.r5,.r6,.r7,.r8,#home').hide();
                $(".r3").load('<?php echo base_url("index.php/Reportes/reporte_tres")?>');
            });

            $("#r4").click(function(){
                $('.r4').show();
                $('#empresa_vista,#stock_vista,.r2,.r3,.r1,.r5,.r6,.r7,.r8,#home').hide();
                $(".r4").load('<?php echo base_url("index.php/Reportes/reporte_cuatro")?>');
            });

            $("#r5").click(function(){
                $('.r5').show();
                $('#empresa_vista,#stock_vista,.r2,.r3,.r4,.r1,.r6,.r7,.r8,#home').hide();
                $(".r5").load('<?php echo base_url("index.php/Reportes/reporte_cinco")?>');

            });

            $("#r6").click(function(){
                $('.r6').show();
                $('#empresa_vista,#stock_vista,.r2,.r3,.r4,.r5,.r1,.r7,.r8,#home').hide();
                $(".r6").load('<?php echo base_url("index.php/Reportes/reporte_seis")?>');
            });

            $("#r7").click(function(){
                $('.r7').show();
                $('#empresa_vista,#stock_vista,.r2,.r3,.r4,.r5,.r6,.r1,.r8,#home').hide();
                $(".r7").load('<?php echo base_url("index.php/Reportes/reporte_ciete")?>');
            });

            $("#r8").click(function(){
                $('.r8').show();
                $('#empresa_vista,#stock_vista,.r2,.r3,.r4,.r5,.r6,.r7,.r1,#home').hide();
                $(".r8").load('<?php echo base_url("index.php/Reportes/reporte_ocho")?>');

            });
            $("#Stock").click(function(){
                    $('#empresa_vista,.r2,.r3,.r4,.r5,.r6,.r7,.r1,#home,.r8,.r1').hide();
                    $('#stock_vista').show();
                    $("#stock_vista").load('<?php echo base_url("index.php/Stock")?>');
            });
            $("#empresa").click(function(){
                 $('#stock_vista,.r2,.r3,.r4,.r5,.r6,.r7,.r1,#home,.r8,.r1').hide();
                  $('#empresa_vista').show();
                 $("#empresa_vista").load('<?php echo base_url("index.php/Empresa")?>');
            });
        });
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>
  </body>
</html>