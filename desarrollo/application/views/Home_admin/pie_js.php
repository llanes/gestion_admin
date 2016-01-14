
    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url();?>admin_stilo/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- datetimepicker-->
    <script src="<?= base_url();?>admin_stilo/pikear/js/moment.js"></script>
    <script src="<?= base_url();?>admin_stilo/pikear/es.js"></script>
    <script src="<?= base_url();?>admin_stilo/pikear/js/bootstrap-datetimepicker.js"></script>
    <!-- autocomplete -->
    <script src="<?php echo base_url();?>admin_stilo/js/jquery.autocomplete.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?= base_url();?>admin_stilo/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
   <!-- AdminLTE App -->
    <script src="<?= base_url();?>admin_stilo/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?= base_url();?>admin_stilo/dist/js/demo.js" type="text/javascript"></script>
    <script src="<?= base_url();?>admin_stilo/alert/sweetalert.min.js" type="text/javascript"></script>
    <!-- datatables -->
    <script src="<?php echo base_url('admin_stilo/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('admin_stilo/datatables/js/dataTables.bootstrap.js')?>"></script>
    <!-- bootstrap-checkbox -->
    <script src="<?php echo base_url('bower_components/bootstrap-checkbox/dist/js/bootstrap-checkbox.js')?>"></script>


<script>
$(function() {
    $('#cliente_vista').hide();
    $("#empleado_vista").hide();
    $("#productos_vista").hide();
    $("#stock_vista").hide();
    $("#presupuesto_vista").hide();
    $("#servicios_vista").hide();
});
$(function () {
        $("#cliente").click(function(){
        $('#cliente_vista').show()
        $("#servicios_vista,#presupuesto_vista,#stock_vista,#home,#empleado_vista,#productos_vista").hide();
        $("#cliente_vista").load('<?= base_url("index.php/Cliente")?>');
        });
});
$(function () {
        $("#empleado").click(function(){
        $('#empleado_vista').show()
        $('#servicios_vista,#presupuesto_vista,#stock_vista,#home,#cliente_vista,#productos_vista').hide();
        $("#empleado_vista").load('<?= base_url("index.php/Empleado")?>');
        });
});
$(function () {
         $("#productos").click(function(){
        $('#productos_vista').show()
        $('#servicios_vista,#presupuesto_vista,#stock_vista,#home,#cliente_vista,#empleado_vista').hide();
        $("#productos_vista").load('<?= base_url("index.php/Productos")?>');
        });
});
$(function () {
         $("#Stock").click(function(){
        $('#stock_vista').show()
        $('#servicios_vista,#presupuesto_vista,#productos_vista,#home,#cliente_vista,#empleado_vista').hide();
        $("#stock_vista").load('<?= base_url("index.php/Stock")?>');
        });
});
$(function () {
         $("#servicios").click(function(){
        $('#servicios_vista').show()
        $('#presupuesto_vista,#productos_vista,#stock_vista,#home,#cliente_vista,#empleado_vista').hide();
        $("#servicios_vista").load('<?= base_url("index.php/Servicios")?>');
        });
});
$(function () {
         $("#presupuesto").click(function(){
        $('#presupuesto_vista').show()
        $('#servicios_vista,#productos_vista,#stock_vista,#home,#cliente_vista,#empleado_vista').hide();
        $("#presupuesto_vista").load('<?= base_url("index.php/Presupuesto_arquiler")?>');
        });
});

</script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });

</script>    
    
  </body>
</html>