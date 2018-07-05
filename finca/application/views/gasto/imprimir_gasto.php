<!DOCTYPE html>
<html>
<head>
</head>
<style type="text/css">
	table {
  border-collapse: collapse;
  width: 50%;
}
</style>
<body>
<br>
<img width="200" height="66" src="assets/img/nacer.png" alt="">

<?php if ($gasto): ?>
	<?php foreach ($gasto as $key): ?>
		
		<div align="center">
		<?$fecha=date('d-m-Y',strtotime($key->fecha_gasto))?>
	<label><h2>Finca: <?=$key->nombre_finca?></h2></label>
	 <label><h2>Fecha: <?=$fecha?> Total: <?=$key->total?></h2></label>
	<label><h2>Observaciones:<?=$key->observacion?></h2></label>
	&nbsp;
		</div>
	<?php endforeach ?>
<?php endif ?>
<table align="center" border="1">
	<thead>
		<tr>
			<th width="50%" align="center"><font size="5">Descripcion</font></th>
			<th width="50%" align="center"><font size="5">Cantidad</font></th>
			<th width="50%" align="center"><font size="5">Total</font></th>
			<th width="50%" align="center"><font size="5">Observaciones</font></th>       
		</tr>
	</thead>
	<tbody>
	<?php if ($det_gasto): ?>
		<?php foreach ($det_gasto as $key): ?>	
		<tr>
				<td width="50%" align="center"><font size="5"><?=$key->descripcion?></font></td>
				<td width="50%" align="center"><font size="5"><?=$key->cantidad?></font></td>
				<td width="50%" align="center"><font size="5"><?=$key->total?></font></td>
				<td width="50%" align="center"><font size="5"><?=$key->observacion?></font></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>

</div>
</body>
</html>