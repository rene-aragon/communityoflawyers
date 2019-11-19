<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Cliente extends CI_Controller {

  public function __construct(){
	 parent::__construct();


	 header( 'X-Content-Type-Options: nosniff' );
	 header( 'X-Frame-Options: SAMEORIGIN' );
	 header( 'X-XSS-Protection: 1; mode=block' );

 	}

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
    $this->load->model('UsuarioM');

     $id = $_SESSION['id'];

    $data2=$this->UsuarioM->get_abogados_activos($id);

    if($data2){

      foreach ($data2 as &$k) {
        // code...
        $datax =$this->UsuarioM->get_categorias_id($k['cat1']) ;
        $k['cat1']= $datax[0]['nombre'];
        $datax =$this->UsuarioM->get_categorias_id($k['cat2']) ;
        $k['cat2']= $datax[0]['nombre'];
        $datax =$this->UsuarioM->get_categorias_id($k['cat3']) ;
        $k['cat3']= $datax[0]['nombre'];
      }

    }

    $data   = array('data2' => $data2 );

		$this->load->view('cliente/content',$data);

	}

  public function contactar_abogado($id){
    $this->load->model('UsuarioM');
    $data2=$this->UsuarioM->contactar_abogado($id);
    if($data2){

      foreach ($data2 as &$k) {
        // code...
        $datax =$this->UsuarioM->get_categorias_id($k['cat1']) ;
        $k['cat1']= $datax[0]['nombre'];
        $datax =$this->UsuarioM->get_categorias_id($k['cat2']) ;
        $k['cat2']= $datax[0]['nombre'];
        $datax =$this->UsuarioM->get_categorias_id($k['cat3']) ;
        $k['cat3']= $datax[0]['nombre'];
      }

    }
    $data1   = array('data' => $data2 );
    $this->load->view('cliente/contacto', $data1);
  }




	public function index()
	{
		$this->load->view('welcome_message');
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
?>
