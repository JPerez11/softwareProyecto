function getFormProvider()
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Registrar proveedor";
    
    $.post('ProviderController/formProvider',function(response)
    {
        $('#my_modal_content').html(response);
    });                 
}

function addProvider()
{
    var cadena=$('#addProvider').serialize();

    $.post('ProviderController/addProvider',cadena,function(response)
    {
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);        
    });
}

function getProvider(id)
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Actualizar cliente";
    
    $.post('ProviderController/getProvider',{id:id},function(response)
    {
        $('#my_modal_content').html(response);
    });   
}

function updateProvider()
{ 
    var cadena=$('#updateProvider').serialize();

    $.post('ProviderController/updateProvider',cadena,function(response)
    {
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);        
    });
}

$(function () {
    bsCustomFileInput.init();
});

$(function () {
    $("#example1").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
});