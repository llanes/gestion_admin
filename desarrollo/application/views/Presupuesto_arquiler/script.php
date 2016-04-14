<script type="text/javascript">
  $('#listados_presupuesto,#listados_alquiler').hide();
  $(function () {
        $("#presupuesto1").click(function(){
        $('#snnip').modal('show'); // show bootstrap modal
        $('#presupuesto_alquiler,#listados_presupuesto,#listados_alquiler,#listados_presupuesto,#cliente_vista,#empleado_vista,#productos_vista,#stock_vista,#servicios_vista').hide();

                 setTimeout(function() {
          $('#snnip').modal('hide'); // show bootstrap modal
          $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler"); ?>');
          $('#presupuesto_vista').show()
        },800);
        });
});
    $(function () {
        $("#lista_presus").click(function(){
        $('#snnip').modal('show'); // show bootstrap modal
        $('#listados_alquiler,#presupuesto_alquiler,#cliente_vista,#empleado_vista,#productos_vista,#stock_vista,#servicios_vista').hide();
        $("#listados_presupuesto").load('<?php echo base_url("index.php/Presupuesto_arquiler/listados_presupuesto"); ?>');
                 setTimeout(function() {
            $('#listados_presupuesto').show();
            $('#snnip').modal('hide'); // show bootstrap modal
        },800);
        });
});
        $(function () {
        $("#lista_alqui").click(function(){
        $('#snnip').modal('show'); // show bootstrap modal
        $('#presupuesto_alquiler,#listados_presupuesto,#cliente_vista,#empleado_vista,#productos_vista,#stock_vista,#servicios_vista').hide();
        $("#listados_alquiler").load('<?php echo base_url("index.php/Presupuesto_arquiler/listados_alquiler"); ?>');
                 setTimeout(function() {
            $('#listados_alquiler').show();
            $('#snnip').modal('hide'); // show bootstrap modal
        },800);
        });
});
    function mapa(rowid) {
      $("#mapaload").load('<?php echo base_url("index.php/Presupuesto_arquiler/mapaload"); ?>/'+rowid);
      $('#modal-id-mapa').modal('show'); // show bootstrap modal

    }
