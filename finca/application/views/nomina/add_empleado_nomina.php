  <div class="right_col" role="main">
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
        <div class="x_panel">
        <div class="animated bounceInDown" align="left">
  <?= validation_errors('<div class="alert alert-danger">','</div> ')?>
    </div> 
          <div class="animated fadeIn" align="left">
             <label><h3><strong>Agregar Empleado a Nomina</strong></h3></label>
             <hr>
        <form  role="form" action="<?php echo $this->config->base_url();?>nomina/guardar_empleado_nomina" method="POST"  enctype="multipart/form-data">
            <div class="form-group">
            <?php if ($nomina): ?>
              <?php foreach ($nomina as $key): ?>
                <input type="hidden" name="txt_id_nomina" value="<?=$key->id?>">
              <?php endforeach ?>
            <?php endif ?>
              <label>Empleado</label>
          <select class="selectpicker form-control" name="id_empleado" id="id_empleado" data-show-subtext="true" data-live-search="true"  required="required">
                <option data-tokens="" value="">Seleccione Empleado</option>
                 <?php if ($empleado): ?>
                   <?php foreach ($empleado as $key): ?>
                      <option data-tokens="<?= $key->id.", ".$key->cedula.",".$key->nombre?>" value="<?= $key->id?>"><?= $key->cedula?>,<?= $key->nombre?> </option>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>
            </div>
                <div class="form-group">
                  <label>Sueldo</label>
                    <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_sueldo" id="txt_sueldo" >
                </div>
  <!-- **************************** -->
  <!-- **************************** -->
      <div class="form-group">
        <label>Mercado</label>
    <div class="input-group">
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_mercado" id="txt_mercado" class="form-control" value="0">
      <div class="input-group-btn">
       <select class="selectpicker form-control" name="id_proveedor_mercado" id="id_proveedor_mercado" data-show-subtext="true" data-live-search="true">
          <option data-tokens="" value="">Seleccione Proveedor</option>
           <?php if ($proveedor): ?>
             <?php foreach ($proveedor as $key): ?>
                <option data-tokens="<?= $key->id.", ".$key->dni.",".$key->nombre?>" value="<?= $key->id?>"><?= $key->dni?>,<?= $key->nombre?> </option>
             <?php endforeach ?>
           <?php else: echo "no hay Resultados" ?>
           <?php endif ?>
        </select>
      </div><!-- /btn-group -->
    </div><!-- /input-group -->
    </div>
                <div class="form-group">
                  <label>Seguro</label>
                    <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_seguro" id="txt_seguro" >
                </div>
  <div class="form-group">
      <label>Gastos Personales</label>
    <div class="input-group">
        <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_gastos_per" id="txt_gastos_per" class="form-control" value="0">
      <div class="input-group-btn">
       <select class="selectpicker form-control" name="id_proveedor_gastos_personales" id="id_proveedor_gastos_personales" data-show-subtext="true" data-live-search="true">
                <option data-tokens="" value="">Seleccione Proveedor</option>
                 <?php if ($proveedor): ?>
                   <?php foreach ($proveedor as $key): ?>
                      <option data-tokens="<?= $key->id.", ".$key->dni.",".$key->nombre?>" value="<?= $key->id?>"><?= $key->dni?>,<?= $key->nombre?> </option>
                   <?php endforeach ?>
                 <?php else: echo "no hay Resultados" ?>
                 <?php endif ?>
        </select>
      </div><!-- /btn-group -->
    </div>
  </div>
    <div class="form-group">
      <label>Servicios</label>
        <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_servicios" id="txt_servicios" >
    </div>
  <div class="form-group">
    <label>Herramienta</label>
    <div class="input-group">
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_herramientas" id="txt_herramientas" value="0">
      <div class="input-group-btn">
       <select class="selectpicker form-control" name="id_proveedor_herramienta" id="id_proveedor_herramienta" data-show-subtext="true" data-live-search="true">
          <option data-tokens="" value="">Seleccione Proveedor</option>
           <?php if ($proveedor): ?>
             <?php foreach ($proveedor as $key): ?>
                <option data-tokens="<?= $key->id.", ".$key->dni.",".$key->nombre?>" value="<?= $key->id?>"><?= $key->dni?>,<?= $key->nombre?> </option>
             <?php endforeach ?>
           <?php else: echo "no hay Resultados" ?>
           <?php endif ?>
        </select>
      </div><!-- /btn-group -->
    </div>
  </div>
  <div class="form-group">
    <label>Prestamos</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_prestamos" id="txt_prestamos" >
  </div>
  <div class="form-group">
    <label>Inasistencia</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_inasistencia" id="txt_inasistencia" >
  </div>
  <div class="form-group">
    <label>Pasajes</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_pasajes" id="txt_pasajes" >
  </div>
  <div class="form-group">
    <label>Liquidacion</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_liquidacion" id="txt_liquidacion" >
  </div>
  <div class="form-group">
    <label>Otros</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_otros" id="txt_otros" >
  </div>
  <div class="form-group">
    <label>Prestaciones</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_prestaciones" id="txt_prestaciones" >
  </div>
  <div class="form-group">
    <label>Incapacidades</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_incapacidad" id="txt_incapacidad" >
  </div>
  <div class="form-group">
    <label>Trabajos_varios</label>
      <input type="number" onkeyup="sumar_cantidad()" class="form-control" name="txt_trabajo_varios" id="txt_trabajo_varios" >
  </div>
  <div class="form-group">
    <label>Valor Final</label>
      <input type="number" class="form-control" name="txt_valor_final" id="txt_valor_final" readonly="true">
  </div>
            <div class="form-group" align="center">
             <hr>
              <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-save"></i>&nbsp;Agregar</button>
              <a href="<?=$this->config->base_url()?>nomina/grilla" title="" class="btn btn-warning btn-lg"><i class="fa fa-exclamation-triangle"></i>&nbsp;Volver</a>
            </div>
          </form>  
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
              <th class="info">Acciones</th>
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
                <td align="center">
                 <a data-toggle="modal" href="#<?=$key->id_det_nomina?>" class="btn btn-success btn-xs" title="">Editar</a>
                 <a href="<?=$this->config->base_url()?>/nomina/borrar_det_nomina/<?=$key->id_det_nomina?>/2" class="btn btn-danger btn-xs" title="">Borrar</a>
                 </td>
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
        <input type="hidden" name="txt_id_cambio" value="2">
     <div class="form-group">
                  <label>Sueldo</label>
                    <input type="text" class="form-control" name="txt_sueldo" id="txt_sueldo" onkeyup="sumar_cantidad()" value="<?=$key->salario?>" >
                </div>
                <div class="form-group">
                  <label>Mercado</label>
                    <input type="text" class="form-control" name="txt_mercado" id="txt_mercado" onkeyup="sumar_cantidad()" value="<?=$key->mercado?>" >
                </div>
                <div class="form-group">
                  <label>Seguro</label>
                    <input type="text" class="form-control" name="txt_seguro" id="txt_seguro" onkeyup="sumar_cantidad()" value="<?=$key->seguro?>" >
                </div>
                <div class="form-group">
                  <label>Gastos Personales</label>
                    <input type="text" class="form-control" name="txt_gastos_per" id="txt_gastos_per" onkeyup="sumar_cantidad()" value="<?=$key->gastos_per?>" >
                </div>
                <div class="form-group">
                  <label>Servicios</label>
                    <input type="text" class="form-control" name="txt_servicios" id="txt_servicios" onkeyup="sumar_cantidad()" value="<?=$key->servicios?>" >
                </div>
                <div class="form-group">
                  <label>Herramienta</label>
                    <input type="text" class="form-control" name="txt_herramientas" id="txt_herramientas" onkeyup="sumar_cantidad()" value="<?=$key->herramientas?>" >
                </div>
                <div class="form-group">
                  <label>Prestamos</label>
                    <input type="text" class="form-control" name="txt_prestamos" id="txt_prestamos" onkeyup="sumar_cantidad()" value="<?=$key->prestamos?>" >
                </div>
                <div class="form-group">
                  <label>Inasistencia</label>
                    <input type="text" class="form-control" name="txt_inasistencia" id="txt_inasistencia" onkeyup="sumar_cantidad()" value="<?=$key->inasistencia?>" >
                </div>
                <div class="form-group">
                  <label>Pasajes</label>
                    <input type="text" class="form-control" name="txt_pasajes" id="txt_pasajes" onkeyup="sumar_cantidad()" value="<?=$key->pasajes?>" >
                </div>
                <div class="form-group">
                  <label>Valor Final</label>
                    <input type="text" class="form-control" name="txt_valor_final" value="<?=$key->valor_final?>" readonly="true" >
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