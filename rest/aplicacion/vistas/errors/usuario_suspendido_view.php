<?php
$nombre = $this->session->userdata('nombre');
$this->session->sess_destroy();
?>
<body class="suspendido-img1-body">
	<img src = "<?php echo base_url(); ?>assets/img/suspendido.png" class="img-responsive center-block img-50p">
	<h1 class="dosis-n">LA CUENTA DEL USUARIO <?php echo $nombre; ?> SE ENCUENTRA SUSPENDIDA; CONTACTE AL ADMINISTRADOR DEL SISTEMA MEDIANTE EL TELÉFONO 0800 466 68 27</h1>
	<br/>
	<a href = "<?php echo base_url(); ?>" class="link_suspendido">Regresar</a>
</body>