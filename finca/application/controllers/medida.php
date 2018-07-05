<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Medida extends CI_Controller {
	public function __construct(){
		parent::__construct();
			$this->load->helper('url');
			$this->load->library('grocery_crud');
			$this->load->model('finca_model');
			$this->load->model('medida_model');
			$this->load->model('faena_model');
		  $this->load->library('export_excel');
		  $this->load->library('html2pdf');
		  $this->load->library('dompdf_gen');
	}
	public function index(){
			redirect('medida/grilla');
	}
	public function grilla(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_medidas');
				$crud->set_relation('id_finca','t_finca','nombre');
				$crud->set_subject('Medida');
				$crud->set_language('spanish');
				$crud->display_as('id_finca','Predio');
				$crud->display_as('fecha_i','Fecha Inicio');
				$crud->display_as('fecha_f','Fecha Final');
				$crud->display_as('id_finca','Predio');
			if ($data_usuario['id_nivel']=='1') {
				$crud->columns('id_finca','fecha_i','fecha_f');
				$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
				$crud->add_action('Editar', '', '','fa fa-pencil',array($this,'fn_editar'));
				$crud->add_action('Cargar Archivo Excel', '', '','fa fa-file-excel-o',array($this,'fn_add_archivo_excel'));
				$crud->add_action('Agregar Medidas Manual', '', '','fa fa-plus',array($this,'fn_add_medidas'));
				$crud->required_fields('id_finca','fecha_i','fecha_f');
				$crud->unset_edit();
				$crud->unset_read();
				$output = $crud->render();
				$state = $crud->getState();
				if($state == 'add'){
				redirect('medida/add');
				}
				$this->load->view('../../assets/inc/head_common', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('medida/medida',$output );
				$this->load->view('../../assets/inc/footer_common',$output);
			}else{
        $crud->columns('id_finca','fecha_i','fecha_f');
		$crud->add_action('Ver', '', '','fa fa-eye',array($this,'fn_ver'));
		
		$crud->required_fields('id_finca','fecha_i','fecha_f');
		$crud->unset_add();
		$crud->unset_edit();
		$crud->unset_read();
		$crud->unset_delete();
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common', $output);
		$this->load->view('../../assets/inc/menu_lateral_n3');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('medida/medida',$output );
		$this->load->view('../../assets/inc/footer_common',$output);
			}
			}else{
				redirect('login','refresh');
			}
		
	}
	function fn_ver($primary_key , $row){
		return site_url('medida/ver_medida').'/'.$row->id;
		}
	function fn_editar($primary_key , $row){
		return site_url('medida/editar_medidas').'/'.$row->id;
		}
	function fn_add_medidas($primary_key , $row){
		return site_url('medida/agregar_medidas_manual').'/'.$row->id;
		}
	function fn_add_archivo_excel($primary_key , $row){
		return site_url('medida/add_archivo_excel').'/'.$row->id;
		}
	public function add(){
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$output = $crud->render();
		$data = array('finca' =>$this->finca_model->get_finca());
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('medida/add',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function add_archivo_excel(){
		$id_medida['id_medida']=$this->uri->segment(3);
		if ($id_medida['id_medida']) {
			$this->session->set_userdata($id_medida);
			}
		$id_medida=$this->session->userdata('id_medida');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$output = $crud->render();
		$data = array('medida' =>$this->medida_model->get_medida_id_medida($id_medida));
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('medida/add_archivo_excel',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function agregar_medidas_manual(){
		$id_medida['id_medida']=$this->uri->segment(3);
			if ($id_medida['id_medida']) {
				$this->session->set_userdata($id_medida);
				}
		$id_medida=$this->session->userdata('id_medida');
		$crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$output = $crud->render();
		$data = array('medida' =>$this->medida_model->get_medida_id_medida($id_medida),
			'faena'=>$this->faena_model->get_faena(),
			'det_medida'=>$this->medida_model->get_det_medida_id_medida($id_medida));
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('../../assets/inc/menu_lateral');
		$this->load->view('../../assets/inc/menu_superior');
		$this->load->view('medida/add_medida_manual',$data);
		$this->load->view('../../assets/inc/footer_common_add',$output);
	}
	public function editar_medidas(){
			$id_medida['id_medida']=$this->uri->segment(3);
				if ($id_medida['id_medida']) {
					$this->session->set_userdata($id_medida);
					}
			$id_medida=$this->session->userdata('id_medida');
			$crud = new grocery_CRUD();
			$crud->set_theme('bootstrap');
			$crud->set_table('t_medidas');
			$output = $crud->render();
			$data = array('medida' =>$this->medida_model->get_medida_id_medida($id_medida),'det_medida'=>$this->medida_model->get_det_medida_id_medida($id_medida),
				'faena'=>$this->faena_model->get_faena());
			$this->load->view('../../assets/inc/head_common_add', $output);
			$this->load->view('../../assets/inc/menu_lateral');
			$this->load->view('../../assets/inc/menu_superior');
			$this->load->view('medida/editar_medida',$data);
			$this->load->view('../../assets/inc/footer_common_add',$output);
		}
	public function ver_medida(){
		if ($this->session->userdata('logueado')) {
			$data_usuario = array('id' =>$this->session->userdata('id'),
			'id_nivel'=>$this->session->userdata('id_nivel'));
			$id_medida['id_medida']=$this->uri->segment(3);
				if ($id_medida['id_medida']) {
					$this->session->set_userdata($id_medida);
					}
			$id_medida=$this->session->userdata('id_medida');
			if ($data_usuario['id_nivel']=='1') {
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_medidas');
				$output = $crud->render();
				$data = array('medida' =>$this->medida_model->get_medida_id_medida($id_medida),
				'det_medida'=>$this->medida_model->get_det_medida_id_medida($id_medida),
				'faena'=>$this->faena_model->get_faena(),
				'id_nivel'=>$data_usuario['id_nivel']);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('medida/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}else{
				$crud = new grocery_CRUD();
				$crud->set_theme('bootstrap');
				$crud->set_table('t_medidas');
				$output = $crud->render();
				$data = array('medida' =>$this->medida_model->get_medida_id_medida($id_medida),
				'det_medida'=>$this->medida_model->get_det_medida_id_medida($id_medida),
				'faena'=>$this->faena_model->get_faena(),
				'id_nivel'=>$data_usuario['id_nivel']);
				$this->load->view('../../assets/inc/head_common_add', $output);
				$this->load->view('../../assets/inc/menu_lateral_n3');
				$this->load->view('../../assets/inc/menu_superior');
				$this->load->view('medida/ver',$data);
				$this->load->view('../../assets/inc/footer_common_add',$output);
			}
			}else{
				redirect('login','refresh');
			}
			
		
			
		}
	public function guardar_medidas(){
		$this->form_validation->set_rules('id_finca', 'finca', 'required|callback_check_default');
		$this->form_validation->set_rules('txt_fecha_i', 'Fecha Inicio', 'required|required');
		$this->form_validation->set_rules('txt_fecha_f', 'Fecha Final', 'required|required');
		$this->form_validation->set_message("callback_check_default","El campo %s es Requerido");
		$this->form_validation->set_message("required","El campo %s es Requerido");
		if ($this->form_validation->run()===false) {
			/*lo regresa al add porque no furula*/
				$this->add();
		}else{
			$id_finca=$this->input->post('id_finca','true');
			$fecha_i=$this->input->post('txt_fecha_i','true');
			$fecha_f=$this->input->post('txt_fecha_f','true');
			$this->medida_model->guardar_medidas($id_finca,$fecha_i,$fecha_f);
		  $this->session->set_flashdata('alerta', 'Se ha guardado correctamente');
				redirect('medida/grilla','refresh');
		}
			/***************************/
		}
		public function guardar_archivo_excel(){
			$id_medida=$this->input->post('txt_id_medida','true');
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
						'faena' =>$key['2'],
						'rodal'=>$key['3'],
						'medidas_gps'=>$key['4'],
						'medidas_cas'=>$key['5'],
						'precio_faena'=>$key['6']);
						$fecha=explode('/',$data['fecha']);
						$fecha_1=$fecha['0']-1;
						$fecha_arreglo=$fecha['2'].'-'.$fecha['1'].'-'.$fecha_1;
						$faena=$data['faena'];
						$rodal=$data['rodal'];
						$medidas_gps=$data['medidas_gps'];
						$medidas_cas=$data['medidas_cas'];
						$precio_faena=$data['precio_faena'];
						$consulta=$this->faena_model->get_faena_descripcion($faena);
						if ($consulta) {
							foreach ($consulta as $key) {
								$id_faena=$key->id;
							}
						$this->medida_model->guardar_det_medida($id_medida,$id_faena,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$fecha_arreglo);
						}else{
							echo "existe un error con la faena: "+$faena+" Verifiquelo e intente de nuevo";
						}
					}
					$i++;
				}
			
				$this->session->set_flashdata('alerta', 'Se ha guardado los datos correctamente');
						redirect('medida/grilla','refresh');
		}
		public function actualizar_det_medidas(){
			$id_det_medida=$this->input->post('txt_id_det_medida','true');
			$rodal=$this->input->post('txt_rodal','true');
			$medidas_gps=$this->input->post('txt_medidas_gps','true');
			$medidas_cas=$this->input->post('txt_medidas_cas','true');
			$precio_faena=$this->input->post('txt_precio_faena','true');
			$id_faena=$this->input->post('id_faena','true');
			$this->medida_model->actualizar_det_medidas($id_det_medida,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$id_faena);
			redirect('medida/ver_medida','refresh');
		}
		public function actualizar_det_medidas_manual(){
			$id_det_medida=$this->input->post('txt_id_det_medida','true');
			$rodal=$this->input->post('txt_rodal','true');
			$medidas_gps=$this->input->post('txt_medidas_gps','true');
			$medidas_cas=$this->input->post('txt_medidas_cas','true');
			$precio_faena=$this->input->post('txt_precio_faena','true');
			$id_faena=$this->input->post('id_faena','true');
			$this->medida_model->actualizar_det_medidas($id_det_medida,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$id_faena);
			redirect('medida/agregar_medidas_manual','refresh');
		}
		public function guardar_medida_manual(){
			$id_medida=$this->input->post('txt_id_medida','true');
			$rodal=$this->input->post('txt_rodal','true');
			$medidas_gps=$this->input->post('txt_medidas_gps','true');
			$medidas_cas=$this->input->post('txt_medidas_cas','true');
			$precio_faena=$this->input->post('txt_precio_faena','true');
			$id_faena=$this->input->post('id_faena','true');
			$fecha=$this->input->post('txt_fecha','true');
			$this->medida_model->guardar_medida_manual($id_medida,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$id_faena,$fecha);
			redirect('medida/agregar_medidas_manual','refresh');
		}
		public function eliminar_det_medida(){
			$id_det_medida=$this->uri->segment(3);
			$this->medida_model->eliminar_det_medida($id_det_medida);
			redirect('medida/ver_medida','refresh');
		}
		public function eliminar_det_medida_manual(){
			$id_det_medida=$this->uri->segment(3);
			$this->medida_model->eliminar_det_medida($id_det_medida);
			redirect('medida/agregar_medidas_manual','refresh');
		}
		public function actualizar_det_medidas_todos(){
			$id_medida=$this->input->post('txt_id_medida','true');
			$consulta=$this->medida_model->get_det_medida_id_medida($id_medida);
			foreach ($consulta as $key) {
			$id_det_medida=$key->id_det_medida;
			$rodal=$this->input->post('txt_rodal_'.$id_det_medida,'true');
			$medidas_gps=$this->input->post('txt_medidas_gps_'.$id_det_medida,'true');
			$medidas_cas=$this->input->post('txt_medidas_cas_'.$id_det_medida,'true');
			$precio_faena=$this->input->post('txt_precio_faena_'.$id_det_medida,'true');
			$id_faena=$this->input->post('id_faena_'.$id_det_medida,'true');
			$this->medida_model->actualizar_det_medidas($id_det_medida,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$id_faena);
			}	
			redirect('medida/grilla','refresh');
		}
		public function exportar_excel(){
			$id_medida['id_medida']=$this->uri->segment(3);
				if ($id_medida['id_medida']) {
					$this->session->set_userdata($id_medida);
					}
		$id_medida=$this->session->userdata('id_medida');
		$consulta=$this->medida_model->get_det_medida_id_medida_exportar($id_medida);
		$this->export_excel->to_excel($consulta, 'medida_num_'.$id_medida);	
		}
		public function exportar_pdf(){
		$id_medida['id_medida']=$this->uri->segment(3);
				if ($id_medida['id_medida']) {
					$this->session->set_userdata($id_medida);
					}
		$id_medida=$this->session->userdata('id_medida');
		$data = array('medida' =>$this->medida_model->get_medida_id_medida($id_medida),
				'det_medida'=>$this->medida_model->get_det_medida_id_medida($id_medida));
    $consulta=$this->medida_model->get_det_medida_id_medida_exportar($id_medida);
    $crud = new grocery_CRUD();
		$crud->set_theme('bootstrap');
		$crud->set_table('t_medidas');
		$crud->set_subject('medida');
		$output = $crud->render();
		$this->load->view('../../assets/inc/head_common_add', $output);
		$this->load->view('medida/imprimir_medida',$data);
		/*si quiero la hoja en horizonal*/
		$html = $this->output->get_output();
		$this->dompdf->set_paper('letter','landscape');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("medidas.pdf",array('Attachment'=>0));
  	}

	}