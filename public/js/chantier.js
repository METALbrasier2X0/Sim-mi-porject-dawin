var etapes = [
    {name:"test",description:"description1",bonne:1},
    {name:"test2",description:"description2",bonne:2},
    {name:"test3",description:"description3",bonne:3},
    {name:"test4",description:"description4",bonne:4},
    {name:"test5",description:"description5",bonne:1}
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
            buttons: [],
        }
        open_modal(message,false);
    }
    updateUI();
}



function updateUI() {
    var back = $("#satif .bar_back").attr("width");
    //console.log(back);
    
    //$("#satif .bar_front").animate({width: rep.satif * back / 100}, 5000, function() {});
    

    $.each(rep, function(index, value) {
        $("#"+ index +" .bar_front").attr("width",  value * back / 100);
        $("#"+ index +" p")[0].innerHTML = value + "/100";
    }); 
}

updateUI();

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