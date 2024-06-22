
function themeColorHome(){
    const icon_dark = "public/img/lua.png";
    const icon_light = "public/img/sol.png";

    const icon_user_dark = "public/img/user-black.png";
    const icon_user_light = "public/img/user-white.png";

    const icon_menu_sandwich_dark = "public/img/menu-black.png";
    const icon_menu_sandwich_light = "public/img/menu-white.png";

    const icon_buttons_arrow_dark = "public/img/seta-direita.png";
    const icon_buttons_arrow_light = "public/img/seta-direita-white.png"; 

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

    //Ícone do botão de Mudar Tema do Menu Sandwich
    const icon2 = document.getElementById("icon-theme2");

    //Ícone do botão de Usuário da estrutura
    const icon_user = document.getElementById("img-user-profile");

    //Ícone do botão de Usuário do Submenu Sandwich
    const icon_user2 = document.getElementById("img-user-profile2");

    //Ícone do botão abrir o submenu sandwich
    const icon_menu_sandw = document.getElementById("icon-menu-sandwich");

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

    //Titulo da Página Sobre
    const title_h1 = document.getElementById("title-sobre");
    if(title_h1 != null){
        title_h1.classList.toggle("title-sobre-dark");
    }

    //Estilo Light Dark do Titulo da página Cortes
    const title_page_cortes = document.getElementById("title-cortes");
    if(title_page_cortes != null){
        title_page_cortes.classList.toggle("container-title-cortes-dark");    
    }

    //Estilo Light Dark do Subtitulo da Página Cortes
    const subtitle_page_cortes = document.getElementById("subtitle-cortes");
    if(subtitle_page_cortes != null){
        subtitle_page_cortes.classList.toggle("container-subtitle-dark");    
    }

    //Estilo Light Dark dos Textos da Page Cortes
    const text_page_cortes = document.getElementById("text-cortes");
    if(text_page_cortes != null){
        text_page_cortes.classList.toggle("text-dark");    
    }

    //Estilo das considerações finais da View Cortes
    const consideracoes_page_cortes = document.getElementById("consideracoes");
    if(consideracoes_page_cortes != null){
        consideracoes_page_cortes.classList.toggle("consideracoes-dark");    
    }

    const icon_btn_prev_imgs = document.getElementById("icon_btn_prev_imgs");
    const icon_btn_next_imgs = document.getElementById("icon_btn_next_imgs");
    const icon_btn_prev2_imgs = document.getElementById("icon_btn_prev_imgs2");
    const icon_btn_next2_imgs = document.getElementById("icon_btn_next_imgs2");


    //Estilo do nome da Barbearia no Footer
    const name_barber = document.getElementById("name-barber");
    if(name_barber != null){
        name_barber.classList.toggle("name-barber-dark");    
    }
    
    if(icon.getAttribute("src") == icon_dark || icon2.getAttribute("src") == icon_dark){
        if(icon != null) icon.setAttribute("src", icon_light);
        if(icon2 != null) icon2.setAttribute("src", icon_light);
        if(icon_user != null) icon_user.setAttribute("src", icon_user_light);
        if(icon_user2 != null) icon_user2.setAttribute("src", icon_user_light);
        if(icon_menu_sandw != null) icon_menu_sandw.setAttribute("src", icon_menu_sandwich_light);
        if(icon_btn_next_imgs != null) icon_btn_next_imgs.setAttribute("src", icon_buttons_arrow_light);
        if(icon_btn_prev_imgs != null) icon_btn_prev_imgs.setAttribute("src", icon_buttons_arrow_light);
        if(icon_btn_next2_imgs != null) icon_btn_next2_imgs.setAttribute("src", icon_buttons_arrow_light);
        if(icon_btn_prev2_imgs != null) icon_btn_prev2_imgs.setAttribute("src", icon_buttons_arrow_light);
           
    } else{
        if(icon != null) icon.setAttribute("src", icon_dark);
        if(icon2 != null) icon2.setAttribute("src", icon_dark);
        if(icon_user != null) icon_user.setAttribute("src", icon_user_dark);   
        if(icon_user2 != null) icon_user2.setAttribute("src", icon_user_dark);   
        if(icon_menu_sandw != null) icon_menu_sandw.setAttribute("src", icon_menu_sandwich_dark);
        if(icon_btn_next_imgs != null) icon_btn_next_imgs.setAttribute("src", icon_buttons_arrow_dark);
        if(icon_btn_prev_imgs != null) icon_btn_prev_imgs.setAttribute("src", icon_buttons_arrow_dark);  
        if(icon_btn_next2_imgs != null) icon_btn_next2_imgs.setAttribute("src", icon_buttons_arrow_dark);
        if(icon_btn_prev2_imgs != null) icon_btn_prev2_imgs.setAttribute("src", icon_buttons_arrow_dark);   
    }
}


