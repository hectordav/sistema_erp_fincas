  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
      <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Nomina</strong></h3></label>
             <hr>
        <div class="form-group">
              <label>Finca</label>
          <?php if ($nomina): ?>
            <?php foreach ($nomina as $key): ?>
          <?$id_nomina=$key->id?>
            <input type="text" class="form-control" name="" value="<?=$key->nombre_finca?>" readonly="true">
        </div>
          <div class="form-group">
            <label>Fecha Inicio</label>
            <?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
            <?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
              <input type="text" class="form-control" name="Nombre" required="required" readonly="true" value="<?=$fecha_i?>">
          </div>
              <div class="form-group">
                <label>Fecha Fin</label>
                  <input type="text" class="form-control" name="Nombre" required="required" readonly="true" value="<?=$fecha_f?>">
              </div>
              <?php if ($sumar_nomina): ?>
                <?php foreach ($sumar_nomina as $data): ?>
              <div class="form-group">
                <label>Total</label>
                  <input type="text" class="form-control" name="Nombre" required="required" readonly="true" value="<?=$data->total?>">
              </div>
              <?php endforeach ?>
              <?php endif ?>
        </div>
          <?php endforeach ?>
        <?php endif ?>
        <br>
<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-6 col-sm-6 col-xs-6">
    
  </div>
  <div class="col-md-6 col-sm-6 col-xs-6">
  <form  role="form" action="<?php echo $this->config->base_url();?>nomina/buscar_empleado" method="POST"  enctype="multipart/form-data">
   <div class="input-group">
    <input type="hidden" name="txt_id_nomina_1" value="<?=$id_nomina?>">
      <input type="text" name="txt_busqueda" class="form-control" placeholder="Buscar Empleado por Nombre Cedula">
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit">Buscar</button>
      </span>
    </div><!-- /input-group -->
    </form>
</div>
</div>
       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Cedula</th>
             <th class="info">Empleado</th>
             <th class="info">Salario</th>
             <th class="info">Mercado</th>
             <th class="info">Seguro</th>
             <th class="info">Gastos Per.</th>
             <th class="info">Servicios</th>
             <th class="info">Herramientas</th>
             <th class="info">Prestamos</th>
             <th class="info">Inasistencia</th>
             <th class="info">Pasajes</th>
             <th class="info">Valor Final</th>
             <th class="info">Firma</th>
             <?php if ($id_nivel=='1'): ?>
              <th class="info">Acciones</th> 
             <?php endif ?>
           </tr>
         </thead>
         <tbody>
         <?php if ($det_nomina): ?>
           <?php foreach ($det_nomina as $key): ?>
               <tr>
                <td><?=$key->cedula?></td>
                <td><?=$key->nombre_empleado?></td>
                <td><?=$key->salario?></td>
                <td><?=$key->mercado?></td>
                <td><?=$key->seguro?></td>
                <td><?=$key->gastos_per?></td>
                <td><?=$key->servicios?></td>
                <td><?=$key->herramientas?></td>
                <td><?=$key->prestamos?></td>
                <td><?=$key->inasistencia?></td>
                <td><?=$key->pasajes?></td>
                <td><?=$key->valor_final?></td>
                <td><?=$key->firma?></td>
                <?php if ($id_nivel=='1'): ?>
                  <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_nomina?>" class="btn btn-success btn-xs" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>/nomina/borrar_det_nomina/<?=$key->id_det_nomina?>/1" class="btn btn-danger btn-xs" title="">Borrar</a>
                 </td>  
                <?php endif ?>
                
              </tr>
          <!--la modal-->
          <div class="modal fade "id="<?=$key->id_det_nomina?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>
      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>nomina/actualizar_det_nomina" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_det_nomina" value="<?=$key->id_det_nomina?>">
        <input type="hidden" name="txt_id_cambio" value="1">
     <div class="form-group">
                  <label>Sueldo</label>
                    <input type="text" class="form-control" name="txt_sueldo" value="<?=$key->salario?>" >
                </div>
                <div class="form-group">
                  <label>Mercado</label>
                    <input type="text" class="form-control" name="txt_mercado" value="<?=$key->mercado?>" >
                </div>
                <div class="form-group">
                  <label>Seguro</label>
                    <input type="text" class="form-control" name="txt_seguro" value="<?=$key->seguro?>" >
                </div>
                <div class="form-group">
                  <label>Gastos Personales</label>
                    <input type="text" class="form-control" name="txt_gastos_per" value="<?=$key->gastos_per?>" >
                </div>
                <div class="form-group">
                  <label>Servicios</label>
                    <input type="text" class="form-control" name="txt_servicios" value="<?=$key->servicios?>" >
                </div>
                <div class="form-group">
                  <label>Herramienta</label>
                    <input type="text" class="form-control" name="txt_herramientas" value="<?=$key->herramientas?>" >
                </div>
                <div class="form-group">
                  <label>Prestamos</label>
                    <input type="text" class="form-control" name="txt_prestamos" value="<?=$key->prestamos?>" >
                </div>
                <div class="form-group">
                  <label>Inasistencia</label>
                    <input type="text" class="form-control" name="txt_inasistencia" value="<?=$key->inasistencia?>" >
                </div>
                <div class="form-group">
                  <label>Pasajes</label>
                    <input type="text" class="form-control" name="txt_pasajes" value="<?=$key->pasajes?>" >
                </div>
                <div class="form-group">
                  <label>Valor Final</label>
                    <input type="text" class="form-control" name="txt_valor_final" value="<?=$key->valor_final?>" >
                </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Guardar</button>
        </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
       </div>
     </div>
          <!--********-->
           <?php endforeach ?>
         <?php endif ?>

         </tbody>
       </table>
     
            <div class="form-group" align="center">
             <hr>
              <a href="<?=$this->config->base_url()?>nomina/exportar_pdf/<?=$id_nomina?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>nomina/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>