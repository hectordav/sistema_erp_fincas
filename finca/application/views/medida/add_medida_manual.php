  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar Medidas manual</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>medida/guardar_medida_manual" method="POST"  enctype="multipart/form-data">
              <div class="form-group">
              <label>Finca</label>
          <?php if ($medida): ?>
            <?php foreach ($medida as $key): ?>
            <input type="hidden" name="txt_id_medida" value="<?=$key->id_medidas?>">
            <input type="text" class="form-control" name="" value="<?=$key->finca_nombre?>" readonly="true">
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
        </div>
          <?php endforeach ?>
        <?php endif ?>
        <div class="form-group">
          <label>Faena</label>
          <select class="form-control" name="id_faena" id="id_faena" data-show-subtext="true" data-live-search="true"  required="required">
                <option data-tokens="" value="">Seleccione Faena</option>
                 <?php if ($faena): ?>
                   <?php foreach ($faena as $key): ?>
                      <option data-tokens="<?= $key->id.", ".$key->descripcion?>" value="<?= $key->id?>"><?= $key->descripcion?></option>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>
        </div>
        <div class="form-group">
          <label>Rodal</label>
      <input type="text" class="form-control" name="txt_rodal" value="" placeholder="Ingrese Rodal">
        </div>
        <div class="form-group">
          <label>Medidas GPS</label>
      <input type="text" class="form-control" name="txt_medidas_gps" value="" placeholder="Ingrese Medidas GPS">
        </div>
        <div class="form-group">
          <label>Medidas CAS</label>
      <input type="text" class="form-control" name="txt_medidas_cas" value="" placeholder="Ingrese Medias CAS">
        </div>
          <div class="form-group">
          <label>Precio Faena</label>
      <input type="text" class="form-control" name="txt_precio_faena" value="" placeholder="Ingrese Precio de Faena">
        </div>
        <div class="form-group">
          <label>Fecha</label>
      <input type="date" class="form-control" name="txt_fecha" value="" placeholder="Ingrese Fecha">
        </div>
            <div class="form-group" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
              <a href="<?=$this->config->base_url()?>medida/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>
          <hr>
           <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Faena</th>
             <th class="info">Rodal</th>
             <th class="info">Medidas GPS</th>
             <th class="info">Medidas CAS</th>
             <th class="info">Precio Faena</th>
             <th class="info">Acciones</th>
           </tr>
         </thead>
         <tbody>
         <?php if ($det_medida): ?>
           <?php foreach ($det_medida as $key): ?>
               <tr>
                 <td><?=$key->faena?></td>
                 <td><?=$key->rodal?></td>
                 <td><?=$key->medidas_gps?></td>
                 <td><?=$key->medidas_cas?></td>
                 <td><?=$key->precio_faena?></td>
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_medida?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>/medida/eliminar_det_medida_manual/<?=$key->id_det_medida?>" class="btn btn-danger" title="">Borrar</a>
                 </td>
              </tr>
          <!--la modal-->
          <div class="modal fade "id="<?=$key->id_det_medida?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>

      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>medida/actualizar_det_medidas_manual" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_det_medida" value="<?=$key->id_det_medida?>">
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
          <!--********-->
           <?php endforeach ?>
         <?php endif ?>

         </tbody>
       </table>
          </div>

        </div>
      </div>