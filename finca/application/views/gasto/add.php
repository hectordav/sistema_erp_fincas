  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Crear Gasto</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>gasto/guardar_gasto" method="POST"  enctype="multipart/form-data">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <label>Finca</label>
          <select class="selectpicker form-control" name="id_finca" id="id_finca" data-show-subtext="true" data-live-search="true"  required="required">
                <option data-tokens="" value="">Seleccione Finca</option>
                 <?php if ($finca): ?>
                   <?php foreach ($finca as $key): ?>
                      <option data-tokens="<?= $key->id.", ".$key->nombre?>" value="<?= $key->id?>"><?= $key->nombre?></option>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>
        <br>
        <br>
        <div class="form-group">
          <label>Fecha Inicio</label>
          <input type="date" class="form-control" name="txt_fecha" value="">
        </div>
        <div class="form-group">
          <label>Observaciones</label>
          <textarea class="form-control" name="txt_observaciones" placeholder="Ingrese Observaciones"></textarea>
        </div>
      </div>
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>gasto/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>