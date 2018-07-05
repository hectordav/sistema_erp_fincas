  <div class="right_col" role="main">
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
      
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
      <div class="animated fadeIn" align="left">
             <label><h3><strong>Ver Informe Gastos de Proveedor</strong></h3></label>
             <hr>
        <div class="form-group">
              <label>Proveedor</label>
          <?php if ($informe_gasto_proveedor): ?>
            <?php foreach ($informe_gasto_proveedor as $key): ?>
          <?$id_informe=$key->id_informe?>
            <input type="text" class="form-control" name="" value="<?=$key->nombre_proveedor?>" readonly="true">
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
        <div class="form-group">
          <label>Totales</label>
          
          <input type="text" name="" class="form-control" value="<?=$key->total?>" readonly="true">
        </div>
        </div>
          <?php endforeach ?>
        <?php endif ?>

       <table class="table table-bordered table-hover">
         <thead>
           <tr>
             <th class="info">Tipo de Gasto</th>
             <th class="info">Monto</th>
             <th class="info">Fecha</th>
            <!--  <?php if ($id_nivel=='1'): ?>  
             <th class="info">Acciones</th>
             <?php endif ?> -->
           </tr>
         </thead>
         <tbody>
         <?php if ($det_informe_gasto_proveedor): ?>
           <?php foreach ($det_informe_gasto_proveedor as $key): ?>
               <tr>
                 <td><?=$key->tipo_gasto_proveedor?></td>
                 <td><?=$key->monto_det_informe?></td>
                 <?$fecha_det=date('d-m-Y',strtotime($key->fecha_det_informe))?>
                 <td><?=$fecha_det?></td>
                 <!-- <?php if ($id_nivel=='1'): ?>  
                 <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_informe?>_informe" class="btn btn-primary" title="">Informe</a>
                 <a data-toggle="modal" href="#<?=$key->id_det_informe?>" class="btn btn-success" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>/medida/eliminar_det_medida/<?=$key->id_det_informe?>" class="btn btn-danger" title="">Borrar</a>
                 </td>
                 <?php endif ?> -->
              </tr>
         

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
               <a href="<?=$this->config->base_url()?>gasto_proveedor/exportar_pdf/<?=$id_informe?>" title="" class="btn btn-success btn-lg"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
              <a href="<?=$this->config->base_url()?>gasto_proveedor/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
      </div>
          </form>  
          </div>
        </div>
      </div>