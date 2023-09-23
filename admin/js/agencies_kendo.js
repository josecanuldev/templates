$(document).ready(function() {
	$("#grid").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: baseUrl + "/agencies/list"
			},
			schema: {
				data: "row",
				total: "__count",
				model: {
					id: "id",
					fields: {
						id: { type: "number", editable: false },
						name: { type: "string", editable: false },
						email: { type: "string", editable: false },
						email_two: { type: "string", editable: false },
						attendant: { type: "string", editable: false },
						created_at: { type: "date", editable: false },
						status: { type: "string", editable: false, filterable: false },
						description: { type: "string", editable: false, filterable: false },
					}
				}
			},
			sort: { field: "name", dir: "asc"},
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
			title: "Agencia",
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
			field: "email",
			title: "Correo",
			width: 140,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "email_two",
			title: "Correo 2",
			width: 140,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "attendant",
			title: "Contacto",
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
			field: "created_at",
			title: "Fecha de creación",
			width: 130,
			format: "{0:dd/MM/yyyy H:m:s}",
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		},{
			field: "status",
			title: "Estatus",
			width: 60,
			filterable: false,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "description",
			width: 130,
			title: "Descripción",
			filterable: false,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, { 
			command: [
			    { name:"Ver", text: "", width:15, click:editRow, iconClass: "fa fa-edit"  },
			    { name:"Archivos", text: "", width:15, click:deleteRow, iconClass: "fa fa-trash"  },       
    		], 
    		title: "Opciones", 
    		width: 110,
    		headerAttributes: {
				style: "font-weight: bolder;"
			}  
    	}
		]
	});
});

