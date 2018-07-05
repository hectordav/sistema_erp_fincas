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

<?php if ($proforma): ?>
	<?php foreach ($proforma as $key): ?>
		<div align="center">
		<?$total=$key->total?>
	<label><h3>Proforma: <?=$key->id_proforma?></h3></label>
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
			<th WIDTH="60" align="center">Fecha</th>
			<th  WIDTH="60" align="center">Finca</th>
			<th  WIDTH="60" align="center">Codigo</th>
			<th  WIDTH="60" align="center">Faena</th>
			<th  WIDTH="60" align="center">Rodal</th>
			<th  WIDTH="60" align="center">Unidad</th>
			<th  WIDTH="60" align="center">Medida</th>
			<th  WIDTH="60" align="center">Precio Unidad</th>
			<th  WIDTH="60" align="center">Total</th>
			<th  WIDTH="60" align="center">Observaciones</th>
			<th  WIDTH="60" align="center">Notas</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($det_proforma): ?>
		<?php foreach ($det_proforma as $key): ?>	
		<tr>
		<?$fecha=date('d-m-Y',strtotime($key->fecha))?>
			<td  WIDTH="60" align="center"><?=$fecha?></td>
			<td  WIDTH="60" align="center"><?=$key->nombre_finca?></td>
			<td  WIDTH="60" align="center"><?=$key->codigo_finca?></td>
			<td  WIDTH="60" align="center"><?=$key->descripcion_faena?></td>
			<td  WIDTH="60" align="center"><?=$key->rodal?></td>
			<td  WIDTH="60" align="center"><?=$key->unidad?></td>
			<td  WIDTH="60" align="center"><?=$key->medida?></td>
			<td  WIDTH="60" align="center"><?=$key->precio_unidad?></td>
			<td  WIDTH="60" align="center"><?=$key->total?></td>
			<td  WIDTH="60" align="center"><?=$key->observacion?></td>
			<td  WIDTH="60" align="center"><?=$key->nota?></td>
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