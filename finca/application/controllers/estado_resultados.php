<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Estado_resultados extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('proforma_model');
			$this->load->model('proforma_pago_model');
			$this->load->model('gasto_model');
			$this->load->model('medida_model');
			$this->load->model('ingresos_model');
			$this->load->library('html2pdf');
			$this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('estado_resultados/add');
	}
	public function grilla(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_estado_resultados');
		$crud->set_subject('Estado de Resultados');
		$crud->set_language('spanish');
		$crud->display_as('nombre_empresa','Empresa');
		$crud->display_as('utilidad_bruta','Utilidad bruta');
		$crud->display_as('utilidad_operativa','Utilidad Operativa');
		$crud->display_as('utilidad_neta_ajustada','Utilidad Neta');
		$crud->display_as('fecha_i','Fecha de Inicial');
		$crud->display_as('fecha_f','Fecha Final');
		$crud->columns('nombre_empresa','utilidad_bruta','utilidad_operativa','utilidad_neta_ajustada','fecha_i','fecha_f');
		$crud->required_fields('nombre_empresa','utilidad_bruta','utilidad_operativa','utilidad_neta_ajustada','fecha_i','fecha_f');
		$output = $crud->render();
		$state = $crud->getState();
			if($state == 'add'){
			redirect('estado_resultados/add');
			}
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('estado_resultados/estado_resultados',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('estado_resultados/add');
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function buscar_estado_resultados(){
		$this->form_validation->set_rules('txt_fecha_i', 'Fecha Inicial', 'required|required');
		$this->form_validation->set_rules('txt_fecha_f', 'Fecha Final', 'required|required');
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
		$fecha_i=$this->input->post('txt_fecha_i','true');
		$fecha_f=$this->input->post('txt_fecha_f','true');
		/*la proforma CAS*/
		$consulta_proforma=$this->proforma_model->sumar_det_proforma_por_fecha($fecha_i,$fecha_f);
		if ($consulta_proforma) {
			foreach ($consulta_proforma as $key) {
				$total_cas=$key->total;
			}
		}else{
			$this->session->set_flashdata('alerta', 'No se ha encontrado el Informe');
				redirect('estado_resultados/add','refresh');

		}

		/*la proforma de pago que se saca de las medidas pero ahora por fecha i fecha f*/
		$consulta_proforma_pago=$this->medida_model->get_medida_x_fecha($fecha_i,$fecha_f);
		if ($consulta_proforma_pago) {
			foreach ($consulta_proforma_pago as $key){
				$total_proforma_pago=$key->total;
			}
		}else{
			$this->session->set_flashdata('alerta', 'No se ha encontrado el Informe');
			redirect('estado_resultados/add','refresh');
		}
		$consulta_tipo_gasto=$this->gasto_model->suma_tipo_gasto_fecha($fecha_i,$fecha_f);
		if ($consulta_tipo_gasto) {
			foreach ($consulta_tipo_gasto as $key) {
				$id_tipo_gasto=$key->id_tipo_gasto;
			$consulta_det_tipo_gasto=$this->gasto_model->get_det_gasto_id_tipo_gasto();
			}
			$consulta_suma_ingresos=$this->ingresos_model->get_sum_ingreso_x_fecha($fecha_i,$fecha_f);
			$consulta_ingresos=$this->ingresos_model->get_ingreso_x_fecha($fecha_i,$fecha_f);
				if ($consulta_suma_ingresos) {
					foreach ($consulta_suma_ingresos as $key) {
						$total_ingresos=$key->total;
					}
				}
		}else{
			$this->session->set_flashdata('alerta', 'No se ha encontrado el Informe');
				redirect('estado_resultados/add','refresh');
		}
		$consulta_suma_gasto_total=$this->gasto_model->suma_tipo_gasto_fecha_total($fecha_i,$fecha_f);
		if ($consulta_suma_gasto_total) {
			foreach ($consulta_suma_gasto_total as $key) {
				$total_det_gasto=$key->total;
			}
		}else{
			$this->session->set_flashdata('alerta', 'No se ha encontrado el Informe');
				redirect('estado_resultados/add','refresh');
		}
		
		$data = array('id_tipo_gasto' =>$id_tipo_gasto,
			'ingresos_cas' =>$total_cas,
		'costo_ventas' =>$total_proforma_pago,
		'consulta_tipo_gasto'=>$consulta_tipo_gasto,
		'consulta_det_tipo_gasto' =>$consulta_det_tipo_gasto,
		'total_ingresos' =>$total_ingresos,
		'consulta_det_ingresos' =>$consulta_ingresos,
		'total_det_gasto'=>$total_det_gasto,
		'fecha_i'=>$fecha_i,
		'fecha_f'=>$fecha_f);
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_estado_resultados');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('estado_resultados/ver',$data);
		$this->load->view('../../assets/inc/footer_common',$output);
	
	}
}
	public function exportar_pdf(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$fecha_i=$this->uri->segment(3);
			$fecha_f=$this->uri->segment(4);
			if ($data_usuario['id_nivel']==1) {
				/*la proforma CAS*/
		$consulta_proforma=$this->proforma_model->sumar_det_proforma_por_fecha($fecha_i,$fecha_f);
		if ($consulta_proforma) {
			foreach ($consulta_proforma as $key) {
				$total_cas=$key->total;
			}
		}
		/*la proforma de pago que se saca de las medidas pero ahora por fecha i fecha f*/
		$consulta_proforma_pago=$this->medida_model->get_medida_x_fecha($fecha_i,$fecha_f);
		if ($consulta_proforma_pago) {
			foreach ($consulta_proforma_pago as $key){
				$total_proforma_pago=$key->total;
			}
		}
		$consulta_tipo_gasto=$this->gasto_model->suma_tipo_gasto_fecha($fecha_i,$fecha_f);
		if ($consulta_tipo_gasto) {
			foreach ($consulta_tipo_gasto as $key) {
				$id_tipo_gasto=$key->id_tipo_gasto;
			$consulta_det_tipo_gasto=$this->gasto_model->get_det_gasto_id_tipo_gasto();
			}
			$consulta_suma_ingresos=$this->ingresos_model->get_sum_ingreso_x_fecha($fecha_i,$fecha_f);
			$consulta_ingresos=$this->ingresos_model->get_ingreso_x_fecha($fecha_i,$fecha_f);
				if ($consulta_suma_ingresos) {
					foreach ($consulta_suma_ingresos as $key) {
						$total_ingresos=$key->total;
					}
				}
		}
		$consulta_suma_gasto_total=$this->gasto_model->suma_tipo_gasto_fecha_total($fecha_i,$fecha_f);
		if ($consulta_suma_gasto_total) {
			foreach ($consulta_suma_gasto_total as $key) {
				$total_det_gasto=$key->total;
			}
		}
		$data = array('id_tipo_gasto' =>$id_tipo_gasto,
			'ingresos_cas' =>$total_cas,
		'costo_ventas' =>$total_proforma_pago,
		'consulta_tipo_gasto'=>$consulta_tipo_gasto,
		'consulta_det_tipo_gasto' =>$consulta_det_tipo_gasto,
		'total_ingresos' =>$total_ingresos,
		'consulta_det_ingresos' =>$consulta_ingresos,
		'total_det_gasto'=>$total_det_gasto,
		'fecha_i'=>$fecha_i,
		'fecha_f'=>$fecha_f);
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_estado_resultados');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('estado_resultados/imprimir_estado_resultados',$data);
		/*si quiero la hoja en horizonal*/
		$html = $this->output->get_output();
		$this->dompdf->set_paper('letter','portraid');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("estado_resultados_".$fecha_i.".pdf",array('Attachment'=>0));
	}
		}else{
			redirect('login','refresh');
		}
	}

}