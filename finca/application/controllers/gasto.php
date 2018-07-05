<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gasto extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('finca_model');
			$this->load->model('gasto_model');
			$this->load->library('html2pdf');
			$this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('gasto/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id' =>$this->session->userdata('id'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_gasto');
		$crud->set_subject('Gasto');
		$crud->set_language('spanish');
		$crud->set_relation('id_finca','t_finca','nombre');
		$crud->display_as('id_finca','Finca');
		$crud->display_as('observacion','Observacion');
		$crud->display_as('fecha','Fecha');
		$crud->display_as('total','Total');
		$crud->columns('id_finca','observacion','total','fecha');
		$crud->required_fields('id_finca','observacion','total','fecha');
		if ($data_usuario['id_nivel']==1) {
			$crud->add_action('Agregar Gasto Detallado', '', '','fa fa-plus',array($this,'fn_add_gasto'));
			$crud->add_action('Ver Gasto Detallado', '', '','fa fa-eye',array($this,'fn_ver_gasto'));
			$output = $crud->render();
			$state = $crud->getState();
			if($state == 'add'){
			redirect('gasto/add');
			}
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('gasto/gasto',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}else{
			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('gasto/gasto',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}
	}else{
		redirect('login','refresh');
	}
		
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_gasto');
		$output = $crud->render();
		$data = array('finca' =>$this->finca_model->get_finca());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('gasto/add',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	function fn_add_gasto($primary_key , $row){
		return site_url('gasto/add_gasto').'/'.$row->id;
		}
		function fn_ver_gasto($primary_key , $row){
		return site_url('gasto/ver_gasto').'/'.$row->id;
		}

	public function add_gasto(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id' =>$this->session->userdata('id'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_gasto['id_gasto']=$this->uri->segment(3);
					if ($id_gasto['id_gasto']) {
					$this->session->set_userdata($id_gasto);
					}
				$id_gasto=$this->session->userdata('id_gasto');
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_gasto');
					$output = $crud->render();
					$data = array('finca' =>$this->finca_model->get_finca(),
						'gasto'=>$this->gasto_model->get_gasto_id_gasto($id_gasto),
						'det_gasto'=>$this->gasto_model->get_det_gasto_id_gasto($id_gasto),
						'id_nivel'=>$data_usuario['id_nivel'],
						'tipo_gasto'=>$this->gasto_model->get_tipo_gasto());
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral');
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('gasto/add_det_gasto',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
				}else{
					redirect('principal','refresh');
				}
			}else{
				redirect('login','refresh');
			}
	}
	public function ver_gasto(){
			if ($this->session->userdata('logueado')) {
				$data_usuario = array('id' =>$this->session->userdata('id'),
				'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_gasto['id_gasto']=$this->uri->segment(3);
					if ($id_gasto['id_gasto']) {
					$this->session->set_userdata($id_gasto);
					}
				$id_gasto=$this->session->userdata('id_gasto');
				if ($data_usuario['id_nivel']==1) {
					$crud = new grocery_CRUD();
					$crud->set_theme('bootstrap');
					$crud->set_table('t_gasto');
					$output = $crud->render();
					$data = array('finca' =>$this->finca_model->get_finca(),
						'gasto'=>$this->gasto_model->get_gasto_id_gasto($id_gasto),
						'det_gasto'=>$this->gasto_model->get_det_gasto_id_gasto($id_gasto),
						'id_nivel'=>$data_usuario['id_nivel']);
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral');
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('gasto/ver_det_gasto',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
				}else{
					redirect('principal','refresh');
				}
			}else{
				redirect('login','refresh');
			}
	}
	public function guardar_gasto(){
		$this->form_validation->set_rules('id_finca', 'Finca', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_fecha', 'Fecha', 'required|required');
		$this->form_validation->set_rules('txt_observaciones', 'observaciones', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
			if ($this->form_validation->run()===false) {
				/*lo regresa al add porque no furula*/
				$this->add();
			}else{
				$id_finca=$this->input->post('id_finca','true');
				$fecha=$this->input->post('txt_fecha','true');
				$observaciones=$this->input->post('txt_observaciones','true');
				$this->gasto_model->guardar_gasto($id_finca,$fecha,$observaciones);
				$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
						redirect('gasto/grilla','refresh');
			}
	}
	public function guardar_det_gasto(){
		$this->form_validation->set_rules('txt_descripcion_gasto', 'Descripcion', 'required|required');
		$this->form_validation->set_rules('id_tipo_gasto', 'Tipo de Gasto', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_cantidad_det_gasto', 'Cantidad', 'required|required');
		$this->form_validation->set_rules('txt_total_det_gasto', 'Total', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
			if ($this->form_validation->run()===false) {
				/*lo regresa al add porque no furula*/
				$this->add_gasto();
			}else{
		$id_gasto=$this->input->post('txt_id_gasto','true');
		$id_tipo_gasto=$this->input->post('id_tipo_gasto','true');
		$descripcion_gasto=$this->input->post('txt_descripcion_gasto','true');
		$cantidad_det_gasto=$this->input->post('txt_cantidad_det_gasto','true');
		$total_det_gasto=$this->input->post('txt_total_det_gasto','true');
		$observacion=$this->input->post('txt_observaciones','true');
		$this->gasto_model->guardar_det_gasto($id_gasto,$id_tipo_gasto,$descripcion_gasto,$cantidad_det_gasto,$total_det_gasto,$observacion);
		$consulta=$this->gasto_model->suma_det_gasto_id_gasto($id_gasto);
		if ($consulta) {
			foreach ($consulta as $key) {
				$total=$key->total;
			}
		}
		$this->gasto_model->actualizar_suma_gasto_id_gasto($id_gasto,$total);
		redirect('gasto/add_gasto','refresh');
		}
	}
	public function eliminar_det_gasto(){
		$id_det_gasto=$this->uri->segment(3);
		$id_gasto=$this->uri->segment(4);
		$this->gasto_model->eliminar_det_gasto($id_det_gasto);
		$consulta=$this->gasto_model->suma_det_gasto_id_gasto($id_gasto);
		if ($consulta) {
			foreach ($consulta as $key) {
				$total=$key->total;
			}
		}
		$this->gasto_model->actualizar_suma_gasto_id_gasto($id_gasto,$total);
		redirect('gasto/add_gasto','refresh');
	}
	public function exportar_pdf(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$id_gasto['id_gasto']=$this->uri->segment(3);
				if ($id_gasto['id_gasto']) {
				$this->session->set_userdata($id_gasto);
				}
			$id_gasto=$this->session->userdata('id_gasto');
			if ($data_usuario['id_nivel']==1) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_gasto');
				$output = $crud->render();
				$data = array('gasto'=>$this->gasto_model->get_gasto_id_gasto($id_gasto),
					'det_gasto'=>$this->gasto_model->get_det_gasto_id_gasto($id_gasto));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('gasto/imprimir_gasto',$data);
				/*si quiero la hoja en horizonal*/
				$html = $this->output->get_output();
				$this->dompdf->set_paper('letter','landscape');
				$this->dompdf->load_html($html);
				$this->dompdf->render();
				$this->dompdf->stream("gasto_".$id_gasto.".pdf",array('Attachment'=>0));
			}
		}
	}
}