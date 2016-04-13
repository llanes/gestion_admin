  <script type="text/javascript">
    var save_method; //for save method string
    var table_cliente;
    $(document).ready(function() {
      table_cliente = $('#table_cliente').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Cliente/ajax_list'); ?>",
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
     $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
      $("#cliente_aler").hide();
      $(".modal-body,.modal-header").show();
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_form').modal('show'); // show bootstrap modal
      $('.modal-title').text('Agregar Cliente'); // Set Title to Bootstrap modal title
    }

    function edit_person(idCliente)
    {
      $(".N,.A,.D,.C_R,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
       $("#cliente_aler").hide();
       $(".modal-body,.modal-header").show();
      save_method = 'update';
      // $('#PF').hide();
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Cliente/ajax_edit/'); ?>/" + idCliente,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="idCliente"]').val(data.idCliente);
            $('[name="Nombres"]').val(data.Nombres);
            $('[name="Apellidos"]').val(data.Apellidos);
            $('[name="Direccion"]').val(data.Direccion);
             $('[name="ci_ruc"]').val(data.ci_ruc);
            $('[name="Telefono"]').val(data.Telefono);
            $('[name="Email"]').val(data.Email);
            $('[name="usuario"]').val(data.Usuario);
            $('[name="password"]').val(data.Password);
            $('[name="passconf"]').val(data.Password);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Cliente'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos');
        }
    });
    }

    function reload_table()
    {
      table_cliente.ajax.reload(null,false); //reload datatable ajax 
    }
    $(function() {
    $('#form').submit(function(e) {
      var url;
      if(save_method == 'add') 
      {
        url = "<?php echo site_url('index.php/Cliente/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Cliente/ajax_update'); ?>";
      }
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.Nombres) {
                               $(".N").append(json.Nombres).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Apellidos) {
                               $(".A").append(json.Apellidos).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Direccion) {
                               $(".D").append(json.Direccion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                             if (json.ci_ruc) {
                               $(".C_R").append(json.ci_ruc).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Telefono) {
                               $(".T").append(json.Telefono).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Email) {
                               $(".E").append(json.Email).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.usuario) {
                               $(".U").append(json.usuario).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.password) {
                               $(".P").append(json.password).css({"display":"block"}); /// mostar validation  de iten pass
                            }
                           if (json.passconf) {
                               $(".PF").append(json.passconf).css({"display":"block"}); /// mostar validation  de iten pass
                            }
                          }else{ 
                                        $(".modal-body,.modal-header").hide();
                                         $('#cliente_aler').show()
                                          if (save_method == 'add') {
                                            $('.title').text('Registrado Correctamente');
                                          } else {
                                            $('.title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#cliente_aler").fadeOut(1500);
                                                $('#modal_form').modal('hide');
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


    function delete_person(id)
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
            url : "<?php echo site_url('index.php/Cliente/ajax_delete'); ?>/"+id,
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

