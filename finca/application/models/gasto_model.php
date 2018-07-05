<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gasto_model extends CI_Model {
	
	public function guardar_gasto($id_finca,$fecha,$observaciones){
		$data = array('id_finca' =>$id_finca,
		'observacion' =>$observaciones,
		'total' =>'0',
		'fecha' =>$fecha);
		$this->db->insert('t_gasto', $data);
	}
	public function get_gasto_id_gasto($id_gasto){
		$this->db->select('t_gasto.id as id_gasto, t_gasto.observacion as observacion, t_gasto.total as total, t_gasto.fecha as fecha_gasto, t_finca.nombre as nombre_finca');
		$this->db->join('t_finca', 't_gasto.id= t_finca.id', 'left');
		$this->db->where('t_gasto.id', $id_gasto);
		$consulta=$this->db->get('t_gasto');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function sumar_gastos_entre_fechas($fecha_i, $fecha_f){
			$this->db->select('fecha as fecha, sum(total) as total');
			$this->db->group_by('fecha');
      $this->db->where('fecha >=',$fecha_i);
      $this->db->where('fecha <=',$fecha_f);
      $consulta=$this->db->get('t_gasto');
      if($consulta->num_rows() > 0){
        return $consulta->result();
      }
  }
	public function get_det_gasto_id_gasto($id_gasto){
		$this->db->select('t_det_gasto.id as id_det_gasto, t_det_gasto.id_gasto as id_gasto,t_det_gasto.descripcion as descripcion, t_det_gasto.cantidad as cantidad, t_det_gasto.total as total, t_det_gasto.observacion as observacion, t_tipo_gasto.descripcion as descripcion_tipo_gasto');
		$this->db->join('t_tipo_gasto', 't_det_gasto.id_tipo_gasto = t_tipo_gasto.id', 'left');
		$this->db->where('id_gasto', $id_gasto);
		$consulta=$this->db->get('t_det_gasto');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function suma_tipo_gasto_fecha($fecha_i,$fecha_f){
		$this->db->select('sum(t_det_gasto.total) as total,t_det_gasto.id_tipo_gasto as id_tipo_gasto, t_tipo_gasto.descripcion as tipo_gasto');
		$this->db->join('t_gasto', 't_det_gasto.id_gasto = t_gasto.id', 'left');
		$this->db->join('t_tipo_gasto', 't_det_gasto.id_tipo_gasto = t_tipo_gasto.id', 'left');
		$this->db->group_by('t_tipo_gasto.descripcion');
		$this->db->where('t_gasto.fecha >=', $fecha_i);
		$this->db->where('t_gasto.fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_gasto');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function suma_tipo_gasto_fecha_total($fecha_i,$fecha_f){
		$this->db->select('sum(t_det_gasto.total) as total');
		$this->db->join('t_gasto', 't_det_gasto.id_gasto = t_gasto.id', 'left');
		$this->db->where('t_gasto.fecha >=', $fecha_i);
		$this->db->where('t_gasto.fecha <=', $fecha_f);
		$consulta=$this->db->get('t_det_gasto');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}

	public function get_det_gasto_id_tipo_gasto(){
		$this->db->select('t_det_gasto.id_tipo_gasto as id_tipo_gasto_det,t_det_gasto.total as total, t_det_gasto.descripcion as descripcion_det_gasto');
		$consulta=$this->db->get('t_det_gasto');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function guardar_det_gasto($id_gasto,$id_tipo_gasto,$descripcion_gasto,$cantidad_det_gasto,$total_det_gasto,$observacion){
		$data = array('id_gasto' =>$id_gasto,
		'id_tipo_gasto' =>$id_tipo_gasto,
		'descripcion' =>$descripcion_gasto,
		'cantidad' =>$cantidad_det_gasto,
		'total' =>$total_det_gasto,
		'observacion' =>$observacion);
		$this->db->insert('t_det_gasto', $data);
	}
	public function eliminar_det_gasto($id_det_gasto){
		$this->db->where('id', $id_det_gasto);
		$this->db->delete('t_det_gasto');
	}
	public function get_tipo_gasto(){
		$consulta=$this->db->get('t_tipo_gasto');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function suma_det_gasto_id_gasto($id_gasto){
		$this->db->select('sum(t_det_gasto.total) as total, t_det_gasto.id_tipo_gasto as id_tipo_gasto');
		$this->db->where('t_det_gasto.id_gasto', $id_gasto);
		$consulta=$this->db->get('t_det_gasto');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function actualizar_suma_gasto_id_gasto($id_gasto,$total){
		$data = array('total' =>$total);
		$this->db->where('id', $id_gasto);
		$this->db->update('t_gasto', $data);
	}

}

/* End of file gasto_model.php */
/* Location: ./application/models/gasto_model.php */