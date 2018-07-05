<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medidas_valores_model extends CI_Model {

	public function get_medidas_valores_id_medidas($id_medida){
		$this->db->where('id_medidas', $id_medida);
		$consulta=$this->db->get('t_medida_valor',1);
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function guardar_medidas_valores($id_medida){
		$data = array('id_medidas' =>$id_medida);
		$this->db->insert('t_medida_valor', $data);
	}
	public function get_medidas_valores_id_medidas_det_medidas($id_medida_valor,$id_det_medida){
		$this->db->where('id_medida_valor', $id_medida_valor);
		$this->db->where('id_det_medidas', $id_det_medida);
		$consulta=$this->db->get('t_det_medidas_valor');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function guardar_det_medidas_valores($id_medida_valor,$id_det_medida,$diferencia,$observaciones){
		$data = array('id_medida_valor' =>$id_medida_valor,
		'id_det_medidas' =>$id_det_medida,
		'diferencia' =>$diferencia,
		'observacion' =>$observaciones);
		$this->db->insert('t_det_medidas_valor', $data);
	}
	public function actualizar_det_medidas_valores($id_det_medida_valor,$diferencia,$observaciones){
		$data = array('diferencia' =>$diferencia,
			'observacion' =>$observaciones);
		$this->db->where('id', $id_det_medida_valor);
		$this->db->update('t_det_medidas_valor', $data);
	}
	public function get_medidas_valores_id_medida($id_medida_valor){
		$this->db->select('t_medida_valor.id as id_medida_valor,t_medida_valor.observacion as observaciones, t_medidas.fecha_i as fecha_i, t_medidas.fecha_f as fecha_f, t_finca.nombre as nombre_finca');
		$this->db->join('t_medidas', 't_medida_valor.id_medidas = t_medidas.id', 'left');
		$this->db->join('t_finca', 't_medidas.id_finca = t_finca.id', 'left');
		$this->db->where('t_medida_valor.id', $id_medida_valor);
		$consulta=$this->db->get('t_medida_valor');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function get_det_medidas_valores_id_medida_valor($id_medida_valor){
		$this->db->select('t_det_medidas_valor.id as id_det_medida_valor, t_det_medidas_valor.diferencia as diferencia, t_det_medidas_valor.observacion as observacion_det_medida,t_faena.descripcion as faena, t_det_medidas.rodal as rodal, t_det_medidas.medidas_gps as medidas_gps, t_det_medidas.medida_cas as medidas_cas');
		$this->db->join('t_det_medidas', 't_det_medidas_valor.id_det_medidas = t_det_medidas.id', 'left');
		$this->db->join('t_faena', 't_det_medidas.id_faena = t_faena.id', 'left');
		$this->db->where('t_det_medidas_valor.id_medida_valor', $id_medida_valor);
		$consulta=$this->db->get('t_det_medidas_valor');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}

}

/* End of file medidas_valores_model.php */
/* Location: ./application/models/medidas_valores_model.php */