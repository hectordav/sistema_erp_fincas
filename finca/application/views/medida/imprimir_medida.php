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

<?php if ($medida): ?>
	<?php foreach ($medida as $key): ?>
		<div align="center">
	<label><h3>Predio: <?=$key->finca_nombre?></h3></label>
		</div>
	<?php endforeach ?>
<?php endif ?>

<table align="center" border="1">
	<thead>
		<tr>
			<th WIDTH="80" align="center">Fecha</th>
			<th  WIDTH="80" align="center">Faena</th>
			<th  WIDTH="80" align="center">Rodal</th>
			<th  WIDTH="80" align="center">Medidas GPS</th>
			<th  WIDTH="80" align="center">Medidas CAS</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($det_medida): ?>
		<?php foreach ($det_medida as $key): ?>	
		<tr>
		<?$fecha=date('d-m-Y',strtotime($key->fecha))?>
			<td  WIDTH="80" align="center"><?=$fecha?></td>
			<td  WIDTH="80" align="center"><?=$key->faena?></td>
			<td  WIDTH="80" align="center"><?=$key->rodal?></td>
			<td  WIDTH="80" align="center"><?=$key->medidas_gps?></td>
			<td  WIDTH="80" align="center"><?=$key->medidas_cas?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>
</body>
</html>