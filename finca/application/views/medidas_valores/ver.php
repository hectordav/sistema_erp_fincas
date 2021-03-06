  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
      <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Informe Medidas</strong></h3></label>
             <hr>
        <div class="form-group">
              <label>Finca</label>
          <?php if ($medidas_valor): ?>
            <?php foreach ($medidas_valor as $key): ?>
          <?$id_medida_valor=$key->id_medida_valor?>
            <input type="text" class="form-control" name="" value="<?=$key->nombre_finca?>" readonly="true">
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

       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Faena</th>
             <th class="info">Rodal</th>
             <th class="info">Medidas GPS</th>
             <th class="info">Medidas CAS</th>
             <th class="info">Diferencia</th>
             <th class="info">Observaciones</th>
            <!--  <?php if ($id_nivel=='1'): ?>  
             <th class="info">Acciones</th>
             <?php endif ?> -->
           </tr>
         </thead>
         <tbody>
         <?php if ($det_medidas_valores): ?>
           <?php foreach ($det_medidas_valores as $key): ?>
               <tr>
                 <td><?=$key->faena?></td>
                 <td><?=$key->rodal?></td>
                 <td><?=$key->medidas_gps?></td>
                 <td><?=$key->medidas_cas?></td>
                 <td><?=$key->diferencia?></td>
                <td><?=$key->observacion_det_medida?></td>
               
                 <!-- <?php if ($id_nivel=='1'): ?>  
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_medida_valor?>_informe" class="btn btn-primary" title="">Informe</a>
                 <a data-toggle="modal" href="#<?=$key->id_det_medida_valor?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>/medida/eliminar_det_medida/<?=$key->id_det_medida_valor?>" class="btn btn-danger" title="">Borrar</a>
                 </td>
                 <?php endif ?> -->
              </tr>
          <!--la modal-->
          <div class="modal fade "id="<?=$key->id_det_medida_valor?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>

      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>medida/actualizar_det_medidas" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_det_medida" value="<?=$key->id_det_medida_valor?>">
       <div class="form-group">
         <label>Rodal</label>
         <input type="text" class="form-control" name="txt_rodal" value="<?=$key->rodal?>" placeholder="Ingrese Rodal">
       </div>
       <div class="form-group">
         <label>Medidas GPS</label>
         <input type="text" class="form-control" name="txt_medidas_gps" value="<?=$key->medidas_gps?>" placeholder="Ingrese Rodal">
       </div>
       <div class="form-group">
         <label>Medidas CAS</label>
         <input type="text" class="form-control" name="txt_medidas_cas" value="<?=$key->medidas_cas?>" placeholder="Ingrese Rodal">
       </div>
       <div class="form-group">
         <label>Precio Faena</label>
         <input type="text" class="form-control" name="txt_precio_faena" value="<?=$key->precio_faena?>" placeholder="Ingrese Rodal">
       </div>
          <div class="form-group">
         <label>Fecha</label>
         <?$fecha=date('d-m-Y', strtotime($key->fecha))?>
         <input type="text" class="form-control" name="txt_precio_faena" value="<?=$fecha?>" placeholder="Ingrese Rodal" readonly="true">
       </div>

       <div class="form-group">
        <label>Faena</label>
          <select class="form-control" name="id_faena" id="id_faena" data-show-subtext="true" data-live-search="true"  required="required">
            <option data-tokens="<?= $key->id_faena.", ".$key->faena?>" value="<?= $key->id_faena?>"><?= $key->faena?></option>
                 <?php if ($faena): ?>
                   <?php foreach ($faena as $data): ?>
                      <?php if ($data->descripcion==$key->faena): ?>
                      <?php else: ?>
                         <option data-tokens="<?= $data->id.", ".$data->descripcion?>" value="<?= $data->id?>"><?= $data->descripcion?></option>
                    <?php endif ?>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>

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
     <!-- la modal del informe ojo -->
          <div class="modal fade " id="<?=$key->id_det_medida_valor?>_informe">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Genear Informe de este Rodal</h4>

      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>medidas_valores/guardar_informe"" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_det_medida_valor" value="<?=$key->id_det_medida_valor?>">
        <input type="hidden" name="txt_id_medida" value="<?=$id_medida_valor?>">
       <div class="form-group">
         <label>Rodal</label>
         <input type="text" class="form-control" name="txt_rodal" value="<?=$key->rodal?>" placeholder="Ingrese Rodal" readonly="true">
       </div>
       <div class="form-group">
         <label>Medidas GPS</label>
         <input type="text" class="form-control" name="txt_medidas_gps" value="<?=$key->medidas_gps?>" placeholder="Ingrese Rodal" readonly="true">
       </div>
       <div class="form-group">
         <label>Medidas CAS</label>
         <input type="text" class="form-control" name="txt_medidas_cas" value="<?=$key->medidas_cas?>" placeholder="Ingrese Rodal" readonly="true">
       </div>
       <div class="form-group">
         <label>Observaciones</label>
         <textarea name="txt_observaciones" class="form-control" placeholder="Ingrese Observaciones"></textarea>
       </div>
        </select>

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
     <!-- ************************ -->
          <!--********-->
           <?php endforeach ?>
         <?php endif ?>
         </tbody>
       </table>
     
            <div class="form-group" align="center">
             <hr>
             <!--  <a href="<?=$this->config->base_url()?>medida/exportar_excel/<?=$id_medida_valor?>" title="" class="btn btn-primary btn-lg"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</a>-->
              <a href="<?=$this->config->base_url()?>medidas_valores/exportar_pdf/<?=$id_medida_valor?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>medidas_valores/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>