<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ingreso extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('ingreso/grilla');
	}
	public function grilla(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_ingreso');
		$crud->set_subject('Ingresos');
		$crud->set_language('spanish');
		$crud->display_as('descripcion','Descripcion');
		$crud->display_as('total','Total');
		$crud->display_as('fecha','Fecha');
		$crud->columns('descripcion','total','fecha');
		$crud->required_fields('descripcion','total','fecha');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('ingreso/ingreso',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}

}