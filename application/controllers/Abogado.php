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
class Abogado extends CI_Controller {

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
        $this->load->model('AbogadoM');
		$id = $this->session->id;	
		$data = array(
			'cuentaBanco' => $this->input->post('cuentaBanco'),
            'costoBase' => $this->input->post('costoBase'),
            'descripcion' => $this->input->post('descripcion'),
            'cedulaPro' => $this->input->post('cedulaPro')
        );
		$resultId = $this->AbogadoM->updateAbogado($id,$data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se actualizo correctamente el abogado.","error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}
		$this->response($respuesta);
	}

	//=================FUNCIONES DE TIPO GET=================//
	public function myInfo_get(){
		$this->load->model('CasoM');
		$id = $this->input->get('id');
		$result = $this->CasoM->get_caso_ByID($id);
		if(!empty($result)){
			$respuesta = array("respuesta" => "Consulta exitosa","result" => $result,"error" => 0);
		}else if(empty($result)){
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}else{
			$respuesta = array("respuesta" => "Error al ejecutar su operación", "error" => 12);
		}
		$this->response($respuesta);
	}
}
