
							<section class="content">

										<table id="listado_alq_ajax" class="table table-striped table-advance table-hover" >
						<style type="text/css" media="screen">
                         .row{
                            display: block;
                          }
                          </style>
											<thead>
												<tr>
													<th class  ="text-danger" style="width:120px;"><i class="fa fa-list"></i> Servicio</th>
													<th class  ="text-danger" style="width:120px;"><i class="fa fa-user"></i> Cliente</th>
													<th class  ="text-danger" style="width:120px;"><i class="fa fa-usd"></i> Monto </th>
													<th class  ="text-danger" style="width:120px;"><i class="fa fa-"></i> Entegado</th>
													<th class  ="text-danger" style="width:120px;"><i class="fa fa-"></i> Devolucion</th>
													<th class  ="text-danger" style="width:50px; text-align:center"> Detalles</th>
													<th  class ="text-danger"style="width:100px; text-align:center"> Acciones</th>
												</tr>
											</thead>
 <tbody>
                                       <tr id="transparente" class="active">    
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                            </td>
                                            <td>
                                                Prueva
                                            </td>
                                        </tr>
                                      </tbody>
										</table>

							</section><!-- /.content <-->	</-->

<div class="modal fade" id="details_al" >
		<div class="modal-dialog">
			<div class="modal-content">

			<div class="modal-body form" id="reset">
			<fieldset title="Step 3" class="" id="default-step-2" style="display: block;">
				<table id="table" class="table table-striped" cellspacing="30" width="100%">
					<caption><h4 style="text-align:center;" class ="text-success">Detalles Pedidos </h4></caption>
					<thead>
						<tr style="background-color:#DFF0D8">
							<td  style="text-align:left ">
								<div id="1"></div>
							</td>
							<td  style="text-align:left ">
								<div id="2"></div>
							</td>
							<td  style="text-align:left  ">
								<div id="3"></div>
							</td>
						</tr>
						<tr style="background-color:#DFF0D8">
							<td  style="text-align:left ">
								<div id="4"></div>
							</td>
							<td  style="text-align:left ">
								<div id="5"></div>
							</td>
							<td  style="text-align:left  ">
								<div id="6"></div>
							</td>
						</tr>
					</thead>
				</table>
			</fieldset>
			<fieldset title="Step 3" class="step" id="default-step-2" style="display: block;">

			</fieldset>
			<p id='Total' ></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-success" onclick="impri()"><i class="fa fa-print"></i> Imprimir</button>
				<button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>

<script type="text/javascript" charset="utf-8" async defer>
 $(':checkbox').checkboxpicker();
		var save_method; //for save method string
		var listado_alq_ajax;
		$(document).ready(function() {
			listado_alq_ajax = $('#listado_alq_ajax').DataTable({ 
				"processing": true, //Feature control the processing indicator.
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				// Load data for the table's content from an Ajax source
				"ajax": {
						"url": "<?php echo site_url('index.php/Presupuesto_arquiler/ajax_list_alquiler'); ?>",
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
			listado_alq_ajax.ajax.reload(null,false); //reload datatable ajax 
		}
 function details_al(idArquiler)
 {
		$("#des,#Inp,#Precio,#Sub").html("").css({"display":"none"});
		$("#1,#2,#3,#4,#5,#6,#Total").html("").css({"display":"none"})
		$.ajax({
			type: "POST",
			url : "<?php echo site_url('index.php/Presupuesto_arquiler/ajax_edit/'); ?>/"+idArquiler,
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
							$("#3").append('<strong class="text-danger">Telefono :</strong> &nbsp;&nbsp;'+ val.Telefono + '&nbsp;&nbsp;').css({"display":"block"});
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

		function delete_presupuesto(id)
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
						url : "<?php echo site_url('index.php/Presupuesto_arquiler/delete_presupuesto'); ?>/"+id,
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
					swal("Confirmar!", "Presupuesto ha sido borrado.", "success");
				} else {
					swal("Cancelar", "Sin accion:)", "error");
				}
			});
		}
		function entregar(id,si_no){
			var parametros = {
                "id" : id,
                "si_no" : si_no
			};
				swal({
				title: "Entregar Alquiler?",
				text: "Usted podra volver a modificar!",
				// type: "info",
				showCancelButton: true,
				confirmButtonColor: "#00A65A",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Entregar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false
			},
			function(isConfirm) {
				if (isConfirm) {
			// ajax delete data to database
					$.ajax({
						data:  parametros,
						url : "<?php echo site_url('index.php/Presupuesto_arquiler/entrega'); ?>",
						type: "POST",
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
					swal("Confirmado!", "Alquiler ha sido Entegado.", "success");
				} 
			});
		}
		function entrega_pndnt(id,si_no){
			var parametros = {
                "id" : id,
                "si_no" : si_no
			};
				swal({
				title: "Cambiar Estado....?",
				text: "Usted podra volver a modificar!",
				// type: "info",
				showCancelButton: true,
				confirmButtonColor: "#C9302C",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Cambiar....?",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false
			},
			function(isConfirm) {
				if (isConfirm) {
			// ajax delete data to database
					$.ajax({
						data:  parametros,
						url : "<?php echo site_url('index.php/Presupuesto_arquiler/entrega'); ?>",
						type: "POST",
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
					swal("Confirmado!", "Alquiler estado Pendiente.", "success");
				} 
			});
		}
		function devolucion(id,si_no){
			var parametros = {
                "id" : id,
                "si_no" : si_no
			};
				swal({
				title: "Recibir Alquiler?",
				text: "Usted podra volver a modificar!",
				// type: "info",
				showCancelButton: true,
				confirmButtonColor: "#00A65A",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Recibir",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false
			},
			function(isConfirm) {
				if (isConfirm) {
			// ajax delete data to database
					$.ajax({
						data:  parametros,
						url : "<?php echo site_url('index.php/Presupuesto_arquiler/devolucion'); ?>",
						type: "POST",
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
					swal("Confirmado!", "Alquiler ha sido Recibir.", "success");
				} 
			});
		}
		function cancel_devolu(id,si_no){
			var parametros = {
                "id" : id,
                "si_no" : si_no
			};
				swal({
				title: "Cambiar Estado....?",
				text: "Usted podra volver a modificar!",
				// type: "info",
				showCancelButton: true,
				confirmButtonColor: "#C9302C",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Cambiar....?",
				cancelButtonText: "Cancelar",
				closeOnConfirm: false
			},
			function(isConfirm) {
				if (isConfirm) {
			// ajax delete data to database
					$.ajax({
						data:  parametros,
						url : "<?php echo site_url('index.php/Presupuesto_arquiler/devolucion'); ?>",
						type: "POST",
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
					swal("Confirmado!", "Alquiler estado Pendiente.", "success");
				} 
			});
		}
		function impri(){
			swal('Yes');
		}

</script>
