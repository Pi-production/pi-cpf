// JSON import from central URL
import data from 'https://dev.pubinteractive.ca/pi-cpf/assets/json/gabarits.json' with { type: 'json' };

// Functions from central JS
import { galerieAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { galerieDel } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { textImageDel } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { mediaUpload } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { piMetaNameReset } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { accordeonAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { accordeonInit } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { colonneAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { colonneInit } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { carrouselSwitch } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { carrouselAdd } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';
import { carrouselDel } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta.js';



// Pi meta condition change

export function piMetaConditions() {

  console.log('init condition');

  // let changer = document.getElementsByClassName('pi-meta-mains-select');
  let box = document.querySelectorAll('[data-js-pi-meta-container]');
  let triangle = document.querySelectorAll('[data-js-pi-triangle]');
  
  for (let i = 0; i < box.length; i++) {
    let changer = box[i].getElementsByClassName('pi-meta-mains-select')[0];
    let CloneC = changer.cloneNode(true)
    changer.replaceWith(CloneC);
  }
  
  
  for (let i = 0; i < box.length; i++) {
    
    let ParentBloc = box[i].querySelector('[data-js-pi-meta-content]');
    let triangle = box[i].querySelector('[data-js-pi-triangle]');
    let contentBloc = box[i].querySelector('[data-js-pi-meta-content-container]');
    let newChanger = box[i].getElementsByClassName('pi-meta-mains-select')[0];

    newChanger.addEventListener('change', () => {

      let childs = newChanger.children;
      for (let i = 0; i < childs.length; i++) {
        childs[i].removeAttribute('selected');        
      }
      var value = newChanger.value;
      let newOption = box[i].getElementsByClassName('pi-option-'+value);
      console.log(value);
      console.log(newOption);
      newOption[0].setAttribute('selected', '');

      let gabarits = data['gabarits'];

      for (let ii = 0; ii < gabarits.length; ii++) {
        // console.log(gabarits[ii]);
        
        if (gabarits[ii]['name'] == newChanger.value) {
          contentBloc.innerHTML = gabarits[ii]['html'];

          // Update remaning box meta
          setTimeout(myFunction, 500);
          
          if (ParentBloc.classList.contains('pi-meta-container-closed')) {
              ParentBloc.classList.remove('pi-meta-container-closed');
              triangle.style.transform = 'rotate(180deg)';
          }
        }
      }
          
      galerieAdd();
      galerieDel();
      textImageDel();
      mediaUpload();
      accordeonAdd();
      accordeonInit();
      colonneAdd();
      colonneInit();
      carrouselSwitch();
      carrouselAdd();
      carrouselDel();
    })
  }
}

function myFunction() {
  piMetaNameReset();
}