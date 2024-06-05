function themeColorHome(){
    const icon_dark = "public/img/lua.png";
    const icon_light = "public/img/sol.png";

    const icon_user_dark = "public/img/user-black.png";
    const icon_user_light = "public/img/user-white.png";

    //Área de navegação no topo da Home
    const div_links = document.getElementById("links");
    if(div_links != null){
        div_links.classList.toggle("links_dark");
    }
    
    //Área do subtítulo da Home
    const div_subtitle = document.getElementById("div-subtitle");
    if(div_subtitle !== null){
        div_subtitle.classList.toggle("div-subtitle-dark");    
    }
    
    /*Footer da estrutura*/
    const footer = document.getElementById("footer");
    if(footer != null){
        footer.classList.toggle("footer-dark");        
    }
    
    //Body do documento HTML da Página Home
    const body = document.getElementById("body");
    if(body != null){
        body.classList.toggle("body-style-dark");    
    }
    
    //Ícone do botão de Mudar Tema da Estrutura
    const icon = document.getElementById("icon-theme");

    //Ícone do botão de Usuário da estrutura
    const icon_user = document.getElementById("img-user-profile");

    //Texto da breve descrição da Barbearia
    const text_description = document.getElementById("text-desc");
    if(text_description != null){
        text_description.classList.toggle("text-description-dark");     
    }
   
    //Link para redirecionar para página sobre
    const link_sobre = document.getElementById("link-sobre");
    if(link_sobre != null){
        link_sobre.classList.toggle("link-sobre-dark");    
    }
    
    //Estilo do nome da BArbearia no Footer
    const name_barber = document.getElementById("name-barber");
    if(name_barber != null){
        name_barber.classList.toggle("name-barber-dark");    
    }

    //Titulo da Página Sobre
    const title_h1 = document.getElementById("title-sobre");
    if(title_h1 != null){
        title_h1.classList.toggle("title-sobre-dark");
    }
    
    //Área da primeira imagem da View Sobre
    const div_img_old_barber = document.getElementById("div-figure");
    if(div_img_old_barber != null){
        div_img_old_barber.classList.toggle("div-figure-old-barber-dark");
    }
    
    //Área de texto da História da Barbearia Página Sobre
    const text_history = document.getElementById("text-history-barber");
    if(text_history != null){
        text_history.classList.toggle("text-history-barber-dark");
    }
    
    
    if(icon.getAttribute("src") == icon_dark){
        icon.setAttribute("src", icon_light);
        icon_user.setAttribute("src", icon_user_light);
         
    } else{
        icon.setAttribute("src", icon_dark);
        icon_user.setAttribute("src", icon_user_dark);           
    }
}



function slider(direction){
    let slide = "inp4";
    slide = document.querySelector("input[name='radio-buttons']:checked").value;

    let localeInpNext = parseInt(slide.substring(3)) + 1;
    if(direction == 1){
        if(localeInpNext <= 7){
            let nextSlide = document.getElementById("radio" + localeInpNext);
            nextSlide.checked = "checked";

        } else{
            let nextSlide = document.getElementById("radio" + 1);
            nextSlide.checked = "checked";
        }
    }

    let localeInpPrev = parseInt(slide.substring(3)) - 1;
    if(direction == -1){
    
        if(localeInpPrev < 1){
            localeInpPrev = 7;
            let prevSlide = document.getElementById("radio" + localeInpPrev);
            prevSlide.checked = "checked";
        }

        let prevSlide = document.getElementById("radio" + localeInpPrev);
        prevSlide.checked = "checked";
    }
}

function slider2(direction){
    let slide = "inp10";
    slide = document.querySelector("input[name='radio-buttons-2']:checked").value;

    let localeInpNext = parseInt(slide.substring(3)) + 1;
    if(direction == 1){
        if(localeInpNext <= 20){
            let nextSlide = document.getElementById("radio2-" + localeInpNext);
            nextSlide.checked = "checked";

        } else{
            let nextSlide = document.getElementById("radio2-" + 1);
            nextSlide.checked = "checked";
        }
    }

    let localeInpPrev = parseInt(slide.substring(3)) - 1;
    if(direction == -1){
    
        if(localeInpPrev < 1){
            localeInpPrev = 20;
            let prevSlide = document.getElementById("radio2-" + localeInpPrev);
            prevSlide.checked = "checked";
        }

        let prevSlide = document.getElementById("radio2-" + localeInpPrev);
        prevSlide.checked = "checked";
    }
}

setInterval(function(){
    nextImageAutomatic();
    nextImageAutomatic2();
}, 6000);

let count = 4;
function nextImageAutomatic(){
    count++;

    if(count > 7){
        count = 1;
    }

    document.getElementById("radio"+count).checked = true;
}

let count2 = 10;
function nextImageAutomatic2(){
    count2++;

    if(count2 > 20){
        count2 = 1;
    }

    document.getElementById("radio2-"+count2).checked = true;
}