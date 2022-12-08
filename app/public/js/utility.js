$(document).ready(function(e) {

    // Function to toggle edit options for a comment in the selected post
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

    // Show mobile menu on toggle
    $("#burger-menu").click(function(event) {
        if($( document ).width() <= 640) {
            if($('.user-sidebar:visible').length) {
                $('.user-sidebar').hide("slow");} 
            else {
                $('.user-sidebar').show("slow");
            }

        }
    });

    // Make sure sidebar is visible on bigger screens
    $(window).on('resize', function(){
        if(window.width > 640 && !('.user-sidebar:visible').length) {
            $('.user-sidebar').show("slow");
        }
    });

     // Replace image on click in selected post page
     $(".small-img").click(function(event) {
        var newImgValue = event.target.src
       $('#big-img').attr( "src", newImgValue)
    });

    // Show public posts
    $("#public").click(function(event) {
         $('.public').show()
         $('.private').hide()
    });

    // Show private posts
     $("#private").click(function(event) {
         $('.private').show()
         $('.public').hide()
      });

});