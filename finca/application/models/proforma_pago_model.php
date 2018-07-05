<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proforma_pago_model extends CI_Model {

	public function guardar_proforma_pago($id_empresa,$id_finca,$fecha_i,$fecha_f){
		$data = array('id_empresa' =>$id_empresa,
		'id_finca'=>$id_finca,
		'fecha_i'=>$fecha_i,
		'fecha_f'=>$fecha_f);
		$this->db->insert('t_proforma_pago', $data);
	}
	public function get_max_proforma_pago(){
		$this->db->select_max('id');
		$consulta=$this->db->get('t_proforma_pago');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  } 
	}
	public function get_proforma_id_proforma($id_proforma_pago){
		$this->db->select('t_proforma_pago.id as id_proforma_pago,t_proforma_pago.fecha_i as fecha_i, t_proforma_pago.fecha_f as fecha_f,t_proforma_pago.total as total, t_empresa.nombre as nombre_empresa, t_finca.nombre as nombre_finca');
		$this->db->join('t_empresa', 't_proforma_pago.id_empresa = t_empresa.id', 'left');
		$this->db->join('t_finca', 't_proforma_pago.id_finca = t_finca.id', 'left');
		$this->db->where('t_proforma_pago.id', $id_proforma_pago);
		$consulta=$this->db->get('t_proforma_pago');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_det_proforma_id_proforma($id_proforma_pago){
		$this->db->select('t_det_proforma_pago.id as id_det_proforma_pago,t_det_proforma_pago.rodal as rodal,t_det_proforma_pago.medida as medida,t_det_proforma_pago.precio_unidad as precio_unidad,t_det_proforma_pago.total as total,t_det_proforma_pago.id_faena as id_faena, t_faena.descripcion as descripcion_faena');
		$this->db->join('t_faena', 't_det_proforma_pago.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_proforma_pago.id_proforma_pago', $id_proforma_pago);
		$consulta=$this->db->get('t_det_proforma_pago');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_det_proforma_id_proforma_exportar($id_proforma_pago){
		$this->db->select('t_faena.descripcion as descripcion_faena,t_det_proforma_pago.rodal as rodal,t_det_proforma_pago.medida as medida,t_det_proforma_pago.precio_unidad as precio_unidad,t_det_proforma_pago.total as total');
		$this->db->join('t_faena', 't_det_proforma_pago.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_proforma_pago.id_proforma_pago', $id_proforma_pago);
		$consulta=$this->db->get('t_det_proforma_pago');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function guardar_det_proforma_pago($id_proforma_pago,$id_faena,$rodal,$medida,$precio_unidad,$total){
		$data = array('id_proforma_pago'=>$id_proforma_pago,
			'id_faena'=>$id_faena,
			'rodal'=>$rodal,
			'medida'=>$medida,
			'precio_unidad'=>$precio_unidad,
			'total'=>$total);
		$this->db->insert('t_det_proforma_pago', $data);
	}
	public function get_sum_det_plataforma($id_proforma_pago){
		$this->db->select('SUM(total) as total');
		$this->db->where('id_proforma_pago', $id_proforma_pago);
		$consulta=$this->db->get('t_det_proforma_pago');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_sum_det_proforma_pago_fechas($fecha_i,$fecha_f){
		$this->db->select('SUM(total) as total');
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_proforma_pago');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_proforma_pago_total($id_proforma_pago,$total){
		$data = array('total' =>$total);
		$this->db->where('id', $id_proforma_pago);
		$this->db->update('t_proforma_pago', $data);
	}
	public function actualizar_det_proforma_pago($id_det_proforma_pago,$rodal,$medida,$precio_u,$total,$id_faena){
		$data = array('id_faena'=>$id_faena,
		'rodal'=>$rodal,
		'medida'=>$medida,
		'precio_unidad'=>$precio_u,
		'total'=>$total);
		$this->db->where('id',$id_det_proforma_pago);
		$this->db->update('t_det_proforma_pago', $data);
	}
	public function borrar_det_proforma($id_det_proforma_pago){
		$this->db->where('id', $id_det_proforma_pago);
		$this->db->delete('t_det_proforma_pago');
	}

}

/* End of file proforma_pago_model.php */
/* Location: ./application/models/proforma_pago_model.php */