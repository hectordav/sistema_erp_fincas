<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Medidas_valores extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('medidas_valores_model');
			$this->load->library('html2pdf');
		  $this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('medidas_valores/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id' =>$this->session->userdata('id'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medida_valor');
		$crud->set_relation('id_medidas','t_medidas','fecha_i');
		$crud->set_subject('Informe de Medidas');
		$crud->set_language('spanish');
		$crud->display_as('id_medidas','Fecha de las medidas');
		$crud->display_as('observacion','Observaciones');
		$crud->columns('id_medidas','observacion');
		$crud->required_fields('id_medidas','observacion');
		$crud->unset_read();
		if ($data_usuario['id_nivel']==1) {
			$crud->add_action('Ver Informe', '', '','fa fa-user-eye',array($this,'fn_ver'));
			$crud->unset_edit();
			$crud->unset_add();
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('medidas_valores/medidas_valores',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}else{
			$crud->unset_edit();
			$crud->unset_add();
			$crud->unset_delete();
			$output = $crud->render();
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/inc/menu_lateral_n3');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('medidas_valores/medidas_valores',$output );
			$this->load->view('../../assets/inc/footer_common',$output);
		}
		}else{
			redirect('login','refresh');

		}
	}
	function fn_ver($primary_key , $row){
		return site_url('medidas_valores/ver').'/'.$row->id;
	}
	public function ver(){
			if ($this->session->userdata('logueado')) {
		$data_usuario = array('id' =>$this->session->userdata('id'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		$id_medida_valor['id_medida_valor']=$this->uri->segment(3);
			if ($id_medida_valor['id_medida_valor']) {
				$this->session->set_userdata($id_medida_valor);
				}
		$id_medida_valor=$this->session->userdata('id_medida_valor');
		$data = array('medidas_valor' =>$this->medidas_valores_model->get_medidas_valores_id_medida($id_medida_valor),
		'det_medidas_valores'=>$this->medidas_valores_model->get_det_medidas_valores_id_medida_valor($id_medida_valor),
		'id_nivel'=>$data_usuario['id_nivel']);
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral_n3');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('medidas_valores/ver',$data );
		$this->load->view('../../assets/inc/footer_common',$output);
	}else{
		redirect('login','refresh');
	}
		
	}
	public function guardar_informe(){
		$id_medida=$this->input->post('txt_id_medida','true');
		$id_det_medida=$this->input->post('txt_id_det_medida','true');
		$observaciones=$this->input->post('txt_observaciones','true');
		$diferencia=$this->input->post('txt_diferencia','true');
		$consulta_1=$this->medidas_valores_model->get_medidas_valores_id_medidas($id_medida);
		if ($consulta_1) {
			foreach ($consulta_1 as $key) {
				$id_medida_valor=$key->id;
			}
		}else{
			$this->medidas_valores_model->guardar_medidas_valores($id_medida);
		}
		$consulta_1=$this->medidas_valores_model->get_medidas_valores_id_medidas($id_medida);
		foreach ($consulta_1 as $key) {
				$id_medida_valor=$key->id;
			}
		$consulta=$this->medidas_valores_model->get_medidas_valores_id_medidas_det_medidas($id_medida_valor,$id_det_medida);
		if ($consulta) {
			foreach ($consulta as $key) {
				$id_det_medida_valor=$key->id;
			}
			$this->medidas_valores_model->actualizar_det_medidas_valores($id_det_medida_valor,$diferencia,$observaciones);
		}else{
			$this->medidas_valores_model->guardar_det_medidas_valores($id_medida_valor,$id_det_medida,$diferencia,$observaciones);
		}
		redirect('medida/ver_medida','refresh');
	}
		public function exportar_pdf(){
		if ($this->session->userdata('logueado')) {
		$data_usuario = array('id' =>$this->session->userdata('id'),
		'id_nivel'=>$this->session->userdata('id_nivel'));
		$id_medida_valor['id_medida_valor']=$this->uri->segment(3);
			if ($id_medida_valor['id_medida_valor']) {
				$this->session->set_userdata($id_medida_valor);
				}
		$id_medida_valor=$this->session->userdata('id_medida_valor');
		$data = array('medidas_valor' =>$this->medidas_valores_model->get_medidas_valores_id_medida($id_medida_valor),
		'det_medidas_valores'=>$this->medidas_valores_model->get_det_medidas_valores_id_medida_valor($id_medida_valor),
		'id_nivel'=>$data_usuario['id_nivel']);
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('medidas_valores/imprimir_medida_valor',$data);
		/*si quiero la hoja en horizonal*/
		$html = $this->output->get_output();
		$this->dompdf->set_paper('letter','landscape');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("medidas.pdf",array('Attachment'=>0));
  	}
	}
}