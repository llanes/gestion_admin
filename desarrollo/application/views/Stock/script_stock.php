  <script type="text/javascript">
    var save_methodstock; //for save method string
    var table_stock;
    $(document).ready(function() {
      table_stock = $('#table_stock').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Stock/ajax_list'); ?>",
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

    function add_stock()
    {
     $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
     $(".transparente").hide();
      $("#stock_aler").hide();
      $(".modal-body,.modal-header").show();
      save_methodstock = 'add';
      $('#form_stock')[0].reset(); // reset form on modals
      $('#modal_form_stock').modal('show'); // show bootstrap modal
      $('.modal-title').text('Agregar Stock'); // Set Title to Bootstrap modal title

    }

    function edit_stock(idStock)
    {
      $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
      $(".transparente").hide();
      $("#stock_aler").hide();
      $(".modal-body,.modal-header").show();
      save_methodstock = 'update';
      // $('#PF').hide();
      $('#form_stock')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Stock/ajax_edit/'); ?>/" + idStock,
        type: "GET",
        dataType: "JSON",
        cache: false,
        success: function(data)
        {
            $('[name="idStock"]').val(data.idStock);
            $('[name="Cantidad_stock"]').val(data.Cantidad_stock);
            $('[name="Nombre"]').val(data.Nombre);
            $('[name="idProducto_Servicio"]').val(data.Producto_Servicio_idProducto_Servicio);
            $('#modal_form_stock').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Stock'); // Set title to Bootstrap modal title
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
    $('#form_stock').submit(function(e) {
      var url;
      if(save_methodstock == 'add') 
      {
        url = "<?php echo site_url('index.php/Stock/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Stock/ajax_update'); ?>";
      }
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      cache: false,
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.idProducto_Servicio) {
                               $(".N").append(json.idProducto_Servicio).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Cantidad_stock) {
                               $(".A").append(json.Cantidad_stock).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                          }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                        $(".modal-body,.modal-header").hide();
                                         $('#stock_aler').show()
                                          if (save_methodstock == 'add') {
                                            $('.title').text('Registrado Correctamente');
                                          } else {
                                            $('.title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#stock_aler").fadeOut(1500);
                                                $('#modal_form_stock').modal('hide');
                                            },2000);
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


    function delete_stock(id)
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
            url : "<?php echo site_url('index.php/Stock/ajax_delete'); ?>/"+id,
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

    $(function(){
  $('.servicio_select').autocomplete({

    serviceUrl:  "<?php echo site_url('index.php/Stock/busqueda_producto_servicio'); ?>",

    onSelect: function (suggestions) {
      $(".bg-red,.bg-green,.bg-blue,.transparente").hide();
      document.form.idProducto_Servicio.value = suggestions.data;
      var cn = suggestions.Cantidad ;
      if (cn < 11) {
        $(".transparente,.bg-red").show();
        $('.bg-red').text(cn);
      } else if (cn > 50){
        $(".transparente,.bg-green").show();
          $('.bg-green').text(cn);
          alert($(".bg-green").html());
      }else{
        $(".transparente,.bg-blue").show();
          $('.bg-blue').text(cn);
          alert($(".bg-blue").html());
      }

      }
  });
});


