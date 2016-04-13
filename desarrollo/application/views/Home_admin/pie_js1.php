
 
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
    add_cliente();


    $("#refrescar,#administsdad").click(function(){

    });
});
    function add_cliente()
    {
     $(".N,.DI,.D,.T,.CO,.SE,.RU,.TI,.MP").html("").css({"display":"none"});
      $("#empresa_aler").hide();
      $(".modal-body,.modal-header").show();
      save_method = 'add';
      $('#from_empresa')[0].reset(); // reset form on modals
      $('#modal_form_empresa').modal('show'); // show bootstrap modal
      $('.modal-title').text('Agregar Empresa'); // Set Title to Bootstrap modal title
    }
        $(function() {
    $('#from_empresa').submit(function(e) {
      var url;
      url = "<?php echo site_url('index.php/Empresa/ajax_add'); ?>";
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.Nombre) {
                               $(".N").append(json.Nombre).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Descripcion) {
                               $(".DI").append(json.Descripcion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Direccion) {
                               $(".D").append(json.Direccion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                             if (json.R_U_C) {
                               $(".RU").append(json.R_U_C).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Telefono) {
                               $(".T").append(json.Telefono).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Email) {
                               $(".CO").append(json.Email).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Timbrado) {
                               $(".TI").append(json.Timbrado).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Series) {
                               $(".SE").append(json.Series).css({"display":"block"}); /// mostar validation  de iten pass
                            }
                           // if (json.passconf) {
                           //     $(".PF").append(json.passconf).css({"display":"block"}); /// mostar validation  de iten pass
                           //  }
                          }else{ 
                                        $(".modal-body,.modal-header").hide();
                                         $('#empresa_aler').show()
                                             $('.title').text('Registrado Correctamente');
                                          setTimeout(function() {
                                                $("#empresa_aler").fadeOut(1500);
                                                $('#modal_form_empresa').modal('hide');
                                            },2000);
                                        // $('#modal_form_empresa').modal('hide');
                                        location.reload();
                           }
                     },
                      // código a ejecutar si la petición falla;
                      error : function(xhr, status) {
                          alert('Disculpe, existió un problema');
                          console.log('error(jqXHR, textStatus, errorThrown)');
                      },
                  });
      e.preventDefault();
    })
    });
$(function () {
        $("#agenda").click(function(){
                add_cliente();
        });

        $("#cliente").click(function(){
                add_cliente();
        });
        $("#empleado").click(function(){
                add_cliente();
        });

         $("#productos").click(function(){
                add_cliente();
        });

         $("#Stock").click(function(){
               add_cliente();
        });

         $("#servicios").click(function(){
               add_cliente();
        });
});

    jQuery(document).ready(function ($) {
        $('#tabs').tab();
    });
</script>
  <div class="modal fade" id="modal_form_empresa" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Formulario Empresa</h3>
      </div>
       <div class="alert alert-info" id="empresa_aler" >
        <strong class="title" ></strong>
      </div>
      <div class="modal-body form">

        <form action="#" id="from_empresa" name="from_empresa" class="form-signin">
          <input type="hidden" value="" name="idEmpresa"/> 
                       <div class="table-responsive">
                <table class="table table-striped" i>
                  <tbody>
                     <tr id="transparente">
                        <td >
                          <a> Nombre </a>
                        </td>
                        <td>
                          <span class ="N text-danger"></span>
                          <div class="form-group has-feedback">
                            <input required  type ="text" id="Nombre" name="Nombre" class="form-control input-sm" placeholder="" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                            <span class=""></span>
                          </div>
                        </td>
                        <td >
                          <a> Descripcion </a>
                        </td>
                        <td>
                          <span class ="DI text-danger"></span>
                          <div class="form-group has-feedback">
                            <input   type ="text" id="Descripcion" name="Descripcion" class="form-control input-sm" placeholder="" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                            <!-- <span class="glyphicon glyphicon-ok form-control-feedback"></span> -->
                          </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Direccion </a>
                        </td>
                        <td>
                          <span class ="D text-danger"></span>
                          <div class="form-group has-feedback">
                              <input required  type ="text" id="Direccion" name="Direccion" class="form-control input-sm" placeholder="" size='45' title="ingrese Direccion" pattern="[A-Za-z ]{5,50}" maxlength="50"  autofocus  >
                            <span class=""></span>
                          </div>
                        </td>
                             <td >
                          <a> Telefono</a>
                        </td>
                        <td>
                          <span class ="T text-danger"></span>
                          <div class="form-group has-feedback">
                              <input required  type ="text" id="Telefono" name="Telefono" class="form-control input-sm" placeholder="" title="ingrese Telefono" pattern="[0-9]{5,15}" maxlength="15"  autofocus  >
                             <span class=""></span>
                          </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Correo </a>
                        </td>
                        <td>
                              <span class ="CO text-danger"></span>
                            <div class="form-group has-feedback">
                              <input required   type ="Email" id="Email" name="Email" class="form-control input-sm" placeholder="" title="ejemplo@correo.com" onfocus="autofocus" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus  >
                              <span class=""></span>
                            </div>
                        </td>
                                                <td >
                          <a> R.U.D </a>
                        </td>
                        <td>
                            <span class ="RU text-danger"></span>
                            <div class="form-group has-feedback">
                                <input required   type ="text" id="R_U_C" name="R_U_C" class="form-control input-sm" placeholder="" size='45'   title="ingrese CEDULA RUC"  min="10" maxlength="15"  autofocus  >
                              <span class=""></span>
                            </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Timbrado </a>
                        </td>
                        <td>
                        <span class ="TI text-danger"></span>
                        <div class="form-group has-feedback">
                          <input required  type ="text" id="Timbrado" name="Timbrado" class="form-control input-sm" onfocus="autofocus"   placeholder=""    >
                          <span class=""></span>
                        </div>
                        </td>                        
                        <td >
                          <a> Series </a>
                        </td>
                        <td>
                        <span class ="SE text-danger"></span>
                        <div class="form-group has-feedback">
                          <input required  type ="text" id="Series" name="Series" class="form-control input-sm" onfocus="autofocus"   placeholder=""   >
                        </div>
                        </td>
                      </tr> 
                      <tr id="transparente"> 
                        <td >
                          <a> Mapa </a>
                        </td>
                        <td>
                         <span class ="MP text-danger"></span>
                        <div class="form-group has-feedback" id="PF">
                            <!-- <button type="button" id="mapa" class="btn btn-success btn-sm">Mostrar</button> -->
                          <span class=""></span>
                        </div>
                        </td>
                     </tr>
                  </tbody>
                </table>
              </div>
         <div class="modal-footer">
            <button type="submit" id="btnSave"  class="btn btn-sm btn-success">
                     <span class="glyphicon glyphicon-floppy-disk"></span> Guardar
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
  </body>
</html>