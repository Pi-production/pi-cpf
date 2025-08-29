// JSON imports from central URL
import data from 'https://dev.pubinteractive.ca/pi-cpf/assets/json/components.json' with { type: 'json' };
import dataG from 'https://dev.pubinteractive.ca/pi-cpf/assets/json/gabarits.json' with { type: 'json' };

// JS imports from central URL
import { piMetaConditions } from 'https://dev.pubinteractive.ca/pi-cpf/assets/pi-meta-json.js';



export function piMetaRepeatble(){
  let parentBox = document.querySelector('[data-js-pi-parent-container]');
  let addBtn = document.querySelector('[data-js-pi-add-btn]');
  let delBtn = document.querySelectorAll('[data-js-pi-del-btn]');

  let controls = document.querySelectorAll('[data-js-pi-meta-controls]');
  let upBtn = document.querySelectorAll('[data-js-pi-up-btn]');
  let downBtn = document.querySelectorAll('[data-js-pi-down-btn]');
  
  for (let i = 0; i < delBtn.length; i++) {
    delBtn[i].addEventListener('click', () => {

      let parentCont = delBtn[i].parentElement.parentElement;
      let confCont = parentCont.querySelector('[data-js-pi-del-confirm-cont]');
      let delCancel = confCont.querySelector('[data-js-pi-del-cancel]');
      let delConfirm = confCont.querySelector('[data-js-pi-del-confirm]');
      
      let box = document.querySelectorAll('[data-js-pi-meta-container]');
      let indiceBtn = delBtn[i].getAttribute('name');
      // indiceBtn = indiceBtn.substr(-2,1);
      indiceBtn = indiceBtn.substring(
        indiceBtn.indexOf("[") + 1, 
        indiceBtn.lastIndexOf("]")
      );

      if (box.length > 1) {
        confCont.classList.add('pi-supression-confirm-show');
        
        delCancel.addEventListener('click', () => {
          confCont.classList.remove('pi-supression-confirm-show');
        })

        delConfirm.addEventListener('click', () => {
          parentCont.parentElement.remove();

          // Update remaning box meta
          piMetaNameReset();

        })

      }
    })
  }

  let contentBloc = document.querySelectorAll('[data-js-pi-meta-content]');
  let triangle = document.querySelectorAll('[data-js-pi-triangle]');
  for (let i = 0; i < controls.length; i++) {
    controls[i].addEventListener('click', () => {

      if (contentBloc[i].classList.contains('pi-meta-container-closed')) {
        contentBloc[i].classList.remove('pi-meta-container-closed');
        triangle[i].style.transform = 'rotate(180deg)';
      }else {
        contentBloc[i].classList.add('pi-meta-container-closed');
        triangle[i].style.transform = 'rotate(0deg)';
      }
    })
  }
  for (let i = 0; i < triangle.length; i++) {
    triangle[i].addEventListener('click', () => {

      if (contentBloc[i].classList.contains('pi-meta-container-closed')) {
        contentBloc[i].classList.remove('pi-meta-container-closed');
        triangle[i].style.transform = 'rotate(180deg)';
      }else {
        contentBloc[i].classList.add('pi-meta-container-closed');
        triangle[i].style.transform = 'rotate(0deg)';
      }
    })
  }

  // Initialized Up btn function

  for (let i = 0; i < upBtn.length; i++) {
    upBtn[i].addEventListener('click', () => {
      let box = document.querySelectorAll('[data-js-pi-meta-container]');

      upBtnFc(upBtn[i], box);
    })    
  }

  // Initialized Down btn function

  for (let i = 0; i < downBtn.length; i++) {
    downBtn[i].addEventListener('click', () => {
      let box = document.querySelectorAll('[data-js-pi-meta-container]');
      
      downBtnFc(downBtn[i], box);
    })    
  }

  // Add box function

  if(addBtn){
    addBtn.addEventListener('click', () => {
      let box = document.querySelectorAll('[data-js-pi-meta-container]');

      if (box.length > 0) {
        var newBox = box[0].cloneNode(true);
      }else{
        let components = data['Components'];
        let wrapper = document.createElement('div');
        wrapper.innerHTML = components[0]['html'];
        let newBoxComp = wrapper.firstChild;

        var newBox = newBoxComp;
      }

      let tracker = box.length;

      parentBox.insertAdjacentElement('beforeend', newBox);

      let newBoxMetas = newBox.querySelectorAll('[data-js-pi-meta]');

      for (let i = 0; i < newBoxMetas.length; i++) {
        newBoxMetas[i].value = '';
      }

      let content = newBox.querySelector('[data-js-pi-meta-content]');
      
      content.innerHTML = '';
      content.innerHTML = '<div class=\"pi-input-section-parameters\"><div class=\"pi-input-flex-wrapper\"><div>ID pour le défilement automatique (aucun caractères spéciaux)&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"pi-meta-section-id[0]\" value=\"\" data-js-pi-meta></div><div class=\"pi-input-flex-wrapper\"><div class=\"pi-input-flex-wrapper\"><div>Marge du haut&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"pi-meta-padding-top[0]\" value=\"40\" type=\"number\" min=\"0\" max=\"200\" data-js-pi-meta></div>&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"pi-input-flex-wrapper\"><div>Marge du bas&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"pi-meta-padding-bottom[0]\" value=\"40\" type=\"number\" min=\"0\" max=\"200\" data-js-pi-meta></div>&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"pi-input-flex-wrapper\"><div>Utilisation de la pleine largeur&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"pi-meta-full-width[0]\" type=\"checkbox\" data-js-pi-meta></div>&nbsp;&nbsp;&nbsp;&nbsp;<div class=\"pi-input-flex-wrapper\"><div>Classe CSS supplémentaire&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;<input name=\"pi-meta-extra-class[0]\" value=\'\' type=\"text\" data-js-pi-meta></div></div></div><div class=\"pi-meta-content\" data-js-pi-meta-content-container></div>';

      let controls = newBox.querySelector('[data-js-pi-meta-controls]');
      let triangle = newBox.querySelector('[data-js-pi-triangle]');

      let newChanger = newBox.getElementsByClassName('pi-meta-mains-select')[0];

      let childs = newChanger.children;
      for (let i = 0; i < childs.length; i++) {
        childs[i].removeAttribute('selected');        
      }

      controls.addEventListener('click', () => {
        let contentBloc = newBox.querySelector('[data-js-pi-meta-content]');

        if (contentBloc.classList.contains('pi-meta-container-closed')) {
          contentBloc.classList.remove('pi-meta-container-closed');
          triangle.style.transform = 'rotate(180deg)';
        }else {
          contentBloc.classList.add('pi-meta-container-closed');
          triangle.style.transform = 'rotate(0deg)';
        }
      })

      triangle.addEventListener('click', () => {
        let contentBloc = newBox.querySelector('[data-js-pi-meta-content]');

        if (contentBloc.classList.contains('pi-meta-container-closed')) {
          contentBloc.classList.remove('pi-meta-container-closed');
          triangle.style.transform = 'rotate(180deg)';
        }else {
          contentBloc.classList.add('pi-meta-container-closed');
          triangle.style.transform = 'rotate(0deg)';
        }
      })

      // Update new box meta
      piMetaNameReset();

      // Call condition function

      let upBtn = newBox.querySelectorAll('[data-js-pi-up-btn]');
      let downBtn = newBox.querySelectorAll('[data-js-pi-down-btn]');

      // New box Up btn function

      for (var ii=0; ii < upBtn.length; ii++) {
        let upBtnName = upBtn[ii].getAttribute("name");
        upBtnName = upBtnName.substring(0, upBtnName.indexOf('['));
        upBtn[ii].setAttribute("name", upBtnName+'['+tracker+']');
      }

      for (let i = 0; i < upBtn.length; i++) {
        upBtn[i].addEventListener('click', () => {
          let box = document.querySelectorAll('[data-js-pi-meta-container]');

          upBtnFc(upBtn[i], box);
        })    
      }

      // New box Down btn function

      for (var ii=0; ii < downBtn.length; ii++) {
        let downBtnName = downBtn[ii].getAttribute("name");
        downBtnName = downBtnName.substring(0, downBtnName.indexOf('['));
        downBtn[ii].setAttribute("name", downBtnName+'['+tracker+']');
      }

      for (let i = 0; i < downBtn.length; i++) {
        downBtn[i].addEventListener('click', () => {
          let box = document.querySelectorAll('[data-js-pi-meta-container]');

          downBtnFc(downBtn[i], box);
        })    
      }

      // Box deletion

      var elements = newBox.querySelectorAll('[data-js-pi-del-btn]');
      for (var ii=0; ii < elements.length; ii++) {
          let elementsName = elements[ii].getAttribute("name");
          elementsName = elementsName.substring(0, elementsName.indexOf('['));
          elements[ii].setAttribute("name", elementsName+'['+tracker+']');

          let delBtn = elements[ii];

          delBtn.addEventListener('click', () => {
          
            let confCont = document.querySelectorAll('[data-js-pi-del-confirm-cont]');
            let delCancel = document.querySelectorAll('[data-js-pi-del-cancel]');
            let delConfirm = document.querySelectorAll('[data-js-pi-del-confirm]');
            let box = document.querySelectorAll('[data-js-pi-meta-container]');
            let indiceBtn = delBtn.getAttribute('name');
            // indiceBtn = indiceBtn.substr(-2,1);
            indiceBtn = indiceBtn.substring(
              indiceBtn.indexOf("[") + 1, 
              indiceBtn.lastIndexOf("]")
            );
    
            confCont[indiceBtn].classList.add('pi-supression-confirm-show');
        
            delCancel[indiceBtn].addEventListener('click', () => {
              confCont[indiceBtn].classList.remove('pi-supression-confirm-show');
            })
    
            delConfirm[indiceBtn].addEventListener('click', () => {
              box[indiceBtn].remove();
            })
    
            // Update other remaining box meta
            piMetaNameReset();
            
          })
        }
    })
    mediaUpload();
  }
}


