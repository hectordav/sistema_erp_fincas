<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->helper('security');
			$this->load->model('usuario_model');
			$this->load->model('nivel_model');
	}
	public function index(){
			redirect('usuario/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']=='1') {
				$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_usuario');
			$crud->set_relation('id_nivel','t_nivel','descripcion');
			$crud->set_subject('Usuario');
			$crud->set_language('spanish');
			$crud->display_as('nombre','Nombre');
			$crud->display_as('login','Login');
			$crud->display_as('id_nivel','Nivel');
			$crud->columns('id_nivel','nombre','login');
			$crud->required_fields('id_nivel','nombre','login');
			$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_editar'));
			$crud->unset_edit();
			$output = $crud->render();
			$state = $crud->getState();
			if($state == 'add'){
				redirect('usuario/add');
			}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('usuario/usuario',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				redirect('login','refresh');
			}
			
			}else{
				redirect('login','refresh');
			}
	}
	function fn_editar($primary_key , $row){
		return site_url('usuario/editar').'/'.$row->id;
		}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_usuario');
		$output = $crud->render();
		$data = array('nivel' =>$this->nivel_model->get_nivel());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('usuario/add',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function editar(){
		$id_usuario['id_usuario']=$this->uri->segment(3);
			if ($id_usuario['id_usuario']) {
				$this->session->set_userdata($id_usuario);
				}
		$id_usuario=$this->session->userdata('id_usuario');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_usuario');
		$output = $crud->render();
		$data = array('usuario' =>$this->usuario_model->get_usuario_id_usuario($id_usuario),
			'nivel' =>$this->nivel_model->get_nivel());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('usuario/editar_usuario',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function guardar_usuario(){
				$this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|required');
				$this->form_validation->set_rules('txt_login', 'Login', 'required|required');
				$this->form_validation->set_rules('id_nivel', 'Nivel', 'required|callback_check_default');
				$this->form_validation->set_rules('txt_clave_1', 'Clave', 'required|required');
				$this->form_validation->set_rules('txt_clave_2', 'Repita su Clave', 'required|required');
				$this->form_validation->set_rules('txt_clave_2', ' Confirmacion de Clave', 'required|matches[txt_clave_1]');
				$this->form_validation->set_message("required","El campo %s es Requerido");
				$this->form_validation->set_message("valid_email","El campo %s Debe contener un Email");
				$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
				$this->form_validation->set_message("matches","Las Claves no coinciden");
				if ($this->form_validation->run()===false) {
					/*lo regresa al add porque no furula*/
						$this->add();
				}else{
				$id_nivel=$this->input->post('id_nivel','true');
				$nombre=$this->input->post('txt_nombre','true');
				$login=$this->input->post('txt_login','true');
				$clave_2=do_hash($this->input->post('txt_clave_2','true'));
				$this->usuario_model->guardar_usuario($id_nivel,$nombre,$login,$clave_2);
				$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('usuario/grilla','refresh');
				}
	}
	public function actualizar_usuario(){
		$this->form_validation->set_rules('txt_nombre', 'Nombre', 'required|required');
		$this->form_validation->set_rules('txt_login', 'Login', 'required|required');
		$this->form_validation->set_rules('id_nivel', 'Nivel', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_clave_1', 'Clave', 'required|required');
		$this->form_validation->set_rules('txt_clave_2', 'Repita su Clave', 'required|required');
		$this->form_validation->set_rules('txt_clave_2', ' Confirmacion de Clave', 'required|matches[txt_clave_1]');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("valid_email","El campo %s Debe contener un Email");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		$this->form_validation->set_message("matches","Las Claves no coinciden");
				if ($this->form_validation->run()===false) {
					/*lo regresa al add porque no furula*/
						$this->editar();
				}else{
				$id_usuario=$this->input->post('txt_id_usuario','true');
				$id_nivel=$this->input->post('id_nivel','true');
				$nombre=$this->input->post('txt_nombre','true');
				$login=$this->input->post('txt_login','true');
				$clave_2=do_hash($this->input->post('txt_clave_2','true'));
				$this->usuario_model->actualizar_usuario($id_usuario,$id_nivel,$nombre,$login,$clave_2);
				$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('usuario/grilla','refresh');
				}
	}

}