$(document).ready(function() {
	if (type != "new") {
		$("#gridOrders").kendoGrid({
			dataSource: {
				type: "odata",
				transport: {
					read: {
						url: baseUrl + "/orders/list",
						type: 'GET',
						data: function(){
							return {
								idreserva: $("#idordenreserva").val(),
								type: type
							}
						}
					},
				},
				schema: {
					data: "row",
					total: "__count",
					model: {
						id: "idorden",
						fields: {
							idorden: { type: "number", editable: false },
							total: { type: "number", editable: false },
							subtotal: { type: "number", editable: false },
							status: { type: "string", editable: false },
							moneda: { type: "string", editable: false },
							tipo_cambio: { type: "number", editable: false },
							observaciones: { type: "string", editable: false, filterable: false },
						}
					}
				},
				pageSize: 10,
				aggregate: [
					{field: "total",aggregate: "sum"},
					{field: "subtotal",aggregate: "sum"}
				],
				sort: { field: "idorden", dir: "desc"}
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
			filterable: {
	            mode: "row"
	        },
	        resizable: true,
			columns: getColumnsOrders()
		});
	}
});


function getColumnsOrders(){
	let media = []; let columns = [];
	media = mediaColumnsOrders("xs");
	columns = mediaColumnsOrders("lg");
	var columnsMedia = media.concat(columns)
	console.log('columnsMedia',columnsMedia)

	return columnsMedia
}

function mediaColumnsOrders(mediaqueries){
	var columns = [];
	var columns = [
		{
			field: "idorden",
			title: "ID",
			width: 70,
			filterable: false,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			attributes: {
				style: "text-align: right;"
			},
			media: mediaqueries,
		}, {
			field: "total",
			title: "Total",
			width: 130,
			format: "{0:c}",
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			},
			attributes: {
				style: "text-align: right;"
			},
			media: mediaqueries,
			aggregates: ["sum"],
			footerTemplate: "<div><b>Total: #=kendo.toString(sum, 'C')#</b></div>"
		}, {
			field: "subtotal",
			title: "Conversión (MXN)",
			width: 130,
			format: "{0:c}",
			filterable: false,
            headerAttributes: {
				style: "font-weight: bolder;"
			},
			attributes: {
				style: "text-align: right;"
			},
			media: mediaqueries,
			aggregates: ["sum"],
			footerTemplate: "<div style='color:black;'><b>Total: #=kendo.toString(sum, 'C')#</b></div>"
		}, {
			field: "tipo_cambio",
			title: "Tipo Cambio",
			width: 100,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			},
			attributes: {
				style: "text-align: right;"
			},
			media: mediaqueries
		}, {
			field: "moneda",
			title: "Moneda",
			width: 70,
			media: mediaqueries,
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "status",
			title: "Estatus",
			width: 70,
			filterable: false,
			media: mediaqueries,
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "observaciones",
			// width: 250,
			title: "observaciones",
			filterable: false,
			media: mediaqueries,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}
	]

	var commandFunctions = [
	{ 
		name: "editOrders", 
		text: "", 
		className: 
		"btn-command", 
		click:editOrder, 
		iconClass: "fa fa-edit"  
	},      
	]
	if (mediaqueries == "xs") {
		commandFunctions = [
		{ 
			name: "editOrdersXs", 
			text: "", 
			className: 
			"btn-command", 
			click:editOrder, 
			iconClass: "fa fa-edit"  
		}      
		]
	}

	columns.push({ 
		command: commandFunctions, 
		title: "Opciones", 
		width: 100,
		headerAttributes: {
			style: "font-weight: bolder;"
		},
		media: mediaqueries  
	});

	return columns
}


function editOrder(e){
	e.preventDefault();
  var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
  app.openActionOrder(dataItem)
  console.log(dataItem)
}