<?php
$prin = 0;
foreach ($menu as $f) {
	if($f["jerarquia"] ==1) {
		$prin++;
	}
}
$sub = $menu;
?>
<aside class="main-sidebar">
	<section class="sidebar">
		<?php 
		if ($buscar) {
			?>
			<form action="#" method="get" class="sidebar-form">
				<div class="input-group">
					<input type="text" name="q" class="form-control" placeholder="Buscar...">
					<span class="input-group-btn">
						<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
						</button>
					</span>
				</div>
			</form>
			<?php 
		}
		?>
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header"><b><?php echo $this->session->userdata('denominacion'); ?></b></li>
			<?php 
			foreach ($menu as $f) {
				if ($f["jerarquia"]==1) {
					$cod = $f["cod_menu"];
					$cant_sub=0;
					$ulclass="";
					foreach ($sub as $s) {
						if ($s["precedencia"]==$cod) {
							$cant_sub++;
						}
					}
					if ($cant_sub>0) {
						?>
						<li class="sub-menu list-group">
							<a href="javascript:;" class="">
								<i class="icon_group"></i>
								<span><?php echo $f["titulo_menu"]; ?></span>
								<span class="menu-arrow arrow_carrot-right"></span>
							</a>
						</li>
						<ul class='sub'>
							<?php
							foreach ($sub as $s) {
								if ($cod==$s["precedencia"]) {
									?>
									<li class="list-group"><a href="<?php echo base_url().$s['destino']; ?>" class=""><i class="<?php echo $s['icono']; ?>"></i><span class=""><?php echo $s['titulo_menu']; ?></span></a></li>	
									<?php
								}
							}
							echo '</ul>';
						} else {
							echo '<li  class="list-group">';
							?>
							<a href="<?php echo base_url(); ?><?php echo $f['destino']; ?>" class=''>
								<i class="fa <?php echo $f['icono']; ?>"></i> <span><?php echo ' '.$f['titulo_menu']; ?></span>
							</a>
							<?php 
							echo '</li>';
						}
					}
					echo '</ul>';
				}
				?>
				<span class="ocultar-opc" style="margin-left:10%;">
					<br/>
					<span  style="color:#fff;">--------------------------</span>
					<li>
						<a href="<?php echo base_url(); ?>login/salir" style="color:#fff;"><i class="fa fa-sign-out"></i> Salir</a>
					</li>
				</span>
			</ul>
		</section>
	</aside>