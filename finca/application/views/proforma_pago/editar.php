  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Proforma Pago</strong></h3></label>
             <hr>
        <div class="form-group">
        <label>Finca</label>
         <form  role="form" action="<?php echo $this->config->base_url();?>proforma_pago/actualizar_det_proforma_pago_todos" method="POST"  enctype="multipart/form-data">
          <?php if ($proforma_pago): ?>
            <?php foreach ($proforma_pago as $key): ?>
          <input type="hidden" name="txt_id_proforma_pago" value="<?=$key->id_proforma_pago?>">
            <input type="text" class="form-control" name="" value="<?=$key->nombre_finca?>" readonly="true">
        </div>
        <div class="form-group">
          <label>Fecha Inicio</label>
          <?$fecha_format_i=date('d-m-Y',strtotime($key->fecha_i))?>
          <input type="text" class="form-control" name="" value="<?=$fecha_format_i?>" readonly="true">
        </div>
        <div class="form-group">
          <label>Fecha Final</label>
           <?$fecha_format_f=date('d-m-Y',strtotime($key->fecha_f))?>
          <input type="text" class="form-control" name="" value="<?=$fecha_format_f?>" readonly="true">
        </div>
        <div class="form-group">
          <label>Total</label>
          <?$total_1=$key->total?>
          <?$total_2 = number_format($total_1, 2, '.', '.');?>
          <input type="text" class="form-control" name="" value="<?=$total_2?>" readonly="true">
        </div>
          <?php endforeach ?>
        <?php endif ?>
          <?php if ($det_proforma_pago): ?>
           <?php foreach ($det_proforma_pago as $key): ?>

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-4 col-sm-4 col-xs-4">
   <label>Faena</label>
    <select class="form-control" name="id_faena_<?=$key->id_det_proforma_pago?>" id="id_faena_<?=$key->id_det_proforma_pago?>" data-show-subtext="true" data-live-search="true"  required="required">
        <!--   <option data-tokens="" value="">Seleccione Faena</option> -->
            <option data-tokens="<?= $key->id_faena.", ".$key->descripcion_faena?>" value="<?= $key->id_faena?>"><?= $key->descripcion_faena?></option>
             <?php foreach ($faena as $data): ?>
              <?php if ($data->descripcion==$key->descripcion_faena): ?>
                <?php else: ?>
                   <option data-tokens="<?= $data->id.", ".$data->descripcion?>" value="<?= $data->id?>"><?= $data->descripcion?></option>
              <?php endif ?>
             <?php endforeach ?>
  </select>
  </div>
  <div class="col-md-2 col-sm-2 col-xs-2">
  <label>Rodal</label>
  <input type="text" class="form-control" name="txt_rodal_<?=$key->id_det_proforma_pago?>" value="<?=$key->rodal?>" placeholder="Ingrese Rodal">
  </div>
  <div class="col-md-2 col-sm-2 col-xs-2">
  <label>Medidas</label>
  <input type="text" class="form-control" name="txt_medida_<?=$key->id_det_proforma_pago?>" value="<?=$key->medida?>" placeholder="Ingrese Medidas">
  </div>
  <div class="col-md-2 col-sm-2 col-xs-2">
  <label>Precio Unidad</label>
  <input type="text" class="form-control" name="txt_precio_u_<?=$key->id_det_proforma_pago?>" value="<?=$key->precio_unidad?>" placeholder="Ingrese Precio Unidadd">
  </div>
  <div class="col-md-2 col-sm-2 col-xs-2">
  <label>Total</label>
  <input type="text" class="form-control" name="txt_total_<?=$key->id_det_proforma_pago?>" value="<?=$key->total?>" placeholder="Ingrese Total">
  </div>
</div>

  <?php endforeach ?>

 <?php endif ?>
      
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             
             <hr>
                <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
             
              <a href="<?=$this->config->base_url()?>proforma_pago/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>