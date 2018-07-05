  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Crear Proforma</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>proforma/guardar_proforma" method="POST"  enctype="multipart/form-data">
  <div class="col-md-12 col-sm-12 col-xs-12">
          <label>Ingrese Archivo Excel 97-2003</label>
          <input type="file" name="file" value="" placeholder="">
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