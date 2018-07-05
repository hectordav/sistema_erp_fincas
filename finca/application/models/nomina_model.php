<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nomina_model extends CI_Model {

	public function get_nomina_id_nomina($id_nomina){
		$this->db->select('t_nomina.id as id, t_finca.nombre as nombre_finca, t_nomina.fecha_i as fecha_i, t_nomina.fecha_f as fecha_f');
		$this->db->join('t_finca', 't_nomina.id_finca = t_finca.id', 'left');
		$this->db->where('t_nomina.id',$id_nomina);
		$consulta=$this->db->get('t_nomina');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function guardar_nomina($id_finca,$fecha_i,$fecha_f){
		$data = array('id_finca' =>$id_finca,
		'fecha_i'=>$fecha_i,
		'fecha_f'=>$fecha_f);
		$this->db->insert('t_nomina', $data);
	}
	public function guardar_empleado_nomina($id_nomina,$id_empleado,$sueldo,$mercado,$seguro,$gastos_per,$servicios,$herramientas,$prestamos,$inasistencia,$pasajes,$liquidacion,$otros,$prestaciones,$incapacidad,$trabajos_varios,$valor_final){
		$data = array('id_nomina' =>$id_nomina,
		'id_empleado' =>$id_empleado,
		'salario'=>$sueldo,
		'mercado'=>$mercado,
		'seguro'=>$seguro,
		'gastos_per'=>$gastos_per,
		'servicios'=>$servicios,
		'herramientas'=>$herramientas,
		'prestamos'=>$prestamos,
		'inasistencia'=>$inasistencia,
		'pasajes'=>$pasajes,
		'liquidacion' =>$liquidacion,    
		'otros' =>$otros,          
		'prestaciones' =>$prestaciones,   
		'incapacidades' =>$incapacidad,  
		'trabajos_varios' =>$trabajos_varios,
		'valor_final'=>$valor_final);
		$this->db->insert('t_det_nomina', $data);
	}
	public function get_det_nomina_id_nomina($id_nomina){
		$this->db->select('t_empleado.cedula as cedula, t_empleado.nombre as nombre_empleado, t_det_nomina.id as id_det_nomina, t_det_nomina.salario as salario, t_det_nomina.mercado as mercado, t_det_nomina.seguro as seguro, t_det_nomina.gastos_per as gastos_per, t_det_nomina.servicios as servicios, t_det_nomina.herramientas as herramientas, t_det_nomina.prestamos as prestamos, t_det_nomina.inasistencia as inasistencia, t_det_nomina.pasajes as pasajes,t_det_nomina.liquidacion as liquidacion, t_det_nomina.otros as otros, t_det_nomina.prestaciones as prestaciones, t_det_nomina.incapacidades as incapacidades, t_det_nomina.trabajos_varios as trabajos_varios, t_det_nomina.valor_final as valor_final, t_det_nomina.firma as firma');
		$this->db->join('t_empleado', 't_det_nomina.id_empleado = t_empleado.id', 'left');
		$this->db->where('t_det_nomina.id_nomina', $id_nomina);
		$consulta=$this->db->get('t_det_nomina');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function get_det_nomina_id_nomina_empleado($id_nomina,$busqueda){
		$this->db->select('t_empleado.cedula as cedula, t_empleado.nombre as nombre_empleado, t_det_nomina.id as id_det_nomina, t_det_nomina.salario as salario, t_det_nomina.mercado as mercado, t_det_nomina.seguro as seguro, t_det_nomina.gastos_per as gastos_per, t_det_nomina.servicios as servicios, t_det_nomina.herramientas as herramientas, t_det_nomina.prestamos as prestamos, t_det_nomina.inasistencia as inasistencia, t_det_nomina.pasajes as pasajes, t_det_nomina.valor_final as valor_final, t_det_nomina.firma as firma');
		$this->db->join('t_empleado', 't_det_nomina.id_empleado = t_empleado.id', 'left');
		$this->db->where('t_det_nomina.id_nomina', $id_nomina);
		$where='(t_empleado.cedula='.$busqueda.' or t_empleado.nombre='.$busqueda.')';
		$this->db->where($where);
		$consulta=$this->db->get('t_det_nomina');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
	}
	public function actualizar_det_nomina($id_det_nomina,$sueldo,$mercado,$seguro,$gastos_per,$servicios,$herramientas,$prestamos,$inasistencia,$pasajes,$valor_final){
		$data = array('salario'=>$sueldo,
		'mercado'=>$mercado,
		'seguro'=>$seguro,
		'gastos_per'=>$gastos_per,
		'servicios'=>$servicios,
		'herramientas'=>$herramientas,
		'prestamos'=>$prestamos,
		'inasistencia'=>$inasistencia,
		'pasajes'=>$pasajes,
		'valor_final'=>$valor_final);
		$this->db->where('id', $id_det_nomina);
		$this->db->update('t_det_nomina', $data);
	}
	public function borrar_det_nomina($id_det_nomina){
		$this->db->where('id', $id_det_nomina);
		$this->db->delete('t_det_nomina');
	}
	public function get_empleado_id_empleado_nomina($id_empleado){
		$this->db->where('id_empleado', $id_empleado);
		$consulta=$this->db->get('t_det_nomina');
		  if($consulta->num_rows() > 0){
		      return $consulta->result();
		  }
	}
	public function sumar_det_nomina_id_nomina($id_nomina){
		$this->db->select('SUM(valor_final) as total');
		$this->db->where('id_nomina', $id_nomina);
		$consulta=$this->db->get('t_det_nomina');
			  if($consulta->num_rows() > 0){
			      return $consulta->result();
			  }
		
	}

}

/* End of file nomina_model.php */
/* Location: ./application/models/nomina_model.php */