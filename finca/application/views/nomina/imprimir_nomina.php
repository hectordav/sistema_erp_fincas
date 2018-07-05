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

<?php if ($nomina): ?>
	<?php foreach ($nomina as $key): ?>
		<div align="center">
		<?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
		<?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
	<label><h3>Nomina: <?=$key->id?> &nbsp; Fecha Inicio: <?=$fecha_i?> Fecha Final: <?=$fecha_f?></h3></label>
	&nbsp;
		
	<label><h3></h3></label>
		</div>
	<?php endforeach ?>
<?php endif ?>
<table align="center" border="1">
	<thead>
		<tr>
			<th WIDTH="10" align="center"><font size="2">Cedula</font></th>
			<th WIDTH="10" align="center"><font size="2">Empleado</font></th>
			<th WIDTH="10" align="center"><font size="2">Salario</font></th>
			<th WIDTH="10" align="center"><font size="2">Mercado</font></th>
			<th WIDTH="10" align="center"><font size="2">Seguro</font></th>
			<th WIDTH="10" align="center"><font size="2">Gastos Per.</font></th>
			<th WIDTH="10" align="center"><font size="2">Servicios</font></th>
			<th WIDTH="10" align="center"><font size="2">Herramientas</font></th>
			<th WIDTH="10" align="center"><font size="2">Prestamos</font></th>
			<th WIDTH="10" align="center"><font size="2">Inasistencia</font></th>
			<th WIDTH="10" align="center"><font size="2">Pasajes</font></th>
			<th WIDTH="10" align="center"><font size="2">Liquidacion</font></th>
			<th WIDTH="10" align="center"><font size="2">Otros</font></th>
			<th WIDTH="10" align="center"><font size="2">Prestaciones</font></th>
			<th WIDTH="10" align="center"><font size="2">Incapacidades</font></th>
			<th WIDTH="10" align="center"><font size="2">T Varios</font></th>
			<th WIDTH="10" align="center"><font size="2">Valor Final</font></th>
			
             
		</tr>
	</thead>
	<tbody>
	<?php if ($det_nomina): ?>
		<?php foreach ($det_nomina as $key): ?>	
		<tr>
				<td WIDTH="10" align="center"><font size="2"><?=$key->cedula?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->nombre_empleado?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->salario?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->mercado?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->seguro?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->gastos_per?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->servicios?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->herramientas?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->prestamos?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->inasistencia?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->pasajes?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->liquidacion?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->otros?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->prestaciones?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->incapacidades?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->trabajos_varios?></font></td>
				<td WIDTH="10" align="center"><font size="2"><?=$key->valor_final?></font></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>

</div>
</body>
</html>