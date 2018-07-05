<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Finca extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('finca_model');
			$this->load->model('empleado_model');
			$this->load->model('seguro_model');
			$this->load->library('html2pdf');
		  $this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('finca/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id' =>$this->session->userdata('id'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_finca');
		$crud->set_subject('finca');
		$crud->set_language('spanish');
		$crud->display_as('codigo','Codigo');
		$crud->display_as('nombre','Finca');
		$crud->display_as('dni','Dni');
		$crud->display_as('direccion','Direccion');
		$crud->display_as('telf','Telf');
		$crud->display_as('email','Email');
		$crud->columns('codigo','nombre','dni','direccion','telf','email');
		$crud->required_fields('codigo','nombre','dni','direccion','telf','email');
		if ($data_usuario['id_nivel']==1) {
			$crud->add_action('Ver Empleados Asignados', '', '','fa fa-user',array($this,'fn_ver_empleado'));
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('finca/finca',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}else{
			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_n3');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('finca/finca',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}
		}else{
			redirect('login','refresh');
		}
	
	
	}
	function fn_ver_empleado($primary_key , $row){
		return site_url('finca/ver_empleados').'/'.$row->id;
		}
	public function ver_empleados(){
		$id_finca['id_finca']=$this->uri->segment(3);
			if ($id_finca['id_finca']) {
				$this->session->set_userdata($id_finca);
				}
		$id_finca=$this->session->userdata('id_finca');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_finca');
		$output = $crud->render();
		$data = array('empleado' =>$this->empleado_model->get_empleado_id_finca($id_finca),
		'finca'=>$this->finca_model->get_finca_id_finca($id_finca),
		'seguro'=>$this->seguro_model->get_seguro());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('finca/ver_empleados',$data);
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function actualizar_empleado(){
		$id_empleado=$this->input->post('txt_id_empleado','true');
		$id_seguro=$this->input->post('id_seguro','true');
		$cedula=$this->input->post('txt_cedula','true');
		$nombre=$this->input->post('txt_nombre','true');
		$direccion=$this->input->post('txt_direccion','true');
		$telf=$this->input->post('txt_telf','true');
		$this->empleado_model->actualizar_empleado($id_empleado,$id_seguro,$cedula,$nombre,$direccion,$telf);
		$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('finca/ver_empleados','refresh');
	}
	public function borrar_empleado(){
		$id_empleado=$this->uri->segment(3);
		$this->empleado_model->borrar_empleado($id_empleado);
		redirect('finca/ver_empleados','refresh');
	}
	public function exportar_pdf(){
		$id_finca['id_finca']=$this->uri->segment(3);
				if ($id_finca['id_finca']) {
					$this->session->set_userdata($id_finca);
					}
		$id_finca=$this->session->userdata('id_finca');
	$data = array('empleado' =>$this->empleado_model->get_empleado_id_finca($id_finca),
		'finca'=>$this->finca_model->get_finca_id_finca($id_finca),
		'seguro'=>$this->seguro_model->get_seguro());
    $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$crud->set_subject('medida');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('finca/imprimir_empleados',$data);
		/*si quiero la hoja en horizonal*/
		$html = $this->output->get_output();
		$this->dompdf->set_paper('letter','landscape');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("medidas.pdf",array('Attachment'=>0));

	}


}