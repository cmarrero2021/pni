</section>
<!-- /.content -->
<footer class="main-footer pie-oncti2"">
	<div class="row" >
		<div class="cl-xs-6 col-sm-6 col-md-6 col-md-offset-2" style="margin-left:0% !important;">
			<strong id="texto"><?php echo $pie[0]['pie']; ?></strong>
		</div>
		<div class="col-xs-6 col-sm-6 col-md-6 col-xs-offset-10 col-sm-offset-10 col-md-offset-10">
			<img src ="<?php echo base_url();?>assets/img/oncti_blanco.png" class="img-responsive no-imprimir logo-pie-oncti2" >
		</div>
	</footer>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".main-footer").width($(window).width());
		var altoVentana = $(window).innerHeight();
		var altoPie = $(".main-footer").innerHeight();
		var posYpie = (altoVentana - altoPie);
		$(".main-footer").offset({top:posYpie, left:0});
		$("texto").offset({left:0});

	});
	$(window).resize(function(){
		$(".main-footer").width($(window).width());
		var altoVentana = $(window).innerHeight();
		var altoPie = $(".main-footer").innerHeight();
		var posYpie = (altoVentana - altoPie);
		$(".main-footer").offset({top:posYpie, left:0});
		$("texto").offset({left:0});
	});
</script>
<!-- /.content-wrapper -->