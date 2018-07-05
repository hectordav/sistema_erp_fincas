  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar Cantidad</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>herramienta/guardar_agregar_cantidad" method="POST"  enctype="multipart/form-data">
        <?php if ($herramienta): ?>
          <?php foreach ($herramienta as $key): ?>
            <input type="hidden" name="txt_id_herramienta" value="<?=$key->id?>">
        <div class="form-group">
          <label>Herramienta</label>
            <input type="text" class="form-control" name="txt_herramienta" value="<?=$key->descripcion?>" required="required" readonly="true">
        </div>
        <div class="form-group">
          <label>Cantidad Anterior</label>
            <input type="text" class="form-control" name="txt_cantidad_anterior" value="<?=$key->cantidad?>" required="required" readonly="true">
        </div>
          <?php endforeach ?>
        <?php endif ?>
        <br>
        <br>
        <div class="form-group">
          <label>Sumar Cantidad</label>
            <input type="number" class="form-control" name="txt_cantidad_nueva" required="required" >
        </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>herramienta/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>