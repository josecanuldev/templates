var headerAttributes = { style: "font-weight: bolder; text-align: center;" }
var attributes = { style: "text-align: center;" }
$(document).ready(function() {
	$("#grid").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: {
					url: baseUrl + "/drivers/getListDrivers",
					type: 'GET',
					data: function(){
						return {
							hoy: $("#hoy").val(),
							hoyMenos15Dias: $("#hoyMenos15Dias").val(),
							id_operador: $("#id_operador").val(),
							rango: $("#tipo_rango").val()
						}
					}
				}
			},
			requestEnd: function(e) {
				if (e.type === "read" && e.response) {
					app.getTableRows(e.response);
				}
			},
			schema: {
				data: "row",
				total: "__count",
				sort: { field: "operador", dir: "asc"},
				model: {
					id: "idreserva",
					fields: getModel()
				}
			},
			sort: { field: "operador", dir: "asc"},
			batch: true,
			group: { field: "operador", aggregates: [
            	{ field: "total", aggregate: "sum" }
        	]},
        	aggregate: [{ field: "total", aggregate: "sum" }]
		},
		groupable: true,
		selectable: "row",
		editable: "inline",
		reorderable: true,
		sortable: false,
		pageable: {
			refresh: true,
			pageSizes: true
		},
		filterable: {
			mode: "row"
		},
		resizable: true,
		columns: [{
			field: "agencia",
			title: "Agencia",
			width: 100,
			headerAttributes: headerAttributes,
			attributes: attributes,
			// media: mediaqueries 
		}, {
			field: "fecha",
			title: "Fecha",
			format: "{0:dd/MM/yyyy}",
			width: 100,
			headerAttributes: headerAttributes,
			template: '#: fechaString #',
			// media: mediaqueries
		}, {
			field: "nombre",
			title: "Nombre",
			width: 100,
			headerAttributes: headerAttributes,
			attributes: attributes,
			template: '#: nombre # #: apellido #',
			// media: mediaqueries 
		}, {
			field: "pasajeros",
			title: "Pax",
			width: 50,
			headerAttributes: headerAttributes,
			// media: mediaqueries,
			filterable: false
		}, {
			field: "origen",
			title: "Origen",
			width: 100,
			headerAttributes: headerAttributes,
			attributes: attributes,
			template: function(dataItem) {
				var html = dataItem.origen
				if (dataItem.aerolineaLlegada != "" && dataItem.aerolineaLlegada != null) {
					html+= '<br> <br> <span> ' + dataItem.aerolineaLlegada + ' <br> ' + dataItem.vueloLlegada + ' </span>'
				}
				if (dataItem.hotel != "" && dataItem.hotel != null) {
					html += '<br> <br> <span> ' + dataItem.hotel + ' </span>'
				}
				return html
			}
			// media: mediaqueries 
		}, {
			field: "hora",
			title: "Hora",
			width: 80,
			headerAttributes: headerAttributes,
			attributes: attributes,
			// media: mediaqueries
		}, {
			field: "destino",
			title: "Destino",
			width: 100,
			headerAttributes: headerAttributes,
			attributes: attributes,
			template: function(dataItem) {
				var html = dataItem.destino
				if (dataItem.aerolinea != "" && dataItem.aerolinea != null) {
					html += '<br> <br> <span> ' + dataItem.aerolinea + ' <br> ' + dataItem.numeroVuelo + ' </span>' 
				}
				if (dataItem.hotelSalida != "" && dataItem.hotelSalida != null) {
					html += '<br> <br> <span> ' + dataItem.hotelSalida + ' </span>'
				}
				return html
			}
			// media: mediaqueries 
		}, {
			field: "operador",
			title: "Operador",
			width: 80,
			headerAttributes: headerAttributes,
			attributes: attributes,
			hidden: true,
			groupHeaderTemplate: "<span class='group--header'> #= value # - Total: #= kendo.format('{0:c}', aggregates.total.sum) # MXN </span>",
			// media: mediaqueries 
		}, {
			field: "referencia",
			title: "Referencia",
			width: 60,
			headerAttributes: headerAttributes,
			attributes: attributes,
			// media: mediaqueries 
		}, {
			field: "total",
			title: "Costo (MXN)",
			width: 80,
			format: "{0:c}",
			headerAttributes: headerAttributes,
			attributes: {
				style: "text-align: right;"
			},
			aggregates: ["sum"],
			// media: mediaqueries,
			filterable: false
		}, {
			command: [
			{ name:"Ver", text: "", width: 15, className: "btn-command", click:showBook, iconClass: "fa fa-eye"  }
			], 
			title: "Ver", 
			width: 50,
			headerAttributes: headerAttributes,
			// media: mediaqueries 
		}]
	});
})


function getModel(){
	var model = {};
	model = {
		agencia: { type: "string", editable: false },
		fecha: { type: "date", editable: false },
		nombre: { type: "string", editable: false },
		hotel: { type: "string", editable: false },
		pasajeros: { type: "number", editable: false },
		aerolinea_vuelo: { type: "string", editable: false },
		origen: { type: "string", editable: true },
		hora: { type: "string", editable: false },
		destino: { type: "string", editable: false },
		operador: { type: "string", editable: false },
		referencia: { type: "string", editable: false },
		total: { type: "number", editable: false }
	}
	return model;
}

function showBook(e){
	e.preventDefault();
	var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
	window.open(baseUrl + '/reservatour?id=' + dataItem.idreserva, '_blank');
}