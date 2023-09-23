$(document).ready(function() {
	$("#grid").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: baseUrl + "/arrivals/list"
			},
			schema: {
				data: "row",
				total: "__count",
				sort: { field: "name", dir: "asc"},
				model: {
					id: "id",
					fields: {
						id: { type: "number", editable: false },
						name: { type: "string", editable: false },
						description: { type: "string", editable: false },
						estatus: { type: "string", editable: false, filterable: false }
					}
				}
			},
			sort: { field: "name", dir: "asc"},
			pageSize: 10
		},
		groupable: false,
		selectable: "row",
		editable: true,
		sortable: true,
		pageable: {
			refresh: true,
			pageSizes: true
		},
		filterable: {
			mode: "row"
		},
		resizable: true,
		columns: [
		{
			field: "id",
			title: "ID",
			width: 30,
			filterable: false,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "name",
			title: "Destino",
			width: 100,
			filterable: {
				cell: {
					operator: "contains"
				}
			},
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "description",
			title: "Descripción",
			width: 80,
			filterable: {
				cell: {
					operator: "contains"
				}
			},
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			sortable: false
		}, {
			field: "estatus",
			title: "Estatus",
			template: function(dataItem) {
				var estatus = "";
				if (parseInt(dataItem.estatus) == 1) {
					estatus = '<div class="badge badge-primary">Áctivo</div>';
				} else if (parseInt(dataItem.estatus) == 0) {
					estatus = '<div class="badge badge-danger">Ináctivo</div>';
				}

				return estatus;
			},
			width: 60,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			filterable: false,
			sortable: false
		}, { 
			command: [
			{ name:"Ver", text: "", width:15, click:editArrival, iconClass: "fa fa-edit"  },
			{ name:"Archivos", text: "", width:15, click:deleteArrival, iconClass: "fa fa-trash"  },       
			], 
			title: "Opciones", 
			width: 100,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			sortable: false
		}
		]
	});

	$("#gridH").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: baseUrl + "/sitios/list"
			},
			schema: {
				data: "row",
				total: "__count",
				model: {
					id: "id",
					fields: {
						id_sitio: { type: "number", editable: false },
						sitio: { type: "string", editable: false },
						destino: { type: "string", editable: false },
						descripcion: { type: "string", editable: false },
						estatus: { type: "string", editable: false }
					}
				}
			},
			sort: { field: "sitio", dir: "asc"},
			pageSize: 10
		},
		groupable: false,
		selectable: "row",
		editable: true,
		sortable: true,
		pageable: {
			refresh: true,
			pageSizes: true
		},
		filterable: {
			mode: "row"
		},
		resizable: true,
		columns: [
		{
			field: "id_sitio",
			title: "ID",
			width: 30,
			filterable: false,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "sitio",
			title: "Hotel/sitio",
			width: 100,
			filterable: {
				cell: {
					operator: "contains"
				}
			},
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "destino",
			title: "Destino",
			width: 100,
			filterable: {
				cell: {
					operator: "contains"
				}
			},
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "estatus",
			title: "Estatus",
			template: function(dataItem) {
				var estatus = "";
				if (parseInt(dataItem.estatus) == 1) {
					estatus = '<div class="badge badge-primary">Áctivo</div>';
				} else if (parseInt(dataItem.estatus) == 0) {
					estatus = '<div class="badge badge-danger">Ináctivo</div>';
				}

				return estatus;
			},
			width: 60,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			filterable: false,
			sortable: false
		}, { 
			command: [
			{ name:"Ver", text: "", width:15, click:editSitio, iconClass: "fa fa-edit"  },
			{ name:"Archivos", text: "", width:15, click:deleteSitio, iconClass: "fa fa-trash"  },       
			], 
			title: "Opciones", 
			width: 110,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			sortable: false
		}
		]
	});
});

