
  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar Gasto Detallado</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>gasto/guardar_det_gasto" method="POST"  enctype="multipart/form-data">
         
				<?php if ($gasto): ?>
					<?php foreach ($gasto as $key): ?>
						 <?$id_gasto=$key->id_gasto?>
            <input type="hidden" name="txt_id_gasto" value="<?=$key->id_gasto?>">
        <div class="form-group">
	        <label>Finca</label>
	        <input type="text" class="form-control" name="txt_finca" value="<?=$key->nombre_finca?>" readonly="true">
        </div>
  
        <div class="form-group">
          <label>Observaciones</label>
          <textarea class="form-control" name="txt_observaciones" placeholder="Ingrese Observaciones" readonly="true"><?=$key->observacion?></textarea>
        </div>
     
      <div class="form-group">
        <label>Fecha</label>
        <?$fecha=date('d-m-Y',strtotime($key->fecha_gasto))?>
        <input type="text" class="form-control" name="txt_fecha" value="<?=$fecha?>" readonly="true">
      </div>
					<?php endforeach ?>
				<?php endif ?>
				<hr>
  <div class="form-group">
      <label>Tipo de Gasto</label>
      <select class="selectpicker form-control" name="id_tipo_gasto" id="id_tipo_gasto" data-show-subtext="true" data-live-search="true"  required="required">
        <option data-tokens="" value="">Seleccione Tipo de Gasto</option>
         <?php if ($tipo_gasto): ?>
           <?php foreach ($tipo_gasto as $key): ?>
              <option data-tokens="<?= $key->id.", ".$key->descripcion?>" value="<?= $key->id?>"><?= $key->descripcion?></option>
           <?php endforeach ?>
         <?php else: echo "no hay Resultados" ?>
         <?php endif ?>
    </select>
    </div>	
<div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">Descripcion</span>
	  <input type="text" name="txt_descripcion_gasto" class="form-control" placeholder="Descripcion" aria-describedby="basic-addon1" required="required">
	  <span class="input-group-addon" id="basic-addon1">Cantidad</span>
	  <input type="number" class="form-control" placeholder="Cantidad" aria-describedby="basic-addon1" required="required" name="txt_cantidad_det_gasto">
	  <span class="input-group-addon" id="basic-addon1">Total</span>
	  <input type="number" class="form-control" placeholder="Total" aria-describedby="basic-addon1" required="required" name="txt_total_det_gasto">
</div>
<div class="form-group">
  <label>Observaciones</label>
  <textarea name="txt_observaciones" class="form-control" placeholder="Ingrese Observaciones"></textarea>
</div>
   <div class="form-group" align="center">
     <hr>
      <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      <a href="<?=$this->config->base_url()?>gasto/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
   </div>

<div class="form-group">
<?php if ($det_gasto): ?>
	<table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Tipo de Gasto</th>
             <th class="info">Descripcion</th>
             <th class="info">Cantidad</th>
             <th class="info">Total</th>
             <th class="info">Observaciones</th>
             <th class="info">Acciones</th>
             
            <!--  <?php if ($id_nivel=='1'): ?>  
             <th class="info">Acciones</th>
             <?php endif ?> -->
           </tr>
         </thead>
         <tbody>
 			<?php if ($det_gasto): ?>
 				<?php foreach ($det_gasto as $key): ?>
               <tr>
                 <td><?=$key->descripcion_tipo_gasto?></td>
                 <td><?=$key->descripcion?></td>
                 <td><?=$key->cantidad?></td>
                 <td><?=$key->total?></td>
                <td> <?=$key->observacion?></td>           
               <?php if ($id_nivel=='1'): ?>  
                 <td align="center">
                  <a href="<?=$this->config->base_url()?>/gasto/eliminar_det_gasto/<?=$key->id_det_gasto?>/<?=$id_gasto?>" class="btn btn-danger" title="">Borrar</a>
                 </td>
                 <?php endif ?>
      <?php endforeach ?>
     <?php endif ?>
        
              </tr>
              </tbody>
     </table>
<?php endif ?>  
</div>

          </form>  
          </div>
        </div>
      </div>