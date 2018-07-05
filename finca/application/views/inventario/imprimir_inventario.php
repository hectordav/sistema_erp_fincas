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
<img width="200" height="66" src="assets/img/nacer.png" alt="">
<br>
<br>
<br>

<?php if ($inventario): ?>
	<?php foreach ($inventario as $key): ?>
		<div align="center">
	<label><h3>Inventario: <?=$key->id_inventario?></h3></label>
	<label><h3>Empleado: <?=$key->nombre_empleado?></h3></label>
	<?$fecha=date('d-m-Y',strtotime($key->fecha))?>
	<label><h3>Fecha: <?=$fecha?></h3></label>
	

		
	<label><h3></h3></label>
		</div>
	<?php endforeach ?>
<?php endif ?>

<table align="center" border="1">
	<thead>
		<tr>
			<th WIDTH="200" align="center">Herramienta</th>
			<th WIDTH="200" align="center">Cantidad</th>
	           
		</tr>
	</thead>
	<tbody>
	<?php if ($det_inventario): ?>
		<?php foreach ($det_inventario as $key): ?>	
		<tr>
				<td WIDTH="200" align="center"><?=$key->descripcion_herramienta?></td>
				<td WIDTH="200" align="center"><?=$key->cantidad?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>
<?php if ($inventario): ?>
	<?php foreach ($inventario as $key): ?>	
		<label>Observaciones</label>
		<h3><?=$key->observacion?></h3>
	<?php endforeach ?>
<?php endif ?>

</div>
</body>
</html>