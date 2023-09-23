$(document).ready(function() {
	var persistSelection = false; 
	if (letreros == 'letreros') { persistSelection = true; }
	$("#grid").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: {
					url: baseUrl + url_site,
					type: 'GET',
					data: function(){
						return {
							type: type,
							fecha_de: $("#fechaLlegada").val(),
							fecha_hasta: $("#fechaSalida").val(),
							tipoFecha: $("#tipoFecha").val(),
							id_agencia: $("#id_agencia").val(),
							tipoViaje: $("#id_tipoViaje").val()
						}
					}
				}
			},
			requestEnd: function(e) {
	    		if (e.type === "read" && e.response) {
	    			app.getDesglose(e.response);
	        		console.log(e);
	    		}
	    	},
			schema: {
				data: "row",
				total: "__count",
				model: {
					id: "idreserva",
					fields: getModel()
				}
			},
			batch: true,
			aggregate: [
				{field: "total", aggregate: "sum"}
			]
		},
		groupable: false,
		selectable: "row",
		editable: "inline",
		reorderable: true,
		sortable: false,
		pageable: {
			refresh: true,
			pageSizes: false
		},
		persistSelection: persistSelection,
		change: onChange,
		filterable: {
            mode: "row"
        },
    	resizable: true,
		columns: getColumns()
	});

	$("#grid").kendoTooltip({
		filter: ".k-grid-Operador",
		content: function(e){
			return "Agregar o Editar Operador";
		}
	});

	$("#grid").kendoTooltip({
		filter: ".k-grid-Ver",
		content: function(e){
			return "Editar Reserva";
		}
	});

	$("#grid").kendoTooltip({
		filter: ".k-grid-Orden",
		content: function(e){
			return "Agregar Orden";
		}
	});

	$("#grid").kendoTooltip({
		filter: ".k-grid-List",
		content: function(e){
			return "Ver Ordenes de Pago";
		}
	});
	
});

function editRow(e){
	e.preventDefault();
  var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  window.open(baseUrl + '/reservatour?id=' + dataItem.idreserva, '_blank');
}

function orderRow(e){
	e.preventDefault();
  var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  app.openModalOrders(dataItem)
  console.log(dataItem)
}

function addDriver(e){
	e.preventDefault();
  var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  app.openModal(dataItem)
}

function showList(e){
	e.preventDefault();
  var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  app.openShowOrders(dataItem)
}

// 26/06/2022
function DeleteRow(e){
	e.preventDefault();
  	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  	app.deleteOrder(dataItem)
}

var dsType = new kendo.data.DataSource({
	data: drivers
});

function driverDropDownList(container, options) {
	console.log(options)
	$('<input data-text-field="name" data-value-field="id" data-bind="value:' + options.field + '"/>')
		.appendTo(container)
		.kendoComboBox({
			autoBind: false,
			dataSource: dsType
		});
}


$("#grid tbody").on("click", "tr", function(e) {

	var rowElement = this;
	var row = $(rowElement);
	var grid = $("#grid").getKendoGrid();

	console.log('aaa')

});

$("#btn_word").click(function(e) {
		if ($("#ordersIds").val() === "") {
			toastr.error('Seleccionar minimo una reserva.')	
			return false;
		}
		$("#form_descargas").submit();
});

function onChange(e) {
	var ids = this.selectedKeyNames();
	$("#ordersIds").val(ids);
	console.log(this.selectedKeyNames())
}

function getModel(){
	var model = {};

	model = {
			operador: { type: "string", editable: true },
			categoria: { type: "string", editable: false },
			tipo: { type: "string", editable: false },
			date: { type: "date", editable: false },
			pickup: { type: "string", editable: false },
			origen: { type: "string", editable: false },
			destino: { type: "string", editable: false },
			agencia: { type: "string", editable: false },
			nombre: { type: "string", editable: false },
			pax: { type: "string", editable: false },
			origenReserva: { type: "string", editable: false },
			total: { type: "number", editable: false },
			estatus: { type: "string", editable: false },
		}

	model.total = { type: "number", editable: false }
	if (type != "letreros") {
		model.observaciones = { type: "string", editable: false }
	}

	return model;
}

function getColumns(){
	let media = []; let columns = [];
	columns = mediaColumns("(min-width: 350px)");
	var columnsMedia = columns

	return columnsMedia
}


