
  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Gastos por Finca</strong></h3></label>
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
<?php if ($det_gasto): ?>
	<table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Descripcion</th>
             <th class="info">Cantidad</th>
             <th class="info">Total</th>
             <th class="info">Observaciones</th>  
            <!--  <?php if ($id_nivel=='1'): ?>  
             <th class="info">Acciones</th>
             <?php endif ?> -->
           </tr>
         </thead>
         <tbody>
 			<?php if ($det_gasto): ?>
 				<?php foreach ($det_gasto as $key): ?>
     					
               <tr>
                 <td><?=$key->descripcion?></td>
                 <td><?=$key->cantidad?></td>
                 <td><?=$key->total?></td>
                <td> <?=$key->observacion?></td>
						
               
               <?php if ($id_nivel=='1'): ?>  
                 <?php endif ?>
      <?php endforeach ?>
     <?php endif ?>
        
              </tr>
              </tbody>
     </table>
<?php endif ?>  
</div>
 <div class="form-group" align="center">
     <hr>
       <a href="<?=$this->config->base_url()?>gasto/exportar_pdf/<?=$id_gasto?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
      <a href="<?=$this->config->base_url()?>gasto/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
   </div>

          </form>  
          </div>
        </div>
      </div>