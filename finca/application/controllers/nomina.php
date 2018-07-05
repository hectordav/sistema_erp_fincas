<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Nomina extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('mes_model');
			$this->load->model('finca_model');
			$this->load->model('nomina_model');
			$this->load->model('empleado_model');
			$this->load->library('html2pdf');
			$this->load->library('dompdf_gen');
			$this->load->model('proveedor_model');
			$this->load->model('gasto_proveedor_model');
	}
	public function index(){
			redirect('nomina/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_nomina');
			$crud->set_relation('id_finca','t_finca','nombre');
			$crud->set_subject('Nomina');
			$crud->set_language('spanish');
			$crud->display_as('id_finca','Finca');
			$crud->display_as('fecha_i','Fecha Inicio');
			$crud->display_as('fecha_f','Fecha Final');
			$crud->columns('id_finca','fecha_i','fecha_f');
			$crud->required_fields('id_finca','fecha_i','fecha_f');
			if ($data_usuario['id_nivel']=='1') {
				
				$crud->add_action('Agregar Empleado', '', '','fa fa-user-plus',array($this,'fn_add_empleado'));
				$crud->add_action('Ver ', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_edit();
				$crud->unset_read();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('nomina/add');
				}
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('nomina/nomina',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				$crud->add_action('Ver ', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_edit();
				$crud->unset_read();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('nomina/nomina',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}
			}else{
				redirect('login','refresh');
			}
	
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nomina');
		$output = $crud->render();
		$data = array('mes' =>$this->mes_model->get_mes(),
			'finca'=>$this->finca_model->get_finca());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nomina/add',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function ver(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$id_nomina['id_nomina']=$this->uri->segment(3);
			if ($id_nomina['id_nomina']) {
				$this->session->set_userdata($id_nomina);
				}
			$id_nomina=$this->session->userdata('id_nomina');	
					$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_nomina');
			$output = $crud->render();
			if ($data_usuario['id_nivel']=='1') {
				$data = array('nomina' =>$this->nomina_model->get_nomina_id_nomina($id_nomina),
				'det_nomina'=>$this->nomina_model->get_det_nomina_id_nomina($id_nomina),
				'sumar_nomina'=>$this->nomina_model->sumar_det_nomina_id_nomina($id_nomina),
				'id_nivel'=>$data_usuario['id_nivel']);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('nomina/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}else{
				$data = array('nomina' =>$this->nomina_model->get_nomina_id_nomina($id_nomina),
				'det_nomina'=>$this->nomina_model->get_det_nomina_id_nomina($id_nomina),
				'sumar_nomina'=>$this->nomina_model->sumar_det_nomina_id_nomina($id_nomina),
				'id_nivel'=>$data_usuario['id_nivel']);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('nomina/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
			}else{
				redirect('login','refresh');
			}
		

		
	}
	function fn_add_empleado($primary_key , $row){
		return site_url('nomina/add_empleado_nomina').'/'.$row->id;
		}
		function fn_ver($primary_key , $row){
			return site_url('nomina/ver').'/'.$row->id;
			}
	public function add_empleado_nomina(){
		$id_nomina['id_nomina']=$this->uri->segment(3);
			if ($id_nomina['id_nomina']) {
				$this->session->set_userdata($id_nomina);
				}
		$id_nomina=$this->session->userdata('id_nomina');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_nomina');
		$output = $crud->render();
		$data = array('empleado' =>$this->empleado_model->get_empleado(),
			'nomina'=>$this->nomina_model->get_nomina_id_nomina($id_nomina),
			'det_nomina'=>$this->nomina_model->get_det_nomina_id_nomina($id_nomina),
			'proveedor'=>$this->proveedor_model->get_proveedor());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('nomina/add_empleado_nomina',$data);
		$this->load->view('../../assets/script/script_sumar_cantidad_nomina',$output);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function guardar_nomina(){
		$this->form_validation->set_rules('id_finca', 'Finca', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_fecha_i', 'Fecha i', 'required|required');
		$this->form_validation->set_rules('txt_fecha_f', 'Fecha i', 'required|required');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
			$id_finca=$this->input->post('id_finca','true');
			$fecha_i=$this->input->post('txt_fecha_i','true');
			$fecha_f=$this->input->post('txt_fecha_f','true');
			$this->nomina_model->guardar_nomina($id_finca,$fecha_i,$fecha_f);
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('nomina/grilla','refresh');
		}
	}
	public function guardar_empleado_nomina(){
		$this->form_validation->set_rules('id_empleado', 'Empleado', 'required|callback_check_default');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add_empleado_nomina();
		}else{
		$id_nomina=$this->input->post('txt_id_nomina','true');
		$id_empleado=$this->input->post('id_empleado','true');
		$id_proveedor_mercado=$this->input->post('id_proveedor_mercado','true');
		$id_proveedor_gastos_personales=$this->input->post('id_proveedor_gastos_personales','true');
		$id_proveedor_herramienta=$this->input->post('id_proveedor_herramienta','true');
		$sueldo=$this->input->post('txt_sueldo','true');
		$mercado=$this->input->post('txt_mercado','true');
		$seguro=$this->input->post('txt_seguro','true');
		$gastos_per=$this->input->post('txt_gastos_per','true');
		$servicios=$this->input->post('txt_servicios','true');
		$herramientas=$this->input->post('txt_herramientas','true');
		$prestamos=$this->input->post('txt_prestamos','true');
		$inasistencia=$this->input->post('txt_inasistencia','true');
		$pasajes=$this->input->post('txt_pasajes','true');
		$liquidacion=$this->input->post('txt_liquidacion','true');
		$otros=$this->input->post('txt_otros','true');
		$prestaciones=$this->input->post('txt_prestaciones','true');
		$incapacidad=$this->input->post('txt_incapacidad','true');
		$trabajos_varios=$this->input->post('txt_trabajo_varios','true');
		$valor_final=$this->input->post('txt_valor_final','true');
		/*gasto mercado*/
		$fecha=date('Y-m-d');
		
		$id_gasto_mercado='1';
		if ($id_proveedor_mercado!=null) {
		$this->gasto_proveedor_model->guardar_det_gasto_proveedor($id_proveedor_mercado,$id_gasto_mercado,$mercado,$fecha);
		}
		/***************/
		/*gasto personales*/
		$id_gasto_personal='2';
		if ($id_proveedor_gastos_personales!=null) {
		$this->gasto_proveedor_model->guardar_det_gasto_proveedor($id_proveedor_gastos_personales,$id_gasto_personal,$gastos_per,$fecha);
		}
		/*******************/
		/*gasto herramientas*/
		$id_gasto_herramienta='3';
		if ($id_proveedor_herramienta!=null) {
		$this->gasto_proveedor_model->guardar_det_gasto_proveedor($id_proveedor_herramienta,$id_gasto_herramienta,$herramientas,$fecha);
		}
		/********************/
		$this->nomina_model->guardar_empleado_nomina($id_nomina,$id_empleado,$sueldo,$mercado,$seguro,$gastos_per,$servicios,$herramientas,$prestamos,$inasistencia,$pasajes,$liquidacion,$otros,$prestaciones,$incapacidad,$trabajos_varios,$valor_final);
		$this->session->set_flashdata('alerta', 'Se ha actualizado el registro');
				redirect('nomina/add_empleado_nomina','refresh');
	}
}
public function actualizar_det_nomina(){
	$id_cambio=$this->input->post('txt_id_cambio','true');
	$id_det_nomina=$this->input->post('txt_id_det_nomina','true');
	$sueldo=$this->input->post('txt_sueldo','true');
	$mercado=$this->input->post('txt_mercado','true');
	$seguro=$this->input->post('txt_seguro','true');
	$gastos_per=$this->input->post('txt_gastos_per','true');
	$servicios=$this->input->post('txt_servicios','true');
	$herramientas=$this->input->post('txt_herramientas','true');
	$prestamos=$this->input->post('txt_prestamos','true');
	$inasistencia=$this->input->post('txt_inasistencia','true');
	$pasajes=$this->input->post('txt_pasajes','true');
	$valor_final=$this->input->post('txt_valor_final','true');
	$this->nomina_model->actualizar_det_nomina($id_det_nomina,$sueldo,$mercado,$seguro,$gastos_per,$servicios,$herramientas,$prestamos,$inasistencia,$pasajes,$valor_final);
	if ($id_cambio=='1') {
		$this->session->set_flashdata('alerta', 'Se ha actualizado correctamente');
    redirect('nomina/ver','refresh');
	}else{
		$this->session->set_flashdata('alerta', 'Se ha actualizado correctamente');
    redirect('nomina/add_empleado_nomina','refresh');
	}
}
public function borrar_det_nomina(){
	$id_det_nomina=$this->uri->segment(3);
	$id_cambio=$this->uri->segment(4);

	$this->nomina_model->borrar_det_nomina($id_det_nomina);
	if ($id_cambio=='1') {
		$this->session->set_flashdata('alerta', 'Se ha actualizado correctamente');
			redirect('nomina/ver','refresh');	
	}else{
		$this->session->set_flashdata('alerta', 'Se ha actualizado correctamente');
			redirect('nomina/add_empleado_nomina','refresh');
	}
	
}
public function exportar_pdf(){
	$id_nomina=$this->uri->segment(3);
	$data = array('nomina' =>$this->nomina_model->get_nomina_id_nomina($id_nomina),
	'det_nomina'=>$this->nomina_model->get_det_nomina_id_nomina($id_nomina));
	$crud = new grocery_CRUD();
	$crud->set_theme('bootstrap');
	$crud->set_table('t_nomina');
	$crud->set_subject('medida');
	$output = $crud->render();
	$this->load->view('../../assets/inc/head_common_add', $output);
	$this->load->view('nomina/imprimir_nomina',$data);
	/*si quiero la hoja en horizonal*/
	$html = $this->output->get_output();
	$this->dompdf->set_paper('letter','landscape');
	$this->dompdf->load_html($html);
	$this->dompdf->render();
	$this->dompdf->stream("nomina_".$id_nomina.".pdf",array('Attachment'=>0));
}
public function buscar_empleado(){
	if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_nomina');
			$output = $crud->render();
			$id_nomina=$this->input->post('txt_id_nomina_1','true');
			$busqueda=$this->input->post('txt_busqueda','true');
			$data = array('nomina' =>$this->nomina_model->get_nomina_id_nomina($id_nomina),
			'det_nomina'=>$this->nomina_model->get_det_nomina_id_nomina_empleado($id_nomina,$busqueda),
			'id_nivel'=>$data_usuario['id_nivel'],
			'sumar_nomina'=>$this->nomina_model->sumar_det_nomina_id_nomina($id_nomina));
			if ($data_usuario['id_nivel']=='1') {
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('nomina/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}else{
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('nomina/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
	
}
}
}