//navbar toggle
const _open = document.querySelector("#open");
const _close = document.querySelector("#close");
const navbar = document.querySelector("#menu");

_open.addEventListener('click', () => {
    navbar.classList.remove("hidden");
})
_close.addEventListener('click', () => {
    navbar.classList.add("hidden");
})


//list
const menu = document.querySelector("#mnav");

/*
inhalt : {
    m1 : { name: 'Home', href: '/home' },
    m2 : { name: 'Artikel', href: "/articles" },
    m3 : { name: 'Kategorien', href: '/categories'},
    m4 : { name: 'Verkaufen', href: '/newarticle'},
    m5: {
    u1 : { name: 'Philosophie', href: '' },
    u2 : { name: 'Karriere', href: ''}
    }  
*/
let nav = {
    inhalt : [
        { name: 'Home', href: "/home" },
        { name: 'Artikel', href: "/articles" },
        { name: 'Kategorien', href: "/categories" },
        { name: 'Verkaufen', href: "/newarticle" },
        { name: 'Unternehmen', sub: [{ name: 'Philosophie', href: "" }, { name: 'Karriere', href: "" }] }
    ],
    compose:function(){
        const ul = document.createElement('ul');
        menu.appendChild(ul)
        const list = document.querySelector("#mnav ul");
        this.inhalt.forEach((e) => {

        if (!e.sub) {
            list.innerHTML += `<li><a href="${e.href}">${e.name}</a></li>`;
        } else {
            list.innerHTML += '<ul>';
            for (i of e.sub) {
                let sublist = this.create_list();
                let link = this.create_link(i.href, i.name);

                //<li><a></a></li>
                sublist.appendChild(link);
                sublist.classList.add("sub-nav");

                //temporary div to insert html
                temp = this.create_div()
                temp.appendChild(sublist);

                //add to main list
                list.innerHTML += temp.innerHTML;
            }
        }

        })
    },
    create_list:function(){
        return document.createElement('li');
    },
    create_link:function(href, name){
        let link = document.createElement('a');
        link.href = href;
        link.innerText = name;
        return link;
    },
    create_div:function(){
        return document.createElement('div');
    }
    
}

nav.compose()


