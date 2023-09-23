$(document).ready(function() {
	$("#grid").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: baseUrl + "/drivers/list"
			},
			schema: {
				data: "row",
				total: "__count",
				model: {
					id: "id",
					fields: {
						id: { type: "number", editable: false },
						name: { type: "string", editable: false },
						license: { type: "string", editable: false },
						telefono: { type: "string", editable: false },
						whatsapp: { type: "string", editable: false },
						correo: { type: "string", editable: false },
						van: { type: "string", editable: false },
						status: { type: "string", editable: false, filterable: false }
					}
				}
			},
			pageSize: 10
		},
		groupable: false,
		selectable: "row",
		editable: true,
		sortable: false,
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
			title: "Operador",
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
			field: "license",
			title: "Licencia",
			width: 80,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "telefono",
			title: "Teléfono",
			width: 80,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "whatsapp",
			title: "WhatsApp",
			width: 80,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "correo",
			title: "Correo",
			width: 120,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "van",
			title: "Camioneta",
			width: 80,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "status",
			title: "Estatus",
			width: 60,
			filterable: false,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, { 
			command: [
			    { name:"Ver", text: "", width:15, click:editDrive, iconClass: "fa fa-edit"  },
			    { name:"Archivos", text: "", width:15, click:deleteDrive, iconClass: "fa fa-trash"  },       
    		], 
    		title: "Opciones", 
    		width: 100,
    		headerAttributes: {
				style: "font-weight: bolder;"
			}  
    	}
		]
	});

	$("#gridV").kendoGrid({
		dataSource: {
			type: "odata",
			transport: {
				read: baseUrl + "/vans/list"
			},
			schema: {
				data: "row",
				total: "__count",
				model: {
					id: "id",
					fields: {
						id: { type: "number", editable: false },
						model: { type: "string", editable: false },
						plates: { type: "string", editable: false },
						max_passenger: { type: "number", editable: false },
						brand: { type: "string", editable: false },
						codigo_verificacion: { type: "string", editable: false },
						fecha_alta: { type: "date", editable: false },
						fecha_vencimiento: { type: "date", editable: false },
						fecha_seguro: { type: "date", editable: false },
						fecha_mantenimiento: { type: "date", editable: false }
					}
				}
			},
			pageSize: 10
		},
		groupable: false,
		selectable: "row",
		editable: true,
		sortable: false,
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
			field: "model",
			title: "Modelo",
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
			field: "plates",
			title: "Placas",
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
			field: "max_passenger",
			title: "Max. Pasajeros",
			width: 80,
			filterable: {
                cell: {
                    operator: "contains"
                }
            },
            headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "brand",
			title: "Marca",
			width: 70,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "codigo_verificacion",
			title: "Código verificación",
			width: 80,
			headerAttributes: {
				style: "font-weight: bolder;"
			}
		}, {
			field: "fecha_alta",
			title: "Fecha de alta",
			format: "{0:dd/MM/yyyy}",
			width: 70,
			headerAttributes: {
				style: "font-weight: bolder; text-align: center;"
			}
		}, {
			field: "fecha_vencimiento",
			title: "Vencimiento verificación",
			format: "{0:dd/MM/yyyy}",
			width: 100,
			headerAttributes: {
				style: "font-weight: bolder; text-align: center;"
			}
		}, {
			field: "fecha_seguro",
			title: "Vencimiento seguro",
			format: "{0:dd/MM/yyyy}",
			width: 100,
			headerAttributes: {
				style: "font-weight: bolder; text-align: center;"
			}
		}, {
			field: "fecha_mantenimiento",
			title: "Mantenimiento",
			format: "{0:dd/MM/yyyy}",
			width: 100,
			headerAttributes: {
				style: "font-weight: bolder; text-align: center;"
			}
		}, {
			field: "estatus",
			title: "Estatus",
			template: function(dataItem) {
				var estatus = "";
				var hoy = moment().format('DD/MM/YYYY')
				var vencimiento = ''
				if (dataItem.fecha_vencimiento != null || dataItem.fecha_vencimiento == '0000-00-00') {
					vencimiento = moment(dataItem.fecha_vencimiento).format('DD/MM/YYYY')
				}
				console.log(hoy, vencimiento)
				if (moment(hoy).isSame(vencimiento) || moment(vencimiento).isAfter(hoy)) {
					estatus = '<div class="badge badge-primary">Áctivo</div>';
				} else if (moment(hoy).isAfter(vencimiento)) {
					estatus = '<div class="badge badge-danger">Vencido</div>';
				} else {
					estatus = '<div class="badge badge-warning">Indefinido</div>';
				}
		      	return estatus;
		    },
		    width: 60,
			headerAttributes: {
				style: "font-weight: bolder;"
			},
			filterable: false
		}, { 
			command: [
			    { name:"Ver", text: "", width:15, click:editVan, iconClass: "fa fa-edit"  },
			    { name:"Archivos", text: "", width:15, click:deleteVan, iconClass: "fa fa-trash"  },       
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

