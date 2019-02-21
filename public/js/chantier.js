var current_q = {};

function loadQuestion(idQuestion){
    var myRequest = new XMLHttpRequest();
    var link= '/loadQuestion?question='+idQuestion;
    console.log(link);
    myRequest.open('GET', link);
    myRequest.send();
    myRequest.onreadystatechange = function () {
        if (myRequest.status === 200) {
            current_q = JSON.parse(myRequest.response);
            console.log(current_q);
            $('.question h3').text(current_q.question.name);
            $('#imgQuestion').attr("src", current_q.question.urlImage);
            $('.radios').html('');
            current_q.reponses[0].forEach(function (value,index) {
                index++;
                if (value.includes("!")){current_q.bonne = index; value = value.split("!")[0]};
                $('.radios').append('<input type="radio" name="group1" id="answer' + index + '" value="newsletter"> <label class="caseCheck case'+index+'" for="answer'+ index +'"><i class="fas fa-check"></i></label><label for="answer'+index+'">'+value+'</input></label> <br>');
            });

        }
        else{
          alert("Error");
        }
    };
  }

timeline_init(etapes);

var rep = {
    satif: 40,
    perso: 80,
    pro: 100,
} 

function changeRep(id, nbr) {
    rep[id] += nbr;
    if (rep[id] > 100) {rep[id] = 100};
    if (rep[id] <= 0) {
        var txt = $("#"+id+" h4")[0].innerHTML;
        var message = {
            header:"GAME OVER",
            text:"Votre "+txt+" n'est plus suffisante!",
            buttons: [{t:"Retour",f:function(){redirect("/menu");}}],
        }
        open_modal(message,false);
    }
    update_UI_rep();
}



function update_UI_rep() {
    var back = $("#satif .bar_back").attr("width");
    //console.log(back);
    
    //$("#satif .bar_front").animate({width: rep.satif * back / 100}, 5000, function() {});
    

    $.each(rep, function(index, value) {
        console.log(index);
        $("#"+ index +" .bar_front").attr("width",  value * back / 100);
        $("#"+ index +" p")[0].innerHTML = value + "/100";
    }); 
}

function update_UI_question() {
    var current = etapes[eventActuel];
    /*$(".question h3")[0].innerHTML = current.question;
    $.each($(".answer label"),function(index,element){
        console.log(element);
        element.textContent = current.reponses[index];
    });*/
    loadQuestion(current.id);
}

update_UI_rep();
update_UI_question();

// Get the button that opens the modal
var btn = document.getElementById("send");

//actions des bouttons
var action1 = function(){
    console.log("continuer");
    if (eventActuel == listeEvent.length - 1){
        redirect("/menu"); //TODO changer vers stat
    }
    else{
        eventSuivant();
        update_UI_question();
    }
    close_modal();
}

//définir le message du modal
var message = {
    header:"test",
    text:"Explication",
    buttons: [{t:"Continuer",f:action1}],
}



//le modal s'ouvre quand on clique sur le bouton
btn.onclick = function() {
    //var bonne = '#answer' + etapes[eventActuel].bonne ? etapes[eventActuel].bonne : 1;
    var bonne = '#answer'+current_q.bonne;
    if ($('.answer input:checked').length == 0) {
        alert("Please check one");
        return;
    }
    if ($(bonne)[0].checked){
        message.header = "Bonne réponse!";
        message.text = current_q.question.textReponse;
        changeRep("satif",current_q.question.satis);
        changeRep("perso",current_q.question.perso);
        changeRep("pro",current_q.question.entre);
    }
    else {
        message.header = "Mauvaise réponse!";
        message.text = current_q.question.textReponse;
        changeRep("satif",-current_q.question.satis);
        changeRep("perso",-current_q.question.perso);
        changeRep("pro",-current_q.question.entre);
    }
    open_modal(message,false);
}