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

<?php if ($informe_gasto_proveedor): ?>
	<?php foreach ($informe_gasto_proveedor as $key): ?>
		
		<div align="center">
		<font size="5">Proveedor: <?=$key->nombre_proveedor?></font>

		</div>
		<div align="center">
		 <?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
			<font size="5">Fecha de Inicio: &nbsp; <?=$fecha_i?></font>
		</div>
		<div align="center">
			<?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
			<font size="5">Fecha Final: <?=$fecha_f?></font>
		</div>
		<div align="center">
			<font size="5">Totales: <?=$key->total?></font>
		</div>
	<?php endforeach ?>
<?php endif ?>
<br>
<table align="center" border="1" style=" border: border-collapse; width:80%">
	<thead>
		<tr>
			<th width="50%" align="center"><font size="5">Tipo de Gasto</font></th>
			<th width="50%" align="center"><font size="5">Monto</font></th>
			<th width="50%" align="center"><font size="5">Fecha</font></th>
		</tr>
	</thead>
	<tbody>
	 <?php if ($det_informe_gasto_proveedor): ?>
      <?php foreach ($det_informe_gasto_proveedor as $key): ?>
		<tr>
			<td width="50%" align="center"><font size="5"><?=$key->tipo_gasto_proveedor?></font></td>
			<td width="50%" align="center"><font size="5"><?=$key->monto_det_informe?></font></td>
			 <?$fecha_det=date('d-m-Y',strtotime($key->fecha_det_informe))?>
			<td width="50%" align="center"><font size="5"><?=$fecha_det?></font></td>
		</tr>
		<?php endforeach ?>
	<?php endif ?>
	</tbody>
</table>

</div>
</body>
</html>