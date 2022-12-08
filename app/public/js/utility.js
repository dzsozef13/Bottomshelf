$(document).ready(function(e) {
    $('#dropdown').hide();
    $("#all").addClass("option-chip-checked")
    
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
       $('#big-img').attr("src", newImgValue)
    });

    // Show public posts
    $("#public").click(function(event) {
        // show public posts
         $('.public').show("fast")

         // add checked class to public chip
         $("#public").addClass("option-chip-checked")
         $("#public").removeClass("option-chip")

         // remove possible checked class from other chips
         $("#private").removeClass("option-chip-checked")
         $("#all").removeClass("option-chip-checked")
         $("#private").addClass("option-chip")
         $("#all").addClass("option-chip")

         // hide all private posts
         $('.private').hide("fast")
    });

    // Show private posts
     $("#private").click(function(event) {
        //show private posts
         $('.private').show("fast")

         // add checked class to private chip
         $("#private").addClass("option-chip-checked")
         $("#private").removeClass("option-chip")

         // remove possible checked class from other chips
         $("#public").removeClass("option-chip-checked")
         $("#all").removeClass("option-chip-checked")
         $("#public").addClass("option-chip")
         $("#all").addClass("option-chip")

         // hide all public posts
         $('.public').hide("fast")
      });

      $("#all").click(function(event) {
        // Show all posts
        $('.private').show("fast")
        $('.public').show("fast")

         // add checked class to 'all' post chip
         $("#all").addClass("option-chip-checked")
         $("#all").removeClass("option-chip")

         // remove possible checked class from other chips
         $("#public").removeClass("option-chip-checked")
         $("#private").removeClass("option-chip-checked")
         $("#public").addClass("option-chip")
         $("#private").addClass("option-chip")

 
     });

    // Toggle open dropdown
    $("#dropdown-container").click(function(event) {
        if($('#dropdown:visible').length) {
            $('#dropdown').hide();
        } else {
            $('#dropdown').show();        
        }
    }); 

    // Toggle open dropdown
    $(".dropdown-button", $('#dropdown')).click(function(event) {
        $('#dropdown-container').attr("value", event.target.textContent)
        $('#dropdown').hide();
    }); 

});