// Fonction Up
function upBtnFc(btnPressed, box) {
  let indiceBtn = btnPressed.getAttribute("name");
  // indiceBtn = indiceBtn.substr(-2,1);
  
  indiceBtn = indiceBtn.substring(
    indiceBtn.indexOf("[") + 1, 
    indiceBtn.lastIndexOf("]")
  );
    
  indiceBtn = Number(indiceBtn);

  let prevIndice = indiceBtn - 1;
  // Index du btn appuyer = indiceBtn / index du prochain bouton = prevIndice


  let currentBox = box[indiceBtn];
  let prevBox = box[prevIndice];

  if (prevBox) {
    insertBefore(prevBox, currentBox);
    piMetaNameReset();
  }
}

// Fonction Down
function downBtnFc(btnPressed, box) {
  let indiceBtn = btnPressed.getAttribute("name");
  // indiceBtn = indiceBtn.substr(-2,1);
  
  indiceBtn = indiceBtn.substring(
    indiceBtn.indexOf("[") + 1, 
    indiceBtn.lastIndexOf("]")
  );
    
  indiceBtn = Number(indiceBtn);

  let nextIndice = indiceBtn + 1;
  // Index du btn appuyer = indiceBtn / index du prochain bouton = nextIndice

  let currentBox = box[indiceBtn];
  let nextBox = box[nextIndice];

  if (nextBox) {
    insertAfter(nextBox, currentBox);
    piMetaNameReset();
  }
}

