<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Predio extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('predio/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_predio');
			$crud->set_subject('Predio');
			$crud->set_language('spanish');
			$crud->display_as('descripcion','Predio');
			$crud->columns('descripcion');
			$crud->required_fields('descripcion');
		
			if ($data_usuario['id_nivel']==1) {
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('predio/predio',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				$crud->unset_edit();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('predio/predio',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}
		}else{
				redirect('login','refresh');
			}
		
	}

}