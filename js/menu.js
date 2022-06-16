
function logOut()
{
    $.post('AccessController/closeSession',function()
    {
        location.href="index.php";
    }); 
}

function routing(route)
{
    $.post(route,function(response)
    {
        $('.content-principal').html(response);
    });  
}