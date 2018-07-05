<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proforma_pago extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('finca_model');
			$this->load->model('mes_model');
			$this->load->model('proforma_model');
			$this->load->model('empresa_model');
			$this->load->model('proforma_pago_model');
			$this->load->model('faena_model');
			$this->load->model('medida_model');
			$this->load->library('export_excel');
			$this->load->library('dompdf_gen');

	}
	public function index(){
			redirect('proforma_pago/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_proforma_pago');
			$crud->set_relation('id_empresa','t_empresa','nombre');
			$crud->set_relation('id_finca','t_finca','nombre');
			$crud->set_subject('Proforma de Pago');
			$crud->set_language('spanish');
			$crud->display_as('id_empresa','Empresa');
			$crud->display_as('fecha_i','Fecha Inicio');
			$crud->display_as('fecha_f','Fecha Fin');
			$crud->display_as('id_finca','Finca');
			$crud->display_as('total','Total');
			$crud->columns('id_empresa','fecha_i','fecha_f','id_finca','total');
				if ($data_usuario['id_nivel']=='1') {
					$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->add_action('Editar', '', '','fa fa-Pencil',array($this,'fn_editar'));
					$crud->required_fields('id_empresa','id_mes','id_finca','total');
					$crud->unset_edit();
					$crud->unset_read();
					$output = $crud->render();
					$state = $crud->getState();
					if($state == 'add'){
					redirect('proforma_pago/add');
					}
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral');
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('proforma_pago/proforma_pago',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
				}else{
					$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
					$crud->required_fields('id_empresa','id_mes','id_finca','total');
					$crud->unset_edit();
					$crud->unset_read();
					$crud->unset_add();
					$crud->unset_delete();
					$output = $crud->render();
					$this->load->view('../../assets/inc/head_common', $output);
					$this->load->view('../../assets/inc/menu_lateral_n3');
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('proforma_pago/proforma_pago',$output );
					$this->load->view('../../assets/inc/footer_common',$output);
				}
			}else{
				redirect('login','refresh');
			}
	}
	function fn_ver($primary_key , $row){
		return site_url('proforma_pago/ver_proforma_pago').'/'.$row->id;
	}
	function fn_editar($primary_key , $row){
		return site_url('proforma_pago/editar_proforma_pago').'/'.$row->id;
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_proforma');
		$output = $crud->render();
		$data = array('finca' =>$this->finca_model->get_finca(),
			'mes'=>$this->mes_model->get_mes());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('proforma_pago/add',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function guardar_proforma_pago(){
		$this->form_validation->set_rules('id_finca', 'Finca', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_fecha_i', 'Fecha de Inicio', 'required|required');
		$this->form_validation->set_rules('txt_fecha_f', 'Fecha Final', 'required|required');
			$this->form_validation->set_message("required","El campo %s es Requerido");
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
		$consulta=$this->empresa_model->get_empresa();
		if ($consulta) {
			foreach ($consulta as $key) {
				$id_empresa=$key->id;
			}
		}
		$id_finca=$this->input->post('id_finca','true');
		$fecha_i=$this->input->post('txt_fecha_i','true');
		$fecha_f=$this->input->post('txt_fecha_f','true');
		$this->proforma_pago_model->guardar_proforma_pago($id_empresa,$id_finca,$fecha_i,$fecha_f);
		$consulta_2=$this->proforma_pago_model->get_max_proforma_pago();
		foreach ($consulta_2 as $key) {
			$id_proforma_pago=$key->id;
		}
		$consulta=$this->medida_model->get_medida_x_mes($id_finca,$fecha_i,$fecha_f);
		if ($consulta) {
			foreach ($consulta as $key) {
				$id_faena=$key->id_faena;
				$rodal=$key->rodal;
				$medida=$key->medida_cas;
				$precio_unidad=$key->precio_faena;
				$total=$precio_unidad*$medida;
				$this->proforma_pago_model->guardar_det_proforma_pago($id_proforma_pago,$id_faena,$rodal,$medida,$precio_unidad,$total);
			}
		$consulta=$this->proforma_pago_model->get_sum_det_plataforma($id_proforma_pago);
		foreach ($consulta as $key) {
			$total=$key->total;
		}
		$this->proforma_pago_model->actualizar_proforma_pago_total($id_proforma_pago,$total);
		}
		$this->session->set_flashdata('alerta', 'Se ha creado la proforma de pago');
				redirect('proforma_pago/grilla','refresh');
	}
	}
	public function ver_proforma_pago(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$id_proforma_pago['id_proforma_pago']=$this->uri->segment(3);
				if ($id_proforma_pago['id_proforma_pago']) {
				$this->session->set_userdata($id_proforma_pago);
				}
				$id_proforma_pago=$this->session->userdata('id_proforma_pago');
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_proforma');
				$output = $crud->render();
				$data = array('proforma_pago' =>$this->proforma_pago_model->get_proforma_id_proforma($id_proforma_pago),
				'det_proforma_pago'=>$this->proforma_pago_model->get_det_proforma_id_proforma($id_proforma_pago),
				'faena'=>$this->faena_model->get_faena(),
				'id_nivel'=>$data_usuario['id_nivel']);
				if ($data_usuario['id_nivel']=='1') {
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral');
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('proforma_pago/ver',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
				}else{
					$this->load->view('../../assets/inc/head_common_add', $output);
					$this->load->view('../../assets/inc/menu_lateral_n3');
					$this->load->view('../../assets/inc/menu_superior');
					$this->load->view('proforma_pago/ver',$data);
					$this->load->view('../../assets/inc/footer_common_add',$output);
				}
			}else{
				redirect('login','refresh');
			}
	}
	public function editar_proforma_pago(){
		$id_proforma_pago['id_proforma_pago']=$this->uri->segment(3);
				if ($id_proforma_pago['id_proforma_pago']) {
					$this->session->set_userdata($id_proforma_pago);
					}
		$id_proforma_pago=$this->session->userdata('id_proforma_pago');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_proforma');
		$output = $crud->render();
		$data = array('proforma_pago' =>$this->proforma_pago_model->get_proforma_id_proforma($id_proforma_pago),
		'det_proforma_pago'=>$this->proforma_pago_model->get_det_proforma_id_proforma($id_proforma_pago),
		'faena'=>$this->faena_model->get_faena());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('proforma_pago/editar',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function actualizar_det_proforma_pago(){
			$id_det_proforma_pago=$this->input->post('txt_id_det_proforma_pago','true');
			$rodal=$this->input->post('txt_rodal','true');
			$medida=$this->input->post('txt_medida','true');
			$precio_u=$this->input->post('txt_precio_u','true');
			$total=$this->input->post('txt_total','true');
			$id_faena=$this->input->post('id_faena','true');
			$this->proforma_pago_model->actualizar_det_proforma_pago($id_det_proforma_pago,$rodal,$medida,$precio_u,$total,$id_faena);
			redirect('proforma_pago/ver_proforma_pago','refresh');
		}
	public function borrar_det_proforma(){
		$id_det_proforma_pago=$this->uri->segment(3);
		$id_proforma_pago=$this->uri->segment(4);
		$this->proforma_pago_model->borrar_det_proforma($id_det_proforma_pago);
		$consulta=$this->proforma_pago_model->get_sum_det_plataforma($id_proforma_pago);
		foreach ($consulta as $key) {
			$total=$key->total;
		}
		$this->proforma_pago_model->actualizar_proforma_pago_total($id_proforma_pago,$total);
		redirect('proforma_pago/ver_proforma_pago','refresh');
	}
	public function actualizar_det_proforma_pago_todos(){
		$id_proforma_pago=$this->input->post('txt_id_proforma_pago','true');
		$consulta=$this->proforma_pago_model->get_det_proforma_id_proforma($id_proforma_pago);
		if ($consulta) {
			foreach ($consulta as $key) {
				$id_det_proforma_pago=$key->id_det_proforma_pago;
				$id_faena=$this->input->post('id_faena_'.$id_det_proforma_pago,'true');
				$rodal=$this->input->post('txt_rodal_'.$id_det_proforma_pago,'true');
				$medida=$this->input->post('txt_medida_'.$id_det_proforma_pago,'true');
				$precio_u=$this->input->post('txt_precio_u_'.$id_det_proforma_pago,'true');
				$total=$this->input->post('txt_total_'.$id_det_proforma_pago,'true');
				$this->proforma_pago_model->actualizar_det_proforma_pago($id_det_proforma_pago,$rodal,$medida,$precio_u,$total,$id_faena);
			}
		$consulta=$this->proforma_pago_model->get_sum_det_plataforma($id_proforma_pago);
		foreach ($consulta as $key) {
			$total=$key->total;
		}
		$this->proforma_pago_model->actualizar_proforma_pago_total($id_proforma_pago,$total);
			$this->session->set_flashdata('alerta', 'Se ha Actualizado correctamente');
			redirect('proforma_pago/editar_proforma_pago','refresh');
		}
	}
	public function exportar_excel(){
		$id_proforma_pago['id_proforma_pago']=$this->uri->segment(3);
				if ($id_proforma_pago['id_proforma_pago']) {
					$this->session->set_userdata($id_proforma_pago);
					}
	  $id_proforma_pago=$this->session->userdata('id_proforma_pago');
	  $consulta=$this->proforma_pago_model->get_det_proforma_id_proforma_exportar($id_proforma_pago);
	  $this->export_excel->to_excel($consulta, 'proforma_pago_num_'.$id_proforma_pago);	
	}
	public function exportar_pdf(){
		$id_proforma_pago['id_proforma_pago']=$this->uri->segment(3);
					if ($id_proforma_pago['id_proforma_pago']) {
						$this->session->set_userdata($id_proforma_pago);
						}
		$id_proforma_pago=$this->session->userdata('id_proforma_pago');
		$data = array('proforma_pago' =>$this->proforma_pago_model->get_proforma_id_proforma($id_proforma_pago),
		'det_proforma_pago'=>$this->proforma_pago_model->get_det_proforma_id_proforma($id_proforma_pago),
		'faena'=>$this->faena_model->get_faena());
		  $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$crud->set_subject('medida');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('proforma_pago/imprimir_proforma_pago',$data);
		
		$html = $this->output->get_output();
		$this->dompdf->set_paper('letter','landscape');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("proforma_pago.pdf",array('Attachment'=>0));

	}

}