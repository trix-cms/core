$(function(){
    $('.dropdown-toggle').dropdown();
    
    $("[rel=tooltip]").tooltip();
    
    $(".alert .close").click(function(){
         $(this).parent().fadeOut('slow');
         return false;
    }); 
    
    // confirm delete
    $(".confirm").click(function(){
        if( !confirm($(this).attr("data-confirm")) ){
            return false;
        } else {
            if( $(this).hasClass("ajax-delete") ){
                $(this).parents(".item").css('background', '#FCF8E3').fadeOut();
                $.get($(this).attr("href"));
                return false;
            }
        }
    });
});