function complaint(id)
{
    var currentLocation = window.location;
    var id;
    $.ajax({
        type: 'POST',
        url: currentLocation,
        async: false,
        data: "COMPLAINT=Y&AJAX=TRUE",
        success: function(data){
            id=data;
        }
    });


    document.getElementById('complaint').firstChild.data = "Ваше мнение учтено, "+id;
}