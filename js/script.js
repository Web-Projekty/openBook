stop = false;
//console.log("declare"); //debug
//add >_
//template: onmouseenter="textAdd('hello')" onmouseleave="textRemove('hello')" id="hello"
function textAdd(id) {
    if (this.stop == false) {
        var element = document.getElementById(id);
        var text = ">_" + element.innerHTML;
        //console.log(text); //debug
        document.getElementById(id).innerHTML = text;
        this.timeout_remove = setTimeout(() => {
            //The f*ck is this??? (Aparently this is called a wrapper function, but I have no idea why does it even work)
            textRemove(id);
        }, 500);
    } else {
        this.stop = false;
    }
}
//remove >_
function textRemove(id) {
    var element = document.getElementById(id);
    var toRemove = "&gt;_";
    var text = element.innerHTML;
    //console.log(text); //debug
    text = text.replace(toRemove, "");
    //console.log(text); //debug
    document.getElementById(id).innerHTML = text;
    if (this.stop == false) {
        this.timeout_add = setTimeout(() => {
            //The f*ck is this??? (Aparently this is called a wrapper function, but I have no idea why does it even work)
            textAdd(id);
        }, 500);
    } else {
        this.stop = false;
    }
}
function stop_timeout() {
    //console.log("stop"); //debug
    this.stop = true;
}
