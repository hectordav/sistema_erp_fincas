<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Tipo_gasto extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('tipo_gasto/grilla');
	}
	public function grilla(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_tipo_gasto');
		$crud->set_subject('Tipo de Gasto');
		$crud->set_language('spanish');
		$crud->display_as('descripcion','Tipo de Gasto');
		$crud->columns('descripcion');
		$crud->required_fields('descripcion');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('tipo_gasto/tipo_gasto',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
		
	}

}