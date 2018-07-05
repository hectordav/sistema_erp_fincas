<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medida_model extends CI_Model {

	public function guardar_medidas($id_finca,$fecha_i,$fecha_f){
		$data = array('id_finca' =>$id_finca,
			'fecha_i'=>$fecha_i,
			'fecha_f'=>$fecha_f);
		$this->db->insert('t_medidas', $data);
	}
	public function get_max_medida(){
		$this->db->select_max('id');
		$consulta=$this->db->get('t_medidas');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function guardar_det_medida($id_medida,$id_faena,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$fecha){
		$data = array('id_medidas' =>$id_medida,
		'id_faena'=>$id_faena,
		'rodal'=>$rodal,
		'medidas_gps'=>$medidas_gps,
		'medida_cas'=>$medidas_cas,
		'precio_faena'=>$precio_faena,
		'fecha'=>$fecha);
		$this->db->insert('t_det_medidas', $data);
	}
	public function get_medida_id_medida($id_medida){
		$this->db->select('t_medidas.id as id_medidas,t_medidas.fecha_i,t_medidas.fecha_f, t_medidas.id_finca, t_finca.nombre as finca_nombre');
		$this->db->join('t_finca', 't_medidas.id_finca = t_finca.id', 'left');
		$this->db->where('t_medidas.id', $id_medida);
		$consulta=$this->db->get('t_medidas');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_det_medida_id_medida($id_medida){
		$this->db->select('t_det_medidas.id as id_det_medida, t_det_medidas.rodal as rodal, t_det_medidas.medidas_gps as medidas_gps, t_det_medidas.medida_cas as medidas_cas, t_det_medidas.precio_faena as precio_faena, t_det_medidas.id_faena as id_faena,t_det_medidas.fecha as fecha, t_faena.descripcion as faena ');
		$this->db->join('t_faena', 't_det_medidas.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_medidas.id_medidas', $id_medida);
		$consulta=$this->db->get('t_det_medidas');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_det_medida_id_medida_exportar($id_medida){
		$this->db->select('t_faena.descripcion as faena,t_det_medidas.rodal as rodal, t_det_medidas.medidas_gps as medida_GPS, t_det_medidas.medida_cas as medidas_CAS, t_det_medidas.precio_faena as precio_faena, t_det_medidas.fecha as fecha');
		$this->db->join('t_faena', 't_det_medidas.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_medidas.id_medidas', $id_medida);
		$consulta=$this->db->get('t_det_medidas');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_det_medida_id_medida_exportar_pdf($id_medida){
		$this->db->select('t_finca.nombre as nombre_finca, t_faena.descripcion as faena,t_det_medidas.rodal as rodal, t_det_medidas.medidas_gps as medida_GPS, t_det_medidas.medida_cas as medidas_CAS, t_det_medidas.precio_faena as precio_faena, t_det_medidas.fecha as fecha');
		$this->db->join('t_faena', 't_det_medidas.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_medidas.id_medidas', $id_medida);
		$consulta=$this->db->get('t_det_medidas');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function actualizar_det_medidas($id_det_medida,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$id_faena){
		$data = array('id_faena' =>$id_faena,
		'rodal'=>$rodal,
		'medidas_gps'=>$medidas_gps,
		'medida_cas'=>$medidas_cas,
		'precio_faena'=>$precio_faena);
		$this->db->where('id', $id_det_medida);
		$this->db->update('t_det_medidas', $data);
	}
	public function guardar_medida_manual($id_medida,$rodal,$medidas_gps,$medidas_cas,$precio_faena,$id_faena,$fecha){
		$data = array('id_medidas'=>$id_medida,
		'id_faena' =>$id_faena,
		'rodal'=>$rodal,
		'medidas_gps'=>$medidas_gps,
		'medida_cas'=>$medidas_cas,
		'precio_faena'=>$precio_faena,
		'fecha'=>$fecha);
		$this->db->insert('t_det_medidas', $data);
	}
	public function eliminar_det_medida($id_det_medida){
		$this->db->where('id', $id_det_medida);
		$this->db->delete('t_det_medidas');
	}
	public function get_medida_x_mes($id_finca,$fecha_i,$fecha_f){
		$this->db->select('t_det_medidas.id_faena as id_faena,t_det_medidas.rodal as rodal, t_det_medidas.medidas_gps as medidas_gps, t_det_medidas.medida_cas as medida_cas, t_det_medidas.precio_faena as precio_faena, t_det_medidas.fecha as fecha');
		$this->db->join('t_medidas', 't_det_medidas.id_medidas = t_medidas.id', 'left'); 
		$this->db->where('t_medidas.id_finca', $id_finca);
		$this->db->where('t_det_medidas.fecha >=', $fecha_i);
		$this->db->where('t_det_medidas.fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_medidas');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_medida_x_fecha($fecha_i,$fecha_f){
		$this->db->select('SUM(t_det_medidas.medida_cas*t_det_medidas.precio_faena) as total');
		$this->db->where('t_det_medidas.fecha >=', $fecha_i);
		$this->db->where('t_det_medidas.fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_medidas');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}

}

/* End of file medida_model.php */
/* Location: ./application/models/medida_model.php */