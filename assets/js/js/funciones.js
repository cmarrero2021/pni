$(document).ready(function() {
	$('.seleccionar-recibos').on('click',  function(){
		var id = $(this).attr('id');
		url = base_url+"recibos/obtener_resumen_recibos/" + id;
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'JSON',
		})
		.done(function(data) {
			$("#rec").show();
			$("#recibo_generado").hide();
			$("#recibos_encontrados").empty();
			var longitud = data.length;
			for (n=0;n<longitud;n++){
				if (n%2 ==0) {
					var clase = " bgc-azulelectrico cacerozombreado ";
				} else {
					var clase = " bgc-turquesa cacerozombreado ";
				}
				var monto = new Intl.NumberFormat("de-DE").format(data[n]['monnetres']);
				var decimales = monto.indexOf(',');
				if (decimales == -1) {
					monto += ',00';
				} else if (monto.substr(monto.indexOf(',')+1,2).trim().length==1) {
					monto += '0';
				}
				$("#recibos_encontrados").append('<div class= "row '+clase+' recibo_pago" id="recibo'+n+'"><div class="col-xs-3 col-sm-2 col-md-1 xm-text-left sm-text-left text-center col-md-offset-1">'+data[n]['fechasper']+'</div><div class="col-xs-1 col-sm-1 col-md-1 xm-text-left sm-text-left text-center small-hide-pr small-hide-ld">'+data[n]['codnom']+'</div><div class="col-xs-4 col-sm-4 col-md-4">'+data[n]['desnom']+'</div><div class="col-xs-3 col-sm-3 col-md-3 xm-text-left sm-text-left text-right">'+monto+'</div></div>');
			}
			$(".recibo_pago").click(function() {
				$("#recibo_generado").show();
				var rec = this.id.replace("recibo","");
				var anocur = data[rec]['anocur'];
				var codper = data[rec]['codper'];
				var codperi = data[rec]['codperi'];
				var codnom = data[rec]['codnom'];
				$.ajax({
					url: 'recibos/obtener_detalle_recibo/'+anocur+"-"+codper+"-"+codperi+"-"+codnom,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					var fecdesper = data["encabezado"][0]["fecdesper"];
					var fechasper = data["encabezado"][0]["fechasper"];
					var fecha_actual = new Date();
					var dd = fecha_actual.getDate();
					var mm = fecha_actual.getMonth() + 1;
					var yyyy = fecha_actual.getFullYear();
					if (dd < 10) {
						dd = '0' + dd;
					} 
					if (mm < 10) {
						mm = '0' + mm;
					} 
					var fecha_actual = dd + '/' + mm + '/' + yyyy;
					$("#femi").html("<small>"+fecha_actual+"</small>");
					$("#femip").html("<small>"+fecha_actual+"</small>");
					$("#codperi").html("<small>"+codperi+"</small>");
					$("#codperip").html("<small>"+codperi+"</small>");
					$("#perdesde").html("<small>"+data["encabezado"][0]["fecdesper"]+"</small>");
					$("#perdesdep").html("<small>"+data["encabezado"][0]["fecdesper"]+"</small>");
					$("#perhasta").html("<small>"+data["encabezado"][0]["fechasper"]+"</small>");
					$("#perhasp").html("<small>"+data["encabezado"][0]["fechasper"]+"</small>");
					$("#cedula").html("<small>"+data["encabezado"][0]["cedper"])+"</small>";
					$("#nombre").html("<small>"+data["encabezado"][0]["apeper"]+", "+data["encabezado"][0]["nomper"])+"</small>";
					$("#rif").html("<small>"+data["encabezado"][0]["rifper"])+"</small>";
					$("#fingre").html("<small>"+data["encabezado"][0]["fecingper"])+"</small>";
					$("#codubi").html("<small>"+data["encabezado"][0]["cod_ubicacion"])+"</small>";
					$("#ubicacion").html("<small>"+data["encabezado"][0]["desuniadm"])+"</small>";
					$("#cuenta").html("<small>"+data["encabezado"][0]["codcueban"])+"</small>";
					$("#cod_cargo").html("<small>"+data["encabezado"][0]["codasicar"])+"</small>";
					$("#cargo").html("<small>"+data["encabezado"][0]["descasicar"])+"</small>";
					$("#desnom").html("<small>"+data["encabezado"][0]["desnom"]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código: "+data["encabezado"][0]["codnom"])+"</small>";
					$("#cedulap").html("<small>"+data["encabezado"][0]["cedper"])+"</small>";
					$("#nombrep").html("<small>"+data["encabezado"][0]["apeper"]+", "+data["encabezado"][0]["nomper"])+"</small>";
					$("#rifp").html("<small>"+data["encabezado"][0]["rifper"])+"</small>";
					$("#fingrep").html("<small>"+data["encabezado"][0]["fecingper"])+"</small>";
					$("#codubip").html("<small>"+data["encabezado"][0]["cod_ubicacion"])+"</small>";
					$("#ubicacionp").html("<small>"+data["encabezado"][0]["desuniadm"])+"</small>";
					$("#cuentap").html("<small>"+data["encabezado"][0]["codcueban"])+"</small>";
					$("#cod_cargop").html("<small>"+data["encabezado"][0]["codasicar"])+"</small>";
					$("#cargop").html("<small>"+data["encabezado"][0]["descasicar"])+"</small>";
					$("#desnomp").html("<small>"+data["encabezado"][0]["desnom"]+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código: "+data["encabezado"][0]["codnom"])+"</small>";
					var dets = data["detalle"].length;
					$("#detrec").empty();
					var asignaciones = 0.00;
					var deducciones = 0.00;
					var total = 0.00;
					for (n=0;n<dets;n++) {
						if (data["detalle"][n]["valsal"] > 0) {
							var asi1 = Math.abs(data["detalle"][n]["valsal"]);
							asignaciones += asi1;
							var ded = '';
							var asi = new Intl.NumberFormat("de-DE").format(Math.abs(data["detalle"][n]["valsal"]));
							var decimales = asi.indexOf(',');
							if (decimales == -1) {
								asi += ',00';
							} else if (asi.substr(asi.indexOf(',')+1,2).trim().length==1) {
								asi += '0';
							}
						} else {
							var asi = '';
							var ded1 = Math.abs(data["detalle"][n]["valsal"]);
							deducciones += ded1;
							var ded = new Intl.NumberFormat("de-DE").format(Math.abs(data["detalle"][n]["valsal"]));
							var decimales = ded.indexOf(',');
							if (decimales == -1) {
								ded += ',00';
							} else if (ded.substr(ded.indexOf(',')+1,2).trim().length==1) {
								ded += '0';
							}
						}
						$("#detrec").append('<div class="row no-imprimir"><div class="col-xs-4 col-md-1"><small>'+data["detalle"][n]["codconc"]+'</small></div><div class="col-xs-4 col-md-5"><small>'+data["detalle"][n]["titcon"]+'</small></div><div class="col-xs-4 col-md-2 text-right"><small>'+asi+'</small></div><div class="col-xs-4 col-md-2 text-right"><small>'+ded+'</small></div></div>');
						$("#detrecp").append('<div class="row imprimir"><div class=" col-sm-2 col-md-1 peq50"><small>'+data["detalle"][n]["codconc"]+'</small></div><div class=" col-sm-5 col-md-4 peq50"><small>'+data["detalle"][n]["titcon"]+'</small></div><div class=" col-sm-2 col-md-2 text-right peq50"><small>'+asi+'</small></div><div class=" col-sm-2 col-md-2 text-right peq50"><small>'+ded+'</small></div></div>');
					}
					total = Math.abs(asignaciones) - Math.abs(deducciones);
					var asig = new Intl.NumberFormat("de-DE").format(asignaciones);
					var decimales = asig.indexOf(',');
					if (decimales == -1) {
						asig += ',00';
					} else if (asig.substr(asig.indexOf(',')+1,2).trim().length==1) {
						asig += '0';
					}
					var deduc = new Intl.NumberFormat("de-DE").format(deducciones);
					var decimales = deduc.indexOf(',');
					if (decimales == -1) {
						deduc += ',00';
					} else if (deduc.substr(deduc.indexOf(',')+1,2).trim().length==1) {
						deduc += '0';
					}
					var mtotal = new Intl.NumberFormat("de-DE").format(total);
					var decimales = mtotal.indexOf(',');
					if (decimales == -1) {
						mtotal += ',00';
					} else if (mtotal.substr(mtotal.indexOf(',')+1,2).trim().length==1) {
						mtotal += '0';
					}
					$("#totdeducci").html(deduc);
					$("#totalcobrar").html(mtotal);
					$("#totasignac").html(asig);
					$("#totdeduccip").html(deduc);
					$("#totalcobrarp").html(mtotal);
					$("#totasignacp").html(asig);
				})
.fail(function(data) {
})
.always(function() {
});
});
})
.fail(function(data) {
})
.always(function(data) {
});
})
$("#rec_clave").on("click",function() {
	window.location.href = base_url+"registro/recuperar_clave";
});
$("#registro").click(function() {
	alert("pepe")
	window.location.href = base_url+"sincronizacion";
});
$('#ractual').click(function() {
	recibos("sno_salida");
});
$('#ranteriores').click(function() {
	recibos("sno_hsalida");
});
function recibos(tabla) {
	$("#recibos_encontrados").html('');
	var codper = $("#codper").html().trim();
	var codtab=codper+"@@@"+tabla;
	var url = base_url+"recibos/obtener_recibos/"+codtab;
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'json',
		data: {codtab:codtab},
	})
	.done(function(data) {
		var cantRegs = data.length;
		for (n=0;n<cantRegs;n++) {
			$("#recibos_encontrados").append('<div class="row"><div class="col-xs-8 col-sm-8 col-md-5 col-md-offset-2">'+data[n].desnom+'</div><div class="col-md-2 col-xs-3 col-sm-2 text-center">'+data[n].numpernom+'</div></div>');
		}
	})
	.fail(function(data) {
		console.log("error");
	})
	.always(function() {
	});
}
});