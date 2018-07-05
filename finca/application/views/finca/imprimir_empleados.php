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

<?php if ($finca): ?>
	<?php foreach ($finca as $key): ?>
		<div align="center">
	<label><h3>finca: <?=$key->nombre?></h3></label>
		</div>
	<?php endforeach ?>
<?php endif ?>

<table align="center" border="1">
	<thead>
		<tr>

			<th WIDTH="130" align="center">Cedula</th>
			<th  WIDTH="130" align="center">Nombre</th>
			<th  WIDTH="130" align="center">Direccion</th>
			<th  WIDTH="130" align="center">Telf</th>
			<th  WIDTH="130" align="center">Posee Seguro?</th>
		</tr>
	</thead>
	<tbody>
	<?php if ($empleado): ?>
		<?php foreach ($empleado as $key): ?>	
		<tr>
			<td  WIDTH="130" align="center"><?=$key->cedula?></td>
			<td  WIDTH="130" align="center"><?=$key->nombre?></td>
			<td  WIDTH="130" align="center"><?=$key->direccion?></td>
			<td  WIDTH="130" align="center"><?=$key->telf?></td>
			<td  WIDTH="130" align="center"><?=$key->seguro?></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>
</body>
</html>