  <script type="text/javascript">

    var save_method_servicios; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table_servicios').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Servicios/ajax_list'); ?>",
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

    function add_Servicios()
    {
     $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
     $("#servicios_aler").hide();
     $(".modal-body,.modal-header").show();
      save_method_servicios = 'add';
      $('#form_servicios')[0].reset(); // reset form on modals
      $('#modal_form_servicios').modal('show'); // show bootstrap modal
      $('.modal-title_servicios').text('Agregar Servicios'); // Set Title to Bootstrap modal title
      $( "#loader" ).load( "<?php echo site_url('index.php/Servicios/reser');?>" );
    }

        function edit_servicios(idServicio)
    {
      $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
      $("#servicios_aler").hide();
      $(".modal-body,.modal-header").show();
      save_method_servicios = 'update';
      // $('#PF').hide();
      $('#form_servicios')[0].reset(); // reset form on modals
      // $('#Iva').html('');
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Servicios/ajax_edit2/'); ?>/" + idServicio,
        type: "GET",
        cache: false,
        dataType: "JSON",
        success: function(data)
        {
        
                $('[name="idServicio"]').val(data.idServicio);
                $('[name="servicio"]').val(data.Servicio);
                 $('[name="Descripcion"]').val(data.Descripcion);
                $('#modal_form_servicios').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title_servicios').text('Editar Servicio'); // Set title to Bootstrap modal title
                 $( "#loader" ).load( "<?php echo site_url('index.php/Servicios/loader');?>" );
            
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos');
        }
    });
    }
    function reser() {
     $( "#loader" ).load( "<?php echo site_url('index.php/Servicios/reser');?>" );
    }

    function reload_table()
    {
      table.ajax.reload(null,false); //reload datatable ajax 
    }
    $(function() {
    $('#form_servicios').submit(function(e) {
      var url;
      if(save_method_servicios == 'add')
      {
        url = "<?php echo site_url('index.php/Servicios/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Servicios/ajax_update'); ?>";
      }
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: form,
                      cache: false,
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          // console.log(data);
                          $(".N,.D").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.servicio) {
                               $(".N").append(json.servicio).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Descripcion) {
                               $(".D").append(json.Descripcion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                          }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                         $(".modal-body,.modal-header").hide();
                                         $('#servicios_aler').show()
                                          if (save_method_servicios == 'add') {
                                            $('.title').text('Registrado Correctamente');
                                          } else {
                                            $('.title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#servicios_aler").fadeOut(1500);
                                                 $('#modal_form_servicios').modal('hide');
                                            },1500);
                                        $('#form_servicios')[0].reset(); 
                                        reload_table();
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


    function delete_servicios(id)
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
            url : "<?php echo site_url('index.php/Servicios/ajax_delete'); ?>/"+id,
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


    function ver_articulos(idServicio)
  {
      // $('#reset')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
    $("#descripcion,#costo").html("").css({"display":"none"});
    $.ajax({
      type: "POST",
       url : "<?php echo site_url('index.php/Servicios/ajax_edit/'); ?>/"+idServicio,
      data: $("#form").serialize(),
      success: function(data) {
           var result = JSON.parse(data);
           $.each(result, function(i, val){
                           // $("#cantidad").append('<i class="fa fa-dot-circle-o"></i>&nbsp;&nbsp;' + val.cantidad + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $("#descripcion").append('&nbsp;&nbsp;'+ val.Cantidad_detalle  +'&nbsp;&nbsp;'+ val.Nombre + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $("#costo").append('₲.&nbsp;&nbsp;' + val.Costo + '&nbsp;&nbsp;<br><br>').css({"display":"block"});
                           $('#ver_articulos').modal('show'); // show bootstrap modal when complete loaded
                           $(".modal-body,.modal-header").show();
                           $('.modal-title_servicios').text('Listados'); // Set title to Bootstrap modal title
      });

      }
  });
    }
    $(function(){
      $('.cliente_bus').autocomplete({
        serviceUrl:  "<?php echo site_url('index.php/Productos/busqueda_Categoria'); ?>",
        onSelect: function (suggestions) {
          $('[name ="idCategoria"]').val(suggestions.data);
          }
  });
  // buqueda de articulos
    $('.articulo_servicio').autocomplete({
    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_producto'); ?>",
    onSelect: function (suggestions) {

            $('[name ="id_articulo"]').val(suggestions.data);
            $('[name ="precio_articulo"]').val(suggestions.Precio_Unitario);
              // $('#max1').hide();
          // $('#max').append('<input type ="text" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="" pattern="{10,15}" placeholder="">');
      }
  });
});
      $(function() {
       $("#botonenviar").click( function() {
          var url ="<?php echo site_url('index.php/Servicios/agregar_carrito'); ?>";
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $('#form_servicios').serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          // console.log(data);
                          $(".code").html("").css({"display":"none"});

                          if (json.res == "error") {
                                            if (json.id_articulo) {
                                          swal(json.id_articulo, json.cantidad); // mostrar validation de iten usuario    
                                           // $('#formulario')[0].reset();
                                      }else{
                                          if (json.cantidad) {
                                            swal(json.cantidad, json.id_articulo);
                                            // $('#formulario')[0].reset();
                                          }
                                      }
                          }else{
                           $('#id_articulo').val("");
                           $('#precio_articulo').val("");
                           $('#cantidad').val("");
                           // $('#formulario')[0].reset();
                            $('[name="nombre_articulo"]').each(function(){ 
                              $($(this)).val('');
                            });

                            $( "#loader" ).load( "<?php echo site_url('index.php/Servicios/loader');?>" );

                            }

                     },
                      // código a ejecutar si la petición falla;
                      error : function(xhr, status) {
                          alert('Disculpe, existió un problema');
                          console.log('error(jqXHR, textStatus, errorThrown)');
                      },
                  });
    })
        });
  // eliminr un item, del carrito
     function delete_rowid_servi(rowid)
    {
       // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('index.php/Servicios/delete_item');?>/"+rowid,
            type: "POST",
            data: $(this).serialize(), // serilizo el formulario
            success: function(data)
            {
                 $( "#loader" ).load( "<?php echo site_url('index.php/Servicios/loader');?>" );
            },
            error : function(xhr, status) {
                alert('Disculpe, existió un problema');
                console.log('error(jqXHR, textStatus, errorThrown)');
            },
        });
    }