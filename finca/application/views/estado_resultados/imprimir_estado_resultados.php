<!DOCTYPE html>
<html>
<head>
</head>
<style type="text/css">
	table {
  width: 50%;
}
.espacio{
	line-height: 300%;
}
.espacio_2{
	line-height: 800%;
}

.cuadro{
	border-collapse: collapse; 
	border: 1;
}


</style>
<body>
<br>
<img width="200" height="66" src="assets/img/nacer.png" alt="">
<table style="width:100%" >
	<thead>
		<tr>
			<td border="0">
			<div align="center">
				NACER FORESTAL SAS				
			</div>
			<div align="center">
			 	NIT:  900598767-1
			</div>
			 <div align="center">
			 	ESTADO DE RESULTADOS
			 </div>
				<?$fecha_i=date('d-m-Y',strtotime($fecha_i))?>
				<?$fecha_f=date('d-m-Y',strtotime($fecha_f))?>
				<div align="center">
					Desde <?=$fecha_i?> Hasta <?=$fecha_f?>
				</div>
			</td>
	</thead>
	<tbody>
	</tbody>
</table>
<br>
<br>
<table border="0" align="center" style="border-collapse: collapse; width:80%">
	<thead>
	</thead>
	<tbody>
		<tr class="espacio">
			<td>
				<div>
					<strong>INGRESOS</strong>
				</div>
			</td>
			<td>
				<div align="center">
				</div>
			</td>
				<td>
				<div align="center">
				</div>
			</td>
			<td>
				<div align="right">
					<?=$ingresos_cas?>
				</div>
			</td>
		</tr>
		<tr>
			<td>
			<div>
				<strong>VENTAS</strong>
				<div class="espacio">
					<label>Compañia agricola de la Sierra</label>
				</div>
			</div>
			</td>
			<td class="espacio">

			</td>
			<td>
			<div class="padre" align="right">
				<?=$ingresos_cas?>
			</div>
			</td>
			<td>
			<div align="right">
			
			</div>
			</td>
		</tr>
		<tr>
			<td>
			<div class="padre">
				<strong>Costo de Ventas</strong>
			</div>
			</td>
			<td>
			<div align="center">
			</div>
			</td>
			<td>
			<div class="padre" align="right">
			
			</div>
			</td>
			<td>
			<div align="right">
				<?=$costo_ventas?>
			</div>
			</td>
		</tr>
		<tr>
			<td>
				<div  class="espacio">
				Costo de la mercancia Vendida
			</div>
			</td>
			<td>
		
			</td>
			<td>
			<div align="right">
				<?=$costo_ventas?>
			</div>
			</td>
			<td>
			<div align="right">
			</div>
			</td>
		</tr>
		<tr>
			<td>
				<div  class="espacio">
				<strong>UTILIDAD BRUTA EN VENTAS</strong>
			</div>
			</td>
			<td>
		
			</td>
			<td>
			<div align="right">
			</div>
			</td>
			<td>
			<div align="right">
				<?$utilidad_bruta=$ingresos_cas-$costo_ventas?>
				<?=$utilidad_bruta?>
			</div>
			</td>
		</tr>
		<tr>
			<td>
			<div>
				<strong>G. DE ADMINISTRACION Y VENTAS</strong>
			</div>
			</td>
			<td>
			<div align="center">
			</div>
			</td>
			<td>
			</td>
			<td>
			<div class="padre" align="right">
				<?=$total_det_gasto?>
			</div>
			</td>
		</tr>
			  <?php if ($consulta_tipo_gasto): ?>
      <?php foreach ($consulta_tipo_gasto as $key): ?>
      <tr class="padre">
				<td>
					<div>
					&nbsp;&nbsp;&nbsp;<strong><?=$key->tipo_gasto?></strong>
				</div>
				</td>
				<td>
			
				</td>
				<td>
				</td>
				<td>
					<div align="right">
					<strong><?=$key->total?></strong>
				</div>
				</td>
			</tr>
		  <?php if ($consulta_det_tipo_gasto): ?>
        <?php foreach ($consulta_det_tipo_gasto as $key2): ?>
         <?php if ($key2->id_tipo_gasto_det==$key->id_tipo_gasto): ?>
      <tr>
				<td>
					<div>
					&nbsp;&nbsp;&nbsp;<?=$key2->descripcion_det_gasto?>
				</div>
				</td>
				<td>
				</td>
				<td>
				<div align="right">
					<?=$key2->total?>
				</div>
				</td>
				<td>
				</td>
			</tr>
			 <?php endif ?>
        <?php endforeach ?>
      <?php endif ?>
      <?php endforeach ?>
    <?php endif ?>
    <tr class="espacio">
			<td>
			&nbsp;
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
     <?php if ($total_ingresos): ?>
		<tr>
			<td>
			<div>
				<strong>Otros Ingresos</strong>
			</div>
			</td>
			<td>
			<div align="center">
			</div>
			</td>
			<td>
			</td>
			<td>
			<div class="padre" align="right">
				<strong><?=$total_ingresos?></strong>
			</div>
			</td>
		</tr>
		<?php endif ?>
		  <?php if ($consulta_det_ingresos): ?>
      <?php foreach ($consulta_det_ingresos as $key): ?>
		<tr>
			<td>
			<div>
				&nbsp;&nbsp;&nbsp;<?=$key->descripcion?>
			</div>
			</td>
			<td>
			<div align="center">
			</div>
			</td>
			<td>
			<div class="padre" align="right">
				<?=$key->total?>
			</div>
			</td>
			<td>
			</td>
		</tr>
		  <?php endforeach ?>
    <?php endif ?>
    <tr class="espacio">
			<td>
			&nbsp;
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			</td>
		</tr>
		 <tr class="espacio">
			<td>
		<strong>UTILIDAD NETA AJUSTADA</strong>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
				<?$gastos=$total_det_gasto+$costo_ventas?>
				<?$total_utilidad=$utilidad_bruta+$total_ingresos-$gastos?>
			<strong><?=$total_utilidad?></strong>
			</td>
		</tr>
		<tr>
			<td>
			<strong>INELDA GONZALEZ AGUIRRE</strong>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			<strong>YENNI TORO CELIS </strong>
			</td>
		</tr>
		<tr>
			<td>
			<strong>T.P  142967-T</strong>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			<strong>C.C.  22030056</strong>
			</td>
		</tr>
		<tr>
			<td>
			<strong>Contadora Publica </strong>
			</td>
			<td>
			</td>
			<td>
			</td>
			<td>
			<strong>Representante Legal </strong>
			</td>
		</tr>
	</tbody>
</table>
<br>
<br>
<br>
<div>
	La suscrita contadora publica I identificada con numero de C.C 43545074de Medellin con matricula 142967- T bajo la gravedad de juramento, declaro que lo verificado  previamente las afirmaciones contenidas en los estados financieros aportados con corte al 31/12/2016 conforme al reglamento y las he tomado fielmente de los libros, segùn lo dispuesto en el articulo 37 de la ley 222 de 1995 
</div>
</body>
</html>