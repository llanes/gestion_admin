<script>
$(function() {
    $('#cliente_vista').hide();
    $("#empleado_vista").hide();
    $("#productos_vista").hide();
});
$(function () {
        $("#cliente").click(function(){
		$('#cliente_vista').show()
		$("#home,#empleado_vista,#productos_vista").hide();
        $("#cliente_vista").load('<?= base_url("index.php/Cliente/cliente")?>');
        });
});
$(function () {
        $("#empleado").click(function(){
        $('#empleado_vista').show()
		$('#home,#cliente_vista,#productos_vista').hide();
        $("#empleado_vista").load('<?= base_url("index.php/Empleado/empleado")?>');
        });
});
$(function () {
         $("#productos").click(function(){
        $('#productos_vista').show()
        $('#home,#cliente_vista,#empleado_vista').hide();
        $("#productos_vista").load('<?= base_url("index.php/Productos/productos")?>');
        });
});

</script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>    