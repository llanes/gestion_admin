  <script type="text/javascript">
   $('#form_cobrar').validator();
    var save_method; //for save method string
    var table_Cobranzas;
    var table_Cobrados;
    var table_Listado_cobrar;
  $(function() {
    table_Cobranzas = $('#table_Cobranzas').DataTable({
        processing: true,
        serverSide: true,
        // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?php echo site_url('index.php/Cobros/ajax_Cobranzas'); ?>",
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

    table_Cobrados = $('#table_Cobrados').DataTable({
        processing: true,
        serverSide: true,
        // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?php echo site_url('index.php/Cobros/ajax_Cobrados'); ?>",
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
    $('#lista_cobrados').click(function() {
      table_Cobrados.ajax.reload(null,false);
    });
  }); 
  function listar_creditos(idCliente) 
    {
      $('#Cobranzas').removeClass("active")
      $('.renombre').text('Cuotas a Cobrar'); 
      $("#Listado_cobrar").addClass("active");
      table_Listado_cobrar = $('#table_Listado_cobrar').DataTable({
        processing: true,
        serverSide: true,
        // Load data for the table's content from an Ajax source
            ajax: {
                url: "<?php echo site_url('index.php/Cobros/listar_creditos'); ?>/"+idCliente,
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
    }
    function item_cobrar(idCredito)
    {
      $("#12,#nombre,.modal-title,.C").html("").css({"display":"none"});
        $( "#reset_Des" ).removeClass("has-success");
        $( "#yty" ).removeClass("glyphicon-ok");
      $("#cobros_aler").hide();
      $('#form_cobrar')[0].reset(); // reset form on modals
      $(".modal-body,.modal-header").show();
      $('#modal_form_cobrar').modal('show'); // show bootstrap modal
      $.ajax({
        url : "<?php echo site_url('index.php/Cobros/item_cobrar/'); ?>/"+idCredito,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
        $("#nombre").append('<strong class="text-danger"></strong> &nbsp;&nbsp;'+ data.Nombres + '&nbsp;&nbsp;'+ data.Apellidos + '').css({"display":"block"});
        $("#2").append('<strong class="text-danger"></strong> &nbsp;&nbsp;'+ data.impor + '').css({"display":"block"});
        $('[name="Importe"]').val(data.impor);
        $('#Imp').text(data.impor);
        $('[name="idCredito"]').val(data.idCredito);
        $('[name="Estado_Pago"]').val(data.Estado_Pago);
        $(".modal-title").append('<strong class="text-danger">CUOTA N° :</strong> &nbsp;&nbsp;'+ data.Num_cuota + '').css({"display":"block"});
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            swal('Error al obtener datos');
        }
    });
    }
  function atras() {
  $('#cobros_vista').show()
  $("#cobros_vista").load('<?php echo base_url("index.php/Cobros")?>');
  }
  $(function () {
          $("#cobrar").click(function(){
          $('#cobros_vista').show()
          $("#cobros_vista").load('<?php echo base_url("index.php/Cobros")?>');


   $('#Descripcion').keyup(function(){
    $("#12").html("").css({"display":"none"});
    });
          });
      $('#form_cobrar').validator().on('submit', function (e) {
      var url = "<?php echo site_url('index.php/Cobros/cobrar_credito'); ?>";
           $.ajax({
                      type : 'POST',
                      url : url, // octengo la url del formulario
                      data: $(this).serialize(), // serilizo el formulario
                      success : function(data) {
                         var json = JSON.parse(data);// parseo la dada devuelta por json
                          $("#12").html("").css({"display":"none"});
                          if (json.res == "error") {
                            if (json.Descripcion) {
                                $( "#reset_Des" ).addClass("has-error has-danger");
                               $( "#yty" ).addClass("glyphicon-remove");
                               $("#12").append(json.Descripcion).css({"display":"block"}); // mostrar validation de iten usuario
                            }
                          }else{ 
                                        $(".modal-body,.modal-header").hide();
                                         $('#cobros_aler').show();
                                         $('.title').text('Registrado Correctamente');
                                          setTimeout(function() {
                                                $("#cobros_aler").fadeOut(1500);
                                                $('#modal_form_cobrar').modal('hide');
                                            },2000);
                                        $('#form_cobrar')[0].reset(); // reset form on modals
                                        table_Listado_cobrar.ajax.reload(null,false);
                                      $( "#reset_Des" ).removeClass("has-success");
                                      $( "#yty" ).removeClass("glyphicon-ok");
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

</script>