// Function Insert Before
function insertBefore(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode);
}

// Function Insert After
function insertAfter(referenceNode, newNode) {
  referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
}


// Media library
export function mediaUpload() {
  var mediaUploader;
  
  var uploadImgButton = document.querySelectorAll('[data-js-upload-img-btn]');

  for (let i = 0; i < uploadImgButton.length; i++) {

    let CloneUpload = uploadImgButton[i].cloneNode(true)
    uploadImgButton[i].replaceWith(CloneUpload);

    CloneUpload.addEventListener('click', function (e) {

      var imageUrlInput = CloneUpload.parentElement.querySelector('[data-js-pi-meta]');
      var piImage = CloneUpload.parentElement.querySelector('[data-js-pi-image]');

        e.preventDefault();

        // If the uploader object has already been created, just open it
        // if (mediaUploader) {
        //     mediaUploader.open();
        //     return;
        // }else {
          
          // Create a new instance of the media uploader
          mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose an Image',
            button: {
              text: 'Choose Image'
            },
            multiple: false  // Set to true to allow multiple files
          });
          
          // When a file is selected, update the input field with the URL
          mediaUploader.on('select', function () {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            var urlValue = attachment.url;
            const str = urlValue;
            const cutBefore = "/wp-content/";
            
            // Find the index of the group of characters
            const index = str.indexOf(cutBefore);
            
            // Get the part of the string **before** that group
            urlValue = index !== -1 ? str.substring(index) : str;
            
            imageUrlInput.value = urlValue;  // Set the URL in the input field
            if(piImage){ piImage.src = urlValue };  // Set the URL in the input field
            
          });
          
          // Open the media library
          mediaUploader.open();
        // }
    });
  }
}

