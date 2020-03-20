<div class="col-md-3 left_col menu_fixed">
  <div class="left_col scroll-view">
     <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo base_url(); ?>" class="site_title"><i class="fas fa-paw"></i> <span style="font-size: 20px;"><?php echo 'Dashboard'; ?></span></a>
    </div>

    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="<?php echo $this->session->userdata('user_info')['profile_picture'] ?: base_url('assets/images/user.png'); ?>" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span><?php echo lang('greetings_sidebar'); ?></span>
        <h2><?php echo $this->session->userdata('user_info')['name']; ?></h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br>
    <!-- Sidebar Menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="<?php echo base_url('dashboard'); ?>"><i class="fas fa-tachometer-alt"></i> <?php echo lang('dashboard'); ?></a></li>
          <li><a href="<?php echo base_url('app/index_barang'); ?>"><i class="fas fa-boxes"></i> Barang</a></li>
          <li><a href="<?php echo base_url('app/index_perusahaan'); ?>"><i class="fas fa-building"></i> Perusahaan</a></li>
          <li><a href="<?php echo base_url('app/index_transaksi'); ?>"><i class="fas fa-history"></i> Transaksi</a></li>
        </ul>
      </div>
    </div>
    <!-- /Sidebar Menu -->

    <!-- menu footer buttons -->
    <div class="sidebar-footer hidden-small">
      <a style="width: 100%" data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url('app/logout'); ?>">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
      </a>
    </div>
  <!-- /menu footer buttons -->
  </div>
</div>