$(document).ready(function(e) {
    $(".comment-container", $('#allComments')).click(function(event) {
        if(event.target.className === "las la-edit") {
            if($('.edit-comment:visible', event.currentTarget).length) {
                $('.edit-comment', event.currentTarget).hide("slow");
                $('.comment-content', event.currentTarget).show("slow");
             } else {
                $('.edit-comment', event.currentTarget).show("slow");        
                $('.comment-content', event.currentTarget).hide("slow");
             }
        }
      });

});