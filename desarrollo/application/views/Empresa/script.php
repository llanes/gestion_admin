  <script type="text/javascript">
    var save_method; //for save method string
    var table_empresa;
    $(document).ready(function() {
      table_empresa = $('#table_empresa').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Empresa/ajax_list'); ?>",
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

    function edit_person(idCliente)
    {
     $(".N,.DI,.D,.T,.CO,.SE,.RU,.TI,.MP").html("").css({"display":"none"});
       $("#empresa_aler").hide();
       $(".modal-body,.modal-header").show();
      save_method = 'update';
      // $('#PF').hide();
      $('#from_empresa')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Empresa/ajax_edit/'); ?>/" + idCliente,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="idEmpresa"]').val(data.idEmpresa);
            $('[name="Nombre"]').val(data.Nombre);
            $('[name="Descripcion"]').val(data.Descripcion);
            $('[name="Direccion"]').val(data.Direccion);
             $('[name="R_U_C"]').val(data.R_U_D);
            $('[name="Telefono"]').val(data.Telefono);
            $('[name="Email"]').val(data.Email);
            $('[name="Timbrado"]').val(data.Timbrado);
            $('[name="Series"]').val(data.Series);
            $('#modal_form_empresa').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Empresa'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos');
        }
    });
    }

    function reload_table()
    {
      table_empresa.ajax.reload(null,false); //reload datatable ajax 
    }
    $(function() {
    $('#from_empresa').submit(function(e) {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('index.php/Empresa/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Empresa/ajax_update'); ?>";
      }
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
                                          if (save_method == 'add') {
                                            $('.title').text('Registrado Correctamente');
                                          } else {
                                            $('.title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#empresa_aler").fadeOut(1500);
                                                $('#modal_form_empresa').modal('hide');
                                            },2000);
                                        // $('#modal_form_empresa').modal('hide');
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


    function delete_person(id)
     {
     swal({
        title: "Estas seguro?",
        text: "Usted no será capaz de recuperar!",
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
            url : "<?php echo site_url('index.php/Empresa/ajax_delete'); ?>/"+id,
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