function openMenu(){
    let menuDandwich = document.getElementById("menu-sandwich");
    menuDandwich.classList.toggle("sandwich-light");
}


//Função da View Cortes 
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

    let radioChecked = document.getElementById("radio"+count);
    if(radioChecked != null){
        radioChecked.checked = true;
    }
}

let count2 = 10;
function nextImageAutomatic2(){
    count2++;

    if(count2 > 20){
        count2 = 1;
    }

    let radioChecked = document.getElementById("radio"+count2);
    if(radioChecked != null){
        radioChecked.checked = true;
    }
}


function editUserData(){
    let input_nome = document.getElementById("inp-nome");
    let input_dt_nascimento = document.getElementById("dt-nascimento");
    let input_email1 = document.getElementById("inp-email1");
    let input_email2 = document.getElementById("inp-email2");
    let input_senha1 = document.getElementById("senha1");
    let input_senha2 = document.getElementById("senha2");
    let checkbox_info = document.getElementById("info");
    let btn_clean = document.getElementById("btn-clean");
    let btn_edit = document.getElementById("btn-edit");

    if(btn_edit.classList == "btn-edit"){
        btn_edit.setAttribute("class", "btn-salvar");
        btn_edit.innerHTML = "Salvar";

        input_nome.removeAttribute("disabled");
        input_dt_nascimento.removeAttribute("disabled");  
        input_email1.removeAttribute("disabled");
        input_email2.removeAttribute("disabled");
        input_senha1.removeAttribute("disabled");  
        input_senha2.removeAttribute("disabled");
        checkbox_info.removeAttribute("disabled");
        btn_clean.removeAttribute("disabled");   

    }
}

function openFileImgProfile(){
    let img_selected = document.getElementById("inp-img-profile");
    img_selected.click();

    let img_user = document.getElementById("img-user");

    img_selected.onchange = evt => {
        const [file] = img_selected.files;
        if(file){
            img_user.src = URL.createObjectURL(file);
        }
    }  
}

function openFileImgProfile2(){
    let img = document.getElementById('img-user');
    let input_img = document.getElementById('inp_img_profile');
    let btn_load = document.getElementById('load-img');

    input_img.click();

    input_img.onchange = evt => {
        const[file] = input_img.files;
        if(file){
            img.src = URL.createObjectURL(file);
        }
    }
}




//Funções da View Profile
function resetForm(){
    let inpNome = document.getElementById("inp-nome");
    inpNome.removeAttribute("value");

    let inpDtNascimento = document.getElementById("dt-nascimento");
    inpDtNascimento.removeAttribute("value");

    let inpEmail1 = document.getElementById("inp-email1");
    inpEmail1.removeAttribute("value");

    let inpEmail2 = document.getElementById("inp-email2");
    inpEmail2.removeAttribute("value");
}




//Funções do Formulário de Agendamentos da View Home
function verifyAg(){
    let dataSelected = document.getElementById("inp-data").value;
    let diaSemana = document.getElementById("dia-semana");

    let data = new Date(dataSelected);
    let dia_semana = data.getDay();

    switch(dia_semana){
        case 0:
            diaSemana.value = "Segunda-Feira";
            break;
        
        case 1:
            diaSemana.value = "Terça-Feira";
            break;  
            
        case 2:
            diaSemana.value = "Quarta-Feira";
            break; 

        case 3:
            diaSemana.value = "Quinta-Feira";
            break;

        case 4:
            diaSemana.value = "Sexta-Feira";
            break; 

        case 5:
            diaSemana.value = "Sábado";
            break; 

        case 6:
            diaSemana.value = "Domingo";
            break; 
        
        default:
            diaSemana.value = undefined;
    }
}

function enabledInputDiaSemana(){
    document.getElementById("dia-semana").removeAttribute("disabled"); 
    
    let inpData = document.getElementById('inp-data');
    let inpHorario = document.getElementById('select-horarios');

    var date = new Date(inpData.value);
    if(date.getDay() == 6){
        alert("Ops...  Estamos descansando aos Domingos.");
    }
}

function submitAgendamento(){
    let btn_agendar = document.getElementById('btn_agendar');
    let formAg = document.getElementById('form-disponibilidade');

    formAg.setAttribute("action", "?method=registerAg");
}



//Área da View Register User
function uploadIMGProfile(){
    $btn_photo = document.getElementById('btn-submit');
    $btn_photo.click();
}




