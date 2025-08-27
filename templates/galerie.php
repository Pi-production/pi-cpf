
<!-- Template pour le type : Galerie d'image -->

<?php

$meta_imgs = get_post_meta(get_the_ID(), 'pi-meta-galerie');

$galerieImgs = $meta_imgs[0];
$galerieImgsD = $galerieImgs[0];

?>

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Galerie d'image" : "Image galerie"; ?></div>
    <div class="pi-input-flex-wrapper">
        <div><?=$GLOBALS['lang'] == "fr" ? "Nombre d'images par rangée" : "Number of images per row"; ?> <small>(min:3 - max:5)</small>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="pi-meta-galerie-nbr[<?=$key?>]" value="<?=(!$values['pi-meta-galerie-nbr'][$key]) ? '3' : $values['pi-meta-galerie-nbr'][$key]?>" type="number" min="3" max="5" data-js-pi-meta><br><br><br><br><br>
    </div>
    <div class="pi-meta-galerie-container" data-js-galerie-img-container>

        <?php foreach ($galerieImgsD[$key] as $kkey => $value) { ?>

        <div class="pi-meta-galerie-image-box" data-js-galerie-img-bloc>
            <div class="close" data-js-galerie-del>✕</div>
            <div class="moveUp" data-js-galerie-move-up>↑</div>
            <div class="moveDown" data-js-galerie-move-down>↓</div>
            <button class="button pi-galerie-img-btn" data-js-upload-img-btn>
                <img class="pi-meta-galerie-image" value="pi_image" src="<?=$value?>" alt="" data-js-pi-image>
            </button>
            <input style="width: 100%;" class="pi-img-galerie-input-hidden" type="text" name="pi-meta-galerie-image[<?=$key?>][<?=$kkey?>]" value="<?=$value?>" data-js-pi-meta />
        </div>

        <?php } ?>

        <div class="pi-meta-galerie-image-box-add">
            <div style="font-size:30px; cursor: pointer; outline: 1px solid; padding: 5px 20px 10px;" data-js-galerie-add-btn><strong>+</strong></div>
        </div>
    </div>
</div>