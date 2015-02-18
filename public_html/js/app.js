

$(document).ready(function(){
    $("#send-search-form").click(function(e){
        e.preventDefault();
        $("#search-form").submit();
    });

    $("#make-reservation").click(function(e){
        e.preventDefault();
        $("#reservation-form").submit();
    });
});