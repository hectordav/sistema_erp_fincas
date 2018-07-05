  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Proforma</strong></h3></label>
             <hr>
        <div class="form-group">
        <label>Empresa</label>
        
          <?php if ($proforma): ?>
            <?php foreach ($proforma as $key): ?>
          <?$id_proforma=$key->id_proforma?>
            <input type="text" class="form-control" name="" value="<?=$key->nombre_empresa?>" readonly="true">

        </div>
        <div class="form-group">
          <label>Total</label>
          <?$total_1=$key->total?>
          <?$total_2 = number_format($total_1, 2, ',', '.');?>
          <input type="text" class="form-control" name="" value="<?=$total_2?>" readonly="true">
        </div>
          <?php endforeach ?>
        <?php endif ?>

       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Fecha</th>
             <th class="info">Finca</th>
             <th class="info">Codigo</th>
             <th class="info">Tipo de Faena</th>
             <th class="info">Rodal</th>
             <th class="info">Unidad</th>
             <th class="info">Medida</th>
             <th class="info">Precio Unidad</th>
             <th class="info">total</th>
             <th class="info">Observaciones</th>
             <th class="info">Notas</th>
             <?php if ($id_nivel=='1'): ?>
             <th class="info">Acciones</th>  
             <?php endif ?>
           </tr>
         </thead>
         <tbody>
         <?php if ($det_proforma): ?>
           <?php foreach ($det_proforma as $key): ?>
               <tr>
               <? $fecha=date('d-m-Y',strtotime($key->fecha))?>
                 <td><?=$fecha?></td>
                 <td><?=$key->nombre_finca?></td>
                 <td><?=$key->codigo_finca?></td>
                 <td><?=$key->descripcion_faena?></td>
                 <td><?=$key->rodal?></td>
                 <td><?=$key->unidad?></td>
                 <td><?=$key->medida?></td>
                 <td><?=$key->precio_unidad?></td><!--  -->
                 <td><?=$key->total?></td>
                 <td><?=$key->observacion?></td>
                 <td><?=$key->nota?></td>
                 <?php if ($id_nivel=='1'): ?>
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_proforma?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>proforma/borrar_det_proforma/<?=$key->id_det_proforma?>/<?=$id_proforma?>" class="btn btn-danger" title="">Borrar</a>
                 </td>
                 <?php endif ?>
              </tr>
          <!--la modal-->
          <div class="modal fade "id="<?=$key->id_det_proforma?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>

      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>proforma/actualizar_det_proforma" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
      <input type="hidden" name="txt_id_proforma" value="<?=$id_proforma?>">
        <input type="hidden" name="txt_id_det_proforma" value="<?=$key->id_det_proforma?>">
       
  <div class="form-group">
        <label>Faena</label>
          <select class="form-control" name="id_faena" id="id_faena" data-show-subtext="true" data-live-search="true"  required="required">
            <option data-tokens="<?= $key->id_faena.", ".$key->descripcion_faena?>" value="<?= $key->id_faena?>"><?= $key->descripcion_faena?></option>
                 <?php if ($faena): ?>
                   <?php foreach ($faena as $data): ?>
                      <?php if ($data->descripcion==$key->descripcion_faena): ?>
                      <?php else: ?>
                         <option data-tokens="<?= $data->id.", ".$data->descripcion?>" value="<?= $data->id?>"><?= $data->descripcion?></option>
                    <?php endif ?>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>

       </div> 
       <div class="form-group">
         <label>Rodal</label>
         <input type="text" class="form-control" name="txt_rodal" value="<?=$key->rodal?>" placeholder="Ingrese Rodal">
       </div>
       <div class="form-group">
         <label>Unidad</label>
         <input type="text" class="form-control" name="txt_unidad" value="<?=$key->unidad?>" placeholder="Ingrese unidad">
       </div>
       <div class="form-group">
         <label>Medida</label>
         <input type="text" class="form-control" name="txt_medida" value="<?=$key->medida?>" placeholder="Ingrese Medida">
       </div>
        <div class="form-group">
         <label>Precio Unidad</label>
         <input type="text" class="form-control" name="txt_precio_unidad" value="<?=$key->precio_unidad?>" placeholder="Ingrese Rodal">
       </div>
        <div class="form-group">
         <label>Total</label>
         <input type="text" class="form-control" name="txt_total" value="<?=$key->total?>" placeholder="Ingrese total">
       </div>
       <div class="form-group">
        <label>Observaciones</label>
         <textarea name="txt_observacion" class="form-control"><?=$key->observacion?></textarea>
       </div>
       <div class="form-group">
        <label>Notas</label>
         <textarea name="txt_notas" class="form-control"><?=$key->nota?></textarea>
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
              <a href="<?=$this->config->base_url()?>proforma/exportar_excel/<?=$id_proforma?>" title="" class="btn btn-primary btn-lg"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</a>
                <a href="<?=$this->config->base_url()?>proforma/exportar_pdf/<?=$id_proforma?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>proforma/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>