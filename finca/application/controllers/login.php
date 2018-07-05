<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->helper('security');
			$this->load->model('usuario_model');
	}
	public function index(){
	$crud = new grocery_CRUD();
	$crud->set_theme('bootstrap');
	$crud->set_table('t_usuario');
	$output = $crud->render();
	/*llama a la funcion iniciar sesion facebook para tomar los datos*/
	$this->load->view('../../assets/inc/head_common_login',$output);
	$this->load->view('login/login');
	$this->load->view('../../assets/inc/footer_common_login',$output);
}
  public function login_manual(){
		$this->form_validation->set_rules('txt_login', 'Login', 'required|required');
		$this->form_validation->set_rules('txt_password', 'Clave', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
		/*lo regresa al add porque no furula*/
			$this->index();
		}else{
			$login=$this->input->post('txt_login','true');
			$clave=do_hash($this->input->post('txt_password','true'));
			$usuario = $this->usuario_model->login_manual($login, $clave);
			if ($usuario) {
			foreach ($usuario as $key) {
			$usuario_data = array(
       'id' => $key->id_usuario,
       'id_nivel' => $key->id_nivel,
       'nombre' => $key->nombre,
       'login'=>$key->login,
       'logueado' => TRUE
    );

		}
 		$this->session->set_userdata($usuario_data);
 		redirect('login/logueado','refresh');
 			}else{
 			$this->session->set_flashdata('alerta', 'Login o Clave invalidos');
 					redirect('login/index','refresh');
 				}
			}
 	}
 		public function logueado(){
		if($this->session->userdata('logueado')){
			$data_usuario = array('id_usuario' =>$this->session->userdata('id'),
		'nombre'=>$this->session->userdata('nombre'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
			redirect('principal/home','refresh');
		
		}else{
			redirect('login','refresh');
		}
	}
	public function cerrar_sesion(){
    $usuario_data = array('logueado' => FALSE);
     $this->session->sess_destroy();
      redirect('login');
   }

}