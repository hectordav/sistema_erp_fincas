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
             <label><h3><strong>Ver Inventario</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>inventario/guardar_det_inventario" method="POST"  enctype="multipart/form-data">
        <?php if ($inventario): ?>
          <?php foreach ($inventario as $key): ?>
            <?$id_inventario=$key->id_inventario?>
            <input type="hidden" name="txt_id_inventario" value="<?=$key->id_inventario?>">
              <div class="form-group">
                <label>Empleado</label>
                  <input type="text" class="form-control" name="txt_id_empleado" required="required" value="<?=$key->nombre_empleado?>" readonly="true">
              </div>
              <div class="form-group">
          <label>Observaciones</label>
            <textarea name="txt_observaciones" class="form-control" readonly="true" ><?=$key->observacion?></textarea>
        </div>
          <?php endforeach ?>
        <?php endif ?>
        <br>
        <br>
            </div>
          </form> 
            <div class="form-group">
              
          
             <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Herramienta</th>
             <th class="info">Cantidad</th>
             <?php if ($id_nivel=='1'): ?>
              <th class="info">Acciones</th>
             <?php endif ?>
            
           </tr>
         </thead>
         <tbody>
         <?php if ($det_inventario): ?>
           <?php foreach ($det_inventario as $key): ?>
               <tr>
                 <td><?=$key->descripcion_herramienta?></td>
                 <td><?=$key->cantidad?></td>
                  <?php if ($id_nivel=='1'): ?>
                <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_inventario?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>/inventario/eliminar_det_inventario/<?=$key->id_det_inventario?>/2" class="btn btn-danger" title="">Borrar</a>
                 </td>
                  <?php endif ?>
               
              </tr>
          <!--la modal-->
          <div class="modal fade "id="<?=$key->id_det_inventario?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>

      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>inventario/actualizar_det_inventario_manual" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_det_inventario" value="<?=$key->id_det_inventario?>">
         <input type="hidden" name="txt_id_cambio" value="2">
       <div class="form-group">
         <label>Herramienta</label>
        <select class="form-control" name="id_herramienta" id="id_herramienta" data-show-subtext="true" data-live-search="true"  required="required">
            <option data-tokens="<?= $key->id_herramienta.", ".$key->descripcion_herramienta?>" value="<?= $key->id_herramienta?>"><?= $key->descripcion_herramienta?></option>
                 <?php if ($herramienta): ?>
                   <?php foreach ($herramienta as $data): ?>
                      <?php if ($data->descripcion==$key->descripcion_herramienta): ?>
                      <?php else: ?>
                         <option data-tokens="<?= $data->id.", ".$data->descripcion?>" value="<?= $data->id?>"><?= $data->descripcion?></option>
                    <?php endif ?>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>
       </div>
       <div class="form-group">
         <label>Cantidad anterior</label>
         <input type="text" class="form-control" name="txt_cantidad_anterior" value="<?=$key->cantidad?>" placeholder="Ingrese Cantidad" readonly="true">
       </div>
           <div class="form-group">
             <label>Nueva Cantidad</label>
               <input type="number" class="form-control" name="txt_cantidad_nueva" required="required" >
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
      </div>
          <!--********-->
           <?php endforeach ?>
         <?php endif ?>

         </tbody>
       </table>
           <div class="form-group" align="center">
             <hr>
               <a href="<?=$this->config->base_url()?>inventario/exportar_pdf/<?=$id_inventario?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>inventario/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
        </div>
      </div>