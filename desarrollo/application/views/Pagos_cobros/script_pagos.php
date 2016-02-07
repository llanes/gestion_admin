  <script type="text/javascript">
    var save_method; //for save method string
    var table_pagos;
    $(document).ready(function() {
      table_pagos = $('#table_pagos').DataTable({
        processing: true,
        serverSide: true,
        // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?php echo site_url('index.php/Pagos/ajax_list'); ?>",
                type: "POST",
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

    function add_pagos()
    {
     $(".1,.2,.3,.4,.5,.6,.7,.8").html("").css({"display":"none"});
      $('[name="0"]').val('');
      $('[name="0"]').text('');
     $(".btnSave").text('');
      $("#empleaddo,#pagos_aler").hide();
      $(".modal-body,.modal-header").show();
       $('[name="0"]').append('');
      $(".btnSave").text(' Pagar');
      save_method = 'add';
      $('#form_pagos')[0].reset(); // reset form on modals
      $('#modal_form_pagos').modal('show'); // show bootstrap modal
      $('.modal-title').text('Agregar Pagos'); // Set Title to Bootstrap modal title
    }

    function edit_pagos(id)
    {
         $('#empleaddo').hide();
         $(".btnSave").text('');
         $("[name='0'],.1,.2,.3,.4,.5,.6,.7,.8").html("").css({"display":"none"});
         $("#pagos_aler").hide();
         $(".modal-body,.modal-header").show();
         $(".btnSave").text(' Actualizar');
         save_method = 'update';
         $('#form_pagos')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Pagos/ajax_edit/'); ?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="0"]').show();
            $('[name="idCaja_Pagos"]').val(data.idCaja_Pagos);
            $('[name="Descripcion"]').val(data.Descripcion);
            $('[name="Monto"]').val(data.Monto);
            if (data.Tipos_Pagos  == 'Pagos de Empleado'){
               $('[name="4"],[name="2"],[name="3"]').show();
               $('[name="0"]').val('1');
              $('[name="0"]').append(data.Tipos_Pagos);
              $('[name="1"]').hide();
               $('#empleaddo').show();
               $('.Empl').attr('required');

            }
            if (data.Tipos_Pagos == 'Pago de Agua') {
               $('[name="1"],[name="4"],[name="3"]').show();
              $('[name="0"]').val('2');
              $('[name="0"]').append(data.Tipos_Pagos);
              $('[name="2"]').hide();
            }
            if (data.Tipos_Pagos == 'Pago de Luz') {
               $('[name="1"],[name="2"],[name="4"]').show();
              $('[name="0"]').val('3');
              $('[name="0"]').append(data.Tipos_Pagos);
              $('[name="3"]').hide();
            }
            if (data.Tipos_Pagos == 'Extras') {
               $('[name="1"],[name="2"],[name="3"]').show();
              $('[name="0"]').val('4');
              $('[name="0"]').append(data.Tipos_Pagos);
              $('[name="4"]').hide();
            }
            $('[name="Empleado_idEmpleado"]').val(data.Empleado_idEmpleado);
            $('[name="Empl"]').val(data.Nombres);
            $('#modal_form_pagos').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Pagos'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos');
        }
    });
    }

    function reload_table()
    {
      table_pagos.ajax.reload(null,false); //reload datatable ajax 
    }
    $(function() {
    $('#form_pagos').submit(function(e) {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('index.php/Pagos/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Pagos/ajax_update'); ?>";
      }
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          $(".1,.2,.3,.4,.5,.6,.7,.8").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.Tipos_Pagos) {
                               $(".1").append(json.Tipos_Pagos).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Nombres) {
                               $(".2").append(json.Nombres).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Descripcion) {
                               $(".3").append(json.Descripcion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Monto) {
                               $(".4").append(json.Monto).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                          }else{ 
                                        $(".modal-body,.modal-header").hide();
                                         $('#pagos_aler').show()
                                          if (save_method == 'add') {
                                            $('.title').text('Registrado Correctamente');
                                          } else {
                                            $('.title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#pagos_aler").fadeOut(1500);
                                                $('#modal_form_pagos').modal('hide');
                                            },2000);
                                        // $('#modal_form').modal('hide');
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


    function delete_pagos(id)
     {
     swal({
        title: "Estas seguro?",
        text: "Usted no será capaz de recuperar este Pago!",
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
            url : "<?php echo site_url('index.php/Pagos/ajax_delete'); ?>/"+id,
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

    // Tipos de pagos
    $(function() {
             $('#empleaddo').hide();
            $("#Tipos_Pagos").change(function(){
              var id      = $( "select[name=Tipos_Pagos]").val();
              if (id == 1) {
                 $('#empleaddo').show();
                  $(".Empl").attr("required", true);

              }else{
                 $('#empleaddo').hide();
              }
            });
    });
    $(function(){

  $('#Empl').autocomplete({
    serviceUrl: "<?php echo site_url('index.php/Pagos/busqueda_empleao'); ?>/",

    onSelect: function (suggestions) {
      document.form_pagos.idEmpleado.value = suggestions.data;

      }
  });
});
  </script>

