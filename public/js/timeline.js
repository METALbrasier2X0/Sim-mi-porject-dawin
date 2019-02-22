/*
======================= Creation de la timeline =============================
*/
generateAllBar()
// Generation des graduations dans la timeline
function generateAllBar() {
    $('#timeline').append('<div id="zoneTimeLine"></div><div id="timebarre"><div id="timeCursor"><div></div></div></div>');
    for (i = 0; i < 100; i++) {
        generateLittleBar(i);
    }
    for (i = 0; i < 10; i++) {
        generateBigBar(i * 10);
    }
}

// positionement de chaque petites barres de la timeline
function generateLittleBar(position) {
    $("#timebarre").append('<div class="B2" style="left:' + position + '%"></div>');
}

// positionnement de chaque grande barres de la timeline
function generateBigBar(position) {
    $("#timebarre").append('<div class="B1" style="left:' + position + '%"></div>');
}

/*
======================= Creation des events =============================
*/

var listeEvent = [];

function timeline_init(_arr){

    listeEvent = [];
    
    _arr.forEach(element => {
        var event = createNewEvent(element.name,1,element.description);
        listeEvent.push(event);
    });

    eventActuel = 0;

    //Chargement des events
    organisEvent(listeEvent);
    interac();
}

//Initialisation de l'event
function createNewEvent(nom, time, description) {
    var obj = {};
    obj.nom = nom;
    obj.time = time;
    obj.description = description;
    obj.dateDebut = 0;
    obj.ordre = 0;
    obj.nom_t = obj.nom.replace(" ","");
    return obj;
}

//var listeEvent = [];
//var event = createNewEvent(test.titre,test.size,test.description);
//listeEvent.push(event)

// Creation des Events Nom , temps, description
/*event1 = createNewEvent('event1', 10, 'fzehiohfzhehczjhczmhzh');
event2 = createNewEvent('event2', 10, 'fzehiohfzhehczjhhuiyzediozahzugzaugdgpuaczmhzh');
event3 = createNewEvent('event3', 10, 'fzehiohfzhehczjhc');
event4 = createNewEvent('event4', 50, 'fzehiohfzhehcueyioezaezjhczmhzh');
event5 = createNewEvent('event5', 10, 'fzhczjhczmhzh');
event5 = createNewEvent('event5', 10, 'fzehiohfzhehchgedgfzeiufzzjhczmhzh');
event6 = createNewEvent('event6', 10, 'fzehiohfzhehyiezigezuydueuydzyeuifuizefezefeczjhczmhzh');
event7 = createNewEvent('event7', 10, 'fzeh');
event8 = createNewEvent('event8', 20, 'fzehiohfhuezyhfozyeozyifozefiozeufiozeyhf');
//Tableau liste des evenements
var listeEvent = [event1, event2, event3, event4, event5, event6, event7, event8];*/
//Nombre d'event au total




//Création des dispositions des events dans la timeLine
function organisEvent(listeEvent) {
    createEventFront(listeEvent, calculTimeTotal(listeEvent));
    actuelEventFront(eventActuel);
}

//Calcul le temps total de tout les events enssembles
function calculTimeTotal(listeEvents) {
    var totaltime = 0;
    listeEvents.forEach(function (listeEvent) {
        totaltime = totaltime + listeEvent.time;
    });
    return totaltime;
}

//Creation de chaque cases dans la timeLine correspondant au events
function createEventFront(listeEvents, totalTime) {
    var tempsEcouler = 0;
    listeEvents.forEach(function (listeEvent) {
        var eventPourc = listeEvent.time / totalTime * 100;
        eventPourc = eventPourc;
        baliseInEventHtml = '<div>' + listeEvent.nom + '</div>'
        $('#timebarre').append('<div class="barreGreen" style="left:' + tempsEcouler + '%;"></div>');
        $("#zoneTimeLine").append('<div id="' + listeEvent.nom_t + '" class="event" style="left:' + tempsEcouler + '%;width:' + eventPourc + '%;">' + baliseInEventHtml + '</div>');
        tempsEcouler = tempsEcouler + eventPourc;
        listeEvent.dateDebut = tempsEcouler;
    });
}

