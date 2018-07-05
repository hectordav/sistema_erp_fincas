<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Empleado extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('empleado_model');
			$this->load->model('finca_model');
	}
	public function index(){
			redirect('empleado/grilla');
	}
	public function grilla(){
			if ($this->session->userdata('logueado')) {
			$data = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_empleado');
			$crud->set_relation('id_finca','t_finca','nombre');
			$crud->set_relation('id_seguro','t_seguro','descripcion');
			$crud->set_subject('Empleado');
			$crud->set_language('spanish');
			$crud->display_as('id_seguro','Posee Seguro?');
			$crud->display_as('id_finca','Finca');
			$crud->display_as('cedula','Cedula');
			$crud->display_as('nombre','Nombre');
			$crud->display_as('direccion','Direccion');
			$crud->display_as('telf','Telf');
			$crud->columns('id_finca','id_seguro','cedula','nombre','direccion','telf');
			$crud->required_fields('id_finca','id_seguro','cedula','nombre','direccion','telf');
			if ($data['id_nivel']=='1') {
			$crud->add_action('Cambiar Finca', '', '','fa fa-arrows-h',array($this,'fn_cambio_finca'));
				$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('empleado/empleado',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
			}else{
			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_n3');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('empleado/empleado',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
			}
			}else{
				redirect('login','refresh');
			}
	}
	function fn_cambio_finca($primary_key , $row){
		return site_url('empleado/cambio_empleado_finca').'/'.$row->id;
		}
		public function cambio_empleado_finca(){
			if ($this->session->userdata('logueado')) {
				$data = array('id' =>$this->session->userdata('id'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_empleado['id_empleado']=$this->uri->segment(3);
					if ($id_empleado['id_empleado']) {
						$this->session->set_userdata($id_empleado);
						}
				$id_empleado=$this->session->userdata('id_empleado');
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_medidas');
				$output = $crud->render();
				$data = array('empleado' =>$this->empleado_model->get_empleado_cambio_finca_id_empleado($id_empleado),
				'finca'=>$this->finca_model->get_finca());
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('empleado/cambiar_empleado_finca',$data);
				$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				redirect('login','refresh');
			}	
	}
	public function guardar_cambio_finca(){
		$id_empleado=$this->input->post('txt_id_empleado','true');
		$id_finca=$this->input->post('id_finca','true');
		$this->empleado_model->actualizar_empleado_finca($id_empleado,$id_finca);
		$this->session->set_flashdata('alerta', 'Se ha Cambiado de finca correctamente');
		redirect('empleado/grilla','refresh');
	}

}