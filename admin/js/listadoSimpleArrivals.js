$(document).ready(function() {
	$("#grid").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: baseUrl + url_site
			},
			schema: {
				data: "row",
				total: "__count",
				model: {
					id: "id",
					fields: {
						operador: { type: "string", editable: true },
						date: { type: "date", editable: true },
						pickup: { type: "string", editable: false },
						origen: { type: "string", editable: false },
						destino: { type: "string", editable: false },
						agencia: { type: "string", editable: false },
						nombre: { type: "string", editable: false },
						pax: { type: "number", editable: false },
						observaciones: { type: "string", editable: false },
					}
				}
			},
			pageSize: 10
		},
		// height: 550,
		groupable: false,
		selectable: "row",
		editable: true,
		sortable: false,
		pageable: {
			refresh: true,
			pageSizes: true,
			buttonCount: 5
		},
		columns: [
		{
			field: "operador",
			title: "Operador",
			width: 240
		}, {
			field: "date",
			title: "Fecha",
			format: "{0:dd/MM/yyyy}",
		}, {
			field: "pickup",
			title: "Pick Up"
		}, {
			field: "origen",
			title: "Origen"
		}, {
			field: "destino",
			title: "Destino"
		}, {
			field: "agencia",
			title: "Agencia"
		}, {
			field: "nombre",
			title: "Nombre"
		}, {
			field: "pax",
			title: "Pax"
		}, {
			field: "observaciones",
			title: "Observaciones"
		},
		]
	});
});

$("#grid tbody").on("click", "tr", function(e) {

	var rowElement = this;
	var row = $(rowElement);
	var grid = $("#grid").getKendoGrid();

	console.log('aaa')

});
// var grid = $("#grid").data("kendoGrid");
// var selectedItem = grid.dataItem(grid.select());