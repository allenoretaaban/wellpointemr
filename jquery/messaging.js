$(document).ready(function() {
     
    /*var data = {items: [
                {value: "21", name: "Mick Jagger"},
                {value: "43", name: "Johnny Storm"},
                {value: "46", name: "Richard Hatch"},
                {value: "54", name: "Kelly Slater"},
                {value: "55", name: "Rudy Hamilton"},
                {value: "79", name: "Michael Jordan"}
                ]};    */
    $("#discourier").autoSuggest(data.items, {asHtmlID: "xcselects", selectedItemProp: "name", searchObjProps: "name"});
    
   
    //$("#discourier").autoSuggest("http://xendgpsd.com/api/messaging.php", {minChars: 2, matchCase: true});
    
    setTimeout(function(){fetchMsgsAuto()},4000);
    
 });
 
 var apiserver = "http://xendgpsd.com/api/messaging.php?";
 
 function fetchMsgsAuto(){
     fetchMsgs();
     setTimeout(function(){fetchMsgsAuto()},4000);
 }
 
function sendMsg(){
    xselects = $('#as-values-xcselects').val();
    
    if (xselects == ''){
        alert ('Please select recipients first.'); return;
    }else{
        msgbody = $('#msgbody').val();
        if (msgbody == ''){
            alert ('Please enter your message.'); $('#msgbody').focus();return;
        }
    }
    $('#sendingstat').show(); 
    
    ms_uname = $('#ms_uname').val();
    ms_uid = $('#ms_uid').val();
    
    $.get(apiserver + "job=sendmsg&ms_uid=" + ms_uid + "&ms_uname=" + ms_uname + "&msgbody=" + msgbody + "&couriers=" + xselects, function(result) {
                //alert(result);
                 $("#sendingstat").hide();
                 fetchMsgs();
    });
}

function sendUniMsg(){
    ccode = $('#uni_ccode').val();
    msg = $('#msgbody_uni').val();
    ms_uid = $('#ms_uid').val();
    ms_uname = $('#ms_uname').val();
    $('#sendingstat2').show(); 
    $.get(apiserver + "job=sendmsguni&ccode=" + ccode + "&msg=" + msg + "&ms_uid=" + ms_uid+ "&ms_uname=" + ms_uname, function(result) {
                 fetchMsgs();
                 ino = result;
                 selectMe(ino, ccode);
                 $("#sendingstat2").hide();
                 $('#msgbody_uni').val('');
    });
    
    
}

function fetchMsgs(){
      $.get(apiserver + "job=fetch", function(result) { 
                //$('#tmp_fetchresult').html(result);
                loadFetched(result);
    });
}

loadFetched = function(clist){
     $('#msgslist').html(clist);
}
 

function selectMe(ino, ccode){
   $('#rcptname').html(ccode);
   $('li._k-').css('background','transparent');
   $('.xe').css("color","gray");  
   $('#msgli_' + ino).css("background-color","#6D84B4"); 
   $('#msgli_' + ino).css("border-color","#e0e0e0"); 
   $('.xe_'+ ino).css("color","#ffffff"); 
   $('#frmnewmsg').hide();
   $('#threadmat').show();
   $('#msguni_wrap').show();
   $('#twait').show();
   $('#uni_ccode').val(ccode);
   
   
   $.get(apiserver + "job=getthread&ccode=" + ccode , function(result) {
        $('#threadmsgs').html(result);
        
        //$('threadmsgs').animate({scrollTop:$('#threadmsgs').offset().top - 20}, 'slow');
        $('#threadmsgs').animate({scrollTop: top}, 'slow');
        
        $('#twait').hide();        
    });
   
   
}
function createNew(){
    $('#rcptname').html('New Message');
    $('#frmnewmsg').show();
    $('li._k-').css('background','transparent');
    $('.xe').css("color","gray"); 
    $('#threadmat').hide();
    
}