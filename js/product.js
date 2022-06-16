function getFormProduct()
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Registrar producto";
    
    $.post('ProductController/getFormProduct',function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function addProduct()
{
    var cadena=$('#addProduct').serialize();

    $.post('ProductController/addProduct',cadena,function(response)
    {        
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);        
    });
}

function getProduct(id)
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Actualizar producto";
    
    $.post('ProductController/getProduct',{id:id},function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function updateProduct()
{ 
    var cadena=$('#updateProduct').serialize();

    $.post('ProductController/updateProduct',cadena,function(response)
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