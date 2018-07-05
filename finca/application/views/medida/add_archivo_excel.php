  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
  <!-- esto cuando no tengo la imagen -->
  <?$correcto =$this->session->flashdata('alerta');?> 
    <?php if ($correcto): ?>
     <div class="animated bounceInDown">
       <div class="alert alert-danger alert-dismissible" role="alert">       
        <strong><?= $correcto?></strong>
        <br>
       </div>
     </div>
    <?php endif ?>
  <!-- / -->
    </div>  
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar archivo Excel</strong></h3></label>
             <hr>
        <div class="form-group">
 <form  role="form" action="<?php echo $this->config->base_url();?>medida/guardar_archivo_excel" method="POST"  enctype="multipart/form-data">
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
          <?php endforeach ?>
        <?php endif ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <label>Ingrese Archivo Excel 97-2003</label>
          <input type="file" name="file" value="" placeholder="">
        </div>
            <div class="form-group" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>medida/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>