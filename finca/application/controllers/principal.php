<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Principal extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('empleado_model');
			$this->load->model('finca_model');
			$this->load->model('herramienta_model');
			$this->load->model('gasto_model');
			$this->load->model('ingresos_model');
			$this->load->model('proforma_model');
			$this->load->model('proveedor_model');
			$this->load->model('gasto_proveedor_model');
	}
	public function index(){
			redirect('principal/home');
	}
	public function home(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_finca');
		$crud->set_subject('principal');
		$crud->set_language('spanish');
		$crud->display_as('descripcion','principal');
		$crud->columns('descripcion');
		$crud->required_fields('descripcion');
		$output = $crud->render();
		$data = array('empleado' =>$this->empleado_model->contar_empleado(),
		'finca' =>$this->finca_model->contar_finca(),
		'herramienta'=>$this->herramienta_model->contar_herramientas(),
		'proforma'=>$this->proforma_model->contar_proforma(),
		'proveedor'=>$this->proveedor_model->contar_proveedores());
		$mes=date('m');
		$ano=date('Y');
		$fecha_i= date('Y-m-d', mktime(0,0,0, $mes, 1, $ano));
		$fecha_f=date('Y-m-d', mktime(0,0,0, $mes+1, 0, $ano));
		/******************************/
		$sumar_gasto=$this->gasto_model->sumar_gastos_entre_fechas($fecha_i,$fecha_f);
		if ($sumar_gasto) {
				foreach ($sumar_gasto as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data1[] = $fecha;
						$series_data2[] =(real)$key->total;
					}
			$this->view_data['series_data1']=json_encode($series_data1);
			$this->view_data['series_data2']=json_encode($series_data2);
		}else{
			$series_data1[] =0;
			$series_data2[] =0;
			$this->view_data['series_data1']=json_encode($series_data1);
			$this->view_data['series_data2']=json_encode($series_data2);
		}
		/*********************************/
		/*********************************/
		$sumar_ingreso=$this->ingresos_model->sumar_ingresos_entre_fechas($fecha_i,$fecha_f);
		if ($sumar_ingreso) {
				foreach ($sumar_ingreso as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data3[] = $fecha;
						$series_data4[] =(real)$key->total;
					}
			$this->view_data['series_data3']=json_encode($series_data3);
			$this->view_data['series_data4']=json_encode($series_data4);
		}else{
			$series_data3[] =0;
			$series_data4[] =0;
			$this->view_data['series_data3']=json_encode($series_data3);
			$this->view_data['series_data4']=json_encode($series_data4);
		}
		/*********************************/
			/*********************************/
		$sumar_gasto_proveedor=$this->gasto_proveedor_model->sumar_gasto_proveedor_entre_fechas($fecha_i,$fecha_f);
		if ($sumar_gasto_proveedor) {
				foreach ($sumar_gasto_proveedor as $key) {
						$fecha = date("d-m-Y", strtotime($key->fecha));
						$series_data5[] = $fecha;
						$series_data6[] =(real)$key->total;
					}
			$this->view_data['series_data5']=json_encode($series_data5);
			$this->view_data['series_data6']=json_encode($series_data6);
		}else{
			$series_data5[] =0;
			$series_data6[] =0;
			$this->view_data['series_data5']=json_encode($series_data5);
			$this->view_data['series_data6']=json_encode($series_data6);
		}
		/*********************************/

		if ($data_usuario['id_nivel']=='1') {
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/script/script_grafico_data',$this->view_data);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('../../assets/inc/central', $data);
			$this->load->view('../../assets/inc/footer_common',$output);
		}else{
			$this->load->view('../../assets/inc/head_common', $output);
			$this->load->view('../../assets/script/script_grafico_data',$this->view_data);
			$this->load->view('../../assets/inc/menu_lateral_n3');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('../../assets/inc/central', $data);
			$this->load->view('../../assets/inc/footer_common',$output);
		}
		
			}else{
				redirect('login','refresh');
			}
	}

}