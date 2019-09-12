$(document).ready(function() {
       
    $('body').bind('cut copy paste', function(e) {

        e.preventDefault();

    });

    document.onselectstart = new Function('return false');

});

document.onmousedown = function(event) {
    if (event.button == "2" || event.button == "3") {
      return false;
    }
}
document.onmouseup = function(event) {
 
    if (event.which == "2" || event.which == "3") {
        return false;
    }

}

document.oncontextmenu = new Function("return false");

document.onkeydown = function(e) {
    
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
        return false;
    }
    if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
        return false;
    }
    if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
        return false;
    }
    if (e.keyCode == 123) {
        return false;
    }
} 

window.addEventListener("keyup", function(e) {

  if (e.keyCode == 44) {

    /*
    * I Think print screen can't be block on the we b browser as this action is taken by the operating system we can not control with client side language.
    *
    */

    console.log("in print screen");

        e.preventDefault();

        $('.container').addClass('hide-content');

        return false;

  }else{

   // $('.container').Re('hide-content');

  }
});

$(document).bind('keydown', 'ctrl+s', function(e) {

    e.preventDefault();

    return false;

});