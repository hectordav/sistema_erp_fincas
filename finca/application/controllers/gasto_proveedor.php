<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gasto_proveedor extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('gasto_proveedor_model');
			$this->load->model('proveedor_model');
			$this->load->model('informe_gasto_proveedor_model');
			$this->load->library('html2pdf');
			$this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('gasto_proveedor/grilla');
	}
	public function grilla(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_informe_gasto_proveedor');
		$crud->set_relation('id_proveedor','t_proveedor','nombre');
		$crud->set_subject('Informe de Gastos de Proveedor');
		$crud->set_language('spanish');
		$crud->display_as('id_proveedor','Proveedor');
		$crud->display_as('fecha_i','Fecha Inicial');
		$crud->display_as('fecha_f','Fecha Final');
		$crud->display_as('total','Total');
		$crud->columns('id_proveedor','fecha_i','fecha_f','total');
		$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
		$crud->required_fields('id_proveedor','fecha_i','fecha_f','total');
		$crud->unset_edit();
		$crud->unset_read();
		$output = $crud->render();
		$state = $crud->getState();
			if($state == 'add'){
			redirect('gasto_proveedor/add_informe_gasto_proveedor');
			}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('gasto_proveedor/gasto_proveedor',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function add_informe_gasto_proveedor(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_informe_gasto_proveedor');
		$output = $crud->render();
		$data = array('proveedor' =>$this->proveedor_model->get_proveedor());
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('gasto_proveedor/add_informe_gasto_proveedor',$data);
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	function fn_ver($primary_key , $row){
		return site_url('gasto_proveedor/ver_informe_proveedor').'/'.$row->id;
		}
	public function ver_informe_proveedor(){
		$id_informe_gasto_proveedor['id_informe_gasto_proveedor']=$this->uri->segment(3);
				if ($id_informe_gasto_proveedor['id_informe_gasto_proveedor']) {
					$this->session->set_userdata($id_informe_gasto_proveedor);
					}
		$id_informe_gasto_proveedor=$this->session->userdata('id_informe_gasto_proveedor');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_informe_gasto_proveedor');
		$output = $crud->render();
		$data = array('informe_gasto_proveedor' =>$this->informe_gasto_proveedor_model->get_informe_gasto_proveedor_id($id_informe_gasto_proveedor),
		'det_informe_gasto_proveedor' =>$this->informe_gasto_proveedor_model->get_det_informe_gasto_proveedor_id($id_informe_gasto_proveedor));
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('gasto_proveedor/ver_informe_gasto_proveedor',$data);
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function guardar_informe_gasto_proveedor(){
			$this->form_validation->set_rules('id_proveedor', 'Proveedor', 'required|callback_check_default');
			$this->form_validation->set_rules('txt_fecha_i', 'Fecha Inicio', 'required|required');
			$this->form_validation->set_rules('txt_fecha_f', 'Fecha Final', 'required|required');
			if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add_informe_gasto_proveedor();
			}else{
				$id_proveedor=$this->input->post('id_proveedor','true');
				$fecha_i=$this->input->post('txt_fecha_i','true');
				$fecha_f=$this->input->post('txt_fecha_f','true');
				$this->informe_gasto_proveedor_model->guardar_informe_gasto_proveedor($id_proveedor,$fecha_i,$fecha_f);
				$consulta_1=$this->informe_gasto_proveedor_model->get_max_informe_gasto_proveedor();
				if ($consulta_1) {
					foreach ($consulta_1 as $key) {
						$id_informe_gasto_proveedor=$key->id;
					}
				}
				$consulta=$this->gasto_proveedor_model->get_gasto_proveedor_fechas($id_proveedor,$fecha_i,$fecha_f);
				if ($consulta) {
					foreach ($consulta as $key) {
						$id_tipo_gasto_proveedor=$key->id_tipo_gasto_proveedor;
						$monto=$key->monto;
						$fecha=$key->fecha;
						$this->informe_gasto_proveedor_model->guardar_det_informe_gasto_proveedor($id_informe_gasto_proveedor,$id_tipo_gasto_proveedor,$monto,$fecha);
					}
				}

				$suma_informe=$this->informe_gasto_proveedor_model->get_suma_informe_gasto($id_informe_gasto_proveedor,$fecha_i,$fecha_f);
				if ($suma_informe) {
					foreach ($suma_informe as $key) {
						$total=$key->total;
					}
				$this->informe_gasto_proveedor_model->actualizar_monto_informe_gasto_proveedor($id_informe_gasto_proveedor,$total);
				}
			$this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
					redirect('gasto_proveedor/grilla','refresh');
			}
	}
public function exportar_pdf(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$id_informe_gasto_proveedor['id_informe_gasto_proveedor']=$this->uri->segment(3);
				if ($id_informe_gasto_proveedor['id_informe_gasto_proveedor']) {
					$this->session->set_userdata($id_informe_gasto_proveedor);
					}
		$id_informe_gasto_proveedor=$this->session->userdata('id_informe_gasto_proveedor');
			if ($data_usuario['id_nivel']==1) {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_gasto');
				$output = $crud->render();
				$data = array('informe_gasto_proveedor' =>$this->informe_gasto_proveedor_model->get_informe_gasto_proveedor_id($id_informe_gasto_proveedor),
				'det_informe_gasto_proveedor' =>$this->informe_gasto_proveedor_model->get_det_informe_gasto_proveedor_id($id_informe_gasto_proveedor));
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('gasto_proveedor/imprimir_informe_gasto_proveedor',$data);
				/*si quiero la hoja en horizonal*/
				$html = $this->output->get_output();
				$this->dompdf->set_paper('letter','landscape');
				$this->dompdf->load_html($html);
				$this->dompdf->render();
				$this->dompdf->stream("informe_gasto_proveedor_".$id_informe_gasto_proveedor.".pdf",array('Attachment'=>0));
			}
		}
	}



}