<?php

$meta_multiple_ti = get_post_meta(get_the_ID(), 'pi-meta-multiple-ti');

$textImages = $meta_multiple_ti[0];

if (is_array($textImages)) {
    $textImagesD = end($textImages);
}else {
    $textImagesD = $textImages;
}

?>

<!-- Template pour le type : Texte avec image -->

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Texte avec image" : "Text and image"; ?></div>
    <div><?=$GLOBALS['lang'] == "fr" ? "Titre" : "Title"; ?></div>
    <input type="text" name="pi-meta-block-title[<?=$key?>]" value="<?=$values['pi-meta-block-title'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
    <div><?=$GLOBALS['lang'] == "fr" ? "Sous-titre" : "Subtitle"; ?></div>
    <input type="text" name="pi-meta-block-subtitle[<?=$key?>]" value="<?=$values['pi-meta-block-subtitle'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
    <div><?=$GLOBALS['lang'] == "fr" ? "Contenue du texte" : "Text content"; ?></div>
    <textarea name="pi-meta-block-content[<?=$key?>]" style="width:100%; height:150px; font-weight:lighter" data-js-pi-meta><?=$values['pi-meta-block-content'][$key]?></textarea><br><br>
    <div><?=$GLOBALS['lang'] == "fr" ? "Libellé du boutton" : "Button label"; ?></div>
    <input type="text" name="pi-meta-block-cta-title[<?=$key?>]" value="<?=$values['pi-meta-block-cta-title'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
    <div><?=$GLOBALS['lang'] == "fr" ? "Url de redirection" : "Redirection url"; ?></div>
    <input type="text" name="pi-meta-block-cta-link[<?=$key?>]" value="<?=$values['pi-meta-block-cta-link'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
    <div class="text-img-center-input"><?=$GLOBALS['lang'] == "fr" ? "Centrer le texte" : "Center the text"; ?> : &nbsp;&nbsp;&nbsp;<input type="checkbox" name="pi-meta-center-text-img[<?=$key?>]" value="center" data-js-pi-meta <?=($values['pi-meta-center-text-img'][$key] == 'center') ? 'checked' : '';?>></div>
    <div class="pi-meta-image-container">


    <div class="pi-meta-carrousel-container pi-meta-carrousel-img-container" data-js-carrousel-container-img>

        <?php foreach ($textImagesD[$key] as $keyy => $value) { ?>

        <div class="pi-meta-carrousel-image-box" data-js-carrousel-img-bloc>
            <div class="close" data-js-carrousel-del>✕</div>
            <div class="moveUp" data-js-carrousel-move-up>↑</div>
            <div class="moveDown" data-js-carrousel-move-down>↓</div>
            <button type="button" class="button pi-carrousel-img-btn" data-js-upload-img-btn>
                <img class="pi-meta-carrousel-image" value="pi_image" src="<?=$value?>" alt="" data-js-pi-image>
            </button>
            <input style="width: 100%;" class="pi-img-carrousel-input-hidden" type="text" name="pi-meta-multiple-ti[<?=$key?>][<?=$keyy?>]" value="<?=$value?>" data-js-pi-meta />
        </div>

        <?php } ?>

        <div class="pi-meta-carrousel-image-box-add">
            <div style="font-size:30px; cursor: pointer; padding: 5px 20px 10px;" data-js-carrousel-add-img-btn><strong>+</strong></div>
        </div>
    </div>

        <div class="pi-meta-rtl-text-img">
            <div class="pi-meta-img-param"><?=$GLOBALS['lang'] == "fr" ? "Rayon de bordure" : "Border-radius"; ?>&nbsp;&nbsp;&nbsp;<input style="width: 70px;" type="number" max="100" name="pi-meta-border-text-img[<?=$key?>]" value="<?=$values['pi-meta-border-text-img'][$key]?>" data-js-pi-meta></div>
            <div class="pi-meta-img-param"><?=$GLOBALS['lang'] == "fr" ? "Largeur maximale de l'image" : "Image max-width"; ?>&nbsp;&nbsp;&nbsp;<input style="width: 70px;" type="number" name="pi-meta-maxWidth-text-img[<?=$key?>]" value="<?=$values['pi-meta-maxWidth-text-img'][$key]?>" data-js-pi-meta></div>
            <div class="pi-meta-img-param"><?=$GLOBALS['lang'] == "fr" ? "Image à droite" : "Image on the right"; ?>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pi-meta-direction-text-img[<?=$key?>]" value="rtl" data-js-pi-meta <?=($values['pi-meta-direction-text-img'][$key] == 'rtl') ? 'checked' : '';?>></div>
            <div class="pi-meta-img-param"><?=$GLOBALS['lang'] == "fr" ? "Utiliser l'image en vedette" : "Use the featured image"; ?>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="pi-meta-block-image-thumbnail[<?=$key?>]" value="rtl" data-js-pi-meta <?=($values['pi-meta-block-image-thumbnail'][$key] == 'rtl') ? 'checked' : '';?>></div>
            <div class="pi-meta-img-param"><?=$GLOBALS['lang'] == "fr" ? "Alignement vertical" : "Vertical alignement"; ?>&nbsp;&nbsp;&nbsp;
                <div>
                    <input type="radio" id="top" name="pi-meta-block-image-valign[<?=$key?>]" value="top" <?=($values['pi-meta-block-image-valign'][$key] == 'top') ? 'checked' : '';?> data-js-pi-meta></input>
                    <label for="top"><?=$GLOBALS['lang'] == "fr" ? "Haut" : "Top"; ?></label><br>
                    <input type="radio" id="middle" name="pi-meta-block-image-valign[<?=$key?>]" value="middle" <?=($values['pi-meta-block-image-valign'][$key] == 'middle') ? 'checked' : '';?> data-js-pi-meta></input>
                    <label for="middle"><?=$GLOBALS['lang'] == "fr" ? "Millieu" : "Middle"; ?></label><br>
                    <input type="radio" id="bottom" name="pi-meta-block-image-valign[<?=$key?>]" value="bottom" <?=($values['pi-meta-block-image-valign'][$key] == 'bottom') ? 'checked' : '';?> data-js-pi-meta></input>
                    <label for="bottom"><?=$GLOBALS['lang'] == "fr" ? "Bas" : "Bottom"; ?></label>
                </div>
            </div>
        </div>
    </div>
</div>