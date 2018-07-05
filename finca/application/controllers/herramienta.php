<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Herramienta extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('herramienta_model');
	}
	public function index(){
			redirect('herramienta/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_herramienta');
			$crud->set_subject('Herramienta');
			$crud->set_language('spanish');
			$crud->display_as('descripcion','Herramienta');
			$crud->display_as('cantidad','Cantidad');
			$crud->columns('descripcion','cantidad');
			$crud->required_fields('descripcion','cantidad');
			if ($data_usuario['id_nivel']==1) {
				$crud->add_action('Agregar Cantidad', '', '','fa fa-plus',array($this,'fn_add_cantidad'));
				$crud->unset_edit();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('herramienta/herramienta',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}else{
			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();
			$crud->unset_read();
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_n3');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('herramienta/herramienta',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
			}
			
		}else{
			redirect('login','refresh');
		}
		
	}
	function fn_add_cantidad($primary_key , $row){
		return site_url('herramienta/add_cantidad').'/'.$row->id;
		}
	public function add_cantidad(){
		$id_herramienta['id_herramienta']=$this->uri->segment(3);
			if ($id_herramienta['id_herramienta']) {
				$this->session->set_userdata($id_herramienta);
				}
		$id_herramienta=$this->session->userdata('id_herramienta');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_herramienta');
		$output = $crud->render();
		$data = array('herramienta' =>$this->herramienta_model->get_herramienta_id($id_herramienta));
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('herramienta/add_cantidad',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function guardar_agregar_cantidad(){
		$id_herramienta=$this->input->post('txt_id_herramienta','true');
		$cantidad_anterior=$this->input->post('txt_cantidad_anterior','true');
		$cantidad_nueva=$this->input->post('txt_cantidad_nueva','true');
		$suma_cantidad=$cantidad_anterior+$cantidad_nueva;
		$this->herramienta_model->actualizar_herramienta_cantidad($id_herramienta,$suma_cantidad);
		$this->session->set_flashdata('alerta', 'Se ha sumado la cantidad correctamente');
				redirect('herramienta/grilla','refresh');
	}


}