  <script type="text/javascript">

    var save; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table_').DataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Empleado/ajax_list'); ?>",
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

    function add_empleado()
    {
           $(".N,.A,.D,.T,.S,.C,.U,.P,.PF").html("").css({"display":"none"});
           $("#empleadao_aler").hide();
           $(".modal-body,.modal-header").show();
           save = 'add';
           $('#form_empleado')[0].reset(); // reset form on modals
           $('#modal_form_empleado').modal('show'); // show bootstrap modal
           $('.modal-title').text('Agregar Empleado'); // Set Title to Bootstrap modal title
    }

    function edit_person(idCliente)
    {
       $(".N,.A,.D,.T,.S,.C,.U,.P,.PF").html("").css({"display":"none"});
       $("#empleadao_aler").hide();
       $(".modal-body,.modal-header").show();
       save = 'update';
       // $('#PF').hide();
       $('#form_empleado')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Empleado/ajax_edit/'); ?>/" + idCliente,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
           
                $('[name ="idEmpleado"]').val(data.idEmpleado);
                $('[name ="Nombres"]').val(data.Nombres);
                $('[name ="Apellidos"]').val(data.Apellidos);
                $('[name ="Direccion"]').val(data.Direccion);
                $('[name ="Telefono"]').val(data.Telefono);
                $('[name ="Sueldo"]').val(data.Sueldo);
                $('[name ="Cargo"]').val(data.Cargo);
                $('[name ="usuario"]').val(data.Usuario);
                $('[name ="password"]').val(data.Password);
                $('[name ="passconf"]').val(data.Password);
            
            $('#modal_form_empleado').modal('show'); // show bootstrap modal when complete loaded
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
      table.ajax.reload(null,false); //reload datatable ajax 
    }
    $(function() {
    $('#form_empleado').submit(function(e) {
      var url;
      if(save == 'add') 
      {
        url = "<?php echo site_url('index.php/Empleado/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Empleado/ajax_update'); ?>";
      }
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          $(".N,.A,.D,.T,.S,.C,.U,.P,.PF").html("").css({"display":"none"});
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
                            if (json.Telefono) {
                               $(".T").append(json.Telefono).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Sueldo) {
                               $(".S").append(json.Sueldo).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Cargo) {
                               $(".C").append(json.Cargo).css({"display":"block"}); // mostrar validation de iten usuario
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
                          }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                         $(".modal-body,.modal-header").hide();
                                         $('#empleadao_aler').show()
                                          if (save == 'add') {
                                            $('.empleado_title').text('Registrado Correctamente');
                                          } else {
                                            $('.empleado_title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#empleadao_aler").fadeOut(1500);
                                                 $('#modal_form_empleado').modal('hide');
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
            url : "<?php echo site_url('index.php/Empleado/ajax_delete'); ?>/"+id,
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

