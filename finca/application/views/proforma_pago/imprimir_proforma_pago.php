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
<?php if ($proforma_pago): ?>
	<?php foreach ($proforma_pago as $key): ?>
		<div align="center">
		<?$total=$key->total?>
	<label><h3>Proforma de pago: <?=$key->id_proforma_pago?></h3></label>
	<label><h3>Finca: <?=$key->nombre_finca?></h3></label>
	&nbsp;
		<?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
			<?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
	<label><h3>Fecha Inicio: <?=$fecha_i?> &nbsp;Fecha Final: <?=$fecha_f?></h3></label>
		</div>
	<?php endforeach ?>
<?php endif ?>

<table align="center" border="1">
	<thead>
		<tr>
			<th  WIDTH="140" align="center">Faena</th>
			<th  WIDTH="140" align="center">Rodal</th>
			<th  WIDTH="140" align="center">Medida</th>
			<th  WIDTH="140" align="center">Precio Unidad</th>
			<th  WIDTH="140" align="center">Total</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($det_proforma_pago): ?>
		<?php foreach ($det_proforma_pago as $key): ?>	
		<tr>
			<td  WIDTH="140" align="center"><?=$key->descripcion_faena?></td>
			<td  WIDTH="140" align="center"><?=$key->rodal?></td>
			<td  WIDTH="140" align="center"><?=$key->medida?></td>
			<td  WIDTH="140" align="center"><?=$key->precio_unidad?></td>
			 <?$total_1=$key->total?>
 			<?$total_2 = number_format($total_1, 2, ',', '.');?>
			<td  WIDTH="60" align="center"><?=$total_2?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>
<div align="right">
 <?$total_1=$total?>
 <?$total_2 = number_format($total_1, 2, ',', '.');?>
	<label><h3>Total: <?=$total_2?> </h3></label>
</div>
</body>
</html>