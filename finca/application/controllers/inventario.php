<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inventario extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('empleado_model');
			$this->load->model('inventario_model');
			$this->load->model('herramienta_model');
			$this->load->library('html2pdf');
		  $this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('inventario/grilla');
	}
	public function grilla(){
			if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_inventario');
			$crud->set_subject('Inventario');
			$crud->set_relation('id_empleado','t_empleado','nombre');
			$crud->set_language('spanish');
			$crud->display_as('id_empleado','Empleado');
			$crud->display_as('observacion','Observaciones');
			$crud->display_as('fecha','Fecha');
			$crud->columns('id_empleado','observacion','fecha');
			if ($data_usuario['id_nivel']=='1') {
		$crud->add_action('Incluir Herramientas a Inventario', '', '','fa fa-plus',array($this,'fn_add_cantidad'));
		$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
		$crud->required_fields('id_empleado','observacion','fecha');
		$crud->unset_edit();
		$crud->unset_read();
		$output = $crud->render();
		$state = $crud->getState();
			if($state == 'add'){
			redirect('inventario/add');
			}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario/inventario',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
			}else{
		$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
		$crud->required_fields('id_empleado','observacion','fecha');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_read();
		$crud->unset_delete();
		$output = $crud->render();
		$state = $crud->getState();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral_n3');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario/inventario',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
			}
			}else{
				redirect('login','refresh');
			}
	
		
	}
	function fn_add_cantidad($primary_key , $row){
		return site_url('inventario/add_cantidad').'/'.$row->id;
		}
	function fn_ver($primary_key , $row){
		return site_url('inventario/ver').'/'.$row->id;
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_inventario');
		$output = $crud->render();
		$data = array('empleado' =>$this->empleado_model->get_empleado());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario/add',$data);
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function ver(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			if ($data_usuario['id_nivel']=='1') {
				$id_inventario['id_inventario']=$this->uri->segment(3);
				if ($id_inventario['id_inventario']) {
					$this->session->set_userdata($id_inventario);
					}
				$id_inventario=$this->session->userdata('id_inventario');
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_inventario');
				$output = $crud->render();
				$data = array('inventario' =>$this->inventario_model->get_inventario_id_inventario($id_inventario),
					'det_inventario'=>$this->inventario_model->get_det_inventario_id_inventario($id_inventario),
					'herramienta'=>$this->herramienta_model->get_herramienta(),
					'id_nivel'=>$data_usuario['id_nivel']);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('inventario/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}else{
				$id_inventario['id_inventario']=$this->uri->segment(3);
						if ($id_inventario['id_inventario']) {
							$this->session->set_userdata($id_inventario);
							}
				$id_inventario=$this->session->userdata('id_inventario');
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_inventario');
				$output = $crud->render();
				$data = array('inventario' =>$this->inventario_model->get_inventario_id_inventario($id_inventario),
					'det_inventario'=>$this->inventario_model->get_det_inventario_id_inventario($id_inventario),
					'herramienta'=>$this->herramienta_model->get_herramienta(),
					'id_nivel'=>$data_usuario['id_nivel']);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('inventario/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
			}else{
				redirect('login','refresh');
			}
	}
	public function add_cantidad(){
		$id_inventario['id_inventario']=$this->uri->segment(3);
				if ($id_inventario['id_inventario']) {
					$this->session->set_userdata($id_inventario);
					}
		$id_inventario=$this->session->userdata('id_inventario');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_inventario');
		$output = $crud->render();
		$data = array('inventario' =>$this->inventario_model->get_inventario_id_inventario($id_inventario),
			'det_inventario'=>$this->inventario_model->get_det_inventario_id_inventario($id_inventario),
			'herramienta'=>$this->herramienta_model->get_herramienta());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('inventario/add_cantidad',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function guardar_inventario(){
		$this->form_validation->set_rules('id_empleado', 'Empleado', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_fecha', 'Fecha Inicio', 'required|required');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
			$id_empleado=$this->input->post('id_empleado','true');
			$fecha=$this->input->post('txt_fecha','true');
			$this->inventario_model->guardar_inventario($id_empleado,$fecha);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('inventario/grilla','refresh');
		}
	}
	public function guardar_det_inventario(){
		$id_inventario=$this->input->post('txt_id_inventario','true');
		$observaciones=$this->input->post('txt_observaciones','true');
		$id_herramienta=$this->input->post('id_herramienta','true');
		$cantidad=$this->input->post('txt_cantidad','true');

		$consulta=$this->herramienta_model->get_herramienta_id($id_herramienta);
		foreach ($consulta as $key) {
			$cantidad_herramienta=$key->cantidad;
		}

		$total_cantidad=$cantidad_herramienta-$cantidad;
		$this->herramienta_model->actualizar_herramienta_cantidad($id_herramienta,$total_cantidad);
		$this->inventario_model->guardar_det_inventario($id_inventario,$id_herramienta,$cantidad);
		$this->inventario_model->actualizar_observacion_inventario($id_inventario,$observaciones);
		$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('inventario/add_cantidad','refresh');
	}
	public function actualizar_det_inventario_manual(){
		$id_det_inventario=$this->input->post('txt_id_det_inventario','true');
		$id_cambio=$this->input->post('txt_id_cambio','true');
		$id_herramienta=$this->input->post('id_herramienta','true');
		$cantidad_anterior=$this->input->post('txt_cantidad_anterior','true');
		$cantidad_nueva=$this->input->post('txt_cantidad_nueva','true');
		$consulta=$this->herramienta_model->get_herramienta_id($id_herramienta);
		foreach ($consulta as $key) {
			$cantidad_herramienta=$key->cantidad;
		}
		$sumar=$cantidad_herramienta+$cantidad_anterior;
		$restar=$sumar-$cantidad_nueva;
		if ($restar<0) {
			$this->session->set_flashdata('alerta', 'Cantidad Mayor a la que Existe en Inventario de Herramientas, no se guardaron los datos');
				redirect('inventario/add_cantidad','refresh');
		}else{
				$this->herramienta_model->actualizar_herramienta_cantidad($id_herramienta,$restar);
		$this->inventario_model->actualizar_det_inventario_manual($id_det_inventario,$id_herramienta,$cantidad_nueva);
		if ($id_cambio==1) {
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('inventario/add_cantidad','refresh');
		}else{
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('inventario/ver','refresh');
		}
		
		}
	}
	public function eliminar_det_inventario(){
		$id_det_inventario=$this->uri->segment(3);
		$id_cambio=$this->uri->segment(4);
		$this->inventario_model->borrar_det_inventario($id_det_inventario);
		if ($id_cambio==1) {
			redirect('inventario/add_cantidad','refresh');
		}else{
			redirect('inventario/ver','refresh');
		}
	}
	public function exportar_pdf(){
	$id_inventario=$this->uri->segment(3);
	$data = array('inventario' =>$this->inventario_model->get_inventario_id_inventario($id_inventario),
	'det_inventario'=>$this->inventario_model->get_det_inventario_id_inventario($id_inventario));
	$crud = new grocery_CRUD();
	$crud->set_theme('bootstrap');
	$crud->set_table('t_nomina');
	$crud->set_subject('medida');
	$output = $crud->render();
	$this->load->view('../../assets/inc/head_common_add', $output);
	$this->load->view('inventario/imprimir_inventario',$data);
	/*si quiero la hoja en horizonal*/
	$html = $this->output->get_output();
	$this->dompdf->set_paper('letter','landscape');
	$this->dompdf->load_html($html);
	$this->dompdf->render();
	$this->dompdf->stream("inventario".$id_inventario.".pdf",array('Attachment'=>0));
}



}