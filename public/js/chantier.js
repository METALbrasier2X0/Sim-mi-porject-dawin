var current_q = {};

var pleasewait = {
    header:"Chargement",
    text:"Veuillez patienter...",
    buttons: []
}

var congrats = {
    header:"Bravo!",
    class: "good_answer",
    text:"Vous avez répondu",
    buttons:[{t:"Envoyer le score",f:finish}]
}


function loadQuestion(idQuestion){
    var myRequest = new XMLHttpRequest();
    var link= '/loadQuestion?question='+idQuestion;
    console.log(link);
    myRequest.open('GET', link);
    myRequest.send();
    open_modal(pleasewait);
    myRequest.onreadystatechange = function () {
        if (myRequest.status === 200 && myRequest.readyState == 4) {
            close_modal();
            current_q = JSON.parse(myRequest.response);
            console.log(current_q);
            $('.question h3').text(current_q.question.name);
            $('#imgQuestion').attr("src", "public/imgGame/"+current_q.question.urlImage);
            $('.radios').html('');
            current_q.reponses[0].forEach(function (value,index) {
                index++;
                if (value.includes("!")){current_q.bonne = index; value = value.split("!")[0]};
                $('.radios').append('<input type="radio" name="group1" id="answer' + index + '" value="newsletter"> <label class="caseCheck case'+index+'" for="answer'+ index +'"><i class="fas fa-check"></i></label><label for="answer'+index+'">'+value+'</input></label> <br>');
            });

        }
        else{
            if (myRequest.status != 200){
                alert("Error");
            }
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
        //console.log(index);
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
    var etape_image = "http://chevalier-construction.com/wp-content/gallery/toiture/toiture3.jpg"
    if (current.url_image != "") {
        etape_image = "public/imgGame/"+current.url_image;
    }
    $(".view")[0].src = etape_image;
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
        //finish();
        open_modal(congrats);
    }
    else{
        eventSuivant();
        update_UI_question();
        close_modal();
    }
    
}

function finish(){
    //close_modal();
    //open_modal(pleasewait,false);
    $.post( 
        "saveScore",
        { rep: rep },
        function(data) {
           console.log(data);
           redirect("/score");
        }
     );
    
}

//définir le message du modal
var message = {
    header:"test",
    text:"Explication",
    buttons: [{t:"Plus d'infos",f:afficher_doc},{t:"Continuer",f:action1}],
}

function afficher_doc() {
    //
}

//le modal s'ouvre quand on clique sur le bouton
btn.onclick = function() {
    //var bonne = '#answer' + etapes[eventActuel].bonne ? etapes[eventActuel].bonne : 1;
    var bonne = '#answer'+current_q.bonne;
    if ($('.answer input:checked').length == 0) {
        alert("Please check one");
        return;
    }
    if ($(bonne)[0].checked){ //SI BONNE REPONSE
        message.header = "Bonne réponse! <i class='fas fa-laugh-beam'></i>";
        message.class = "good_answer";
        message.text = current_q.question.textReponse;
        $("#"+listeEvent[eventActuel].nom_t).css({"background-color":"green"});
        changeRep("satif",current_q.question.satis);
        changeRep("perso",current_q.question.perso);
        changeRep("pro",current_q.question.entre);
    }
    else { //SI MAUVAISE REPONSE
        message.header = "Mauvaise réponse! <i class='fas fa-sad-tear'></i>";
        message.class = "bad_answer";
        message.text = current_q.question.textReponse;
        $("#"+listeEvent[eventActuel].nom_t).css({"background-color":"red"});
        changeRep("satif",-current_q.question.satis);
        changeRep("perso",-current_q.question.perso);
        changeRep("pro",-current_q.question.entre);
    }
    open_modal(message,false);
}