$('#tags').tagsInput({
    'defaultText':'Añadir Email',
    'width':'500px'
});

$('#sendCorreo').click(function(event) {
    var correo = $('#correoPrueba').val();
    $.ajax({
        async:true,
        type: "POST",
        dataType: "html",
       	contentType: "application/x-www-form-urlencoded",
       	url:"operaciones.php",
        data:{"operaciones":"pruebaCorreo", "email":correo},
        success:function(data){
            console.log(data);
           	if(data == 1){
                $('.bottom-right').notify({
                    message: { text: 'Envio Correcto' },
                    type:'blackgloss',
                    fadeOut: { enabled: true, delay: 2000 }
                }).show();
            }else{
                $('.bottom-right').notify({
                    message: { text: 'Ocurrio un problema; Error:'+data},
                    type:'blackgloss',
                    fadeOut: { enabled: true, delay: 2000 }
                }).show(); 
            }                
        },
        cache:false
    });
});

function validar_campos(){
    var filter=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    
    if(!filter.test(form1.correo.value || form1.correo.value == '')){
        form1.correo.focus();
        $('#correo').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este no es correo valido o el campo esta vacío' },
            type:'blackgloss',
        }).show();
        return false;
    }
    else{
        $('#correo').removeClass("form-group has-error").addClass("form-group has-success");
    }   
    if(!filter.test(form1.emisor.value) || form1.emisor.value == ''){
        form1.emisor.focus();
        $('#emisor').removeClass("form-group").addClass("form-group has-error");
        $('.top-right').notify({
            message: { text: 'Este no es correo valido o el campo esta vacío' },
            type:'blackgloss',
        }).show();
        return false;   
    }
    else{
        $('#emisor').removeClass("form-group has-error").addClass("form-group has-success");
    }
} 

