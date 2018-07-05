<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proveedor extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
	}
	public function index(){
			redirect('proveedor/grilla');
	}
	public function grilla(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_proveedor');
		$crud->set_subject('proveedor');
		$crud->set_language('spanish');
		$crud->display_as('nombre','Proveedor');
		$crud->display_as('dni','DNI');
		$crud->display_as('direccion','Direccion');
		$crud->display_as('telf','Telf');
		$crud->display_as('email','Email');
		$crud->columns('nombre','dni','direccion','telf','email');
		$crud->required_fields('nombre','dni','direccion','telf','email');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('proveedor/proveedor',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}

	

}