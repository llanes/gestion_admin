
<script type="text/javascript">
  (function($){
    //creamos la fecha actual
    var date = new Date();
    var yyyy = date.getFullYear().toString();
    var mm = (date.getMonth()+1).toString().length == 1 ? "0"+(date.getMonth()+1).toString() : (date.getMonth()+1).toString();
    var dd  = (date.getDate()).toString().length == 1 ? "0"+(date.getDate()).toString() : (date.getDate()).toString();

    //establecemos los valores del calendario
    var options = {
      // definimos que los eventos se mostraran en ventana modal
      modal: '#events-modal', 
      // dentro de un iframe
      modal_type:'template',
      //obtenemos los eventos de la base de datos
      events_source: "<?php echo site_url('index.php/Home_cliente/agenda_ajax_list'); ?>",
      // Mostramos el calendario por mes
      view: 'month',
      //  definimos el lenuaje
      language: 'es-ES',
      //Template de nuestro calendario
      tmpl_path: '<?php echo base_url() ?>bower_components/bootstrap-calendar/tmpls/',
      tmpl_cache: false,
      // y dia actual
      day: yyyy+"-"+mm+"-"+dd,
      // Hora de inicio
      time_start: '6:00',
      // y Hora final de cada dia
      time_end: '23:00',
       // intervalo de tiempo entre las hora, en este caso son 30 minutos
      time_split: '30',
      // Definimos un ancho del 100% a nuestro calendario
      width: '100%',

      onAfterEventsLoad: function(events) 
      {
        if(!events) 
        {
          return;
        }
        var list = $('#eventlist');
        list.html('');

        $.each(events, function(key, val) 
        {
          $(document.createElement('li'))
            .html('<a href="' + val.url + '">' + val.title + '</a>')
            .appendTo(list);
        });
      },
      onAfterViewLoad: function(view) 
      {
        $('#titulos').text(this.getTitle());
        $('.btn-group button').removeClass('active');
        $('button[data-calendar-view="' + view + '"]').addClass('active');
      },
      classes: {
        months: {
          general: 'label'
        }
      }
    };

    // id del div donde se mostrara el calendario
    var calendar = $('#calendar').calendar(options);

    $('.btn-group button[data-calendar-nav]').each(function() 
    {
      var $this = $(this);
      $this.click(function() 
      {
        calendar.navigate($this.data('calendar-nav'));
      });
    });

    $('.btn-group button[data-calendar-view]').each(function() 
    {
      var $this = $(this);
      $this.click(function() 
      {
        calendar.view($this.data('calendar-view'));
      });
    });

    $('#first_day').change(function()
    {
      var value = $(this).val();
      value = value.length ? parseInt(value) : null;
      calendar.setOptions({first_day: value});
      calendar.view();
    });

    // $('#events-in-modal').change(function()
    // {
    //   var val = $(this).is(':checked') ? $(this).val() : null;
    //   calendar.setOptions(
    //     {
    //       modal: val,
    //       modal_type:'iframe'
    //     }
    //   );
    // });
  }(jQuery));
    var listado_alquiler_ajax;
    var site = "<?php echo site_url();?>";
     $(function () {

      listado_alquiler_ajax = $('#listado_alquiler_ajax').DataTable({ 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        bFilter : false,
        bAutoWidth : false,
        bLengthChange : false,
        sort : false,

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('index.php/Home_cliente/listado_alquiler_ajax'); ?>",
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
     function reload_table()
    {
      listado_alquiler_ajax.ajax.reload(null,false); //reload datatable ajax 
    }
     function details_al(idArquiler)
 {
    $("#des,#Inp,#Precio,#Sub").html("").css({"display":"none"});
    $("#1,#2,#3,#4,#5,#6,#Total").html("").css({"display":"none"})
    $.ajax({
      type: "POST",
      url : "<?php echo site_url('index.php/Home_cliente/ajax_edit/'); ?>/"+idArquiler,
      data: $("#form").serialize(),
      success: function(data) {
            var result = JSON.parse(data);
            $.each(result, function(i, val){
            var Subtotal = val.Cantidad*val.Precio;
              $( ".step" ).load( "<?php echo site_url('index.php/Presupuesto_arquiler/load');?>" );
              $('#details_al').modal('show'); // show bootstrap modal when complete loaded
              $(".modal-body,.modal-header").show();
              $("#Total").append('<strong class="text-danger"> Monto Total &nbsp;₲. </strong> &nbsp;&nbsp;'+ val.Monto_Alquiler_Presupuesto + '&nbsp;&nbsp;').css({"display":"block"});
              $("#1").append('<strong class="text-danger">Cliente :</strong> &nbsp;&nbsp;'+ val.Nombres + '&nbsp;&nbsp;'+ val.Apellidos + '').css({"display":"block"});
              $("#2").append('<strong class="text-danger">Direccion :</strong> &nbsp;&nbsp;'+ val.Direccion + '&nbsp;&nbsp;').css({"display":"block"});
              if (val.Contado_Credito == 1) {
                $("#6").append('&nbsp;<strong class="text-danger">Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;Contado ').css({"display":"block"});
              }
              if (val.Contado_Credito == 2) {
                $("#6").append('&nbsp;<strong class="text-danger">Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>&nbsp;&nbsp;Cuotas ').css({"display":"block"});
              }
          });
          }
      });
 }

    </script>