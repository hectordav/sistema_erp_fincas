  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
         <?$correcto =$this->session->flashdata('alerta');?> 
         <?php if ($correcto): ?>
           <div class="col-md-12 col-sm-12 col-xs-12">
             <div class="animated bounceInDown">
             <div class="alert alert-info alert-dismissible" role="alert">       
             <strong><?= $correcto?></strong>
              <br>
              </div>
            </div>
           </div>
      <?php endif ?>
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar Inventario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>inventario/guardar_inventario" method="POST"  enctype="multipart/form-data">
        <?php if ($empleado): ?>
          <?php foreach ($empleado as $key): ?>
          <div class="form-group">
            <label>Empleado</label>
            <select class="selectpicker form-control" name="id_empleado" id="id_empleado" data-show-subtext="true" data-live-search="true"  required="required">
                  <option data-tokens="" value="">Seleccione empleado</option>
                   <?php if ($empleado): ?>
                     <?php foreach ($empleado as $key): ?>
                        <option data-tokens="<?= $key->id.", ".$key->nombre?>" value="<?= $key->id?>"><?= $key->nombre?></option>
                     <?php endforeach ?>
                   <?php else: echo "no hay Resultados" ?>
                   <?php endif ?>
          </select>
          </div>
        <div class="form-group">
          <label>Fecha</label>
            <input type="date" class="form-control" name="txt_fecha" value="" required="required">
        </div>
          <?php endforeach ?>
        <?php endif ?>
        <br>
        <br>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>medida/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>