export function galerieAdd() {
  let addBtn = document.querySelectorAll('[data-js-galerie-add-btn]');
  let components = data['Components'];

  for (let i = 0; i < addBtn.length; i++) {
    addBtn[i].addEventListener('click', () => {
      
      let container = document.querySelectorAll('[data-js-galerie-img-container]');
      let imgContainer = document.querySelectorAll('[data-js-galerie-img-bloc]');

      if (!imgContainer[0]) {
        
        let wrapper= document.createElement('div');
        wrapper.innerHTML= components[1]['html'];
        let newImgContainer = wrapper.firstChild;

        container[i].insertBefore(newImgContainer, addBtn[i].parentElement);
        piMetaNameReset();

      }else {
        let newImgContainer = imgContainer[0].cloneNode(true);
        container[i].insertBefore(newImgContainer, addBtn[i].parentElement);

        newImgContainer.querySelector('[data-js-pi-image]').src = '';
        let newInput = newImgContainer.getElementsByClassName('pi-img-galerie-input-hidden')[0];
        newInput.value = '';
        
        piMetaNameReset();
      }

      mediaUpload();
      galerieDel()
    })    
  }
}


export function textImageDel() {
  let delBtn = document.querySelectorAll('[data-js-text-img-del]');
  
  for (let i = 0; i < delBtn.length; i++) {
    delBtn[i].addEventListener('click', () => {
      delBtn[i].previousElementSibling.src = "";
      delBtn[i].previousElementSibling.previousElementSibling.value = "";
    })    
  }
}

export function galerieDel() {
  document.removeEventListener('click', galerieDelHandler); // prevent double bind
  document.addEventListener('click', galerieDelHandler);
}

function galerieDelHandler(e) {
  const target = e.target;
  const block = target.closest('[data-js-galerie-img-bloc]');
  const wrapper = target.closest('[data-js-galerie-img-container]');
  if (!wrapper) return;

  // DELETE
  if (target.closest('[data-js-galerie-del]')) {
    if (block) {
      block.remove();
      piMetaNameReset();
    }
    return;
  }

  // MOVE UP
  if (target.closest('[data-js-galerie-move-up]')) {
    if (!block) return;
    const prev = block.previousElementSibling;
    if (
      prev &&
      !prev.classList.contains('pi-meta-galerie-image-box-add') &&
      !prev.querySelector?.('[data-js-galerie-add-btn]')
    ) {
      wrapper.insertBefore(block, prev);
      piMetaNameReset();
    }
    return;
  }

  // MOVE DOWN
  if (target.closest('[data-js-galerie-move-down]')) {
    if (!block) return;
    const next = block.nextElementSibling;
    if (
      next &&
      !next.classList.contains('pi-meta-galerie-image-box-add') &&
      !next.querySelector?.('[data-js-galerie-add-btn]')
    ) {
      wrapper.insertBefore(next, block);
      piMetaNameReset();
    }
    return;
  }
}

// Carrousel
export function carrouselSwitch() {
  let carouselRadios = document.querySelectorAll('[data-js-carousel-radios]');
  
  for (let i = 0; i < carouselRadios.length; i++) {
    
    let imgsContainers = carouselRadios[i].parentElement.getElementsByClassName('pi-meta-carrousel-img-container');
    let textContainers = carouselRadios[i].parentElement.getElementsByClassName('pi-meta-carrousel-text-container');
    let currImgRadio = carouselRadios[i].getElementsByClassName('carousel-type-img-radio')[0];
    let currTextRadio = carouselRadios[i].getElementsByClassName('carousel-type-text-radio')[0];

    if (currImgRadio.checked) {
      imgsContainers[0].style.display = 'block';
      textContainers[0].style.display = 'none';
      console.log('textdisplayNone');
    }
    if (currTextRadio.checked) {
      imgsContainers[0].style.display = 'none';
      textContainers[0].style.display = 'block';
      console.log('imgdisplayNone');
    }

    currImgRadio.addEventListener('click', () => {
      imgsContainers[0].style.display = 'block';
      textContainers[0].style.display = 'none';
    })

    currTextRadio.addEventListener('click', () => {
      imgsContainers[0].style.display = 'none';
      textContainers[0].style.display = 'block';
    })
  }
}

