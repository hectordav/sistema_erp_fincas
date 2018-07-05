  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Crear Usuario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>usuario/guardar_usuario" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
              <label>Nivel</label>
           <select class="selectpicker form-control" name="id_nivel" id="id_nivel" data-show-subtext="true" data-live-search="true"  required="required">
          <option data-tokens="" value="">Seleccione Nivel</option>
           <?php if ($nivel): ?>
             <?php foreach ($nivel as $key): ?>
                <option data-tokens="<?= $key->id.", ".$key->descripcion?>" value="<?= $key->id?>"><?= $key->descripcion?></option>
             <?php endforeach ?>
           <?php else: echo "no hay Resultados" ?>
           <?php endif ?>
          </select>
            </div>
            <div class="form-group">
              <label>Nombre</label>
                <input type="text" class="form-control" name="txt_nombre" required="required" >
            </div>
            <div class="form-group">
              <label>Login</label>
                <input type="email" class="form-control" name="txt_login" required="required" >
            </div>
            <div class="form-group">
              <label>Clave</label>
                <input type="password" class="form-control" name="txt_clave_1" required="required" >
            </div>
             <div class="form-group">
              <label>Repita su clave</label>
                <input type="password" class="form-control" name="txt_clave_2" required="required" >
            </div>
            <br>
            <div class="col-md-12 col-sm-12 col-xs-12" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>medida/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>