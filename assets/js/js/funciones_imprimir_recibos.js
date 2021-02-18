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
			console.log(data);
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
				var rec = this.id.replace("recibo","");
				var anocur = data[rec]['anocur'];
				var codper = data[rec]['codper'];
				var codperi = data[rec]['codperi'];
				var codnom = data[rec]['codnom'];
				console.log("anocur: "+anocur);
				console.log("codper: "+codper);
				console.log("codperi: "+codperi);
				console.log("codnom: "+codnom);
				$.ajax({
					url: 'recibos/obtener_detalle_recibo/'+anocur+"-"+codper+"-"+codperi+"-"+codnom,
					type: 'get',
					dataType: 'json',
				})
				.done(function(data) {
					console.log(data);
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
						$("#detrec").append('<div class="row "><div class="col-xs-2 col-sm-2 col-md-1 peq50" id = "codconc"><small>'+data["detalle"][n]["codconc"]+'</small></div><div class="col-xs-4 col-sm-5 col-md-4 peq50" id = "desconc"><small>'+data["detalle"][n]["titcon"]+'</small></div><div class="col-xs-2 col-sm-2 col-md-2 text-right peq50" id = "asignac"><small>'+asi+'</small></div><div class="col-xs-2 col-sm-2 col-md-2 text-right peq50" id = "deducci"><small>'+ded+'</small></div></div>');
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
					$("#totasignac").html(asig);
					$("#totdeducci").html(deduc);
					$("#totalcobrar").html(mtotal);
				})
				.fail(function(data) {
				})
				.always(function() {
				});
			});
})
.fail(function(data) {
	console.log(data);
	console.log("error");
})
.always(function(data) {
	console.log("complete");
});
})
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
			$("#recibos_encontrados").append('<div class="row peq50"><div class="col-xs-8 col-sm-8 col-md-5 col-md-offset-2">'+data[n].desnom+'</div><div class="col-md-2 col-xs-3 col-sm-2 text-center">'+data[n].numpernom+'</div></div>');
		}
	})
	.fail(function(data) {
		console.log("error");
	})
	.always(function() {
	});
}
});