<script >
    var save_method; //for save method string
    var listado_presupuesto_ajax;
    var site = "<?php echo site_url();?>";
     $(function () {

      listado_presupuesto_ajax = $('#listado_presupuesto_ajax').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Home_cliente/ajax_list_presupuesto'); ?>",
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

    function generar_pre()
    {
     $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
     $("#producto_aler,#Actualizar").hide();
      $('#snnip').modal('show'); // show bootstrap modal
      save_method = 'presu';
      $.ajax({
        url:  "<?php echo site_url('index.php/Home_cliente/trunk');?>",
      })
      .always(function() {
        console.log("complete");
      });
        setTimeout(function() {      
             $('#snnip').modal('hide'); // show bootstrap modal
            // $('#form_productos')[0].reset(); // reset form on modals
            $('#modal-id').modal('show'); // show bootstrap modal
            $(".Articulos,.categoria").select2("val", "");
            if (save_method == 'update') {
              $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_update');?>" );
            }
            if (save_method == 'presu'){
              $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_presu');?>" );
              $('[name ="Nombres_servicios"]').val('');
            }
        },700);

    }
   $(function() {
    $('#agregar_carrito').click(function(e) {
      var url ="<?php echo site_url('index.php/Home_cliente/agregar_carrito'); ?>";
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      cache: false,
                      data: $('#formulario').serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json

                                  if (json.res == "error") {
                                      if (json.idProducto_Servicio) {
                                          swal(json.idProducto_Servicio, json.Cantidad); // mostrar validation de iten usuario    
                                           // $('#formulario')[0].reset();
                                      }else{
                                          if (json.Cantidad) {
                                            swal(json.Cantidad, json.idProducto_Servicio);
                                            // $('#formulario')[0].reset();
                                          }
                                      }

                                  }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                    // $('#formulario')[0].reset();
                                    $( "#Precio_Unitario1,#Cantidad_stock1,#Precio_Unitario" ).empty();
                                    $('#Nombre,#Cantidad,#Precio_Unitario').val("");
                                      $('[name="Nombre"]').each(function(){
                                        $($(this)).val('');
                                      });
                                    $(".Articulos").select2("val", "");
                                      if (save_method == 'update') {
                                        $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_update');?>" );
                                      }
                                      if (save_method == 'presu'){
                                        $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_presu');?>" );
                                      }

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

   function reload_table()
    {
      listado_presupuesto_ajax.ajax.reload(null,false); //reload datatable ajax 
    }
     function ver_detalles(idArquiler)
   {
       $('#snnip').modal('show'); // show bootstrap modal
      $("#des,#Inp,#Precio,#Sub").html("").css({"display":"none"});
      $("#1,#2,#3,#4,#5,#6,#Total").html("").css({"display":"none"})
      $.ajax({
        type: "POST",
        url : "<?php echo site_url('index.php/Presupuesto_arquiler/ajax_edit/'); ?>/"+idArquiler,
        data: $("#form").serialize(),
        success: function(data) {
          setTimeout(function() {
              var result = JSON.parse(data);
              $.each(result, function(i, val){
              var Subtotal = val.Cantidad*val.Precio;
                $( ".step" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/load');?>" );
                $('#snnip').modal('hide'); // show bootstrap modal
                $('#details_al').modal('show'); // show bootstrap modal when complete loaded
                $("#Total").append('<strong class="text-danger"> Monto Total &nbsp;₲. </strong> &nbsp;&nbsp;'+ val.Monto_Alquiler_Presupuesto + '&nbsp;&nbsp;').css({"display":"block"});
                $("#1").append('<strong class="text-danger">Cliente :</strong> &nbsp;&nbsp;'+ val.Nombres + '&nbsp;&nbsp;'+ val.Apellidos + '').css({"display":"block"});
                $("#2").append('<strong class="text-danger">Direccion :</strong> &nbsp;&nbsp;'+ val.Direccion + '&nbsp;&nbsp;').css({"display":"block"});
                $("#3").append('<strong class="text-danger">Telefono :</strong> &nbsp;&nbsp;'+ val.Telefono + '&nbsp;&nbsp;').css({"display":"block"});
                if (val.Contado_Credito == 1) {
                  $("#6").append('&nbsp;<strong class="text-danger">Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;Contado ').css({"display":"block"});
                }
                if (val.Contado_Credito == 2) {
                  $("#6").append('&nbsp;<strong class="text-danger">Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;Cuotas ').css({"display":"block"});
                }
            });
         },700);
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


   function edit_presupuesto(idArquiler)
    {
       save_method ='update';
       $('#snnip').modal('show'); // show bootstrap modal
    $.ajax({
        type : 'POST',
        url: site+'index.php/Home_cliente/edit_presupuesto/'+idArquiler,
        dataType: "JSON",
      })
      .done(function(data) {
        setTimeout(function() {
                if (save_method == 'update') {
                  $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_update');?>" );
                  $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
                  $('#snnip').modal('hide'); // show bootstrap modal
                  $('#modal-id').modal('show'); // show bootstrap modal
                  $('[name ="idArquiler"]').val(data.idArquiler);
                  $('[name ="Nombres_servicios"]').val(data.Nombre_servicio);
                }else{}

        },700);
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });

    }
    /**
     * [add_presupuesto funcion que direcciona aal controller add_presupuesto donde se genera un presupuesto  ]
     */

               $('#formulario').submit(function(e) {
                     var title;
                    if (save_method == 'presu') {
                       url = "<?php echo site_url('index.php/Home_cliente/add_presupuesto');?>";
                    }else{
                       url = "<?php echo site_url('index.php/Home_cliente/update');?>";
                    }
                   $.ajax({
                          type : 'POST',
                          url : url, // octengo la url del formulario
                           cache: false,
                          data: $(this).serialize(), // serilizo el formulario
                          success : function(data) {
                               var json = JSON.parse(data);// parseo la dada devuelta por json
                               if (json.res == "error") {
                                if (json.Fecha_Pre_Arqui) {
                                            swal(json.Fecha_Pre_Arqui,json.Fecha_Devolucion);

                                }
                                if (json.Fecha_Devolucion) {
                                            swal(json.Fecha_Devolucion,json.Fecha_Pre_Arqui);
                                    }
                               }else{
                                   if (save_method == 'presu') {
                                      title = 'Procesado Correctamente'     
                                   }else{
                                       title = 'Actualizado Correctamente'    
                                   }
                                            swal({   
                                              title: title,   
                                              text: "  ",
                                              timer: 1500,   
                                              showConfirmButton: false 
                                            });
                                             $('#modal-id').modal('hide');
                                             $('[name ="Nombres_servicios"]').val('');
                                            // $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler"); ?>');
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
    function delete_rowid(rowid)
    {
        swal({
        title: "Estas seguro?",
        text: "Usted no será capaz de recuperar este Articulo!",
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
          $.ajax({
            url : "<?php echo site_url('index.php/Home_cliente/delete_item');?>/"+rowid,
            type: "POST",
            cache: false,
            data: $(this).serialize(), // serilizo el formulario
            success: function(data)
            {
                if (save_method == 'update') {
                  $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_update');?>" );
                }
                if (save_method == 'presu'){
                  $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_presu');?>" );
                }
            },
        });
          swal("Deleted!", "Articulo ha sido borrado.", "success");
        } else {
          swal("Cancelled", "Sin accion:)", "error");
        }
      });
    }

  $(function(){
  $(".categoria,.Articulos").select2(); 
  $("#categoria").change(function() {   //
  var id = $('#categoria').val();
  $.ajax({
    type: 'POST',
    url: site+'index.php/Home_cliente/categoria_articulo/'+id,
    })
    .done(function(resp) {
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
});

  $("#Articulos").change(function() {   //
  var id = $('#Articulos').val();
  // alert( id);
  $.ajax({
    type: 'POST',
    url: site+'index.php/Home_cliente/get_articulo_/'+id,
    dataType: "JSON",
    })
    .done(function(resp) {
            $('[name ="idProducto_Servicio"]').val(resp.idProducto_Servicio);
            $('[name ="Precio_Unitario"]').val(resp.Precio_Unitario);
            $('[name ="Precio_Unitario1"]').html(resp.Precio_Unitario);
            $('[name ="Nombre"]').val(resp.Nombre);
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
});



  $(".Articulos").select2({
      ajax: {
      url: "<?php echo site_url('index.php/Home_cliente/get_articulo');?>",
      dataType: 'json',
      delay: 250,
      data: function (params) {
          return {
              p: params.term // search term
          };
      },
     processResults: function (data) {
              // parse the results into the format expected by Select2.
              // since we are using custom formatting functions we do not need to
              // alter the remote JSON data
              return {
                      results: $.map(data, function(obj) {
              return { 

                id: obj.idProducto_Servicio, text: obj.Nombre };

              })
              };
          },
          cache: true
      },
  placeholder: 'Buscar Articulos',
  width: '220',
  minimumInputLength: 2
  })


  $(".categoria").select2({
  ajax: {
    url: "<?php echo site_url('index.php/Home_cliente/categoria');?>",
    dataType: 'json',
    delay: 250,
    data: function (params) {
        return {
            q: params.term // search term
        };
    },
   processResults: function (data) {
            // parse the results into the format expected by Select2.
            // since we are using custom formatting functions we do not need to
            // alter the remote JSON data
            return {
                    results: $.map(data, function(obj) {
            return { 

              id: obj.idCategoria, text: obj.Categoria };

            })
            };
        },
        cache: true
    },
    placeholder: 'Buscar Categoria',
            width: '220',
    minimumInputLength: 2
});

    var site = "<?php echo site_url();?>";
    $('.busqueda_servicio').autocomplete({
    serviceUrl: site+'index.php/Presupuesto_arquiler/busqueda_servicio',
    onSelect: function (suggestions) {

            $('[name ="idServicio"]').val(suggestions.data);
            document.formulario.idServicio.value = suggestions.data;
            $('[name ="Nombres_servicios"]').attr('data-id',suggestions.data);
            var id = suggestions.data
            if (suggestions.data != '') {
              $.post("<?php echo site_url('index.php/Presupuesto_arquiler/recorrer_servicios/'); ?>/"+id, function(data){
                if (save_method == 'update') {
                  $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_update');?>" );
                }
                if (save_method == 'presu'){
                  $( "#detalle" ).load( "<?php echo site_url('index.php/Home_cliente/loader_presu');?>" );
                }

            });

            }
      }
  });
});
    $(function() {
    $('#vaciar').click(function(e) {
      var url = "<?php echo site_url('index.php/Presupuesto_arquiler/delete_carrito'); ?>";
                $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      cache: false,
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
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

// datetime picker end
     $(function () {
            $('#datetimepicker6').datetimepicker({
              minDate: new Date(),
                format: 'DD-MM-YYYY  LT',
              disabledHours: [0, 1, 2, 3, 4,] ,
              enabledHours: [ 5, 6, 7, 12,18, 19, 20, 21, 22, 23, 24,8,9, 10, 11, 13, 14, 15, 16] ,
            });
            $('#datetimepicker7').datetimepicker({
               minDate: new Date(),
               format: 'DD-MM-YYYY  LT',
              disabledHours: [0, 1, 2, 3, 4,] ,
              enabledHours: [ 5, 6, 7, 12,18, 19, 20, 21, 22, 23, 24,8,9, 10, 11, 13, 14, 15, 16] ,
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });

            
        }); 



</script>
