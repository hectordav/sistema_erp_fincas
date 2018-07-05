  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Proforma Pago</strong></h3></label>
             <hr>
        <div class="form-group">
        <label>Finca</label>
          <?php if ($proforma_pago): ?>
            <?php foreach ($proforma_pago as $key): ?>
              <?$id_proforma_pago=$key->id_proforma_pago?>
            <input type="text" class="form-control" name="" value="<?=$key->nombre_finca?>" readonly="true">

        </div>
        <div class="form-group">
          <label>Fecha Inicio</label>
          <?$fecha_i=date('d-m-Y',strtotime($key->fecha_i))?>
          <input type="text" class="form-control" name="" value="<?=$fecha_i?>" readonly="true">
        </div>
         <div class="form-group">
         <?$fecha_f=date('d-m-Y',strtotime($key->fecha_f))?>
          <label>Fecha Final</label>
          <input type="text" class="form-control" name="" value="<?=$fecha_f?>" readonly="true">
        </div>
        <div class="form-group">
          <label>Total</label>
          <?$total_1=$key->total?>
          <?$total_2 = number_format($total_1, 2, ',', '.');?>
          <input type='text' value='<?=$total_2?>' class="form-control" readonly="true" />
        </div>
          <?php endforeach ?>
        <?php endif ?>

       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Faena</th>
             <th class="info">Rodal</th>
             <th class="info">Medida</th>
             <th class="info">Precio Unidad</th>
             <th class="info">total</th>
             <?php if ($id_nivel=='1'): ?>
             <th class="info">Acciones</th>  
             <?php endif ?>
             
           </tr>
         </thead>
         <tbody>
         <?php if ($det_proforma_pago): ?>
           <?php foreach ($det_proforma_pago as $key): ?>
               <tr>
                 <td><?=$key->descripcion_faena?></td>
                 <td><?=$key->rodal?></td>
                 <td><?=$key->medida?></td>
                <?$precio_u_1=$key->precio_unidad?>
                 <td><?=$precio_u_1?></td>
                 <?$total_1=$key->total?>
                 <td><?=$total_1?></td>
                 <?php if ($id_nivel=='1'): ?>
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_proforma_pago?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>proforma_pago/borrar_det_proforma/<?=$key->id_det_proforma_pago?>/<?=$id_proforma_pago?>" class="btn btn-danger" title="">Borrar</a>
                 </td>
                 <?php endif ?>
              </tr>
          <!--la modal-->
       <div class="modal fade "id="<?=$key->id_det_proforma_pago?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>

     </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>proforma_pago/actualizar_det_proforma_pago" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_det_proforma_pago" value="<?=$key->id_det_proforma_pago?>">
       <div class="form-group">
         <label>Rodal</label>
         <input type="text" class="form-control" name="txt_rodal" value="<?=$key->rodal?>" placeholder="Ingrese Rodal">
       </div>
       <div class="form-group">
         <label>Medidas</label>
         <input type="text" class="form-control" name="txt_medida" value="<?=$key->medida?>" placeholder="Ingrese Rodal">
       </div>
         <?$precio_u_1=$key->precio_unidad?>        
         <?$total_1=$key->total?>
       <div class="form-group">
         <label>Precio Unidad</label>
         <input type="text" class="form-control" name="txt_precio_u" value="<?=$precio_u_1?>" placeholder="Ingrese Rodal">
       </div>
       <div class="form-group">
         <label>Total</label>
         <input type="text" class="form-control" name="txt_total" value="<?=$total_1?>" placeholder="Ingrese Rodal">
       </div>

       <div class="form-group">
        <label>Faena</label>
          <select class="form-control" name="id_faena" id="id_faena" data-show-subtext="true" data-live-search="true">
          
                <option data-tokens="<?=$key->id_faena?>" value="<?=$key->id_faena?>"><?=$key->descripcion_faena?></option>
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
             <a href="<?=$this->config->base_url()?>proforma_pago/exportar_excel/<?=$id_proforma_pago?>" title="" class="btn btn-primary btn-lg"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</a>
              <a href="<?=$this->config->base_url()?>proforma_pago/exportar_pdf/<?=$id_proforma_pago?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>proforma_pago/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
          </div>
        </div>
      </div>