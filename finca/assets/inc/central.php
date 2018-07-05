 <!-- page content -->
      <div class="right_col" align="center">

        <!-- top tiles -->
        <div class="row tile_count">
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-user"></i>&nbsp;Total Empleados</span>
              <div class="count" align="center"><?=$empleado?></div>
            <a href="<?=$this->config->base_url()?>empleado/grilla" title=""><span class="count_bottom"><i class="green"></i>Ir a Empleados</span></a>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-building"></i>&nbsp;Fincas Registradas</span>
              <div class="count" align="center"><?=$finca?></div>
              <a href="<?=$this->config->base_url()?>finca/grilla" title=""><span class="count_bottom"><i class="green"><i class="fa fa-sort-left"></i></i>Ir a Fincas</span></a>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-cogs"></i>&nbsp;Herramientas</span>
              <div class="count green" align="center"><?=$herramienta?></div>
              <a href="<?=$this->config->base_url()?>herramienta/grilla" title=""><span class="count_bottom"><i class="green"><i class="fa fa-sort-lef"></i></i>Ir a Herramientas</span></a>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-envelope-o"></i>&nbsp;Proformas</span>
              <div class="count green" align="center"><?=$proforma?></div>
              <a href="<?=$this->config->base_url()?>proforma/grilla" title=""><span class="count_bottom"><i class="green"><i class="fa fa-sort-lef"></i></i>Ir a Proformas</span></a>
            </div>
          </div>
          <div class="animated flipInY col-md-2 col-sm-4 col-xs-4 tile_stats_count">
            <div class="left"></div>
            <div class="right">
              <span class="count_top"><i class="fa fa-envelope-o"></i>&nbsp;Proveedores</span>
              <div class="count green" align="center"><?=$proveedor?></div>
              <a href="<?=$this->config->base_url()?>proveedor/grilla" title=""><span class="count_bottom"><i class="green"><i class="fa fa-sort-lef"></i></i>Ir a proveedores</span></a>
            </div>
          </div>
        

        </div>
        <!-- /top tiles -->

        <!-- grafico1 -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile">
        <div id="grafico" style="width:100%; height:400px;">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
      <!-- grafico 2 -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile">
        <div id="grafico2" style="width:100%; height:400px;">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>
 <!-- grafico 3 -->
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel tile">
        <div id="grafico3" style="width:100%; height:400px;">
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
</div>