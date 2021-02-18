<header class="main-header">
<!-- 	<a href="#" class="logo">
		<span class="logo-mini"><img src="assets/img/logo.png"></span>
		<span class="logo-lg"><img src="/assets/img/logo.png"><b><?php //echo $this->session->userdata('denominacion'); ?></b></span>
	</a> -->
	<nav class="navbar navbar-static-top">
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Ocultar/Mostrar Menu</span>
		</a>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs">Usuario: <?php echo $this->session->userdata('nombre'); ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-footer pull-right" style="background-color:#222d32;width:100% !important;">
							<div style="">
								<a href="<?php echo base_url(); ?>login/salir" style="color:#fff"><i class="fa fa-sign-out"></i> Salir</a>
							</div>
						</li>
					</ul>
				</li>
				<li>
					<a href="#" data-toggle="control-sidebar" style="display:none;"><i class="fa fa-gears"></i></a>
				</li>
			</ul>
		</div>
	</nav>
</header>
