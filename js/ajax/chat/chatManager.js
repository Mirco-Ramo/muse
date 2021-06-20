function beginChat(contactName){
    var div = document.getElementById('dark_background_div');
    var frame = document.getElementById('chat_frame');   
    div.style.display = "block";
    
    var notifica = document.getElementById(contactName + '_new_message_counter');
    notifica.removeChild(notifica.firstChild);
    notifica.appendChild(document.createTextNode(0));
    notifica.style.display = "none";
    
    frame.setAttribute('src', 'privateChat.php?contactName=' + contactName);
}

function closeChat(){
    var div = document.getElementById('dark_background_div');
    var frame = document.getElementById('chat_frame');   
    frame.setAttribute('src','#');
    div.style.display = "none";
}