export function carrouselAdd() {
  let components = data['Components'];

  // Handle all add-img buttons
  document.querySelectorAll('[data-js-carrousel-add-img-btn]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const carouselWrapper = btn.parentElement.parentElement.parentElement;
      if (!carouselWrapper) return;

      const container = carouselWrapper.querySelector('[data-js-carrousel-container-img]');
      const firstBlock = container.querySelector('[data-js-carrousel-img-bloc]');
      if (btn.parentElement.parentElement.parentElement.classList.contains('pi-meta-image-container')) {
        var componentIndex = 5; // carousel image        
      }else {
        var componentIndex = 4; // carousel image
      }

      let newBlock;
      if (!firstBlock) {
        const temp = document.createElement('div');
        temp.innerHTML = components[componentIndex]['html'];
        newBlock = temp.firstChild;
      } else {
        newBlock = firstBlock.cloneNode(true);

        // Reset all inputs inside the cloned block
        newBlock.querySelectorAll('input').forEach(input => input.value = '');
        // Reset all images inside the cloned block
        newBlock.querySelectorAll('[data-js-pi-image]').forEach(img => img.src = '');
      }

      container.insertBefore(newBlock, btn.parentElement);
      piMetaNameReset();
      mediaUpload();
      carrouselDel();
    });
  });

  // Handle all add-text buttons
  document.querySelectorAll('[data-js-carrousel-add-text-btn]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const carouselWrapper = btn.parentElement.parentElement.parentElement;
      if (!carouselWrapper) return;

      const container = carouselWrapper.querySelector('[data-js-carrousel-container-text]');
      const firstBlock = container.querySelector('[data-js-carrousel-text-bloc]');
      const componentIndex = 6; // carousel text

      let newBlock;
      if (!firstBlock) {
        const temp = document.createElement('div');
        temp.innerHTML = components[componentIndex]['html'];
        newBlock = temp.firstChild;
      } else {
        newBlock = firstBlock.cloneNode(true);

        // Reset all inputs inside the cloned block
        newBlock.querySelectorAll('textarea').forEach(textarea => textarea.value = '');
        // Reset all images inside the cloned block
        newBlock.querySelectorAll('[data-js-pi-image]').forEach(img => img.src = '');
      }

      container.insertBefore(newBlock, btn.parentElement);
      piMetaNameReset();
      mediaUpload();
      carrouselDel();
    });
  });
}

export function carrouselDel() {
  // Remove any old listener before binding (prevents duplicates if re-initialized)
  document.removeEventListener('click', carrouselDelHandler);
  document.addEventListener('click', carrouselDelHandler);
}

function carrouselDelHandler(e) {
  const target = e.target;

  // Find the wrapper (either image or text container)
  const wrapper = target.closest('[data-js-carrousel-container-img], [data-js-carrousel-container-text]');
  if (!wrapper) return;

  // Find the block (either image or text block)
  const block = target.closest('[data-js-carrousel-img-bloc], [data-js-carrousel-text-bloc]');

  // DELETE
  if (target.closest('[data-js-carrousel-del]')) {
    if (block) {
      block.remove();
      piMetaNameReset();
    }
    return;
  }

  // MOVE UP
  if (target.closest('[data-js-carrousel-move-up]')) {
    if (!block) return;
    const prev = block.previousElementSibling;
    if (
      prev &&
      !prev.classList.contains('pi-meta-carrousel-image-box-add') &&
      !prev.querySelector?.('[data-js-carrousel-add-img-btn]')
    ) {
      wrapper.insertBefore(block, prev);
      piMetaNameReset();
    }
    return;
  }

  // MOVE DOWN
  if (target.closest('[data-js-carrousel-move-down]')) {
    if (!block) return;
    const next = block.nextElementSibling;
    if (
      next &&
      !next.classList.contains('pi-meta-carrousel-image-box-add') &&
      !next.querySelector?.('[data-js-carrousel-add-img-btn]')
    ) {
      wrapper.insertBefore(next, block);
      piMetaNameReset();
    }
    return;
  }
}

