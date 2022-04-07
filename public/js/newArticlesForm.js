"use strict";

const base = document.querySelector("#addArticleForm");

//Form anlegen
const form = document.createElement('form');
form.setAttribute("class", "flex flex-col justify-center mx-20");
form.setAttribute("action","");
form.setAttribute("method","GET");

//Label anlegen: Artikel Informationen
const label1 = document.createElement('label');
label1.setAttribute("class","secondHeadline");
label1.innerHTML = "Artikel Informationen";

//Div 1 anlegen
const div1 = document.createElement('div');
div1.setAttribute("class","my-2");
//Inhalt von Div1 anlegen
const inputName =document.createElement('input');
inputName.setAttribute("class","outline outline-gray-300 inp p-6 mx-5");
inputName.setAttribute("type","text");
inputName.setAttribute("placeholder","Artikel Name*")
inputName.setAttribute("required","");
inputName.setAttribute("name","name");
const inputPrice = document.createElement('input');
inputPrice.setAttribute("class","outline outline-gray-300 inp p-6 mx-5");
inputPrice.setAttribute("type","text");
inputPrice.setAttribute("placeholder","Artikel Preis*")
inputPrice.setAttribute("required","");
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
chooseCategory.setAttribute("name","category");
console.log(categories);

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
                    let subcategory = categories[object2];
                    if(id == subcategory['ab_parent']){
                        console.log(subcategory['id'] + "ist ein Kind von Root: " + id);
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
submit.setAttribute("class","outline outline-gray-300 hover:outline-purple rounded-xl p-6 mx-5")
submit.setAttribute("type","submit");
submit.setAttribute("value","Hinzufügen");
//Div4 Zusammensetzen
div4.appendChild(submit);

//Form zusammensetzen
form.appendChild(label1);
form.appendChild(div1);
form.appendChild(div2);
form.appendChild(div3);
form.appendChild(div4);
base.appendChild(form);