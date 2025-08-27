
<!-- Template pour le type : Carrousel -->

<?php

$meta_imgs = get_post_meta(get_the_ID(), 'pi-meta-carrousel-image');
$meta_text_blocs = get_post_meta(get_the_ID(), 'pi-meta-carrousel-text');

$carrouselImgs = $meta_imgs[0];

if (is_array($carrouselImgs)) {
    $carrouselImgsD = end($carrouselImgs);
}else {
    $carrouselImgsD = $carrouselImgs;
}

$carrouselTextBlocs = $meta_text_blocs[0];

if (is_array($carrouselTextBlocs)) {
    $carrouselTextBlocsD = end($carrouselTextBlocs);
}else {
    $carrouselTextBlocsD = $carrouselTextBlocs;
}

?>

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Carrousel" : "Carousel"; ?></div>
    <div class="pi-input-flex-wrapper" data-js-carousel-radios>
        <div><?=$GLOBALS['lang'] == "fr" ? "Type de carrousel" : "Carousel type"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="carousel-type-img-radio" name="pi-meta-carrousel-type[<?=$key?>]" <?=(!$values['pi-meta-carrousel-type'][$key]) ? 'checked' : '' ?> <?=($values['pi-meta-carrousel-type'][$key] == 'img') ? 'checked' : '' ?> value="img" type="radio" data-js-pi-meta>
        <label for="img">Image</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="carousel-type-text-radio" name="pi-meta-carrousel-type[<?=$key?>]" <?=($values['pi-meta-carrousel-type'][$key] == 'text') ? 'checked' : '' ?> value="text" type="radio" data-js-pi-meta>
        <label for="text"><?=$GLOBALS['lang'] == "fr" ? "Texte" : "Text"; ?></label><br>
    </div>
    <div class="pi-input-flex-wrapper">
        <div><?=$GLOBALS['lang'] == "fr" ? "Nombre d'images présentées simultanément" : "Number of images displayed simultaneously"; ?> <small>(min:1 - max:4)</small>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="pi-meta-carrousel-nbr[<?=$key?>]" value="<?=(!$values['pi-meta-carrousel-nbr'][$key]) ? '3' : $values['pi-meta-carrousel-nbr'][$key]?>" type="number" min="1" max="4" data-js-pi-meta><br><br><br>
    </div>
    <div class="pi-meta-carrousel-container pi-meta-carrousel-img-container" data-js-carrousel-container-img>

        <?php foreach ($carrouselImgsD[$key] as $keyy => $value) { ?>

        <div class="pi-meta-carrousel-image-box" data-js-carrousel-img-bloc>
            <div class="close" data-js-carrousel-del>✕</div>
            <div class="moveUp" data-js-carrousel-move-up>↑</div>
            <div class="moveDown" data-js-carrousel-move-down>↓</div>
            <button type="button" class="button pi-carrousel-img-btn" data-js-upload-img-btn>
                <img class="pi-meta-carrousel-image" value="pi_image" src="<?=$value?>" alt="" data-js-pi-image>
            </button>
            <input style="width: 100%;" class="pi-img-carrousel-input-hidden" type="text" name="pi-meta-carrousel-image[<?=$key?>][<?=$keyy?>]" value="<?=$value?>" data-js-pi-meta />
        </div>

        <?php } ?>

        <div class="pi-meta-carrousel-image-box-add">
            <div style="font-size:30px; cursor: pointer; outline: 1px solid; padding: 5px 20px 10px;" data-js-carrousel-add-img-btn><strong>+</strong></div>
        </div>
    </div>

    <div class="pi-meta-carrousel-container pi-meta-carrousel-text-container" data-js-carrousel-container-text>

        <?php foreach ($carrouselTextBlocsD[$key] as $keyy => $value) { ?>

        <div class="pi-meta-carrousel-text-box" data-js-carrousel-text-bloc>
            <div class="close" data-js-carrousel-del>✕</div>
            <div class="moveUp" data-js-carrousel-move-up>↑</div>
            <div class="moveDown" data-js-carrousel-move-down>↓</div>
            <textarea class="pi-meta-carrousel-text" name="pi-meta-carrousel-text[<?=$key?>][<?=$keyy?>]" data-js-pi-meta><?=$value?></textarea>
        </div>

        <?php } ?>

        <div class="pi-meta-carrousel-image-box-add">
            <div style="font-size:30px; cursor: pointer; outline: 1px solid; padding: 5px 20px 10px;" data-js-carrousel-add-text-btn><strong>+</strong></div>
        </div>
    </div>
</div>