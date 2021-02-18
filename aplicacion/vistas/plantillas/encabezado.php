<?php
if (isset($titulo[0]["titulo"])) {
	$tit = $titulo[0]["titulo"];
} else {
	$tit = $titulo;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $tit; ?></title>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/img/favicon.ico">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<script src="<?php echo base_url(); ?>assets/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Elegant Icons -->
	<link href="<?php echo base_url(); ?>assets/css/elegant-icons-style.css" rel="stylesheet" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/dist/css/skins/_all-skins.min.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/jvectormap/jquery-jvectormap.css">
	<!-- DataTables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datatables.min.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/daterangepicker.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css"/>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>  
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/datatables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/fnFindCellRowIndexes.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.editor.min.js"></script>
	<!-- Date Picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa|Dosis|Raleway&display=swap" rel="stylesheet">
	<!-- Bootstrap Toogle -->
	<link href="<?php echo base_url(); ?>assets/css/bootstrap-toggle.css" rel="stylesheet">
	<script src="<?php echo base_url(); ?>assets/js/bootstrap-toggle.js"></script>	
	<script src="<?php echo base_url(); ?>assets/js/fieldChooser.js"></script>	
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilos.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/estilos2.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/colores.css">    
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/fuentes.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/imgs.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<script src="<?php echo base_url(); ?>assets/js/sweetalert2.all.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
	<script src="<?php echo base_url(); ?>assets/js/select2.full.min.js"></script>
	<script type="text/javascript">
		var base_url="<?php echo base_url(); ?>";
	</script>
</head>