// Accordeon
export function accordeonAdd() {
  let addBtn = document.querySelectorAll('[data-js-accordeon-add-btn]');
  let components = data['Components'];

  for (let i = 0; i < addBtn.length; i++) {
    addBtn[i].addEventListener('click', () => {
      
      let container = document.querySelectorAll('[data-js-accordeon-container]');
      let accContainer = document.querySelectorAll('[data-js-accordeon-bloc]');

      if (accContainer.length<1) {
        
        let wrapper= document.createElement('div');
        wrapper.innerHTML= components[2]['html'];
        var newAccContainer = wrapper.firstChild;

        container[i].insertBefore(newAccContainer, addBtn[i].parentElement);
      }else {
        var newAccContainer = accContainer[0].cloneNode(true);
        container[i].insertBefore(newAccContainer, addBtn[i].parentElement);

        let newMeta = newAccContainer.querySelectorAll('[data-js-pi-meta]');
        for (let m = 0; m < newMeta.length; m++) {
          newMeta[m].value = '';
          newMeta[m].content = '';
        }
        
      }
      
      // Panel initialize
      let panel = newAccContainer.querySelector('[data-js-pi-meta-accordeon-controls]'); 
      let contentBox = panel.parentElement.nextElementSibling;
      let triangle = newAccContainer.querySelector('[data-js-pi-triangle]'); 
      
      panel.addEventListener('click', () => {

        if (contentBox.classList.contains('pi-meta-container-closed')) {
          contentBox.classList.remove('pi-meta-container-closed');
          triangle.style.transform = 'rotate(180deg)';
        }else {
          contentBox.classList.add('pi-meta-container-closed');
          triangle.style.transform = 'rotate(0deg)';
        }
      })

      // Del btn initialize
      let delBtn = newAccContainer.querySelector('[data-js-pi-accordeon-del-btn]');
      let confCont = newAccContainer.querySelector('[data-js-pi-accordeon-del-confirm-cont]');
      let delCancel = newAccContainer.querySelector('[data-js-pi-accordeon-del-cancel]');
      let delConfirm = newAccContainer.querySelector('[data-js-pi-accordeon-del-confirm]');

      delBtn.addEventListener('click', () => {
          
        confCont.classList.add('pi-supression-confirm-show');
        
        delCancel.addEventListener('click', () => {
          confCont.classList.remove('pi-supression-confirm-show');
        })

        delConfirm.addEventListener('click', () => {
          newAccContainer.remove();

          piMetaNameReset();
        })
      })

      // up n down
      let btnPressedUp = newAccContainer.querySelector('[data-js-pi-accordeon-up-btn]');
      let btnPressedDown = newAccContainer.querySelector('[data-js-pi-accordeon-down-btn]');

      btnPressedUp.addEventListener('click', () => {
        upBtnAccFc(newAccContainer);
      })

      btnPressedDown.addEventListener('click', () => {
        downBtnAccFc(newAccContainer);
      })
      
      piMetaNameReset();
    })    
  }
}

export function accordeonInit() {

  let accCont = document.querySelectorAll('[data-js-accordeon-bloc]');
  
  for (let i = 0; i < accCont.length; i++) {

    // Panel initialize
    let panel = accCont[i].querySelector('[data-js-pi-meta-accordeon-controls]'); 
    let contentBox = panel.parentElement.nextElementSibling;
    let triangle = accCont[i].querySelector('[data-js-pi-triangle]'); 
    
    panel.addEventListener('click', () => {

      if (contentBox.classList.contains('pi-meta-container-closed')) {
        contentBox.classList.remove('pi-meta-container-closed');
        triangle.style.transform = 'rotate(180deg)';
      }else {
        contentBox.classList.add('pi-meta-container-closed');
        triangle.style.transform = 'rotate(0deg)';
      }
    })
    
    // Del btn initialize
    let delBtn = accCont[i].querySelector('[data-js-pi-accordeon-del-btn]');
    let confCont = accCont[i].querySelector('[data-js-pi-accordeon-del-confirm-cont]');
    let delCancel = accCont[i].querySelector('[data-js-pi-accordeon-del-cancel]');
    let delConfirm = accCont[i].querySelector('[data-js-pi-accordeon-del-confirm]');

    delBtn.addEventListener('click', () => {
        
      confCont.classList.add('pi-supression-confirm-show');
      
      delCancel.addEventListener('click', () => {
        confCont.classList.remove('pi-supression-confirm-show');
      })

      delConfirm.addEventListener('click', () => {
        accCont[i].remove();

        piMetaNameReset();
      })
    })

    // up n down
    let btnPressedUp = accCont[i].querySelector('[data-js-pi-accordeon-up-btn]');
    let btnPressedDown = accCont[i].querySelector('[data-js-pi-accordeon-down-btn]');

    btnPressedUp.addEventListener('click', () => {
      upBtnAccFc(accCont[i]);
    })

    btnPressedDown.addEventListener('click', () => {
      downBtnAccFc(accCont[i]);
    })
  }
}

