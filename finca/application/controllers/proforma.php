<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Proforma extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('mes_model');
			$this->load->model('proforma_model');
			$this->load->model('medida_model');
			$this->load->model('empresa_model');
			$this->load->model('finca_model');
			$this->load->model('faena_model');
		  $this->load->library('export_excel');
		  $this->load->library('html2pdf');
		  $this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('proforma/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_proforma');
			$crud->set_relation('id_empresa','t_empresa','nombre');
			$crud->set_subject('Proforma');
			$crud->set_language('spanish');
			$crud->display_as('id_empresa','Empresa');
			$crud->display_as('total','Total');
			$crud->display_as('fecha_i','Fecha Inicio');
			$crud->display_as('fecha_f','Fecha Final');
			$crud->columns('id_empresa','fecha_i','fecha_f','total');
			$crud->required_fields('id_empresa','total');
			if ($data_usuario['id_nivel']==1) {
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_edit();
				$crud->unset_read();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('proforma/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('proforma/proforma',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}else{
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->unset_edit();
				$crud->unset_read();
				$crud->unset_add();
				$crud->unset_delete();
				$output = $crud->render();
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('proforma/proforma',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}
			}else{
				redirect('login','refresh');
			}
		
		
	}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_proforma');
		$output = $crud->render();
		$data = array('mes' =>$this->mes_model->get_mes());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('proforma/add',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	function fn_ver($primary_key , $row){
		return site_url('proforma/ver_proforma').'/'.$row->id;
		}
	public function ver_proforma(){
		$id_proforma['id_proforma']=$this->uri->segment(3);
			if ($id_proforma['id_proforma']) {
				$this->session->set_userdata($id_proforma);
				}
		$id_proforma=$this->session->userdata('id_proforma');
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_proforma');
				$output = $crud->render();
				$data = array('proforma' =>$this->proforma_model->get_proforma_id_proforma($id_proforma),
			'det_proforma'=>$this->proforma_model->get_det_proforma_id_proforma($id_proforma),
			'faena'=>$this->faena_model->get_faena(),
			'id_nivel'=>$data_usuario['id_nivel']);
			if ($data_usuario['id_nivel']=='1') {
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('proforma/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}else{
				
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('proforma/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
			}else{
				redirect('login','refresh');
			}



	
	}
	public function guardar_proforma(){
		/*aqui crea la proforma*/
		$consulta=$this->empresa_model->get_empresa();
		if ($consulta) {
			foreach ($consulta as $key) {
				$id_empresa=$key->id;
			}
		$total=0;
		$this->proforma_model->guardar_proforma($id_empresa,$total);
		$consulta_2=$this->proforma_model->get_max_proforma();
		foreach ($consulta_2 as $key) {
			$id_proforma=$key->id;
		}
		/*aqui el archivo excel*/
				/*aqui tomo el excel subido*/
				$config['upload_path'] = realpath(APPPATH.'../files');		
				$config['allowed_types'] = 'xls';
				$config['max_size']	= '0';			
				//Load the Upload CI library 
				//Cargamos la libreria CI para Subir
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('file') ){		
					//Displaying Errors.
					//Mostramos los errores.
					print_r($this->upload->display_errors());						
				}else{
					//Uploads the excel file and read it with the PHPExcel Library.
					//Subimos el archivo de excel y lo leemos con la libreria PHPExcel.
					$data = array('upload_data' => $this->upload->data());			
					$this->load->library('excel');
					$excel = $this->excel->read_file($data['upload_data']['file_name']);
				}		
				//El archivo almacenado en el servidor sera eliminado, no lo necesitamos mas.
				unlink($config['upload_path'].'/'.$data['upload_data']['file_name']);			
				//Asignamos el arreglo resultante de la funcion de la libreria y lo pasamos a la vista.
				$data = $excel;
				$i=1;
				foreach ($data as $key) {
					if ($i==1){
					}else{
						$data = array('fecha' =>$key['1'],
						'emsefor'=>$key['2'],
						'finca'=>$key['3'],
						'codigo'=>$key['4'],
						'tipo_faena'=>$key['5'],
						'rodal'=>$key['6'],
						'unidad'=>$key['7'],
						'medida'=>$key['8'],
						'precio_unidad'=>$key['9'],
						'total'=>$key['10'],
						'observacion'=>$key['11'],
						'nota'=>$key['12'],
						);
						$finca=$data['finca'];
						$fecha=explode('/',$data['fecha']);
						$fecha_1=$fecha['0']-1;
						$fecha_arreglo=$fecha['2'].'-'.$fecha['1'].'-'.$fecha_1;
						$faena=$data['tipo_faena'];
						$rodal=$data['rodal'];
						$unidad=$data['unidad'];
						$medida=$data['medida'];
						$precio_unidad=$data['precio_unidad'];
						$total=$data['total'];
						$observacion=$data['observacion'];
						$nota=$data['nota'];
						$consulta=$this->faena_model->get_faena_descripcion($faena);
						if ($consulta) {
							foreach ($consulta as $key) {
								$id_faena=$key->id;
							}
						$consulta_3=$this->finca_model->get_finca_nombre($finca);
						if ($consulta_3) {
							foreach ($consulta_3 as $key) {
								$id_finca=$key->id;
							}
						}else{
							echo "Hubo un error al cargar los datos";
						}
						if($i==2){
							$this->proforma_model->actualizar_proforma_fecha_i($id_proforma,$fecha_arreglo);
						}
						$this->proforma_model->guardar_det_proforma($id_proforma,$id_faena,$id_finca,$fecha_arreglo,$rodal,$unidad,$medida,$precio_unidad,$total,$observacion,$nota);
						
						}else{
							echo "Hubo un error al cargar los datos";
						}
					}
					$i++;
				}
				$consulta_4=$this->proforma_model->sumar_det_proforma_id_proforma($id_proforma);
				foreach ($consulta_4 as $key) {
					$total=$key->total;
				}
				$this->proforma_model->actualizar_proforma_fecha_f($id_proforma,$fecha_arreglo);
				$this->proforma_model->actualizar_proforma_total($id_proforma,$total);
				$this->session->set_flashdata('alerta', 'Se ha guardado los datos correctamente');
						redirect('proforma/grilla','refresh');
		/***********************/
		}else{
			echo "no existe empresa creada";
		}
		/***********************/
		}
	public function actualizar_det_proforma(){
		$id_proforma=$this->input->post('txt_id_proforma','true');
		$id_det_proforma=$this->input->post('txt_id_det_proforma','true');
		$id_faena=$this->input->post('id_faena','true');
		$rodal=$this->input->post('txt_rodal','true');
		$unidad=$this->input->post('txt_unidad','true');
		$medida=$this->input->post('txt_medida','true');
		$precio_unidad=$this->input->post('txt_precio_unidad','true');
		$total=$this->input->post('txt_total','true');
		$observacion=$this->input->post('txt_observacion','true');
		$notas=$this->input->post('txt_notas','true');
		$this->proforma_model->actualizar_det_proforma($id_det_proforma,$id_faena,$rodal,$unidad,$medida,$precio_unidad,$total,$observacion,$notas);
		$consulta_4=$this->proforma_model->sumar_det_proforma_id_proforma($id_proforma);
			foreach ($consulta_4 as $key) {
				$total=$key->total;
			}
		$this->proforma_model->actualizar_proforma_total($id_proforma,$total);
				redirect('proforma/ver_proforma','refresh');
	}
	public function borrar_det_proforma(){
		$id_det_proforma=$this->uri->segment(3);
		$id_proforma=$this->uri->segment(4);
		$this->proforma_model->borrar_det_proforma($id_det_proforma);
		$consulta_4=$this->proforma_model->sumar_det_proforma_id_proforma($id_proforma);
			foreach ($consulta_4 as $key) {
				$total=$key->total;
			}
		$this->proforma_model->actualizar_proforma_total($id_proforma,$total);
				redirect('proforma/ver_proforma','refresh');
	}
	public function exportar_excel(){
		$id_proforma['id_proforma']=$this->uri->segment(3);
			if ($id_proforma['id_proforma']) {
				$this->session->set_userdata($id_proforma);
				}
		$id_proforma=$this->session->userdata('id_proforma');
		$consulta=$this->proforma_model->get_det_proforma_id_proforma_exportar($id_proforma);
		$this->export_excel->to_excel($consulta, 'proforma_num_'.$id_proforma);	
	}
	public function exportar_pdf(){
		$id_proforma['id_proforma']=$this->uri->segment(3);
				if ($id_proforma['id_proforma']) {
					$this->session->set_userdata($id_proforma);
					}
		$id_proforma=$this->session->userdata('id_proforma');
		$data = array('proforma' =>$this->proforma_model->get_proforma_id_proforma($id_proforma),
			'det_proforma'=>$this->proforma_model->get_det_proforma_id_proforma($id_proforma),
			'faena'=>$this->faena_model->get_faena());
    $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$crud->set_subject('medida');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('proforma/imprimir_proforma',$data);
		/*si quiero la hoja en horizonal*/
		$this->html2pdf->paper('a4', 'landscape');

		$html = $this->output->get_output();
		$this->dompdf->set_paper('letter','landscape');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("medidas.pdf",array('Attachment'=>0));
  	}
}
