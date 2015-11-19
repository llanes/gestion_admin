
              <section class="content">
                    <table id="listado_presupuesto_ajax" class="table table-striped table-advance table-hover" >
                      <thead>
                        <tr>
                          <th class ="text-danger" style="width:120px;"><i class="fa fa-list"></i>   Servicio</th>
                          <th class ="text-danger" style="width:120px;"><i class="fa fa-user"></i>   Cliente</th>
                           <th class ="text-danger" style="width:120px;"><i class="fa fa-usd"></i>  Monto Servicio</th>
                          <th class ="text-danger" style="width:120px;"><i class="fa fa-calendar"></i>  Fecha Expedición</th>
                          <th class ="text-danger" style="width:50px; text-align:center"><i class="fa fa-bookmark"></i> Detalles</th>
                          <th  class ="text-danger"style="width:60px; text-align:center"><i class="fa fa-cogs"></i> Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
              </section><!-- /.content -->
<div class="modal fade" id="ver_detalles" >
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <button type="button " class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title_ver_detalles"></h3>

      </div>
      <div class="modal-body form" id="reset">
      <fieldset title="Step 3" class="step" id="default-step-2" style="display: block;">
       <table class="table table-hover">
          <thead>
            <tr>
              <th ><label class="col-lg-3 control-label">Descripcion</label></th>
              <th ><label class="col-lg-3 control-label">Inpuesto</label></th>
              <th ><label class="col-lg-3 control-label">Precio</label></th>
              <th ><label class="col-lg-3 control-label">Subtotal</label></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td ><p class="form-control-static descripcion" id="descripcion"></p></td>
              <td><p class="form-control-static costo" id="Inpuesto"></p></td>
              <td><p class="form-control-static costo" id="Precio"></p></td>
              <td><p class="form-control-static costo" id="Subtotal"></p></td>
            </tr>
          </tbody>
        </table>
        
     </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
<script type="text/javascript" charset="utf-8" async defer>
    var save_method; //for save method string
    var listado_presupuesto_ajax;
    $(document).ready(function() {
      listado_presupuesto_ajax = $('#listado_presupuesto_ajax').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Presupuesto_arquiler/ajax_list_presupuesto'); ?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": false, //set not orderable
        },
        ],

      });
    });
   function reload_table()
    {
      listado_presupuesto_ajax.ajax.reload(null,false); //reload datatable ajax 
    }
     function ver_detalles(idArquiler)
  {
      // $('#reset')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
    $("#descripcion,#Inpuesto,#Precio,#Subtotal").html("").css({"display":"none"});
    $.ajax({
      type: "POST",
       url : "<?php echo site_url('index.php/Presupuesto_arquiler/ajax_edit/'); ?>/"+idArquiler,
      data: $("#form").serialize(),
      success: function(data) {
           var result = JSON.parse(data);
           $.each(result, function(i, val){
            var Subtotal = val.Cantidad*val.Precio;
                           // $("#cantidad").append('<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;' + val.cantidad + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $("#descripcion").append('&nbsp;&nbsp;'+ val.Cantidad  +'&nbsp;&nbsp;'+ val.Nombre + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $("#Inpuesto").append('₲.&nbsp;&nbsp;' + val.Iva + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $("#Precio").append('₲.&nbsp;&nbsp;' + val.Precio + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $("#Subtotal").append('₲.&nbsp;&nbsp;' + Subtotal + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $('#ver_detalles').modal('show'); // show bootstrap modal when complete loaded
                           $(".modal-body,.modal-header").show();
                           $('.modal-title_ver_detalles').text('Listados'); // Set title to Bootstrap modal title
      });

      }
  });
}

    function delete_presupuesto(id)
    {
     swal({
        title: "Estas seguro?",
        text: "Usted no será capaz de recuperar este Presupuesto!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Eliminar !",
        cancelButtonText: "Cancelar !",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
      // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('index.php/Presupuesto_arquiler/delete_presupuesto'); ?>/"+id,
            type: "POST",
            dataType: "JSON",
             cache: false,
            success: function(data)
            {
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al intentar borrar');
            }
        });
          swal("Deleted!", "Presupuesto ha sido borrado.", "success");
        } else {
          swal("Cancelled", "Sin accion:)", "error");
        }
      });
    }
</script>