// Colonne
export function colonneAdd() {
  let addBtn = document.querySelectorAll('[data-js-colonne-add-btn]');
  let components = data['Components'];

  for (let i = 0; i < addBtn.length; i++) {
    addBtn[i].addEventListener('click', () => {
      
      let container = document.querySelectorAll('[data-js-colonne-container]');
      let colContainer = document.querySelectorAll('[data-js-colonne-bloc]');

      if (colContainer.length<1) {
        
        let wrapper= document.createElement('div');
        wrapper.innerHTML= components[3]['html'];
        var newColContainer = wrapper.firstChild;

        container[i].insertBefore(newColContainer, addBtn[i].parentElement);
      }else {
        var newColContainer = colContainer[0].cloneNode(true);
        container[i].insertBefore(newColContainer, addBtn[i].parentElement);

        let newMeta = newColContainer.querySelectorAll('[data-js-pi-meta]');
        for (let m = 0; m < newMeta.length; m++) {
          newMeta[m].value = '';
          newMeta[m].content = '';
        }
        
      }

      pageDropdownSelection();
      
      // Panel initialize
      let panel = newColContainer.querySelector('[data-js-pi-meta-colonne-controls]'); 
      let contentBox = panel.parentElement.nextElementSibling;
      let triangle = newColContainer.querySelector('[data-js-pi-triangle]'); 
      
      panel.addEventListener('click', () => {

        if (contentBox.classList.contains('pi-meta-container-closed')) {
          contentBox.classList.remove('pi-meta-container-closed');
          triangle.style.transform = 'rotate(180deg)';
        }else {
          contentBox.classList.add('pi-meta-container-closed');
          triangle.style.transform = 'rotate(0deg)';
        }
      })

      // Del btn initialize
      let delBtn = newColContainer.querySelector('[data-js-pi-colonne-del-btn]');
      let confCont = newColContainer.querySelector('[data-js-pi-colonne-del-confirm-cont]');
      let delCancel = newColContainer.querySelector('[data-js-pi-colonne-del-cancel]');
      let delConfirm = newColContainer.querySelector('[data-js-pi-colonne-del-confirm]');

      delBtn.addEventListener('click', () => {
          
        confCont.classList.add('pi-supression-confirm-show');
        
        delCancel.addEventListener('click', () => {
          confCont.classList.remove('pi-supression-confirm-show');
        })

        delConfirm.addEventListener('click', () => {
          newColContainer.remove();

          piMetaNameReset();
        })
      })

      // up n down
      let btnPressedUp = newColContainer.querySelector('[data-js-pi-colonne-up-btn]');
      let btnPressedDown = newColContainer.querySelector('[data-js-pi-colonne-down-btn]');

      btnPressedUp.addEventListener('click', () => {
        upBtnAccFc(newColContainer);
      })

      btnPressedDown.addEventListener('click', () => {
        downBtnAccFc(newColContainer);
      })
      
      piMetaNameReset();
      pageDropdownSelection();
    })
  }
}

export function colonneInit() {

  let colCont = document.querySelectorAll('[data-js-colonne-bloc]');
  
  for (let i = 0; i < colCont.length; i++) {

    // Panel initialize
    let panel = colCont[i].querySelector('[data-js-pi-meta-colonne-controls]'); 
    let contentBox = panel.parentElement.nextElementSibling;
    let triangle = colCont[i].querySelector('[data-js-pi-triangle]'); 
    
    panel.addEventListener('click', () => {

      if (contentBox.classList.contains('pi-meta-container-closed')) {
        contentBox.classList.remove('pi-meta-container-closed');
        triangle.style.transform = 'rotate(180deg)';
      }else {
        contentBox.classList.add('pi-meta-container-closed');
        triangle.style.transform = 'rotate(0deg)';
      }
    })
    
    // Del btn initialize
    let delBtn = colCont[i].querySelector('[data-js-pi-colonne-del-btn]');
    let confCont = colCont[i].querySelector('[data-js-pi-colonne-del-confirm-cont]');
    let delCancel = colCont[i].querySelector('[data-js-pi-colonne-del-cancel]');
    let delConfirm = colCont[i].querySelector('[data-js-pi-colonne-del-confirm]');

    delBtn.addEventListener('click', () => {
        
      confCont.classList.add('pi-supression-confirm-show');
      
      delCancel.addEventListener('click', () => {
        confCont.classList.remove('pi-supression-confirm-show');
      })

      delConfirm.addEventListener('click', () => {
        colCont[i].remove();

        piMetaNameReset();
      })
    })

    // up n down
    let btnPressedUp = colCont[i].querySelector('[data-js-pi-colonne-up-btn]');
    let btnPressedDown = colCont[i].querySelector('[data-js-pi-colonne-down-btn]');

    btnPressedUp.addEventListener('click', () => {
      upBtnAccFc(colCont[i]);
    })

    btnPressedDown.addEventListener('click', () => {
      downBtnAccFc(colCont[i]);
    })
  }
}

