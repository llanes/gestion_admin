  <script type="text/javascript">

    var save_metod; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table_').DataTable({
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Empleado/empleado/ajax_list')?>",
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
      save_metod = 'add';
      $('#form_empleado')[0].reset(); // reset form on modals
      $('#modal_form_empleado').modal('show'); // show bootstrap modal
      $('.modal-title').text('Agregar Empleado'); // Set Title to Bootstrap modal title
    }

    function edit_person(idCliente)
    {
       $(".N,.A,.D,.T,.S,.C,.U,.P,.PF").html("").css({"display":"none"});
      save_metod = 'update';
      // $('#PF').hide();
      $('#form_empleado')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Empleado/empleado/ajax_edit/')?>/" + idCliente,
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
      if(save_metod == 'add') 
      {
        url = "<?php echo site_url('index.php/Empleado/empleado/ajax_add')?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Empleado/empleado/ajax_update')?>";
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
                              // var url = "<?= site_url('index.php/Login/login')?>";
                              // $(location).attr('href',url);
                              // setTimeout($(location).attr('href',url), 10000); 
                              // $("#for_login-registro").hide();
                              // $("#mensaje").show();
                             // setTimeout('document.location.reload()',500);
                                         $('#modal_form_empleado').modal('hide');
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
      if(confirm('¿Seguro borrar estos datos?'))
      {
        // ajax delete data to database
          $.ajax({
            url : "<?php echo site_url('index.php/Empleado/empleado/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
               //if success reload ajax table
               $('#modal_form_empleado').modal('hide');
               reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error al intentar borrar');
            }
        });
         
      }
    }

