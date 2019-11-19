<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

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

   public function index()
   {

       $this->load->model('UsuarioM');
       $id = $_SESSION['id'];
       $data1=$this->UsuarioM->get_abogados_inactivos($id);
       if($data1){

         foreach ($data1 as &$k) {
           // code...
           $datax =$this->UsuarioM->get_categorias_id($k['cat1']) ;
           $k['cat1']= $datax[0]['nombre'];
           $datax =$this->UsuarioM->get_categorias_id($k['cat2']) ;
           $k['cat2']= $datax[0]['nombre'];
           $datax =$this->UsuarioM->get_categorias_id($k['cat3']) ;
           $k['cat3']= $datax[0]['nombre'];
         }

       }


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


       $data3=$this->UsuarioM->get_clientes($id);
       $data4=$this->UsuarioM->get_admin($id);
       $data  = array('data1' => $data1,
                       'data2' => $data2,
                       'data3' => $data3,
                       'data4' => $data4,
       );

       $this->load->view('admin/content',$data);
   }




  public function aprobar_usuario($id){
    $this->load->model('UsuarioM');
    $this->UsuarioM->aprobar_usuario($id);
    redirect('Administrador/index', 'refresh');
  }

  public function delete_usuario($id){
    $this->load->model('UsuarioM');
    $this->UsuarioM->delete_usuario($id);
    redirect('Administrador/index', 'refresh');
  }
}
