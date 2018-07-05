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
             <label><h3><strong>Ver Empleado x Finca</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>inventario/guardar_det_inventario" method="POST"  enctype="multipart/form-data">
        <?php if ($finca): ?>
          <?php foreach ($finca as $key): ?>
            <?$id_finca=$key->id?>
            <input type="hidden" name="txt_id_finca" value="<?=$id_finca?>">
              <div class="form-group">
                <label>Finca</label>
                  <input type="text" class="form-control" name="txt_id_empleado" required="required" value="<?=$key->nombre?>" readonly="true">
              </div>
                <div class="form-group">
                <label>Codigo</label>
                  <input type="text" class="form-control" name="txt_id_empleado" required="required" value="<?=$key->codigo?>" readonly="true">
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
             <th class="info">Cedula</th>
             <th class="info">Nombre</th>
             <th class="info">Direccion</th>
             <th class="info">Telf</th>
             <th class="info">Posee Seguro?</th>
             <th class="info">Acciones</th>
           </tr>
         </thead>
         <tbody>
         <?php if ($empleado): ?>
           <?php foreach ($empleado as $key): ?>
            <?php if ($key->seguro=="No"): ?>
              <tr class="danger">
                 <td><?=$key->cedula?></td>
                 <td><?=$key->nombre?></td>
                 <td><?=$key->direccion?></td>
                 <td><?=$key->telf?></td>
                 <td><?=$key->seguro?></td>
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_empleado?>" class="btn btn-success" title="">Editar</a>
                  <a href="<?=$this->config->base_url()?>finca/borrar_empleado/<?=$key->id_empleado?>/2" class="btn btn-danger" title="">Borrar</a>
                 </td>
              </tr>
              <?php else: ?>
            <tr>
                 <td><?=$key->cedula?></td>
                 <td><?=$key->nombre?></td>
                 <td><?=$key->direccion?></td>
                 <td><?=$key->telf?></td>
                 <td><?=$key->seguro?></td>
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_empleado?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>finca/borrar_empleado/<?=$key->id_empleado?>/2" class="btn btn-danger" title="">Borrar</a>
                 </td>
              </tr>
            <?php endif ?>
               
          <!--la modal-->
          <div class="modal fade "id="<?=$key->id_empleado?>">
        <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar</h4>

      </div>
     <form  role="form" action="<?php echo $this->config->base_url();?>finca/actualizar_empleado" method="POST"  enctype="multipart/form-data">
      <div class="modal-body">
        <input type="hidden" name="txt_id_empleado" value="<?=$key->id_empleado?>">
         <input type="hidden" name="txt_id_cambio" value="2">
       <div class="form-group">
         <label>Posee Seguro?</label>
        <select class="form-control" name="id_seguro" id="id_seguro" data-show-subtext="true" data-live-search="true"  required="required">
            <option data-tokens="<?= $key->id_seguro.", ".$key->seguro?>" value="<?= $key->id_seguro?>"><?= $key->seguro?></option>
                 <?php if ($seguro): ?>
                   <?php foreach ($seguro as $data): ?>
                      <?php if ($data->descripcion==$key->seguro): ?>
                      <?php else: ?>
                         <option data-tokens="<?= $data->id.", ".$data->descripcion?>" value="<?= $data->id?>"><?= $data->descripcion?></option>
                    <?php endif ?>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>
       </div>
       <div class="form-group">
         <label>Cedula</label>
         <input type="text" class="form-control" name="txt_cedula" value="<?=$key->cedula?>" placeholder="Ingrese cedula" >
       </div>
        <div class="form-group">
         <label>Nombre</label>
         <input type="text" class="form-control" name="txt_nombre" value="<?=$key->nombre?>" placeholder="Ingrese Cantidad" >
       </div>
        <div class="form-group">
         <label>Direccion</label>
         <input type="text" class="form-control" name="txt_direccion" value="<?=$key->direccion?>" placeholder="Ingrese Cantidad" >
       </div>
        <div class="form-group">
         <label>Telf</label>
         <input type="text" class="form-control" name="txt_telf" value="<?=$key->telf?>" placeholder="Ingrese Cantidad" >
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
               <a href="<?=$this->config->base_url()?>finca/exportar_pdf/<?=$id_finca?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>finca/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
        </div>
      </div>