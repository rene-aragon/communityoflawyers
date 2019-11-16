<?php
defined('BASEPATH') OR exit('No direct script access allowed');

header('Access-Control-Allow-Origin: *');
header("Content-Type: multipart/form-data ; charset=utf-8");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


use Restserver\libraries\REST_Controller;
use Restserver\libraries\REST_Controller_Definitions;

require APPPATH . '/libraries/REST_Controller_Definitions.php';
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';




class Usuario extends CI_Controller{
	//Quitar despues de testear================================
	// public function __construct(){
	//  parent::__construct();

	 
	//  header( 'X-Content-Type-Options: nosniff' );
	//  header( 'X-Frame-Options: SAMEORIGIN' );
	//  header( 'X-XSS-Protection: 1; mode=block' );

 	// }



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

	//Revisar si se quita
	use REST_Controller {
		REST_Controller::__construct as private __resTraitConstruct;
    }


	public function login_post(){
		$this->load->model('UsuarioM');
		$this->load->view('ingreso/login');
		$estado = $this->input->post('botonSubmit',true);
		if(isset($estado)){

					$email = $this->input->post('email');
					$contra = $this->input->post('pass');

					$result = $this->UsuarioM->validatedLogin($email,$contra);
					//$result = $result->result_array();
					if(!empty($result)){
						//$respuesta = array("respuesta" => "Inicio de sesion exitoso","error" => 0);

						$result = $this->UsuarioM->getUsuarioID();
						$result = $result->result_array();
						//$result = $result->result_array();

						echo('<script>

							console.log('.json_encode($result).');
							alert("Inicio de sesion exitoso");

						</script>');
						session_start();
						$_SESSION['id'] = $result[0]['id_usuario'];
						$_SESSION['email'] = $result[0]['email'];
						$_SESSION['tipo'] = $result[0]['rol_id'];
					}else if(empty($result)){
						echo('<script>
							alert("Inicio de sesion fallido");
							console.log('.json_encode($result).');
						</script>');
					}
					//$this->response($respuesta);
					switch ($_SESSION['tipo']) {
						case 2:
							// code...


							redirect('Abogado/welcome', 'refresh');
						break;

						case 3:
							// code...

							redirect('Cliente/welcome', 'refresh');
						break;

						default:
							// code...

							redirect('Administrador/welcome', 'refresh');
						break;



						}

		}

	}

	public function updateInfoUser_post(){
		$this->load->model('UsuarioM');
		//$id = $this->session->id;	
		$id = 3;
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

	public function createAbogado_post(){
		$nombre = $this->input->post('nom');
		$apellidoP = $this->input->post('apeP');
		$apellidoM = $this->input->post('apeM');
		$email = $this->input->post('email');
		$pass = $this->input->post('contra');
		$fechaNac = $this->input->post('fechaN');
		$cuentaBanco = $this->input->post('cuentBanc');
		$costoBase = $this->input->post('costBas');
		$descripcion = $this->input->post('descri');
		$cedulaPro = $this->input->post('ceduPro');
		$this->load->model('UsuarioM');
		$resultId = $this->UsuarioM->createAbo($nombre,$apellidoP,$apellidoM,$email,$pass,$fechaNac,$cuentaBanco,$costoBase,$descripcion,$cedulaPro);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}

	public function createClient_post(){
		$nombre = $this->input->post('nom');
		$apellidoP = $this->input->post('apeP');
		$apellidoM = $this->input->post('apeM');
		$email = $this->input->post('email');
		$pass = $this->input->post('contra');
		$fechaNac = $this->input->post('fechaN');
		$metodoPago = $this->input->post('metoPago');
		$this->load->model('UsuarioM');
		$resultId = $this->UsuarioM->createCli($nombre,$apellidoP,$apellidoM,$email,$pass,$fechaNac,$metodoPago);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el cliente exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
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
