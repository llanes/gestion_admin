  <script>
      function Abrircaja(){
                 $('#Abrir_caja').submit(function(e) {
                  var url = "<?php echo site_url('index.php/Caja/abrir_Cerrar_Caja');?>/"+1;
                          $.ajax({
                            type : 'POST',
                            url : url, // octengo la url del formulario
                            cache: false,
                            data: $(this).serialize(), // serilizo el formulario
                            success : function(data) {
                                 var json = JSON.parse(data);// parseo la dada devuelta por json
                                              swal({
                                                title: "Caja Abierta",
                                                text: "  ",
                                                timer: 2500,
                                                showConfirmButton: false 
                                              });
                                               // $('#modal_form_alquiler').modal('hide');
                                              $("#caja_vista").load('<?php echo base_url("index.php/Caja")?>');
                           },
                            // código a ejecutar si la petición falla;
                            error : function(xhr, status) {
                                alert('Disculpe, existió un problema');
                                console.log('error(jqXHR, textStatus, errorThrown)');
                            },
                        });
                    e.preventDefault();

                    })
      }
      function cerrarCaja(){
                 $('#Cerrar_caja').submit(function(e) {
                  var url = "<?php echo site_url('index.php/Caja/abrir_Cerrar_Caja');?>/"+0;
                          $.ajax({
                            type : 'POST',
                            url : url, // octengo la url del formulario
                            cache: false,
                            data: $(this).serialize(), // serilizo el formulario
                            success : function(data) {
                                 var json = JSON.parse(data);// parseo la dada devuelta por json
                                              swal({
                                                title: "Caja Cerrada",
                                                text: "  ",
                                                timer: 2500,
                                                showConfirmButton: false 
                                              });
                                               // $('#modal_form_alquiler').modal('hide');
                                              $("#caja_vista").load('<?php echo base_url("index.php/Caja")?>');
                           },
                            // código a ejecutar si la petición falla;
                            error : function(xhr, status) {
                                alert('Disculpe, existió un problema');
                                console.log('error(jqXHR, textStatus, errorThrown)');
                            },
                        });
                    e.preventDefault();

                    })
      }
      $(function() {
        $("#monto_final1").html("").css({"display":"none"});
       $('#contenido_caja_ajax').dataTable({
             processing: true,
             serverSide: true,
             bPaginate : false,
             bFilter : false,
             bInfo : false,
             bAutoWidth : false,
             bLengthChange : false,
             sort : false,
              // Load data for the table's content from an Ajax source
              ajax: {
                  url: "<?php echo site_url('index.php/Caja/ajax_list'); ?>",
                  type: "POST",
                dataSrc: function(data){
                  $("#monto_final1").append('<p class="text-danger">'+data.Importe+'&nbsp;₲.</p>').css({"display":"block"});
                  // $('[name="monto_final1"]').val(data.Importe+'₲.');
                  $('[name="Importe"]').val(data.Importe);
                 return data.data;


                }
              },
              //Set column definition initialisation properties.
              columnDefs: [
              { 
                targets: [ -1 ], //last column
                orderable: false, //set not orderable
              },
              ],

            });


       var registro_caja_ajax = $('#registro_caja_ajax').dataTable({
             "processing": true,
             "serverSide": true,
             // bPaginate : false,
             // bFilter : false,
             // bInfo : false,
             // bAutoWidth : false,
             // bLengthChange : false,
             // sort : false,
              // Load data for the table's content from an Ajax source
              ajax: {
                  url: "<?php echo site_url('index.php/Caja/caja_list'); ?>",
                  type: "POST",
                dataSrc: function(data){
                 return data.data;


                }
              },

              //Set column definition initialisation properties.
              columnDefs: [
              { 
                targets: [ -1 ], //last column
                orderable: false, //set not orderable
              },
              ],

            });

    registro_caja_ajax.fnClearTable();

      });
      function edit_caja(id)
      {
          swal({
          title: "Editar caja?",
          text: "Reabrir la caja!",
          type: "warning",
          showCancelButton: true,
          confirmButtonClass: "btn-danger",
          confirmButtonText: "Abrir !",
          cancelButtonText: "Cancelar !",
          closeOnConfirm: false,
          closeOnCancel: false
        },

        function(isConfirm) {
        if (isConfirm) {
                  $.ajax({
                  url: "<?php echo site_url('index.php/Caja/edit_caja'); ?>/" + id,
                  type: "POST",
                  success: function(data)
                   {
                    $("#caja_vista").load('<?php echo base_url("index.php/Caja")?>');
                   },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error');
                    }
                })
          swal("Deleted!", "Abierta Correctamente.", "success");
        } else {
          swal("Cancelled", "Sin accion:)", "error");
        }
      });

      }


  </script>