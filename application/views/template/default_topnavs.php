<!-- Top Nav -->
<div class="top_nav">
	<div class="nav_menu">
		<nav>
			<div class="nav toggle"><a id="menu_toggle"><i class="fas fa-bars fa-lg"></i></a></div>
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						<img src="<?php echo $this->session->userdata('user_info')['profile_picture'] ?: base_url('assets/images/user.png') ?>" alt="">
						<?php echo $this->session->userdata('user_info')['name'] ?>
						<span class="fas fa-angle-down"></span>
					</a>
					<ul class="dropdown-menu dropdown-usermenu pull-right">
						<li><a href="<?php echo base_url('app/logout') ?>" class="btn_logout"><i class="fas fa-sign-out-alt pull-right"></i><?php echo lang('logout') ?></a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</div>
</div>
<!-- /Top Nav -->