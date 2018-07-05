<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proforma_model extends CI_Model {

	public function get_proforma_id_proforma($id_proforma){
		$this->db->select('t_proforma.id as id_proforma,t_proforma.fecha_i as fecha_i,t_proforma.fecha_f as fecha_f,  t_proforma.total as total, t_empresa.nombre as nombre_empresa');
		$this->db->join('t_empresa', 't_proforma.id_empresa = t_empresa.id', 'left');
		$this->db->where('t_proforma.id', $id_proforma);
		$consulta=$this->db->get('t_proforma',1);
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function contar_proforma(){
    $this->db->from('t_proforma');
    return $this->db->count_all_results();
  }
	public function get_det_proforma_id_proforma($id_proforma){
		$this->db->select('t_det_proforma.id as id_det_proforma,t_det_proforma.id_faena as id_faena, t_det_proforma.rodal as rodal,t_det_proforma.medida as medida, t_det_proforma.precio_unidad as precio_unidad, t_det_proforma.total as total,t_det_proforma.fecha as fecha, t_det_proforma.observacion as observacion, t_det_proforma.nota as nota, t_det_proforma.unidad as unidad,  t_finca.nombre as nombre_finca, t_finca.codigo as codigo_finca, t_faena.descripcion as descripcion_faena');
		$this->db->join('t_finca', 't_det_proforma.id_finca = t_finca.id', 'left');
		$this->db->join('t_faena', 't_det_proforma.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_proforma.id_proforma', $id_proforma);
		$consulta=$this->db->get('t_det_proforma');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_det_proforma_id_proforma_exportar($id_proforma){
		$this->db->select('t_det_proforma.fecha as fecha,t_finca.nombre as nombre_finca,t_finca.codigo as codigo_finca,t_faena.descripcion as descripcion_faena,t_det_proforma.rodal as rodal, t_det_proforma.unidad as unidad,t_det_proforma.medida as medida, t_det_proforma.precio_unidad as precio_unidad, t_det_proforma.total as total, t_det_proforma.observacion as observacion, t_det_proforma.nota as nota');
		$this->db->join('t_finca', 't_det_proforma.id_finca = t_finca.id', 'left');
		$this->db->join('t_faena', 't_det_proforma.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_proforma.id_proforma', $id_proforma);
		$consulta=$this->db->get('t_det_proforma');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_det_proforma_finca_mes($id_finca,$fecha_i,$fecha_f){
		$this->db->select('t_det_proforma.rodal as rodal,t_det_proforma.medida as medida, t_det_proforma.precio_unidad as precio_unidad, t_det_proforma.total as total,t_det_proforma.fecha as fecha, t_det_proforma.observacion as observacion, t_det_proforma.nota as nota, t_det_proforma.unidad as unidad,  t_finca.nombre as nombre_finca, t_finca.codigo as codigo_finca,t_det_proforma.id_faena as id_faena, t_faena.descripcion as descripcion_faena');
		$this->db->join('t_finca', 't_det_proforma.id_finca = t_finca.id', 'left');
		$this->db->join('t_faena', 't_det_proforma.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_proforma.id_finca', $id_finca);
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_proforma');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}

	public function guardar_proforma($id_empresa,$total){
		$data = array('id_empresa'=>$id_empresa,
			'total' =>$total);
		$this->db->insert('t_proforma', $data);
	}
	public function get_max_proforma(){
		$this->db->select_max('id');
		$consulta=$this->db->get('t_proforma');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function guardar_det_proforma($id_proforma,$id_faena,$id_finca,$fecha,$rodal,$unidad,$medida,$precio_unidad,$total,$observacion,$nota){
		$data = array('id_proforma'=>$id_proforma,
	'id_finca'=>$id_finca,
	'id_faena'=>$id_faena,
	'fecha'=>$fecha,
	'rodal'=>$rodal,
	'unidad'=>$unidad,
	'medida'=>$medida,
	'precio_unidad'=>$precio_unidad,
	'total'=>$total,
	'observacion'=>$observacion,
	'nota'=>$nota);
		$this->db->insert('t_det_proforma', $data);
	}
	public function sumar_det_proforma_id_proforma($id_proforma){
		$this->db->select('SUM(total) as total');
		$this->db->where('id_proforma', $id_proforma);
		$consulta=$this->db->get('t_det_proforma');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function sumar_det_proforma_por_fecha($fecha_i,$fecha_f){
		$this->db->select('SUM(total) as total');
		$this->db->where('fecha >=', $fecha_i);
		$this->db->where('fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_proforma');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_proforma_total($id_proforma,$total){
		$data = array('total' =>$total);
		$this->db->where('id', $id_proforma);
		$this->db->update('t_proforma', $data);
	}
	public function actualizar_proforma_fecha_i($id_proforma,$fecha_arreglo){
		$data = array('fecha_i' =>$fecha_arreglo);
		$this->db->where('id', $id_proforma);
		$this->db->update('t_proforma', $data);
	}
	public function actualizar_proforma_fecha_f($id_proforma,$fecha_arreglo){
		$data = array('fecha_f' =>$fecha_arreglo);
		$this->db->where('id', $id_proforma);
		$this->db->update('t_proforma', $data);
	}
	public function actualizar_det_proforma($id_det_proforma,$id_faena,$rodal,$unidad,$medida,$precio_unidad,$total,$observacion,$notas){
		$data = array('id_faena'=>$id_faena,
		'rodal'=>$rodal,
		'unidad'=>$unidad,
		'medida'=>$medida,
		'precio_unidad'=>$precio_unidad,
		'total'=>$total,
		'observacion'=>$observacion,
		'nota'=>$notas);
		$this->db->where('id', $id_det_proforma);
		$this->db->update('t_det_proforma', $data);
	}
	public function borrar_det_proforma($id_det_proforma){
		$this->db->where('id', $id_det_proforma);
		$this->db->delete('t_det_proforma');
	}
	

}

/* End of file proforma_model.php */
/* Location: ./application/models/proforma_model.php */