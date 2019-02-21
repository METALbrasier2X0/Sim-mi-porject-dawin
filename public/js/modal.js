// Get the modal
var modal = document.getElementById('myModal');

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  close_modal();
}

// When the user clicks anywhere outside of the modal, close it

function open_modal(m,exit_on_click) {
    //titre
    $('.modal-header').children("h2").html(m.header);
    $('.modal-header').children("h2").removeClass();
    if (m.class){
      $('.modal-header').children("h2").addClass(m.class);
    }
    //corps
    $('.modal-body').html(m.text);
    //$('.modal-footer').children("h3").html(footer);
    $('.modal-footer').html('');
    console.log(m.buttons);
    //Afficher chaque boutons
    m.buttons.forEach(element => {
        var $input = $('<input type="button" class="button bBlue2" value="'+ element.t +'" />');
        $input.click(element.f);
        $input.appendTo($('.modal-footer'));
    });
    

    modal.style.display = "block";

    //si exit_on_click, ajouter un listener
    if (exit_on_click) {
        window.onclick = function(event) {
            if (event.target == modal) {
              close_modal();
            }
          }
          
    }
    else {
        window.onclick = function(event) {}
    }
}

function close_modal() {
    modal.style.display = "none";
}