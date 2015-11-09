
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>admin_stilo/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>admin_stilo/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>    
            <!-- autocomplete -->
    <script src="<?php echo base_url(); ?>admin_stilo/js/jquery.autocomplete.js"></script>
   <!-- AdminLTE App -->
     <script src="<?php echo base_url(); ?>admin_stilo/dist/js/app.min.js" type="text/javascript"></script>    
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>admin_stilo/dist/js/demo.js" type="text/javascript"></script>
    <!-- datatables -->
    <script src="<?php echo base_url('admin_stilo/datatables/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('admin_stilo/datatables/js/dataTables.bootstrap.js'); ?>"></script>
    <script>
$(function() {
    $("#presupuesto_vista").hide();    
    $('#cliente_vista').hide();
    $("#empleado_vista").hide();
    $("#productos_vista").hide();
    $("#stock_vista").hide();
});
$(function () {
         $("#presupuesto").click(function(){
        $('#presupuesto_vista').show()
        $('#home,#cliente_vista,#empleado_vista,#productos_vista,#stock_vista').hide();
        $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler"); ?>');
        });
});
$(function () {
        $("#cliente").click(function(){
        $('#cliente_vista').show()
        $("#home,#presupuesto_vista,#empleado_vista,#productos_vista,#stock_vista").hide();
        $("#cliente_vista").load('<?php echo base_url("index.php/Cliente"); ?>');
        });
});
$(function () {
        $("#empleado").click(function(){
        $('#empleado_vista').show()
        $('#home,#presupuesto_vista,#cliente_vista,#productos_vista,#stock_vista').hide();
        $("#empleado_vista").load('<?php echo base_url("index.php/Empleado"); ?>');
        });
});
$(function () {
         $("#productos").click(function(){
        $('#productos_vista').show()
        $('#home,#presupuesto_vista,#cliente_vista,#empleado_vista,#stock_vista').hide();
        $("#productos_vista").load('<?php echo base_url("index.php/Productos"); ?>');
        });
});
$(function () {
         $("#stock").click(function(){
        $('#stock_vista').show()
        $('#home,#presupuesto_vista,#cliente_vista,#empleado_vista,#productos_vista').hide();
        $("#stock_vista").load('<?php echo base_url("index.php/Stock"); ?>');
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