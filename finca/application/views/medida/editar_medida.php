  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Editar Medidas</strong></h3></label>
             <hr>
       <form  role="form" action="<?php echo $this->config->base_url();?>medida/actualizar_det_medidas_todos" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
              <label>Finca</label>
          <?php if ($medida): ?>
            <?php foreach ($medida as $key): ?>
              <input type="hidden" name="txt_id_medida" value="<?=$key->id_medidas?>">
            <input type="text" class="form-control" name="" value="<?=$key->finca_nombre?>" readonly="true">
        </div>
        <div class="form-group">
          <label>Fecha Inicio</label>
          <?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
          <input type="text" name="" class="form-control" value="<?=$fecha_i?>" readonly="true">
        </div>
        <div class="form-group">
          <label>Fecha Final</label>
          <?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
          <input type="text" name="" class="form-control" value="<?=$fecha_f?>" readonly="true">
        </div>
        </div>
          <?php endforeach ?>
        <?php endif ?>
<?php if ($det_medida): ?>
  <?php foreach ($det_medida as $key): ?>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-4 col-sm-4 col-xs-4">
        <label>Faena</label>
          <select class="form-control" name="id_faena_<?=$key->id_det_medida?>" id="id_faena_<?=$key->id_det_medida?>" data-show-subtext="true" data-live-search="true"  required="required">
              <!--   <option data-tokens="" value="">Seleccione Faena</option> -->
                  <option data-tokens="<?= $key->id_faena.", ".$key->faena?>" value="<?= $key->id_faena?>"><?= $key->faena?></option>
                   <?php foreach ($faena as $data): ?>
                    <?php if ($data->descripcion==$key->faena): ?>
                      <?php else: ?>
                         <option data-tokens="<?= $data->id.", ".$data->descripcion?>" value="<?= $data->id?>"><?= $data->descripcion?></option>
                    <?php endif ?>
                     
                   <?php endforeach ?>
        </select>
   </div>
   
    <div class="col-md-2 col-sm-2 col-xs-2">
      <label>Rodal</label>
      <input type="text" class="form-control" name="txt_rodal_<?=$key->id_det_medida?>" value="<?=$key->rodal?>" placeholder="Ingrese Rodal">
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <label>Medidas GPS</label>
      <input type="text" class="form-control" name="txt_medidas_gps_<?=$key->id_det_medida?>" value="<?=$key->medidas_gps?>" placeholder="Ingrese Rodal">
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <label>Medidas CAS</label>
      <input type="text" class="form-control" name="txt_medidas_cas_<?=$key->id_det_medida?>" value="<?=$key->medidas_cas?>" placeholder="Ingrese Rodal">
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2">
      <label>Precio Faena</label>
      <input type="text" class="form-control" name="txt_precio_faena_<?=$key->id_det_medida?>" value="<?=$key->precio_faena?>" placeholder="Ingrese Rodal">
    </div>
  </div>
  <?php endforeach ?>
  <?php endif ?>
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             <hr>
                <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
             
              <a href="<?=$this->config->base_url()?>medida/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>