<!-- <a class="btn btn-lg btn-success" href="#">
   <i class="fa fa-arrow-left ">Atras</i>
</a> -->
<style type="text/css" media="screen">
.User,.Pass,#mensaje {display: none;}
</style>
 <div class="container">
         <form class="form-signin" id="for_login-registro" >
        <h2 class="form-signin-heading">Registro de Cliente</h2>
        <div class="login-wrap">
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                    <input maxlength="35" required type ="text" id="Nombres" name="Nombres" class="form-control " placeholder="Nombres" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="N"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                  <input maxlength="35" required type ="text" id="Direccion" name="Direccion" class="form-control " placeholder="Direccion" size='45' title="ingrese Nombre"pattern="[A-Za-z ]{4,50}" maxlength="50" maxlength="30"  autofocus   >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="C"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                    <input maxlength="35" required type ="text" id="Telefono" name="Telefono" class="form-control" placeholder="Telefono" size='45'   title="ingrese telefono" pattern="[0-9]{10,15}" min="10" maxlength="15"  autofocus  >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="T"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                    <input maxlength="35"  type ="Email" id="Email" name="Email" class="form-control" placeholder="Correo" title="ejemplo@correo.com" onfocus="autofocus" pattern="^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" autofocus  >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="E"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                     <input maxlength="35" required type ="text" id="ci_ruc" name="ci_ruc" class="form-control" placeholder="Cedula o R-U-C" size='45'   title="ingrese ci_ruc" pattern="[0-9]{10,15}" min="10" maxlength="15"  autofocus  >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="ci"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                    <input maxlength="35" required type ="text" id="usuario" name="usuario" class="form-control" onfocus="autofocus" autocomplete="off"  placeholder="Usuario" pattern="[A-Za-z ]{3,100}"   >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="U"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                    <input maxlength="35" required type ="password" id="password" name="password" class="form-control" onfocus="autofocus" autocomplete="off"  placeholder="Contraseña"   pattern="(?=.*[a-z]).{6,}"  >
                </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="P"></div>
              </div>
              <div class="form-group has-feedback">
                <label for="" class="control-label"></label>
                <div class="">
                    <input maxlength="35" required type ="password" id="passconf" name="passconf" class="form-control" onfocus="autofocus" autocomplete="off" data-match="#password" data-match-error="Error, Contraseña no coisiden"  placeholder="Repetir Contraseña"  pattern="(?=.*[a-z]).{6,}">
               </div>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                <div class="help-block with-errors" id="PF"></div>
              </div>
<!--             <label class="cheloginckbox">
                <input type="checkbox" value="agree this condition"> Acectar Términos de Servicio de Privacidad
            </label> -->
            <button class="btn btn-lg btn-login btn-block" type="submit">Enviar</button>

            <div class="registration">
               Ya registrado.
                <a class="" href="<?= base_url();?>index.php/Login">
                   Iniciar sesión.
                </a>
            </div> 

        </div>

      </form>
      <!-- ///////////////////////////////////////////////////////////////////////////////////////// -->
<div class="alert alert-danger" id="mensaje">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <h4><strong>Felisidades!</strong> <br>Datos introducidos correctamente...<br><strong>La pagina se redigira automaticamente...</strong></h4>
</div>
</div>

   <script src="<?= base_url();?>clienteStilo/js/bootstrap.min.js"></script>
    <script src="<?= base_url();?>clienteStilo/js/jquery.backstretch.min.js"></script>
    <script>
                $.backstretch("<?= base_url();?>clienteStilo/img/boxed-bg.jpg", {speed: 200});
            $(function () {
        //////////////////////Registro add//////////////////////////
         $('#for_login-registro').submit(function(e){
         $.ajax({
              type : 'POST',
              url : '<?= base_url();?>index.php/Login/registro_add', // octengo la url del formulario
              data: $(this).serialize(), // serilizo el formulario
              success : function(data) {
                 var json = JSON.parse(data);// parseo la dada devuelta por json
                  $("#N,#C,#T,#E,#U,#P,#PF").html("").css({"display":"none"});
                  if (json.res == "error") {
                    if (json.Nombres) {
                       $("#N").append(json.Nombres).css({"display":"block"}); // mostrar validation de iten usuario
                    }
                    if (json.Direccion) {
                       $("#C").append(json.Direccion).css({"display":"block"}); // mostrar validation de iten usuario
                    }
                    if (json.Telefono) {
                       $("#T").append(json.Telefono).css({"display":"block"}); // mostrar validation de iten usuario
                    }
                    if (json.Email) {
                       $("#E").append(json.Email).css({"display":"block"}); // mostrar validation de iten usuario
                    }
                    if (json.usuario) {
                       $("#U").append(json.usuario).css({"display":"block"}); // mostrar validation de iten usuario
                    }
                    if (json.password) {
                       $("#P").append(json.password).css({"display":"block"}); /// mostar validation  de iten pass
                    }
                   if (json.passconf) {
                       $("#PF").append(json.passconf).css({"display":"block"}); /// mostar validation  de iten pass
                    }
                  }else{ // si pasa la validation redireccionar al ligin del control de acceso
                                          var url = "<?= site_url('index.php/Login')?>"; 
                                                $("#for_login-registro").hide();
                                                $("#mensaje").show();
                                            setTimeout(function() {
                                                  setTimeout(function() {
                                                    $(location).attr('href',url)
                                              },500);
                                            },1000);

                     // setTimeout('document.location.reload()',500); 
                   }
             },
              // código a ejecutar si la petición falla;
              error : function(xhr, status) {
                  alert('Disculpe, existió un problema');
                  console.log('error(jqXHR, textStatus, errorThrown)');
              },
          });
         e.preventDefault();
        });
        /////////////////////////////////////////////////////////
        });
$('#for_login-registro').validator()
    </script>