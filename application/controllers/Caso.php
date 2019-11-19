<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Caso extends CI_Controller{



	public function test_get(){
        $this->load->model('CasoM');
        //$array = $this->UsuarioM->getUsuarioID();
        //$result = $array->result_array();
		//$this->response($result);
	}

    //=================FUNCIONES DE TIPO POST=================//

    public function mostrarDatos(){
        //$email = $this->input->post('email');
        //$id = $this->CasoM->get_client_id_by_email($email);
        //$edo = 1;
        $this->load->model('CasoM');
        $tipo = $this->session->tipo;
        $data = $this->session->id;




		$resultId = $this->CasoM->get_casos($data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}

    public function mostrarCaso(){
        //$email = $this->input->post('email');
        //$id = $this->CasoM->get_client_id_by_email($email);
        //$edo = 1;
        $this->load->model('CasoM');

        $data = $this->session->id;


		$resultId = $this->CasoM->get_casos($data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}


	public function createCaso_post(){
        $this->load->model('CasoM');
        $email = $this->input->post('email');
        $id = $this->CasoM->get_client_id_by_email($email);
        $edo = 0;

		$data = array(
            'abogado_id' => $this->session->id,
            'cliente_id' => $id[0]['id_usuario'],
            'categoria_id' => $this->input->post('categoria'),
            'titulo' => $this->input->post('titulo'),
            'descripcion' => $this->input->post('descripcion'),
            'estado' => $edo
        );
		$resultId = $this->CasoM->create_caso($data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se creo el abogado exitosamente","id:" => $resultId,"error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error al crear cliente", "error" => 11);
		}
		$this->response($respuesta);
	}

	//Funcion que regresa la informacion de un caso por su ID
	public function casoID_get(){
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

	public function updateCasoID_post(){
        $this->load->model('CasoM');
		$email = $this->input->post('email');
		$id = $this->input->post('id');
		$id = $this->CasoM->get_client_id_by_email($email);
		$data = array(
			'cliente_id' => $id_cliente[0]['id_usuario'],
			//'cliente_id' => 1,
            'categoria_id' => $this->input->post('categoria'),
            'titulo' => $this->input->post('titulo'),
            'descripcion' => $this->input->post('descripcion')
        );
		$resultId = $this->CasoM->updateCaso($id,$data);
		if($resultId != false){
			$respuesta = array("respuesta" => "Se actualizo correctamente el caso.","error" => 0);
		}else{
			$respuesta = array("respuesta" => "Error compruebe su informacion", "error" => 11);
		}
		$this->response($respuesta);
	}

	public function casoAll_get(){
		$this->load->model('CasoM');
		$result = $this->CasoM->get_caso_All();
		if(!empty($result)){
			$respuesta = array("respuesta" => "Consulta exitosa","result" => $result,"error" => 0);
		}else if(empty($result)){
			$respuesta = array("respuesta" => "No hay informacion", "error" => 13);
		}else{
			$respuesta = array("respuesta" => "Error al ejecutar su operación", "error" => 12);
		}
		$this->response($respuesta);
	}

}
?>
