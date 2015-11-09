  <script type="text/javascript">

    var save_method_producro; //for save method string
    $("#fac").html("").css({"display":"none"});
    function add_Productos()
    {
     $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
      save_method_producro = 'add';
      $('#form_productos')[0].reset(); // reset form on modals
      $('#modal_form_productos').modal('show'); // show bootstrap modal
      $('.modal-title_productos').text('Agregar Productos'); // Set Title to Bootstrap modal title
    }

    function edit_producto(idProducto_Servicio)
    {
      $(".N,.A,.D,.T,.E,.U,.P,.PF").html("").css({"display":"none"});
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
                // $('[name="Img"]').val(data.Img);
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
    $(function() {
    $('#agregar_carrito').click(function(e) {
      var url ="<?php echo site_url('index.php/Presupuesto_arquiler/agregar_carrito'); ?>";
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $('#formulario').serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          // console.log(data);
                          $(".can,.pro").html("").css({"display":"none"});
                              if (json.res == "crrito") {
                             swal("Cantidad debe ser menor que el Stock");
                              }else{
                                  if (json.res == "error") {
                                      if (json.producto) {
                                          swal(json.producto, json.Cantidad); // mostrar validation de iten usuario    
                                           // $('#formulario')[0].reset();
                                      }else{
                                          if (json.Cantidad) {
                                            swal(json.Cantidad, json.producto);
                                            // $('#formulario')[0].reset();
                                          }
                                      }

                                  }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                    $('#formulario')[0].reset();
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
            data: $(this).serialize(), // serilizo el formulario
            success: function(data)
            {
               $('#formulario')[0].reset();
               $( "#detalle" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/loader');?>" );
            },
        });
          swal("Deleted!", "Articulo ha sido borrado.", "success");
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
        url : "<?php echo site_url('index.php/Productos/ajax_edit/'); ?>/" + idProducto_Servicio,
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

    $(function(){
  $('.busqueda_cliente').autocomplete({
    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_cliente'); ?>",

    onSelect: function (suggestions) {
      document.formulario.idCliente.value = suggestions.data;
      document.formulario.ci_ruc.value = suggestions.ci_ruc;
      }
  });
    $('.busqueda_cliente2').autocomplete({
    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_cliente2'); ?>",

    onSelect: function (suggestions) {
      document.formulario.idCliente2.value = suggestions.data;
      document.formulario.Nombres.value = suggestions.Nombres;
      }
  });
});
  $(function(){
  $('.busqueda_producto').autocomplete({
    serviceUrl:  "<?php echo site_url('index.php/Presupuesto_arquiler/busqueda_producto'); ?>",
    onSelect: function (suggestions) {
           // $('#max').show();
           document.formulario.idProducto_Servicio.value = suggestions.data;
           document.formulario.Precio_Unitario.value = suggestions.Precio_Unitario;
           document.formulario.stock.value = suggestions.Cantidad_stock;
           document.formulario.Precio_Unitario1.value = suggestions.Precio_Unitario;
           document.formulario.Cantidad_stock1.value = suggestions.Cantidad_stock;
            // $('#max1').hide();
          // $('#max').append('<input type ="text" class="form-control input-sm" id="Cantidad" name="Cantidad" maxlength="" pattern="{10,15}" placeholder="">');
      }
  });
});
    $(function() {
    $('#vaciar').click(function(e) {
      var url = "<?php echo site_url('index.php/Presupuesto_arquiler/delete_carrito'); ?>";
                $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
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
            } if (id == 2) {
                $('#boleta').hide();
                $('#factura').show();
            }
            $("#tipo").change(function(){
              var id      = $( "select[name=natural_juridica]").val();
              // alert(id);
            if (id == 1) {
               $('#factura').hide();
               $('#boleta').show();
            } if (id == 2) {
                $('#boleta').hide();
                $('#factura').show();
            }
                          });
    });

    function add_mass(rowid)
    {
      var id , qty, price, name, options;
       id      = $(this).attr('data-id');
       qty     =   $(this).attr('data-qty');
       price   =   $(this).attr('data-price');
       name    =   $(this).attr('data-name');
       options =  $(this).attr('data-options');
       alert(id);
        $.ajax({
        url : "<?php echo site_url('index.php/Presupuesto_arquiler/add_mass'); ?>/" +id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error al obtener datos');
        }
    });


    }