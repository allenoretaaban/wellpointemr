$(document).ready(function() {   
    
    //select all the a tag with name equal to modal
    $('a[name=modal]').click(function(e) {
        //Cancel the link behavior
        e.preventDefault();
        
        //Get the A tag
        var id = $(this).attr('href');
    
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
    
        //Set heigth and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
        
        //transition effect        
        $('#mask').fadeIn(500);    
        $('#mask').fadeTo("fast",0.8);    
    
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
              
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);
    
        //transition effect
        $(id).fadeIn(500); 
    
    });
    
    //if close button is clicked
    $('.window .close').click(function (e) {
        //Cancel the link behavior
        e.preventDefault();
        
        $('#mask').hide();
        $('.window').hide();
    });        
    
    //if mask is clicked
    $('#mask').click(function () {
        $(this).hide();
        $('.window').hide();
    });            
    
});

function openModalVacantSlot(){         
    var id = '#dialogvacant';

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    
    //transition effect        
    $('#mask').fadeIn(500);    
    $('#mask').fadeTo("fast",0.8);    

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
          
    //Set the popup window to center
    $(id).css('position',  "fixed" );
    $(id).css('top',  "40px" );
    $(id).css('height',  "450px" );  
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(500); 
}

function openModalSPSlot(){         
    var id = '#dialogsp';

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    
    //transition effect        
    $('#mask').fadeIn(500);    
    $('#mask').fadeTo("fast",0.8);    

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
          
    //Set the popup window to center
    $(id).css('position',  "fixed" );
    $(id).css('top',  "40px" );
    $(id).css('height',  "450px" );  
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(500); 
}


function openModalCDSlot(){         
    var id = '#dialogcd';

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    
    //transition effect        
    $('#mask').fadeIn(500);    
    $('#mask').fadeTo("fast",0.8);    

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
          
    //Set the popup window to center
    $(id).css('position',  "fixed" );
    $(id).css('top',  "40px" );
    $(id).css('height',  "450px" );  
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(500); 
}

function showModal(id, width, height){         
    var id = '#'+id;

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    
    //transition effect        
    $('#mask').fadeIn(500);    
    $('#mask').fadeTo("fast",0.8);    

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
          
    //Set the popup window to center
    $(id).css('position',  "fixed" );
    $(id).css('top',  "40px" );
    $(id).css('height',  height );  
    $(id).css('width',  width );  
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(500); 
}

function openModal(){         
    var id = '#dialog';

    //Get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    
    //transition effect        
    $('#mask').fadeIn(500);    
    $('#mask').fadeTo("fast",0.8);    

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
          
    //Set the popup window to center
    $(id).css('position',  "fixed" );
    $(id).css('top',  "40px" );
    $(id).css('height',  "450px" );  
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(500); 
}

function waiting(){         
    var id = '#waiting';

    //Get the screen height and width
    /*var maskHeight = $(document).height();
    var maskWidth = $(window).width();

    //Set heigth and width to mask to fill up the whole screen
    $('#mask').css({'width':maskWidth,'height':maskHeight});
    
    //transition effect        
    $('#mask').fadeIn(500);    
    $('#mask').fadeTo("fast",0.8);    
    */

    //Get the window height and width
    var winH = $(window).height();
    var winW = $(window).width();
          
    //Set the popup window to center
    $(id).css('position',  "fixed" );
    $(id).css('top',  "140px" );
    $(id).css('left', winW/2-$(id).width()/2);

    //transition effect
    $(id).fadeIn(500); 
}
