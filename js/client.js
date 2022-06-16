function getFormClient()
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Registrar cliente";
    
    $.post('ClientController/getFormClient',function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function addClient()
{
    var cadena=$('#addClient').serialize();

    $.post('ClientController/addClient',cadena,function(response)
    {
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);
    });
}

function getClient(id)
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Actualizar cliente";
    
    $.post('ClientController/getClient',{id:id},function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function updateClient()
{ 
    var cadena=$('#updateClient').serialize();

    $.post('ClientController/updateClient',cadena,function(response)
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