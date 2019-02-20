var etapes = [
    {name:"test",description:"description1",bonne:1,question:"question1",reponses:["1-1","1-2","1-3","1-4"]},
    {name:"test2",description:"description2",bonne:2,question:"question2",reponses:["2-1","2-2","2-3","2-4"]},
    {name:"test3",description:"description3",bonne:3,question:"question3",reponses:["3-1","3-2","3-3","3-4"]},
    {name:"test4",description:"description4",bonne:4,question:"question4",reponses:["4-1","4-2","4-3","4-4"]},
    {name:"test5",description:"description5",bonne:1,question:"question5",reponses:["5-1","5-2","5-3","5-4"]}
]

timeline_init(etapes);

var rep = {
    satif: 20,
    details: 50,
    perso: 80,
    pro: 100,
} 

function changeRep(id, nbr) {
    rep[id] += nbr;
    if (rep[id] > 100) {rep[id] = 100};
    if (rep[id] <= 0) {
        var message = {
            header:"GAME OVER",
            text:"Votre réputation n'est plus suffisante!",
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
        $("#"+ index +" .bar_front").attr("width",  value * back / 100);
        $("#"+ index +" p")[0].innerHTML = value + "/100";
    }); 
}

function update_UI_question() {
    var current = etapes[eventActuel];
    $(".question h3")[0].innerHTML = current.question;
    $.each($(".answer label"),function(index,element){
        console.log(element);
        element.textContent = current.reponses[index];
    });
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
    var bonne = '#answer' + etapes[eventActuel].bonne;
    if ($('.answer input:checked').length == 0) {
        alert("Please check one");
        return;
    }
    if ($(bonne)[0].checked){
        message.header = "Bonne réponse!";
        changeRep("perso",+10);
    }
    else {
        message.header = "Mauvaise réponse!";
        changeRep("pro",-20);
    }
    open_modal(message,false);
}