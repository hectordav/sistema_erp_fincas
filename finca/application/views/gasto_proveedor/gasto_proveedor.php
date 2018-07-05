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
        <div class="animated fadeIn">
            <?php echo $output; ?>
        </div>
        </div>
    </div>
</div>