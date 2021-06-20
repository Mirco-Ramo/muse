var OK=0;
var MISSING=1;
var MISMATCH=2;

function changeStyle(field, type, msg){
    field.setCustomValidity(msg);
    switch(type){
        case OK:             
            field.style.borderColor= "lightblue";
            break;
        case MISSING:
            field.style.borderColor= "yellow";
            break;
        case MISMATCH:
            field.style.borderColor= "red";
            break;
    }
}

function checkOnlyLetters(string){
    var pattern=/^[a-zA-Zàèéìòù]+$/;
    return pattern.test(string);
}

function patternPassword(string){
    var pattern1=/[a-zA-Z0-9_-]{8,20}/;
    var pattern2=/[a-z]+/;
    var pattern3=/[A-Z]+/;
    var pattern4=/[0-9]+/;
    return pattern1.test(string) && pattern2.test(string) && pattern3.test(string) && pattern4.test(string);
}

function invalid(evt, msg){
    var field=evt.target;
    var validity = field.validity;
    field.setCustomValidity("");
    if (validity.valueMissing) {
        msg="Si prega di inserire una valore";
        changeStyle(field, MISSING, msg);		
        return;
    }    
    changeStyle(field, MISMATCH, msg);
}

function checkTextConstraints(evt){
    var field=evt.target;
    if(!checkOnlyLetters(field.value) /*|| !field.checkValidity()*/){
        invalid(evt, "Si prega di inserire solo lettere");
        return;
    }    
    changeStyle(field, OK, "");
}

function verificaRequisitiPassword(evt){
    var field=evt.target;
    if(!patternPassword(field.value)){
        invalid(evt, "La password deve avere almeno 8 caratteri tra cui una lettera minuscola, una maiuscola e un numero");
        return;
    }
    changeStyle(field, OK, "");
}

function verificaUguaglianza(evt){
    var field= evt.target;
    var pass=document.getElementsByName('password')[0];
    if(field.value !== pass.value){
        invalid(evt, "Le due password non corrispondono");
        return;
    }
    changeStyle(field, OK, "");	
}

function addHandlers(form){
    for(var i = 0; i < form.elements.length; i++) {
        var e = form.elements[i];
        if(e.type === "text")
            e.addEventListener("blur", checkTextConstraints, false);
	
        if(e.name === "password")
            e.addEventListener("keyup", verificaRequisitiPassword, false);
        
        if(e.name === "repassword")
            e.addEventListener("keyup", verificaUguaglianza, false);
    }
}

addHandlers(document.getElementsByTagName("form")[0]); 