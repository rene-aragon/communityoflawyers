<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V17</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/vendor/bootstrap/css/bootstrap.min.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/fonts/fontawesome/css/font-awesome.min.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/vendor/animate/animate.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/vendor/css-hamburgers/hamburgers.min.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/vendor/animsition/css/animsition.min.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/vendor/select2/select2.min.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/vendor/daterangepicker/daterangepicker.css") ?>'>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/css/login-util.css") ?>'>
	<link rel="stylesheet" type="text/css" href='<?php echo base_url("public/assets/css/login-main.css") ?>'>
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 tab-content">
				<div id="login" style="display:block;">
          <?php
            $attributes = array('class' => "login100-form validate-form", 'id' => 'login');
            echo form_open('Usuario/login_post/', $attributes);
          ?>

						<span class="login100-form-title p-b-34">
							<img src='<?php echo base_url("public/assets/images/logo.png") ?>' width='150px' height='150px'>
						</span>
						<span class="login100-form-title p-b-34">
							Account Login
						</span>

						<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
              <?php

                  $data = array(
                      'type'  => 'text',
                      'name'  => 'email',
                      'id'    => 'first-name',
                      'class' => 'input100',
                      'placeholder' => 'email'
                  );
                  echo form_input($data);
              ?>

							<span class="focus-input100"></span>
						</div>
						<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20" data-validate="Type password">
              <?php

                  $data = array(
                      'type'  => 'password',
                      'name'  => 'pass',

                      'class' => 'input100',
                      'placeholder' => 'password'
                  );
                  echo form_input($data);
              ?>

							<span class="focus-input100"></span>
						</div>

						<div class="container-login100-form-btn">
              <?php
                  $data = array(

                    'class' => "login100-form-btn"

                  );
                  echo form_submit('botonSubmit', 'Enviar', $data);
               ?>

						</div>
            <?php echo form_close(); ?>

						<div class="w-full text-center p-t-27 p-b-239">
							<span class="txt1">
								Forgot
							</span>

							<a href="#" class="txt2">
								Username / password?
							</a>
							<br>

							<div class="tab">
								<span class="txt1">
									¿No tienes una cuenta?
								</span>

								<a href="#signup" class="txt2">
									crea una aquí
								</a>
							</div>
						</div>

						<div class="w-full text-center">
              <a class="txt3" href="<?php echo(base_url('Usuario/index'))?>" >
								Regresar
							</a>
						</div>



				</div>
				<div id="signup" style="display:none;">
					<div class="login100-form validate-form">
						<span class="login100-form-title p-b-34">
							¿Qué tipo de cuenta deseas registrar?
						</span>

						<div style="width:50%; text-align:center;" class="tab">
							<a href="#cliente">
								<img src='<?php echo base_url("public/assets/images/login/user.png") ?>' width='100px' height='100px'><div style="height:20px"></div>
								Cliente
							</a>
						</div>
						<div style="width:50%; text-align:center;" class="tab">
							<a href="#abogado">
								<img src='<?php echo base_url("public/assets/images/login/user.png") ?>' width='100px' height='100px'><div style="height:20px"></div>
								Abogado
							</a>
						</div>
					</div>
					<div class="tab w-full text-center">
							<a href="#login" class="txt3">
								Log In
							</a>
						</div>
					<div style="height:30px"></div>
				</div>
				<div id="cliente" style="display:none;">
					<div class="tab w-full">

            <?php
              $attributes = array('class' => "login100-form validate-form", 'id' => 'form');
              echo form_open_multipart('Usuario/createClient_post', $attributes);
            ?>
						<form class="login100-form validate-form">
							<span class="login100-form-title p-b-34">
								Ingresa la siguiente información
							</span>

							Nombre
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu nombre">
								<input class="input100" type="text" name="nombreC" placeholder="nombre">
								<span class="focus-input100"></span>
							</div>

							Apellido paterno
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu apellido paterno">
								<input class="input100" type="text" name="appatC" placeholder="apellido paterno">
								<span class="focus-input100"></span>
							</div>

							Apellido Materno
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu apellido materno">
								<input class="input100" type="text" name="apmatC" placeholder="apellido materno">
								<span class="focus-input100"></span>
							</div>

							Correo
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa un correo válido">
								<input class="input100" type="email" name="emailC" placeholder="correo">
								<span class="focus-input100"></span>
							</div>

							Contraseña
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa una contraseña">
								<input class="input100" type="password" name="passC" placeholder="contraseña">
								<span class="focus-input100"></span>
							</div>

							Fecha de nacimiento
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu fecha de nacimiento">
								<input class="input100" type="date" name="fechanC">
								<span class="focus-input100"></span>
							</div>

							Tipo de pago
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa un tipo de pago">
								<input class="input100" type="text" name="pago" placeholder="tipo de pago">
								<span class="focus-input100"></span>
							</div>

							Foto
							<div class="wrap-input100 validate-input m-b-20" data-validate="Debes subir al menos un archivo" style="border:none;">
								<input id="file-uploadC" onchange='cambiarC()' type="file" name="fotoC"  />


							</div>

							<div class="wrap-input100 validate-input m-b-20" data-validate="Debes estar de acuerdo" style="border:none;">
								<input class="input100" style="width:auto; height:auto; display:inline;" type="checkbox" name="agreeC"> Estoy de acuerdo con los <a href="" style="">términos y condiciones.</a></input>
								<span class="focus-input100"></span>
							</div>



							<div class="container-login100-form-btn">
								<?php
										$data = array(

											'class' => "login100-form-btn"

										);
										echo form_submit('botonSubmit2', 'Enviar', $data);
								 ?>
							</div>
						<?php echo form_close(); ?>

						<div class="tab w-full text-center">
							<a href="#signup" class="txt3">
								Regresar
							</a>
						</div>
						<div style="height:30px"></div>
					</div>
				</div>
				<div id="abogado" style="display:none;">
					<div class="tab w-full">
            <?php
              $attributes = array('class' => "login100-form validate-form", 'id' => 'form2');
              echo form_open_multipart('Usuario/createAbogado_post', $attributes);
            ?>
							<span class="login100-form-title p-b-34">
								Ingresa la siguiente información
							</span>

							Nombre
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu nombre">
								<input class="input100" type="text" name="nombreA" placeholder="nombre">
								<span class="focus-input100"></span>
							</div>

							Apellido paterno
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu apellido paterno">
								<input class="input100" type="text" name="appatA" placeholder="apellido paterno">
								<span class="focus-input100"></span>
							</div>

							Apellido materno
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu apellido materno">
								<input class="input100" type="text" name="apmatA" placeholder="apellido materno">
								<span class="focus-input100"></span>
							</div>

							Correo
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa un correo válido">
								<input class="input100" type="email" name="emailA" placeholder="correo">
								<span class="focus-input100"></span>
							</div>

							Contraseña
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa una contraseña">
								<input class="input100" type="password" name="passA" placeholder="contraseña">
								<span class="focus-input100"></span>
							</div>


							Fecha de nacimiento
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu fecha de nacimiento">
								<input class="input100" type="date" name="fechanA">
								<span class="focus-input100"></span>
							</div>

							Cuenta bancaria
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu cuenta bancaria">
								<input class="input100" type="text" name="cuentaB" placeholder="cuenta bancaria">
								<span class="focus-input100"></span>
							</div>

							Costo base
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa tu costo base">
								<input class="input100" type="text" name="costoB" placeholder="costo base">
								<span class="focus-input100"></span>
							</div>

							Categoria 1
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa la categoria de derecho">
							  <select class="input100"  name="cat1">
							    <?php

							      foreach ($data2 as $r) {
							        // code...
							        echo('
							          <option value = "'.$r['categoria_id'].'">
							            '.$r['nombre'].'
							          </option>
							        ');
							      }
							    ?>
							  </select>
							  <span class="focus-input100"></span>
							</div>

							Categoria 2
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa la categoria de derecho">
							  <select class="input100"  name="cat2">
							    <?php

							      foreach ($data2 as $r) {
							        // code...
							        echo('
							          <option value = "'.$r['categoria_id'].'">
							            '.$r['nombre'].'
							          </option>
							        ');
							      }
							    ?>
							    <option selected value="0"></option>
							  </select>
							  <span class="focus-input100"></span>
							</div>

							Categoria 3
							<div class="wrap-input100 validate-input m-b-20" data-validate="Ingresa la categoria de derecho">
							  <select class="input100"  name="cat3">
							    <?php

							      foreach ($data2 as $r) {
							        // code...
							        echo('
							          <option value = "'.$r['categoria_id'].'">
							            '.$r['nombre'].'
							          </option>
							        ');
							      }
							    ?>
							    <option selected value="0"></option>
							  </select>
							  <span class="focus-input100"></span>
							</div>

							Foto
							<div class="wrap-input100 validate-input m-b-20"  style="border:none;">
								<input id="file-uploadA1" onchange='cambiar()' type="file" name="fotoA"  style='display: none;'/>

								<label for="file-uploadA1" class="login100-form-btn">
									<i class="fas fa-cloud-upload-alt"></i> Subir archivos
								</label>
							</div>

						</br>

							<div id="files" class="document-visualizer text-center">
								<span class="focus-input100"></span>
							</div>

							</br>

								Cedula Profesional
								<div class="wrap-input100 validate-input m-b-20"  style="border:none;">
									<input id="file-uploadA2" onchange='cambiar2()' type="file" name="cdpro" style='display: none;'/>

									<label for="file-uploadA2" class="login100-form-btn">
										<i class="fas fa-cloud-upload-alt"></i> Subir archivos
									</label>
								</div>

								</br>

								<div id="filesA2" class="document-visualizer text-center">
									<span class="focus-input100"></span>
								</div>

								</br>


									Curriculum
									<div class="wrap-input100 validate-input m-b-20"  style="border:none;">
										<input id="file-uploadA3" onchange='cambiar3()' type="file" name="cv" style='display: none;'/>

								<label for="file-uploadA3" class="login100-form-btn">
									<i class="fas fa-cloud-upload-alt"></i> Subir archivos
								</label>
								</div>


							</div>

							<div id="filesA3" class="document-visualizer text-center">
								<span class="focus-input100"></span>
							</div>


							<div class="wrap-input100 validate-input m-b-20" data-validate="Debes estar de acuerdo" style="border:none;">
								<input class="input100" style="width:auto; height:auto; display:inline;" type="checkbox" name="agreeA"> Estoy de acuerdo con los <a href="" style="">términos y condiciones.</a></input>
								<span class="focus-input100"></span>
							</div>

							<div class="container-login100-form-btn">
								<?php
										$data = array(

											'class' => "login100-form-btn"

										);
										echo form_submit('botonSubmit3', 'Enviar', $data);
								 ?>
							</div>
						<?php echo form_close(); ?>

						<div class="tab w-full text-center">
							<a href="#signup" class="txt3">
								Regresar
							</a>
						</div>
						<div style="height:30px"></div>
					</div>
				</div>
			</div>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/vendor/jquery/jquery-3.2.1.min.js") ?>'></script>
<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/vendor/animsition/js/animsition.min.js") ?>'></script>
<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/vendor/bootstrap/js/popper.js") ?>'></script>
	<script src='<?php echo base_url("public/assets/vendor/bootstrap/js/bootstrap.min.js") ?>'></script>
<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/vendor/select2/select2.min.js") ?>'></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/vendor/daterangepicker/moment.min.js") ?>'></script>
	<script src='<?php echo base_url("public/assets/vendor/daterangepicker/daterangepicker.js") ?>'></script>
<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/vendor/countdowntime/countdowntime.js") ?>'></script>
<!--===============================================================================================-->
	<script src='<?php echo base_url("public/assets/js/login.js") ?>'></script>

</body>
</html>
