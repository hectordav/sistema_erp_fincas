<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="<?=$this->config->base_url()?>principal" class="site_title"><span>Fincas</span></a>
          </div>
          <div class="clearfix"></div>

          <!-- menu prile quick info -->
          <div class="profile">
            <div class="profile_pic">
              <img src="<?= $this->config->base_url();?>/assets/img/user.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>Usuario</h2>
            </div>
            
            
          </div>
          <!-- /menu prile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
               <!--  <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                   
                  </ul>
                </li> -->
                <li><a><i class="fa fa-home"></i>Empresa-Finca<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>empresa/grilla">Empresa</a>
                    </li>
                    <li><a href="<?= $this->config->base_url();?>finca/grilla">Finca</a>
                    </li>
                 
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Faenas<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>faena/grilla">Faenas</a>
                    </li>
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Medidas<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>medida/grilla">Cargar Medidas</a>
                    </li>                   
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Proforma<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>proforma/grilla">Cargar Proforma</a>
                    </li>                   
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Proforma de pagos<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>proforma_pago/grilla">Cargar Proforma</a>
                    </li>                   
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Empleados<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>empleado/grilla">Empleados</a>
                    </li>                   
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Nomina<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>nomina/grilla">Nomina</a>
                    </li>                   
                  </ul>
                </li>
                <li><a><i class="fa fa-edit"></i>Inventario<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu" style="display: none">
                    <li><a href="<?= $this->config->base_url();?>herramienta/grilla">Herramientas</a>
                    </li>
                     <li>
                    <a href="<?= $this->config->base_url();?>inventario/grilla">Inventarios</a>
                    </li>                      
                  </ul>

                </li>
              </ul>
            </div>
          
          </div>
        
        </div>
      </div>