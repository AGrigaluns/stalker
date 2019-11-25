let enterButton = document.getElementById("enter");
let input = document.getElementById("userInput");
let ul = document.querySelector("ul");
let item = document.getElementsByTagName("li");


function listLength() {
    return item.lenght;
}

function crossOut() {
    $(this).toggleClass("done");
}

function addList(event) {
    if (event.type != "click" && event.which !== 13) {
        return false;
    }
    if (input.value.length > 0) {
        let li = document.createElement("li");
        let dBtn = document.createElement("button");
        li.appendChild(document.createTextNode(input.value));
        ul.appendChild(li);
        li.addEventListener("click",crossOut);
        input.value = "";
        dBtn.appendChild(document.createTextNode("x"));
        li.appendChild(dBtn);
        dBtn.addEventListener("click", deleteListItem);
    }
}

function deleteListItem() {
    //if click on 'x' it will close list
    $(this).parent().remove();
}

enterButton.addEventListener("click", addList);

input.addEventListener("keypress", addList);




