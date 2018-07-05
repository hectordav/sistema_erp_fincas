  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
        </div>
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Estado de Resultados</strong></h3></label>
             <hr>
<?$fecha_i?>
<?$fecha_f?>
  <div class="form-group">
    <?php if ($ingresos_cas): ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6">
        <label><strong>Ingresos</strong></label>  
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <label><?=$ingresos_cas?></label>
        </div>
        <hr>
      </div>
    <?php endif ?>
    <?php if ($costo_ventas): ?>
      <div class="col-md-12 col-sm-12 col-xs-12">
       <div class="col-md-5 col-sm-5 col-xs-5">
          Costo de Ventas
       </div>
       <div class="col-md-6 col-sm-6 col-xs-6">
         <label><?=$costo_ventas?></label>
       </div>
       <hr>
      </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="col-md-6 col-sm-6 col-xs-6">
        <label><strong>UTILIDAD BRUTA EN VENTAS</strong></label>
      </div>
      <div class="col-md-6 col-sm-6 col-xs-6">
      <?$utilidad_bruta=$ingresos_cas-$costo_ventas?>
        <label><?=$utilidad_bruta?></label>
      </div>
    </div>
    <?php endif ?>
    <div>
      <div class="col-md-12 col-sm-12 col-xs-12">
      <hr>
        <div class="col-md-6 col-sm-6 col-xs-6">
        <label>GASTOS DE ADMINISTRACION Y VENTAS</label>  
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6">
          <?=$total_det_gasto?>
        </div>
      </div>
    </div>
    <?php if ($consulta_tipo_gasto): ?>
      <?php foreach ($consulta_tipo_gasto as $key): ?>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <hr>
          <div class="col-md-6 col-sm-6 col-xs-6">
          <label><?=$key->tipo_gasto?></label>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
          <label><?=$key->total?></label>
          </div>
        <?php if ($consulta_det_tipo_gasto): ?>
        <?php foreach ($consulta_det_tipo_gasto as $key2): ?>
         <?php if ($key2->id_tipo_gasto_det==$key->id_tipo_gasto): ?>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-1 col-sm-1 col-xs-1">
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4">
            <label><?=$key2->descripcion_det_gasto?></label>
            </div>
            <div class="col-md-5 col-sm-5 col-xs-5">
              <label align="right"><?=$key2->total?></label>
            </div>
          </div>
      </div>
         <?php endif ?>
        <?php endforeach ?>
      <?php endif ?>
      <?php endforeach ?>
    <?php endif ?>
    <?php if ($total_ingresos): ?>
      <!-- el total ingresos -->
     <div class="col-md-12 col-sm-12 col-xs-12">
     <hr>
       <div class="col-md-6 col-sm-6 col-xs-6">
        <label><h3>Otros Ingresos</h3></label>  
       </div>
       <div class="col-md-6 col-sm-6 col-xs-6">
         <label><h3><?=$total_ingresos?></h3></label>
         
       </div>
     </div>   
    <?php endif ?>
    <?php if ($consulta_det_ingresos): ?>
      <?php foreach ($consulta_det_ingresos as $key): ?>
        <!-- el detalle de ingresos -->
        <hr>
        <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-1 col-sm-1 col-xs-1">
        </div>
          <div class="col-md-4 col-sm-4 col-xs-4">
            <label><?=$key->descripcion?></label>
          </div>
          <div class="col-md-5 col-sm-5 col-xs-5">
        <label><?=$key->total?></label>
          </div>
        </div>
      <?php endforeach ?>
    <?php endif ?>
  </div>
    <div class="col-md-12 col-sm-12 col-xs-12" align="center">
     <hr>
     
      <a href="<?=$this->config->base_url()?>estado_resultados/exportar_pdf/<?=$fecha_i?>/<?=$fecha_f?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
      <a href="<?=$this->config->base_url()?>estado_resultados/add" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
    </div>
          </form>  
          </div>
        </div>
      </div>