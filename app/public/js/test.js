$(document).ready(function(e) {
    $(".comment-container", $('#test')).click(function(event) {
        if(event.target.className === "las la-edit") {
            if($('.edit-comment:visible', event.currentTarget).length) {
                $('.edit-comment', event.currentTarget).hide("slow");
             } else {
                $('.edit-comment', event.currentTarget).show("slow");        
             }
        }
        

      });


});