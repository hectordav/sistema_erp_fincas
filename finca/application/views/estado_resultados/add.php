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
             <label><h3><strong>Crear Estado de Resultados</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>estado_resultados/buscar_estado_resultados" method="POST"  enctype="multipart/form-data">
            <div class="col-md-12 col-sm-12 col-xs-12">
        <br>
        <br>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <label>Fecha Inicio</label>
          <input type="date" class="form-control" name="txt_fecha_i" value="">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <label>Fecha Final</label>
          <input type="date" class="form-control" name="txt_fecha_f" value="">
        </div>
            </div>
   
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>principal" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>