function mediaColumns(mediaqueries){
	var columns = [];

	var commandFunctions = [
	{ name: "Operador", text: " Operador ", click:addDriver, iconClass: "fa fa-plus", className: "btn-command" },
	{ name:"Ver", text: "", width:15, className: "btn-command", click:editRow, iconClass: "fa fa-edit"  },
	{ name:"Orden", text: "", width:15, className: "btn-command", click: orderRow, iconClass: "fa fa-receipt"  },       
	{ name:"List", text: "", width:15, className: "btn-command", click: showList, iconClass: "fa fa-table"  },       
	{ name:"Delete", text: "", width:15, className: "btn-command", click: DeleteRow, iconClass: "fa fa-trash"  },       
	]
	if (mediaqueries == "xs") {
		commandFunctions = [
		{ name: "Operador", text: " Operador ", click:addDriver, iconClass: "fa fa-plus", className: "btn-command" },
		{ name:"VerXs", text: "", width:15, className: "btn-command", click:editRow, iconClass: "fa fa-edit"  },
		{ name:"ListXs", text: "", width:15, className: "btn-command", click: showList, iconClass: "fa fa-table"  }, 
		{ name:"DeleteXs", text: "", width:15, className: "btn-command", click: DeleteRow, iconClass: "fa fa-trash"  },  
		]
	}

	var columns = [
	{
		command: commandFunctions, 
		title: "Opciones", 
		width: 125,
		locked: true,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		media: mediaqueries  
	}, {
		field: "operador",
		title: "Operador",
		width: 130,
		locked: true,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		attributes: {
			style: "text-align: center;"
		},
		editor: driverDropDownList,
		template: '#: operador # #if (operador != "" && operador != null){# <br><br> #}# #if(referencia != "" && referencia != null) {# <span>#: referencia #</span> <br> <br> #} #',
		media: mediaqueries,
		filterable: false
	}, {
		field: "pickup",
		title: "Pick Up",
		width: 70,
		headerAttributes: {
			style: "font-weight: bolder; text-align: center;"
		},
		attributes: {
			style: "text-align: center;"
		},
		template: '#if(pickup != null) { #<a href="javascript:void(0);" class="link__pista text-dark" onclick="changeStatusPista(#: idreserva #)">#: pickup # </a> # if (pista == "1") { #<br> <br> <span class="text-danger">Pista</span># } }#',
		media: mediaqueries, 
		filterable: false
	}, {
		field: "origen",
		title: "Origen",
		width: 150,
		headerAttributes: {
			style: "font-weight: bolder; text-align: center;"
		},
		attributes: {
			style: "text-align: center;"
		},
		template: '#if(pickup == null) { # <a href="javascript:void(0);" class="link__pista text-dark" onclick="changeStatusPista(#: idreserva #)">#: origen #</a> #} else {# #: origen # #} if (numeroVueloLlegada != "" && numeroVueloLlegada != null) {# <br> <br> <span>#: numeroVueloLlegada # <br> #: aerolineaLlegada #</span>  #} if(hotelLlegada != "" && hotelLlegada != null) {# <br> <br> <span>#: hotelLlegada #</span> #} if (pista != null && pista == 1 && pickup == null) {# <br> <br> <span class="text-danger">Pista</span> #}#',
		media: mediaqueries 
	}, {
		field: "destino",
		title: "Destino",
		width: 150,
		template: '#: destino # #if (numeroVuelo != "" && numeroVuelo != null) {# <br> <br> <span>#: numeroVuelo # <br> #: aerolinea #</span>  #} if(hotelSalida != "" && hotelSalida != null) {# <br> <br> <span>#: hotelSalida #</span> #}#',
		headerAttributes: {
			style: "font-weight: bolder; text-align: center;"
		},
		attributes: {
			style: "text-align: center;"
		},
		media: mediaqueries 
	}, {
		field: "agencia",
		title: "Agencia",
		width: 120,
		headerAttributes: {
			style: "font-weight: bolder; text-align: center;"
		},
		attributes: {
			style: "text-align: center;"
		},
		template: '#: agencia # #if (otrascategorias != "" && otrascategorias != null) {# <br> <br> <span style="color: red;">#: otrascategorias # </span> #}#',
		media: mediaqueries, 
		filterable: false
	}, {
		field: "nombre",
		title: "Nombre",
		width: 120,
		headerAttributes: {
			style: "font-weight: bolder; text-align: center;"
		},
		attributes: {
			style: "text-align: center;"
		},
		media: mediaqueries 
	}, {
		field: "pax",
		title: "Pax",
		width: 50,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		media: mediaqueries, 
		filterable: false
	}, {
		field: "estatus",
		title: "Estatus",
		width: 80,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		media: mediaqueries,
		template: function(dataItem) {
			return '<span class="badge ' + getEstatusClass(dataItem.estatus) + '">' + kendo.htmlEncode(dataItem.estatus) + '</span>'
		},
		filterable: false
	}, {
		field: "date",
		title: "Fecha Servicio",
		format: "{0:dd/MM/yyyy}",
		width: 100,
		headerAttributes: {
			style: "font-weight: bolder; text-align: center;"
		},
		media: mediaqueries, 
		filterable: false
	}, {
		field: "categoria",
		title: "Categoría",
		width: 130,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		template: '#if (categoria=="Estandar") { # <div class="badge badge-primary">Estandar</div> #}else if (categoria=="Colectivo") {# <div class="badge badge-warning">Colectivo</div> #}else if(categoria=="Premium"){# <div class="badge badge-success">Premium</div>#}#',
		media: mediaqueries,
	}
	]	

	columns.push({
		field: "total",
		title: "Total Pagado(MXN)",
		width: 120,
		format: "{0:c}",
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		footerAttributes:{
			style: "text-align: right;"
		},
		attributes: {
			style: "text-align: right;"
		},
		aggregates: ["sum"],
		footerTemplate: myaggregate,
		media: mediaqueries,
		filterable: false
	});

	columns.push({
		field: "tipo",
		title: "Viaje",
		width: 80,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		media: mediaqueries, 
		filterable: false
	})

	columns.push({
		field: "origenReserva",
		title: "Origen Reserva",
		width: 80,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		template: '#if (origenReserva=="Manual") { # <div class="badge badge-primary">Manual</div> #}else if (origenReserva=="Web") {# <div class="badge badge-success">Web</div> #}#',
		media: mediaqueries, 
		filterable: false
	})

	if (type != "letreros") {
		columns.push({
			field: "observaciones",
			title: "Observaciones",
			width: 120,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			media: mediaqueries,
			filterable: false
		});
	}

	if (letreros == 'letreros') {
		columns.push({ selectable: true, width: "50px", media: mediaqueries });
	}

	return columns
}

