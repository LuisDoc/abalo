"use strict";

const base = document.querySelector("#addArticleForm");

/*
    HTML in Javascript
    Wieso auch immer
*/
//Paragraph Fehlermeldung
const warning = document.createElement('p');
warning.setAttribute("class", "text-red-600 mx-20 my-10");
warning.classList.add("hidden");
warning.innerHTML = "";

//Form anlegen
const form = document.createElement('form');
form.setAttribute("class", "flex flex-col justify-center mx-20");
form.setAttribute("action","/articles");
form.setAttribute("method","POST");
form.setAttribute("enctype", "multipart/form-data")

//Label anlegen: Artikel Informationen
const label1 = document.createElement('label');
label1.setAttribute("class","secondHeadline");
label1.innerHTML = "Artikel Informationen";

//Div 1 anlegen
const div1 = document.createElement('div');
div1.setAttribute("class","my-2");
//Inhalt von Div1 anlegen
const inputName =document.createElement('input');
inputName.setAttribute("class","inp outline outline-gray-300 p-6 mx-5");
inputName.setAttribute("type","text");
inputName.setAttribute("placeholder","Artikel Name*")
//Required zusätzlich zu Java-Script-Validierung
//inputName.setAttribute("required","");
inputName.setAttribute("name","name");
const inputPrice = document.createElement('input');
inputPrice.setAttribute("class","outline outline-gray-300 inp p-6 mx-5");
inputPrice.setAttribute("type","number");
inputPrice.setAttribute("min","0.01");
inputPrice.setAttribute("step","0.01");
inputPrice.setAttribute("placeholder","Artikel Preis*")
//Required zusätzlich zu Java-Script-Validierung
//inputPrice.setAttribute("required","");
inputPrice.setAttribute("name","price");
//Div 1 zusammensetzen
div1.appendChild(inputName);
div1.appendChild(inputPrice);

//Div 2 anlegen
const div2 = document.createElement('div');
div2.classList.add("my-2");
//Inhalt von Div2 anlegen
const inputTextArea = document.createElement('textarea');
inputTextArea.setAttribute("class","outline outline-gray-300 inp mx-5 p-6");
inputTextArea.setAttribute("type","text");
inputTextArea.setAttribute("rows","10");
inputTextArea.setAttribute("cols","100");
inputTextArea.setAttribute("placeholder","Artikelbeschreibung");
inputTextArea.setAttribute("name","description");
//Div2 zusammensetzen
div2.appendChild(inputTextArea);

//Div 3 anlegen
const div3 = document.createElement('div');
div3.setAttribute("class","my-2");
//Inhalt von Div3 anlegen
const chooseCategoryLabel = document.createElement('label');
chooseCategoryLabel.setAttribute("class","thirdHeadline text-black mx-5");
chooseCategoryLabel.innerHTML = "Kategorie auswählen";
//Kategorie Select
const chooseCategory = document.createElement('select');
chooseCategory.setAttribute("class","outline outline-gray-300 focus:outline-purple rounded-xl p-4");
/*
chooseCategory.setAttribute("name","category");
*/



for (var object in categories) {
    if (categories.hasOwnProperty(object)) {
        //Abspeichern des Objekts zur einfacherern Handhabung
        let category = categories[object];
        //Kontrolle ob Root-Kategorie
        if(category['ab_parent'] == null){
            //Hinzufügen einer Option Group
            const optgroup = document.createElement('optgroup');
            optgroup.setAttribute("label",category['ab_name']);
            chooseCategory.appendChild(optgroup);
            //Abspeichern der Root-Kategorie
            let id = category['id'];

            //Suche nach Kindknoten
            for(var object2 in categories){
                if(categories.hasOwnProperty(object2)){
                    //Unterkategorie gefunden - Parent ID identisch
                    let subcategory = categories[object2];
                    if(id == subcategory['ab_parent']){
                        //Option Tag wird angelegt und angehangen
                        const opt = document.createElement('option');
                        opt.setAttribute("value",subcategory['id']);
                        opt.innerHTML = subcategory['ab_name'];
                        optgroup.appendChild(opt);
                    }
                }
            }
        }
    }
}
//Div3 zusammensetzen
div3.appendChild(chooseCategoryLabel);
div3.appendChild(chooseCategory);
//Div 4 - submit
const div4 = document.createElement('div');
div3.setAttribute("class","my-2");
//Div 4 - Inhalt
const submit = document.createElement('input');
submit.setAttribute("class","btn p-2 mx-5 rounded-xl border border-purple");
submit.setAttribute("type","submit");
submit.setAttribute("value","Hinzufügen");

//Div4 Zusammensetzen
div4.appendChild(submit);

//Form zusammensetzen

const filediv = document.createElement('div');
const inputFile = document.createElement('input');
inputFile.setAttribute('type', "file");
inputFile.setAttribute('class', 'mx-5 mb-2')
inputFile.setAttribute('name', 'file');
inputFile.setAttribute('id', 'pic');
filediv.appendChild(inputFile);


form.appendChild(label1);
form.appendChild(div1);
form.appendChild(div2);
form.appendChild(div3);
form.appendChild(filediv)
form.appendChild(div4);
base.appendChild(form);
base.appendChild(warning);

/*
    Event Listener
*/

let priceStatus = false;
let nameStatus = false;

function validateInputPrice(){
    if(!inputPrice.value.match(/^\d*\.?\d{1,2}$/) ||  parseFloat(inputPrice.value)<= 0 ){
        inputPrice.classList.remove("successinput");
        inputPrice.classList.add("errorinput");
        priceStatus = false;
    }
    else{
        inputPrice.classList.remove("errorinput");
        inputPrice.classList.add("successinput");
        priceStatus = true;
    }
}

function validateInputname(){
    if(inputName.value ==""){
        inputName.classList.remove("successinput");
        inputName.classList.add("errorinput");
        nameStatus = false;
    }else{
        inputName.classList.remove("errorinput");
        inputName.classList.add("successinput");
        nameStatus = true;
    }
}
['focus', 'keyup'].forEach((event)=>{
    inputName.addEventListener(event, validateInputname);
    inputPrice.addEventListener(event, validateInputPrice);
})

form.addEventListener('submit', (e)=>{
    e.preventDefault();
    
    if(nameStatus && priceStatus){
        $.ajax({
            url:"/api/createArticle",
            type:"POST",
            data:{
                name: inputName.value,
                price:inputPrice.value,
                description : inputTextArea.value,
                userID : auth_user_id,
                //file :$('#pic').serialize(),
            },
            //Sucess handler will show User that his Article was uploaded correctly
            success:function(response){
                    console.log(response);
                    warning.setAttribute("class", "text-green-600 mx-20 my-5");
                    warning.classList.remove("hidden");
                    warning.innerHTML ="Artikel wurde erfolgreich hinzugefügt";
            },
            //Error handler will tell User why his Article was not uploaded correctly
            error:function(response){
                console.log(response);
                warning.setAttribute("class", "text-red-600 mx-20 my-5");
                warning.classList.remove("hidden");
                warning.innerHTML =JSON.stringify(response.responseJSON.message).slice(1,-1);
            }
        })
    }
    else{
        //Not all needed input fields have been filled
        warning.setAttribute("class", "text-red-600 mx-20 my-5");
        warning.classList.remove("hidden");
        warning.innerHTML ="Bitte füllen sie alle verpflichtenden Felder aus";
    }
})