 <?php
defined('BASEPATH') OR exit('No direct script access allowed');




class Abogado extends CI_Controller {

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





	//=================FUNCIONES DE TIPO POST=================//

  public function welcome(){
  //  $this->load->model('Admin_model');

    $this->load->view('abogado/content');


  }


  public function index()
  {

      $this->load->model('AbogadoM');
      $id = $_SESSION['id'];
      $data1=$this->AbogadoM->get_casos_pendientes($id);
      $data2=$this->AbogadoM->get_casos_activos($id);
      $data3=$this->AbogadoM->get_casos_rechazados($id);
      $data4=$this->AbogadoM->get_casos_completos($id);
      $data  = array('data1' => $data1,
                      'data2' => $data2,
                      'data3' => $data3,
                      'data4' => $data4,
      );

      $this->load->view('abogado/content',$data);
  }

  public function aceptados()
  {

      $this->load->model('AbogadoM');
      $id = $_SESSION['id'];

      $data2=$this->AbogadoM->get_casos_activos($id);

      $data  = array('data1' => $data2,

      );

      $this->load->view('abogado/aceptados',$data);
  }

  public function rechazados()
  {

      $this->load->model('AbogadoM');
      $id = $_SESSION['id'];

      $data2=$this->AbogadoM->get_casos_rechazados($id);
      $data  = array('data1' => $data2,
      );

      $this->load->view('abogado/rechazados',$data);
  }


  public function completados()
  {

      $this->load->model('AbogadoM');
      $id = $_SESSION['id'];

      $data2=$this->AbogadoM->get_casos_completos($id);
      $data  = array('data1' => $data2,
      );

      $this->load->view('abogado/completados',$data);
  }

  public function aceptar_caso($id){
    $this->load->model('CasoM');
    $this->CasoM->aceptar_caso($id);
    redirect('Abogado/aceptados', 'refresh');
  }

  public function rechazar_caso($id){
    $this->load->model('CasoM');
    $this->CasoM->rechazar_caso($id);
    redirect('Abogado/rechazados', 'refresh');
  }

  public function completar_caso($id){
    $this->load->model('CasoM');
    $this->CasoM->completar_caso($id);
    redirect('Abogado/completados', 'refresh');
  }



  public function perfil(){

  }

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
		$this->load->model('AbogadoM');
		$id = $this->session->id;
		$result = $this->AbogadoM->get_Info($id);
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
