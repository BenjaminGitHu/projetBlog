
console.log('tt');

//------ animation nav bar
const navigation = document.querySelector('nav');
let position = 0;
window.addEventListener('scroll', () => {
    if(window.scrollY > position){
        navigation.classList.add('anim-nav');
    }
    else{
        navigation.classList.remove('anim-nav');
    }
    position = window.scrollY;
})

// const pagination = document.getElementsByClassName('pagination-lien');

const titreCard = document.getElementsByClassName('card-title');
console.log(titreCard);

function tt(){
    if( screen.width > 992){
        titreCard.textContent("<?php if (strlen($article['titre']) > 35){ echo strip_tags(substr($article['titre'], 0, 35)).'...'; }else{ echo strip_tags($article['titre']); }?>");
    }
};