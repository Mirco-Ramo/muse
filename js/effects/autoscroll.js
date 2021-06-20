function goToBottom(id){
   
  var elem = document.getElementById(id);
  if(!elem || elem===null)
      elem=document.body;
  elem.scrollTop = elem.scrollHeight;

}