$(function() {
  $('#formulario').submit(function(e) {
              e.preventDefault();
            })
});
    var save_method_presupuesto;
    /**
     * [modal_view funcion para mostrar modal de agregar alquiler]
     * @return {[type]} [html]
     */
    function modal_view()
    {
              save_method_presupuesto = 'modal';
              var Fecha_Pre_Arqui     = $("#Fecha_Pre_Arqui").val();
              var Fecha_Devolucion    = $( "#Fecha_Devolucion" ).val();
              var parametros          = {
              "Fecha_Pre_Arqui" : Fecha_Pre_Arqui,
              "Fecha_Devolucion" :Fecha_Devolucion,
              };
                  $.ajax({
                    url: '<?php echo base_url("index.php/Presupuesto_arquiler/verificar_item"); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: parametros, // serilizo el formulario
                  })
                  .done(function(data) {
                      if(data == "complte"){
                            if (save_method_presupuesto == 'modal') {
                            $('#modal_form_alquiler').modal('show'); // show bootstrap modal
                            $('.modal-title').text('Configurar Alquiler'); // Set Title to Bootstrap modal title
                                  var id      = $( "select[name=credi_cont]").val();
                                  if (id == 1) {
                                     $('.cuotas').hide();
                                     // $('.Vencimiento').hide();
                                  } if (id == 2) {
                                      $('.cuotas').show();
                                      // $('.Vencimiento').show();
                                  }
                          }
                      }else{
                        $('#item_error').hide();
                        $( "#item_error" ).empty();
                        $.each(data, function(i, data){
                           $('#modal_error').modal('show'); // show bootstrap modal
                          $("#item_error").append(data.res).css({"display":"block"});
                      });
                      }

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
   function add_presupuesto()
    {
               save_method_presupuesto = 'presu';
               $('#snnip').modal('show'); // show bootstrap modal
               $('#formulario').submit(function(e) {
                var url = "<?php echo site_url('index.php/Presupuesto_arquiler/add_presupuesto');?>/"+2;
                    if (save_method_presupuesto == 'presu') {
                                             $.ajax({
                          type : 'POST',
                          url : url, // octengo la url del formulario
                           cache: false,
                          data: $(this).serialize(), // serilizo el formulario
                          success : function(data) {
                               var json = JSON.parse(data);// parseo la dada devuelta por json
                               if (json.res == "error") {
                                if (json.ci_ruc) {
                                            swal(json.ci_ruc);
                                }
                                if (json.Fecha_Pre_Arqui) {
                                            swal(json.Fecha_Pre_Arqui,json.Fecha_Devolucion);

                                }
                                if (json.Fecha_Devolucion) {
                                            swal(json.Fecha_Devolucion,json.Fecha_Pre_Arqui);
                                    }
                               }else{
                                       setTimeout(function() {      
                                          $('#snnip').modal('hide'); // show bootstrap modal

                                      },1000);
                                      setTimeout(function() {      
                                            swal({   
                                              title: "Presupuesto Registrado Correctamente",   
                                              text: "  ",
                                              timer: 1500,   
                                              showConfirmButton: false 
                                            });
                                             // $('#modal_form_alquiler').modal('hide');
                                            $('#formulario')[0].reset(); // reset form on modals
                                              $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler"); ?>');

                                      },1200);

                               }
                         },
                          // código a ejecutar si la petición falla;
                          error : function(xhr, status) {
                              alert('Disculpe, existió un problema');
                              console.log('error(jqXHR, textStatus, errorThrown)');
                          },
                      });
                    }
                  e.preventDefault();

                  })
    }
    function add_alquiler(rouw)
    {
               save_method_presupuesto = 'alquiler';
               var title;
               if (rouw == '') { title = 'Alquiler Registrado Correctamente'} else{ title = 'Alquiler Actalizado Correctamente'};
               $('#modal_form_alquiler').modal('hide');
                $('#snnip').modal('show'); // show bootstrap modal
               $('#formulario').submit(function(e) {
                var url = "<?php echo site_url('index.php/Presupuesto_arquiler/add_presupuesto');?>/"+1;
                var id = $('#boleta_factura').val();
                 if (save_method_presupuesto == 'alquiler') {
                         $.ajax({
                          type : 'POST',
                          url : url, // octengo la url del formulario
                           cache: false,
                          data: $(this).serialize(), // serilizo el formulario
                          success : function(data) {
                               var json = JSON.parse(data);// parseo la dada devuelta por json
                               if (json.res == "error") {
                               }else{

                                               setTimeout(function() {
                                                     $('#snnip').modal('hide'); // show bootstrap modal
                                                      swal({   
                                                        title: title,   
                                                        timer: 1500,   
                                                        showConfirmButton: false 
                                                      });
                                                      $('#formulario')[0].reset(); // reset form on modals
                                                },1400);
                                                   setTimeout(function() {
                                                        swal({   
                                                          title: "Redirigiendo generate pfp",   
                                                          timer: 1500,   
                                                          showConfirmButton: false 
                                                        });
                                                        $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler"); ?>');

                                                    },2800);
                                                      setTimeout(function() {
                                                          // $("#detalle").fadeOut(150);
                                                          window.open('boleta/'+id,'_blank');
                                                      },4500);

                               }
                         },
                          // código a ejecutar si la petición falla;
                          error : function(xhr, status) {
                              alert('Disculpe, existió un problema');
                              // console.log('error(jqXHR, textStatus, errorThrown)');
                          },
                      });
                 }
                  e.preventDefault();

                  })
    }

    $(function() {
    $('#agregar_carrito').click(function(e) {
      var url ="<?php echo site_url('index.php/Presupuesto_arquiler/agregar_carrito'); ?>";
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      cache: false,
                      data: $('#formulario').serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                              if (json.res == "crrito") {
                             swal("Cantidad debe ser menor que el Stock");
                              }else{
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
                                    $( "#Precio_Unitario1,#Cantidad_stock1,#checnombre" ).empty();
                                    $("#max").html("").css({"display":"none"});
                                    $('#Cantidad').val("");
                                     $('#checkbox').val("");
                                      $('[name="Nombre"]').each(function(){ 
                                        $($(this)).val('');
                                      });
                                    $( "#detalle" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/loader');?>" );
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
            url : "<?php echo site_url('index.php/Presupuesto_arquiler/delete_item');?>/"+rowid,
            type: "POST",
            cache: false,
            data: $(this).serialize(), // serilizo el formulario
            success: function(data)
            {

               $( "#detalle" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/loader');?>" );
            },
        });
          swal("Deleted!", "Articulo ha sido borrado.", "success");
        } else {
          swal("Cancelled", "Sin accion:)", "error");
        }
      });
    }

    function edit_presupuesto(idArquiler)
    {    
          $('#snnipppp,#snnippp').modal('show'); // show bootstrap modal
          setTimeout(function() {
             $('.modal').modal('hide'); // show bootstrap modal
          },1000);
          setTimeout(function() {
             $('#snnippp').modal('hide'); // show bootstrap modal
              $('#presupuesto_vista').show()
              $('#listados_presupuesto,#listados_alquiler,#listados_presupuesto,#home,#cliente_vista,#empleado_vista,#productos_vista,#stock_vista,#servicios_vista').hide();
              $("#presupuesto_vista").load('<?php echo base_url("index.php/Presupuesto_arquiler/edit_presupuesto"); ?>/' + idArquiler);
               // $( "#detalle" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/loader');?>" );
          },1500);




    }

    $(function(){
      var site1 = "<?php echo base_url();?>";
  $('.busqueda_cliente').autocomplete({
    serviceUrl:  site1+'index.php/Presupuesto_arquiler/busqueda_cliente',
    onSelect: function (suggestions) {
      // document.formulario.idCliente.value = suggestions.data;
      $('[name ="idCliente"]').val(suggestions.data);
      $('[name ="ci_ruc"]').val(suggestions.ci_ruc);
      $('[name ="idCliente2"]').val(suggestions.data);
      $('[name ="Direccion_evento"]').val(suggestions.Direccion);
       // $('[name ="direcc"]').val(suggestions.Direccion);

      // document.formulario.ci_ruc.value = suggestions.ci_ruc;
      }
  });
    $('.busqueda_cliente2').autocomplete({
    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_cliente2'); ?>",

    onSelect: function (suggestions) {
      $('[name ="idCliente2"]').val(suggestions.data);
      $('[name ="Nombres"]').val(suggestions.Nombres);
      $('[name ="idCliente"]').val(suggestions.data);
      $('[name ="Direccion_evento"]').val(suggestions.Direccion);
      // $('[name ="direcc"]').val(suggestions.Direccion);
      }
  });
  $('.busqueda_producto').autocomplete({

    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_producto'); ?>",
    onSelect: function (suggestions) {

            $('[name ="idProducto_Servicio"]').val(suggestions.data);
            $('[name ="Precio_Unitario"]').val(suggestions.Precio_Unitario);
            $('[name ="stock"]').val(suggestions.Cantidad_stock);
            $('[name ="Precio_Unitario1"]').text(suggestions.Precio_Unitario);
            // $('#selec').append('<option value="'suggestions.Precio_Unitario'" selected="selected"></option>');
            $("#max").html("").css({"display":"block"});
            $('#max').append('<input name="checkbox" id="checkbox" type="checkbox" value="">');
            $('[name ="checkbox"]').val(suggestions.Descuento);
            $('#max').append('<span name="checnombre" id="checnombre" class="control-label"></span>');
            $('[name ="checnombre"]').text(suggestions.Descuento);
            // $('#max1').hide();
          // $('#max').append('<input type ="text" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="" pattern="{10,15}" placeholder="">');
      }
  });
    $('.busqueda_servicio').autocomplete({
    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_servicio')?>",
    onSelect: function (suggestions) {

            $('[name ="idServicio"]').val(suggestions.data);
            $('[name ="Nombres_servicios"]').attr('data-id',suggestions.data);
            var id = suggestions.data
            if (suggestions.data != '') {
                          $.post("<?php echo site_url('index.php/Presupuesto_arquiler/recorrer_servicios/'); ?>/"+id, function(data){
             $( "#detalle" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/loader');?>" );
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
// listade factura o boleta tios
    $(function() {
             var id      = $( "select[name=natural_juridica]").val();
            if (id == 1) {
               $('#factura').hide();
               $('#boleta').show();
               $('[name ="boleta_factura"]').val('2');
            } if (id == 2) {
                $('#boleta').hide();
                $('#factura').show();
                $('[name ="boleta_factura"]').val('1');
            }
            $("#tipo").change(function(){
              var id      = $( "select[name=natural_juridica]").val();
              // alert(id);
            if (id == 1) {
               $('#factura').hide();
               $('#boleta').show();
               $('[name ="boleta_factura"]').val('2');
            } if (id == 2) {
                $('#boleta').hide();
                $('#factura').show();
                $('[name ="boleta_factura"]').val('1');

            }
                          });
    });
// datetime picker end
     $(function () {
            $('#datetimepicker6').datetimepicker({
              minDate: new Date(),
                   format: 'DD-MM-YYYY  LTS',
              disabledHours: [0, 1, 2, 3, 4,] ,
              enabledHours: [ 5, 6, 7, 12,18, 19, 20, 21, 22, 23, 24,8,9, 10, 11, 13, 14, 15, 16] ,
            });
            $('#datetimepicker7').datetimepicker({
               minDate: new Date(),
                   format: 'DD-MM-YYYY  LTS',
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