// setTimeout(function(){ resizeGrid(); }, 2000);
function resizeGrid(){
    var gridElement = $("#grid"),        
    bodyHeight = $(window).height(),
    dataArea = gridElement.find(".k-grid-content"),
    dataArealocked = gridElement.find(".k-grid-content-locked"),
    gridHeight = gridElement.innerHeight(),
    otherElements = gridElement.children().not(".k-grid-content"),
    otherElementsHeight = 150;
    var h=bodyHeight - otherElementsHeight;
    dataArea.height(h);
    dataArealocked.height(h);
};


function changeStatusPista(idreserva){
	console.log('idreserva', idreserva)
	$.ajax({
		url: baseUrl + '/orders/changeStatusPista?id=' + idreserva,
		type: 'GET',
	})
	.done(function(response) {
		console.log("success", response);
	})
	.fail(function(error) {
		console.log("error", error);
	})
	.always(function() {
		app.refreshTable()
	});
	
}

// 27/06/2022
function myaggregate(data){
	var data = $("#grid").data("kendoGrid").dataSource.data();
    var total = 0;
    if (data.length > 0) {
	    for(var i = 0; i < data.length; i++) {
	        if (data[i].estatus != 'Cancelado') {
	            total += data[i].total;
	        }
	    }
    }
    return '<div><b>Total: ' + kendo.toString(total, 'C') + '</b></div>'
}

function getEstatusClass(estatus) {
	switch (estatus) {
		case "Pendiente":
		return "badge-warning";
		case "Pagado":
		return "badge-success";
		case "Cancelado":
		return "badge-secondary";
		default:
		return "badge-info";
	}
}