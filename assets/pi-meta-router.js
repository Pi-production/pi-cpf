import { piMetaConditions } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta-json.js';
import { piMetaRepeatble } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { galerieAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { galerieDel } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { textImageDel } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { mediaUpload } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { accordeonAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { accordeonInit } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { colonneAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { colonneInit } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { carrouselSwitch } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { carrouselAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { carrouselDel } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { pageDropdownSelection } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';


window.addEventListener("load", function(){
    piMetaConditions();
});

window.addEventListener("load", function(){
    piMetaRepeatble();
});

window.addEventListener("load", function(){
    galerieAdd();
});

window.addEventListener("load", function(){
    galerieDel();
});

window.addEventListener("load", function(){
    textImageDel();
});

  window.addEventListener("load", function(){
    mediaUpload();
});

window.addEventListener("load", function(){
    accordeonAdd();
});

window.addEventListener("load", function(){
    accordeonInit();
});

window.addEventListener("load", function(){
    colonneAdd();
});

window.addEventListener("load", function(){
    colonneInit();
});

window.addEventListener("load", function(){
    carrouselSwitch();
});

window.addEventListener("load", function(){
    carrouselAdd();
});

window.addEventListener("load", function(){
    carrouselDel();
});

window.addEventListener("load", function(){
    pageDropdownSelection();
});
