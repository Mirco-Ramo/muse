var countTimer = new Array();
var updateTimer = null;

function startCountTimer(contactName, time){
    countTimer[contactName] = setInterval(function() {MessageLoader.countNewMessages(contactName);}, time);
}

function stopCountTimer(contactName){
    if(countTimer[contactName]!==null)
        clearInterval(countTimer[contactName]);
}

function startUpdateTimer(contactName, time){
    updateTimer= setInterval(function() {MessageLoader.loadNewMessages(contactName);}, time);
}

function stopUpdateTimer(){
    if(updateTimer!==null)
        clearInterval(updateTimer);
}