//Trouve un event à partir de son titre (concatené ou non)
function getObjByName(name, listeEvents) {
    var objByName;
    listeEvents.forEach(function (listeEvent) {
        if (listeEvent.nom_t == name || listeEvent.nom == name) {
            objByName = listeEvent;
        }
    });
    return objByName;
}

//Si le joueurs click sur une case -> affichage de la description sauf si le niveau n'est pas encore passé
function interac(){
    $('.event').click('mousemove', function (e) {
        var objectclick = getObjByName(this.id, listeEvent);
        var i = 0;
        var verification = false;
        listeEvent.forEach(function (eventObjet) {
            if (objectclick.nom == eventObjet.nom) {
                if (i > eventActuel) {
                    verification = true;
                }
            }
            i++;
        });
    
        if (verification === false) {
            organisationFrontEvents(listeEvent);
            $(this).css({
                "box-shadow": "0px 10px 12px #A4A4A4",
                "top": "45%",
                "color": "black",
                "opacity": "1"
            });
            let eventClick = getObjByName(this.id, listeEvent);
            $('#timelineDescription').text(eventClick.description);
        }
    });
}


//Click button suivant -> passe à la case/event suivante
$('#suivButton').click('mousemove', function (e) {
    eventSuivant();
});

function eventSuivant() {
    if (eventActuel < listeEvent.length - 1) {
        eventActuel = eventActuel + 1;
    }
    actuelEventFront(eventActuel);
    organisationFrontEvents(listeEvent);
}

//Click button precedent -> passe à la case/event precedent
$('#precButton').click('mousemove', function (e) {
    eventPrecedent();
});

function eventPrecedent() {
    if (eventActuel > 0) {
        eventActuel = eventActuel - 1;
    }
    actuelEventFront(eventActuel);
    organisationFrontEvents(listeEvent);
}

function organisationFrontEvents(listeEvents) {
    var i = 0;
    listeEvents.forEach(function (listeEvent) {
        var idDiv = '#' + listeEvent.nom_t;
        if (i < eventActuel) {
            $(idDiv).css({
                "box-shadow": "0px 0px 5px #D8D8D8",
                "top": "60%",
                "color": "grey",
                "opacity": "0.5"
            });
        }
        if (i == eventActuel) {
            $(idDiv).css({
                "box-shadow": "0px 10px 12px #A4A4A4",
                "top": "45%",
                "color": "black",
                "opacity": "1"
            });
        }
        if (i > eventActuel) {
            $(idDiv).css({
                "box-shadow": "0px 0px 0px #D8D8D8",
                "top": "50%",
                "color": "grey",
                "opacity": "1"
            });
        }
        i++;
    });
}

//Actualise l'event sur la page.
function actuelEventFront(nbEventActuel) {
    if (nbEventActuel < listeEvent.length && nbEventActuel >= 0) {
        var objEventActuel = listeEvent[nbEventActuel];
        $('.event').css({
            "box-shadow": "0px 0px 5px #D8D8D8",
            "top": "50%",
            "color": "grey"
        });
        $('.event > div').css({
            "background-color": "#006992"
        });
        var idBaliseEvent = '#' + objEventActuel.nom_t;
        var idBaliseEventinDiv = '#' + objEventActuel.nom_t + " > div";
        $(idBaliseEvent).css({
            "box-shadow": "0px 10px 12px #A4A4A4",
            "top": "45%",
            "color": "black"
        });
        $(idBaliseEventinDiv).css({
            "background-color": "#001D4A"
        });
        $('#timelineDescription').text(objEventActuel.description);
        var leftCursor = objEventActuel.dateDebut - (objEventActuel.time / calculTimeTotal(listeEvent) * 100);
        $('#timeCursor').css({
            "left": leftCursor + "%"
        });
    }
}