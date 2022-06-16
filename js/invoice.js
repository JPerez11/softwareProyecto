function getFormInvoice()
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Registrar factura de cliente";
    
    $.post('InvoiceController/getFormInvoice',function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function addInvoice()
{
    var cadena=$('#addInvoice').serialize();

    $.post('InvoiceController/addInvoice',cadena,function(response)
    {
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);
    });
}

function getFormDetail(id)
{
    $('#my_modal').modal('show');

    document.querySelector('#modal_tittle').innerHTML="Registrar compra";
    
    $.post('InvoiceController/getFormDetail',{id:id},function(response)
    {
        $('#my_modal_content').html(response);
    });
}

function imprim1(imp1){
var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
		w.print();
		w.close();
        return true;}
        
function addDetail()
{
    var cadena=$('#addDetail').serialize();

    $.post('InvoiceController/addDetail',cadena,function(response)
    {
        $('#my_modal').modal('hide');
        $('.content-principal').html(response);
    });
}

function showInvoiceDetail(id)
{
    $('#invoice_detail').modal('show');
    
    $.post('InvoiceController/showInvoiceDetail',{id:id},function(response)
    {
        $('#my_invoice_detail').html(response);
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