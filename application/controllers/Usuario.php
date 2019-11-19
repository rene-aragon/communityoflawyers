<?php
// defined('BASEPATH') OR exit('No direct script access allowed');

// header('Access-Control-Allow-Origin: *');
// header("Content-Type: multipart/form-data ; charset=utf-8");
// header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


// use Restserver\libraries\REST_Controller;
// use Restserver\libraries\REST_Controller_Definitions;

// require APPPATH . '/libraries/REST_Controller_Definitions.php';
// require APPPATH . '/libraries/REST_Controller.php';
// require APPPATH . '/libraries/Format.php';




class Usuario extends CI_Controller{
	public function __construct(){
	 parent::__construct();


	 header( 'X-Content-Type-Options: nosniff' );
	 header( 'X-Frame-Options: SAMEORIGIN' );
	 header( 'X-XSS-Protection: 1; mode=block' );

 	}



	public function test_get(){
        $this->load->model('UsuarioM');
        $array = $this->UsuarioM->getUsuarioID();
        $result = $array->result_array();
		$this->response($result);
	}

	//=================FUNCIONES DE TIPO POST=================//
	public function index(){
		redirect('index.php', 'refresh');
	}


	//quitar el rest


	public function login_post(){
		session_destroy();
		$this->load->model('UsuarioM');
		$data=array(
			'data2' => $this->UsuarioM->get_categorias()
		);

								echo('<script>

									console.log('.json_encode($data).');


								</script>');

		$this->load->view('ingreso/login',$data);

		$estado = $this->input->post('botonSubmit',true);
		if(isset($estado)){

					$email = $this->input->post('email');
					$contra = $this->input->post('pass');

					$result = $this->UsuarioM->validatedLogin($email,$contra);
					$result = $result->result_array();
					//$result = $result->result_array();
					if(!empty($result) && ($result[0]['estado'] == 1)){
						//$respuesta = array("respuesta" => "Inicio de sesion exitoso","error" => 0);

						$r = $this->UsuarioM->get_user($email);

						//$result = $result->result_array();

						echo('<script>

							console.log('.json_encode($result).');
							alert("Inicio de sesion exitoso");

						</script>');
						session_start();
						$_SESSION['id'] = $r[0]['id_usuario'];
						$_SESSION['nombre'] = $r[0]['nombre']." ".$r[0]['apellidoP'];
						$_SESSION['email'] = $r[0]['email'];
						$_SESSION['tipo'] = $r[0]['rol_id'];
						$_SESSION['estado'] = $r[0]['estado'];
						$_SESSION['imagen'] = $r[0]['imagen'];
					}
					else{
						echo('<script>
							alert("Inicio de sesion fallido");
							console.log('.json_encode($result).');
						</script>');
						redirect('index.php', 'refresh');
					}
					//$this->response($respuesta)
					switch ($r[0]['rol_id']) {
            case 2:
              // code...


              redirect('abogado/index', 'refresh');
            break;

            case 3:
              // code...

              redirect('cliente/welcome', 'refresh');
            break;

            default:
              // code...

              redirect('administrador/index', 'refresh');
            break;
          }







		}

	}

	public function updateInfoUser_post(){
		$this->load->model('UsuarioM');
		$id = $this->session->id;
		$data = array(
			'nombre' => $this->input->post('nombre'),
            'apellidoP' => $this->input->post('apellidoP'),
            'apellidoM' => $this->input->post('apellidoM'),
			'email' => $this->input->post('email'),
			'fechaNac' => $this->input->post('fechaNac')
        );
		$result = $this->UsuarioM->updateUser($id,$data);
		if($result != false){
			$respuesta = array("respuesta" => "Se actualizo correctamente la informacion del usuario.","error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}
		$this->response($respuesta);
	}

	public function updatePassword_post(){
		$this->load->model('UsuarioM');
		//$id = $this->session->id;
		$id = 3;
		$passCurrently = $this->input->post('passCurrently');
		$array = $this->UsuarioM->verifyPassCurrently($id,$passCurrently);
		$resultVerify = $array->result_array();
		if(!empty($resultVerify)){
			$passNew = $this->input->post('passNew');
			$result = $this->UsuarioM->changePass($id,$passNew);
			if($result != false){
				$respuesta = array("respuesta" => "Se cambio la contraseña correctamente","error" => 0);
			}else{
				$respuesta = array("respuesta" => "Error al cambiar la contraseña", "error" => 11);
			}
		}else if(empty($resultVerify)){
			$respuesta = array("respuesta" => "Error la contraseña actual no coincide", "error" => 11);
		}else{
			$respuesta = array("respuesta" => "Error al ejecutar su operación", "error" => 12);
		}
		$this->response($respuesta);
	}

	public function createAbogado_post(){

		$this->load->model('UsuarioM');



			 $config['upload_path']          = './public/uploads/';
			 $config['allowed_types']        = 'gif|jpg|png|pdf';
			 $config['max_size']             = 4096;
			 $config['max_width']            = 4096;
			 $config['max_height']           = 4096;

			 $this->load->library('upload', $config);



			 $data1 = array();
			 $data2 = array();
			 $data3 = array();
			 //$estado = $this->input->post(botonSubmit3,true);
			 $estado = 1;

			 if($estado){
				 $foto = $this->upload->do_upload('fotoA');

				 if ($foto) {
				 	// code...

						$data1 = array('upload_data' => $this->upload->data());
						$cedula = $this->upload->do_upload('cdpro');

						if ($cedula) {
							// code...
								$data2 = array('upload_data' => $this->upload->data());
								$curriculum = $this->upload->do_upload('cv');

								if ($curriculum) {
									// code...
										$data3 = array('upload_data' => $this->upload->data());

										$y = $data1['upload_data']['full_path'];
										$y = substr($y,35);

										$y2 = $data2['upload_data']['full_path'];
										$y2 = substr($y2,35);

										$y3 = $data3['upload_data']['full_path'];
										$y3 = substr($y3,35);

										$datam = array (
											'nombre' => $this->input->post('nombreA',true),
											'apellidoP' => $this->input->post('appatA',true),
											'apellidoM' => $this->input->post('apmatA',true),
											'email' => $this->input->post('emailA',true),
											'pass' => $this->input->post('passA',true),
											'fechaNac' => $this->input->post('fechanA',true),
											'estado' => 0,
											'imagen' => $y,
											'rol_id' => 2
										);

										$id = $this->UsuarioM->create_user($datam);

										$cat2 = $this->input->post('cat2',true);

										if($cat2 == 0){
											$cat2 == null;
										}

										$cat3 = $this->input->post('cat3',true);

										if($cat3 == 0){
											$cat3 == null;
										}

										$datab = array (

											'cuentaBanco' => $this->input->post('cuentaB',true),
											'costoBase' => $this->input->post('costoB',true),
											'cedula' => $y2,
											'curriculum' => $y3,
											'categoria1' => $this->input->post('cat1',true),
											'categoria2' => $cat2,
											'categoria3' => $cat3,
											'usuario_id' => $id
										);

											$id = $this->UsuarioM->crearAbogado($datab);


										echo "<script>
		 								alert('Gracias por registrarse, espere a que sea activado por el administrador');
		 							 </script>";

		 							 redirect('index.php', 'refresh');

								}
								else {
									// code...
									$error = array('error' => $this->upload->display_errors());

								 echo "<script>
									alert(' Error en CV " . json_encode($error) . "');
								 </script>";

								 redirect('Usuario/login_post', 'refresh');
								}

						}
						else {
							// code...
							$error = array('error' => $this->upload->display_errors());

						 echo "<script>
							alert(' Error en cedula " . json_encode($error) . "');
						 </script>";

						 redirect('Usuario/login_post', 'refresh');
						}

				 }
				 else {
				 	// code...
					$error = array('error' => $this->upload->display_errors());

				 echo "<script>
					alert(' Error en foto " . json_encode($error) . "');
				 </script>";

				redirect('Usuario/login_post', 'refresh');
				 }

			 }



	}

	public function createClient_post(){

		$this->load->model('UsuarioM');



			 $config['upload_path']          = './public/uploads/';
			 $config['allowed_types']        = 'gif|jpg|png|pdf';
			 $config['max_size']             = 4096;
			 $config['max_width']            = 4096;
			 $config['max_height']           = 4096;

			 $this->load->library('upload', $config);



			 $data1 = array();
			 $data2 = array();
			 $data3 = array();
			 //$estado = $this->input->post(botonSubmit3,true);
			 $estado = 1;

			 if($estado){
				 $foto = $this->upload->do_upload('fotoC');

				 if ($foto) {
				 	// code...

						$data1 = array('upload_data' => $this->upload->data());


										$y = $data1['upload_data']['full_path'];
										$y = substr($y,35);



										$datam = array (
											'nombre' => $this->input->post('nombreC',true),
											'apellidoP' => $this->input->post('appatC',true),
											'apellidoM' => $this->input->post('apmatC',true),
											'email' => $this->input->post('emailC',true),
											'pass' => $this->input->post('passC',true),
											'fechaNac' => $this->input->post('fechanC',true),
											'estado' => 1,
											'imagen' => $y,
											'rol_id' => 1
										);

										$id = $this->UsuarioM->create_user($datam);



										$datab = array (
											'metodoPago' => $this->input->post('pago',true),
											'usuario_id' => $id

										);

											$id = $this->UsuarioM->crearCliente($datab);


										echo "<script>
		 								alert('Gracias por registrarse, espere a que sea activado por el administrador');
		 							 </script>";

		 							 redirect('index.php', 'refresh');

				 }


				 else {
				 	// code...
					$error = array('error' => $this->upload->display_errors());

				 echo "<script>
					alert(' Error en foto " . json_encode($error) . "');
				 </script>";

				redirect('Usuario/login_post', 'refresh');
				 }

			 }



	}



	//=================FUNCIONES DE TIPO GET=================//
	public function abogadoID_get(){
		$id = $this->input->get('id');
        $this->load->model('UsuarioM');
        $array = $this->UsuarioM->getAbogadoID($id);
        $result = $array->result_array();
		if(!empty($result)){
			$respuesta = array("respuesta" => "Se obtuvieron los datos correctamente.","resultado" => $result,"error" => 0);
		}else if(empty($result)){
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}else{
			$respuesta = array("respuesta" => "Error al ejecutar su operación", "error" => 12);
		}
		$this->response($respuesta);
	}

	public function clienteID_get(){
		$id = $this->input->get('id');
        $this->load->model('UsuarioM');
        $array = $this->UsuarioM->getClientID($id);
        $result = $array->result_array();
		if(!empty($result)){
			$respuesta = array("respuesta" => "Se obtuvieron los datos correctamente.","resultado" => $result,"error" => 0);
		}else if(empty($result)){
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}else{
			$respuesta = array("respuesta" => "Error al ejecutar su operación", "error" => 12);
		}
		$this->response($respuesta);
	}
}
?>
