    <!-- datetimepicker-->
    <script src="<?php echo base_url();?>admin_stilo/pikear/js/moment.js"></script>
    <script src="<?php echo base_url();?>admin_stilo/pikear/es.js"></script>
    <script src="<?php echo base_url();?>admin_stilo/pikear/js/bootstrap-datetimepicker.js"></script>
    <!-- autocomplete -->
    <script src="<?php echo base_url();?>admin_stilo/js/jquery.autocomplete.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>admin_stilo/bootstrap/js/bootstrap.js" type="text/javascript"></script>

        
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
        <!-- Morris.js charts -->
            <script src="<?php echo base_url('clienteStilo/validator.min.js')?>"></script>
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
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
         .done(function(data) {
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
         })
         .fail(function(data) {
              location.reload();
         });

    });
});
$(function () {
        $("#agenda").click(function(){
        $('#snnip').modal('show'); // show bootstrap modal
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
        .done(function(data) {
        $("#agenda_vista").load('<?php echo base_url("index.php/Agenda")?>');
        $("#conte_repo,#cliente_vista,#cobros_vista,#pagos_vista,#caja_vista,#servicios_vista,#presupuesto_vista,#stock_vista,#home,#empleado_vista,#productos_vista").hide();
        $('.acor,.acor_pa,.admi').hide();
         setTimeout(function() {
            $('#agenda_vista').show();

            $('#snnip').modal('hide'); // show bootstrap modal
        },800);

         })
         .fail(function(data) {
              location.reload();
         });
        });

        $("#cliente").click(function(){
        $('#snnip').modal('show'); // show bootstrap modal
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
         .done(function(data) {
                 // $('#skin').removeClass('sidebar-collapse');
            $("#cliente_vista").load('<?php echo base_url("index.php/Cliente")?>');
            $("#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#caja_vista,#servicios_vista,#presupuesto_vista,#stock_vista,#home,#empleado_vista,#productos_vista").hide();
            $('.acor,.acor_pa,.admi').hide();

        setTimeout(function() {
            $('#cliente_vista').show();
            $('#snnip').modal('hide'); // show bootstrap modal
        },800);
         })
         .fail(function(data) {
              location.reload();
         });
        });
        $("#empleado").click(function(){
             $('#snnip').modal('show'); // show bootstrap modal
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
         .done(function(data) {
                 // $('#skin').removeClass('sidebar-collapse');
                $("#empleado_vista").load('<?php echo base_url("index.php/Empleado")?>');
                $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#presupuesto_vista,#home,#cliente_vista,#productos_vista,#caja_vista').hide();
                $('.acor,.acor_pa,.admi').hide();

            setTimeout(function() {
                $('#empleado_vista').show();

                $('#snnip').modal('hide'); // show bootstrap modal
            },800);
         })
         .fail(function(data) {
              location.reload();
         });

        });

         $("#productos").click(function(){
         $('#snnip').modal('show'); // show bootstrap modal
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
         .done(function(data) {
            $("#productos_vista").load('<?php echo base_url("index.php/Productos")?>');
            $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#presupuesto_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
            $('.acor,.acor_pa,.admi').hide();
            setTimeout(function() {
             // $('#skin').removeClass('sidebar-collapse');
            $('#productos_vista').show();
            $('#snnip').modal('hide'); // show bootstrap modal
        },800);
         })
         .fail(function(data) {
              location.reload();
         });

        });

         $("#Stock").click(function(){
              $('#snnip').modal('show'); // show bootstrap modal
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
         .done(function(data) {
            $("#stock_vista").load('<?php echo base_url("index.php/Stock")?>');
           $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#presupuesto_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
            $('.acor,.acor_pa').hide();
            setTimeout(function() {
             // $('#skin').removeClass('sidebar-collapse');
            $('#stock_vista').show();
            $('#snnip').modal('hide'); // show bootstrap modal
        },800);
         })
         .fail(function(data) {
              location.reload();
         });

        });

         $("#servicios").click(function(){
              $('#snnip').modal('show'); // show bootstrap modal
        $.ajax({
                url : "<?php echo site_url('index.php/Verificar_sesion/index'); ?>",
                type: "POST",
                dataType: "JSON",
                data: {param1: 'value1'},
         })
         .done(function(data) {
            $("#servicios_vista").load('<?php echo base_url("index.php/Servicios")?>');
            $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#presupuesto_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#caja_vista').hide();
            $('.acor,.acor_pa,.admi').hide();
            setTimeout(function() {
             // $('#skin').removeClass('sidebar-collapse');
            $('#servicios_vista').show();
            $('#snnip').modal('hide'); // show bootstrap modal
        },800);
         })
         .fail(function(data) {
              location.reload();
         });
        });

         $("#presupuesto").click(function(){
               $('#home').show();
               $('#presupuesto_vista').hide();
            $.ajax({
                url : "<?php echo site_url('index.php/Caja/verificar_caja'); ?>",
                type: "POST",
                dataType: "JSON",
                 cache: false,
                success: function(data)
                {
                    if (data == 'cerrada') {
                        swal('Caja Cerrada','')
                    }else{
                        $('#snnip').modal('show'); // show bootstrap modal
                        $('#skin').addClass('sidebar-collapse');
                        $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler")?>');
                        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#productos_vista,#cliente_vista,#empleado_vista,#caja_vista').hide();
                        $('.acor,.acor_pa,.admi').hide();
                        setTimeout(function() {
                        $('#presupuesto_vista').show();
                        $('#home').hide();
                        $('#snnip').modal('hide'); // show bootstrap modal
                        },1000);
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                     location.reload();
                }
            });
        });

         $("#caja").click(function(){
        $('#skin').addClass('sidebar-collapse');
        $('#caja_vista').show();
        $('#conte_repo,#agenda_vista,#cobros_vista,#pagos_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#presupuesto_vista').hide();
        $("#caja_vista").load('<?php echo base_url("index.php/Caja")?>');
        $('.acor,.acor_pa,.admi').hide();
        });
                     $("#Pagos").click(function(){
                         $.ajax({
                            url : "<?php echo site_url('index.php/Caja/verificar_caja'); ?>",
                            type: "POST",
                            dataType: "JSON",
                             cache: false,
                            success: function(data)
                            {
                                if (data == 'cerrada') {
                                    swal('Caja Cerrada','')
                                }else{
                                 $('#skin').removeClass('sidebar-collapse');
                                 $('#pagos_vista').show();
                                 $('#conte_repo,#agenda_vista,#cobros_vista,#caja_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#presupuesto_vista').hide();
                                 $("#pagos_vista").load('<?php echo base_url("index.php/Pagos")?>');
                                 $('.acor').hide();
                             }

                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                location.reload();
                            }
                        });
                     });
                     $("#Cobros").click(function(){
                         $.ajax({
                            url : "<?php echo site_url('index.php/Caja/verificar_caja'); ?>",
                            type: "POST",
                            dataType: "JSON",
                             cache: false,
                            success: function(data)
                            {
                                if (data == 'cerrada') {
                                    swal('Caja Cerrada','')
                                }else{
                                 $('#skin').removeClass('sidebar-collapse');
                                 $('#cobros_vista').show();
                                 $('#conte_repo,#agenda_vista,#pagos_vista,#caja_vista,#servicios_vista,#productos_vista,#home,#cliente_vista,#empleado_vista,#presupuesto_vista').hide();
                                 $("#cobros_vista").load('<?php echo base_url("index.php/Cobros")?>');
                                 $('.acor').hide();
                                }

                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                location.reload();
                            }
                        });
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