function upBtnAccFc(box) {
  let currentBox = box;
  let prevBox = box.previousElementSibling;

  if (prevBox) {
    insertBefore(prevBox, currentBox);
    piMetaNameReset();
  }
}

function downBtnAccFc(box) {
  let currentBox = box;
  let nextBox = box.nextElementSibling;

  if (nextBox) {
    insertAfter(nextBox, currentBox);
    piMetaNameReset();
  }
}

// Pi meta condition change

export function piMetaNameReset() {

  let box = document.querySelectorAll('[data-js-pi-meta-container]');

  for (let i = 0; i < box.length; i++) {

    // Reset box
    let indiceBox = box[i].getAttribute('name');
    indiceBox = indiceBox.substring(0, indiceBox.indexOf('['));
    box[i].setAttribute("name", indiceBox+'['+i+']');


    // Reset pi meta
    var elements = box[i].querySelectorAll('[data-js-pi-meta]');
    console.log(elements);
    for (var ii=0; ii < elements.length; ii++) {
        let elementsName = elements[ii].getAttribute("name");
        elementsName = elementsName.substring(0, elementsName.indexOf('['));
        elements[ii].setAttribute("name", elementsName+'['+i+']');
    }

    // Reset galerie meta
    var elements = box[i].getElementsByClassName('pi-img-galerie-input-hidden');
    for (var ii=0; ii < elements.length; ii++) {
        let elementsName = elements[ii].getAttribute("name");
        elements[ii].setAttribute("name", elementsName+'['+ii+']');
    }

    // Reset carrousel img meta
    var elements = box[i].getElementsByClassName('pi-img-carrousel-input-hidden');
    for (var ii=0; ii < elements.length; ii++) {
        let elementsName = elements[ii].getAttribute("name");
        elements[ii].setAttribute("name", elementsName+'['+ii+']');
    }

    // Reset carrousel text meta
    var elements = box[i].getElementsByClassName('pi-meta-carrousel-text');
    for (var ii=0; ii < elements.length; ii++) {

      console.log('ouioui');
        let elementsName = elements[ii].getAttribute("name");
        elements[ii].setAttribute("name", elementsName+'['+ii+']');
    }

    // Reset accordeon meta
    var elementsT = box[i].getElementsByClassName('pi-meta-accordeon-box');
    for (var ii=0; ii < elementsT.length; ii++) {
      var elements = elementsT[ii].getElementsByClassName('pi-meta-accordeon-input');
      for (let e = 0; e < elements.length; e++) {
        let elementsName = elements[e].getAttribute("name");
        elements[e].setAttribute("name", elementsName+'['+ii+']');
      }
    }

    // Reset colonne meta
    var elementsT = box[i].getElementsByClassName('pi-meta-colonne-box');
    for (var ii=0; ii < elementsT.length; ii++) {
      var elements = elementsT[ii].getElementsByClassName('pi-meta-colonne-input');
      for (let e = 0; e < elements.length; e++) {
        let elementsName = elements[e].getAttribute("name");
        elements[e].setAttribute("name", elementsName+'['+ii+']');
      }
    }

    // Reset del btn
    var elements = box[i].querySelectorAll('[data-js-pi-del-btn]');
    for (var ii=0; ii < elements.length; ii++) {
        let elementsName = elements[ii].getAttribute("name");
        elementsName = elementsName.substring(0, elementsName.indexOf('['));
        elements[ii].setAttribute("name", elementsName+'['+i+']');
    }

    // Reset Up btn
    var elements = box[i].querySelectorAll('[data-js-pi-up-btn]');
    for (var ii=0; ii < elements.length; ii++) {
        let elementsName = elements[ii].getAttribute("name");
        elementsName = elementsName.substring(0, elementsName.indexOf('['));
        elements[ii].setAttribute("name", elementsName+'['+i+']');
    }

    // Reset Down btn
    var elements = box[i].querySelectorAll('[data-js-pi-down-btn]');
    for (var ii=0; ii < elements.length; ii++) {
        let elementsName = elements[ii].getAttribute("name");
        elementsName = elementsName.substring(0, elementsName.indexOf('['));
        elements[ii].setAttribute("name", elementsName+'['+i+']');
    }
    piMetaConditions();
  }
}


export function pageDropdownSelection() {
  document.querySelectorAll('.pi-page-dropdown').forEach(dropdown => {
      dropdown.addEventListener('change', function() {
          const inputName = this.getAttribute('data-input-target');
          const inputField = document.querySelector(`input[name="${inputName}"]`);
          if (inputField && this.value) {
              inputField.value = this.value;
          }
      });
  });
}
