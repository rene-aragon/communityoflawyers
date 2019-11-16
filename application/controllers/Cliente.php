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
class Cliente extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

  public function welcome(){
  //  $this->load->model('Admin_model');
		$this->load->view('ingreso/index');

	}


	public function index()
	{
		$this->load->view('welcome_message');
	}

	use REST_Controller {
		REST_Controller::__construct as private __resTraitConstruct;
    }

	//=================FUNCIONES DE TIPO POST=================//
	public function updateMyInfoA_post(){
        $this->load->model('ClienteM');
		$id = $this->session->id;	
		$data = array(
			'metodoPago' => $this->input->post('metodoPago')
        );
		$resultId = $this->ClienteM->updateCliente($id,$data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se actualizo correctamente el cliente.","error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}
		$this->response($respuesta);
	}

	//=================FUNCIONES DE TIPO GET=================//
	public function myInfo_get(){
		$this->load->model('ClienteM');
		$id = $this->session->id;
		$result = $this->ClienteM->get_Info($id);
		if(!empty($result)){
			$respuesta = array("respuesta" => "Consulta exitosa","result" => $result,"error" => 0);
		}else if(empty($result)){
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}else{
			$respuesta = array("respuesta" => "Error al ejecutar su operación", "error" => 12);
		}
		$this->response($respuesta);
	}

	//=================FUNCIONES QUE PUEDE REALIZAR ESTA CLASE=================//
	

}
