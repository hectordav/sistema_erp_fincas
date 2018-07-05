<!DOCTYPE html>
<html>
<head>
</head>
<style type="text/css">
	table {
  border-collapse: collapse;
}
</style>
<body>
<br>
<img width="200" height="66" src="assets/img/nacer.png" alt="">

<?php if ($medidas_valor): ?>
	<?php foreach ($medidas_valor as $key): ?>
		 <?$id_medida_valor=$key->id_medida_valor?>
		<div align="center">
	<label><h3>Predio: <?=$key->nombre_finca?></h3></label>
	<?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
	 <?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
	 Fecha Inicio: <?=$fecha_i?> &nbsp;Fecha Final: <?=$fecha_f?>
		</div>
	<?php endforeach ?>
<?php endif ?>

<table align="center" border="1">
	<thead>
		<tr>
			<th WIDTH="80" align="center">Faena</th>
			<th  WIDTH="80" align="center">Rodal</th>
			<th  WIDTH="80" align="center">Medidas GPS</th>
			<th  WIDTH="80" align="center">Medidas CAS</th>
			<th  WIDTH="80" align="center">Diferencia</th>
			<th  WIDTH="80" align="center">Observaciones</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($det_medidas_valores): ?>
		<?php foreach ($det_medidas_valores as $key): ?>	
		<tr>
			<td  WIDTH="80" align="center"><?=$key->faena?></td>
			<td  WIDTH="80" align="center"><?=$key->rodal?></td>
			<td  WIDTH="80" align="center"><?=$key->medidas_gps?></td>
			<td  WIDTH="80" align="center"><?=$key->medidas_cas?></td>
			<td  WIDTH="80" align="center"><?=$key->diferencia?></td>
			<td  WIDTH="80" align="center"><?=$key->observacion_det_medida?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>
</body>
</html>