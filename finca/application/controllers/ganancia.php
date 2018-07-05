<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ganancia extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('ganancia/grilla');
	}
	public function grilla(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_gasto');
		$crud->set_subject('ganancia');
		$crud->set_language('spanish');
		$crud->display_as('descripcion','ganancia');
		$crud->columns('descripcion');
		$crud->required_fields('descripcion');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('ganancia/ganancia');
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function ganancia_proforma_pago(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_gasto');
		$crud->set_subject('ganancia');
		$crud->set_language('spanish');
		$crud->display_as('descripcion','ganancia');
		$crud->columns('descripcion');
		$crud->required_fields('descripcion');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('ganancia/ganancia');
		$this->load->view('../../assets/inc/footer_common',$output);
	}


}