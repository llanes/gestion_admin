  <script type="text/javascript">

    var save_method_producro; //for save method string
    var table;
    $(document).ready(function() {
      table = $('#table_producto').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Productos/ajax_list'); ?>",
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

    function add_Productos()
    {
     $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
     $("#producto_aler").hide();
     $(".modal-body,.modal-header").show();
      save_method_producro = 'add';
      $('#form_productos')[0].reset(); // reset form on modals
      $('#modal_form_productos').modal('show'); // show bootstrap modal
      $('.modal-title_productos').text('Agregar Productos'); // Set Title to Bootstrap modal title
    }

        function edit_producto(idProducto_Servicio)
    {
      $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
      $("#producto_aler").hide();
      $(".modal-body,.modal-header").show();
      save_method_producro = 'update';
      // $('#PF').hide();
      $('#form_productos')[0].reset(); // reset form on modals
      // $('#Iva').html('');
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Productos/ajax_edit/'); ?>/" + idProducto_Servicio,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        
                $('[name="idProducto_Servicio"]').val(data.idProducto_Servicio);
                $('[name="Codigo"]').val(data.Codigo);
                 $('[name="Codigo_Barra"]').val(data.Codigo_Barra);
                $('[name="Nombre"]').val(data.Nombre);
                $('[name="Descripcion"]').val(data.Descripcion);
                $('[name="Precio_Unitario"]').val(data.Precio_Unitario);
                $('[name="Cantidad"]').val(data.Cantidad);
                $('[name="usuario"]').val(data.Usuario);
                $('[name="Descuento"]').val(data.Descuento);
                $('[name="Iva"]').val(data.Iva);
                $('[name="Img"]').val(data.Img);
                $('[name="Categoria"]').val(data.Categoria);
                $('[name="idCategoria"]').val(data.idCategoria);
            $('#modal_form_productos').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title_productos').text('Editar Cliente'); // Set title to Bootstrap modal title
            
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
    $('#form_productos').submit(function(e) {
      var url;
      var form = new FormData(document.getElementById('form_productos'));
      if(save_method_producro == 'add') 
      {
        url = "<?php echo site_url('index.php/Productos/ajax_add'); ?>";
      }
      else
      {
        url = "<?php echo site_url('index.php/Productos/ajax_update'); ?>";
      }
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: form,
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          // console.log(data);
                          $(".N,.A,.cate,.T,.E,.U,.P,.PF,.IMG").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.Codigo) {
                               $(".N").append(json.Codigo).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Nombre) {
                               $(".A").append(json.Nombre).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Descripcion) {
                               $(".PF").append(json.Descripcion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Precio_Unitario) {
                               $(".T").append(json.Precio_Unitario).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Cantidad) {
                               $(".E").append(json.Cantidad).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                              if (json.Descuento) {
                               $(".U").append(json.Descuento).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                            if (json.Iva) {
                               $(".P").append(json.Iva).css({"display":"block"}); /// mostar validation  de iten pass
                            }
                           if (json.Img) {
                               $(".IMG").append(json.Img).css({"display":"block"}); /// mostar validation  de iten pass
                            }
                              if (json.idCategoria) {
                               $(".cate").append(json.idCategoria).css({"display":"block"}); /// mostar validation  de iten pass
                            }
                          }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                         $(".modal-body,.modal-header").hide();
                                         $('#producto_aler').show()
                                          if (save_method_producro == 'add') {
                                            $('.title').text('Registrado Correctamente');
                                          } else {
                                            $('.title').text('Datos Actualizado correctamente');
                                          }
                                          setTimeout(function() {
                                                $("#producto_aler").fadeOut(1500);
                                                 $('#modal_form_productos').modal('hide');
                                            },1500);
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

    function delete_producto(id)
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
            url : "<?php echo site_url('index.php/Productos/ajax_delete')?>/"+id,
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


    function ver_mas(idProducto_Servicio)
    {
      // $('#reset')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo site_url('index.php/Productos/ajax_edit/')?>/" + idProducto_Servicio,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
                 $('.modal-title_productos_ver').text(data.Img);
                 $('.Codigo_Barra').text(data.Codigo_Barra);
                 $('.Descripcion').text(data.Descripcion);
                 $('.Descuento').text(data.Descuento);
                 $('.Iva').text(data.Iva);
       $('#ver_mas').modal('show'); // show bootstrap modal when complete loaded
       $('.modal-title_productos').text('Listados'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos');
        }
    });
    }

var site = "<?php echo site_url();?>";
$(function(){
  $('.autocomplete').autocomplete({
    serviceUrl:  site+"index.php/Productos/busqueda_Categoria",

    onSelect: function (suggestions) {
      document.form_productos.idCategoria.value = suggestions.data;

      }
  });
});