function getFormSupply()
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Completar suministro";
    
    $.post('SupplyController/formSupply',function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function addSupply()
{
    var cadena=$('#addSupply').serialize();

    $.post('SupplyController/addSupply',cadena,function(response)
    {
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);
    });
}

function getSupply(id)
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Actualizar suministro";
    
    $.post('SupplyController/getSupply',{id:id},function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function updateSupply()
{ 
    var cadena=$('#updateSupply').serialize();

    $.post('SupplyController/updateSupply',cadena,function(response)
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