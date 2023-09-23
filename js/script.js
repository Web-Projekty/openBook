//add >_
//template: onmouseenter="text_add('hello')" onmouseleave="text_remove('hello')" id="hello"
function text_add(id) {
    var element = document.getElementById(event.target.id);
    var text = ">_" + element.innerHTML;
    //console.log(text) //debug
    document.getElementById(id).innerHTML = text;
}
//remove >_
function text_remove(id) {
    var element = document.getElementById(id);
    var toRemove = "&gt;_";
    var text = element.innerHTML;
    //console.log(text); //debug
    text = text.replace(toRemove, "");
    //console.log(text) //debug
    document.getElementById(id).innerHTML = text;
}