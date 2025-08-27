
<!-- Template pour le type : Articles -->

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Extraits d'articles" : "Article excerpts"; ?></div>
    <div class="pi-input-flex-wrapper">
        <div><?=$GLOBALS['lang'] == "fr" ? "Nombre d'extraits" : "Number of excerpts"; ?> <small>(min:1)</small>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="pi-meta-articles-nbr[<?=$key?>]" value="<?=(!$values['pi-meta-articles-nbr'][$key]) ? '3' : $values['pi-meta-articles-nbr'][$key]?>" type="number" min="1" data-js-pi-meta><br><br><br><br><br>
    </div>
    <div><?=$GLOBALS['lang'] == "fr" ? "Libellé des bouttons" : "Button labels"; ?></div>
    <input type="text" name="pi-meta-articles-cta-label[<?=$key?>]" value="<?=$values['pi-meta-articles-cta-label'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
    <div class="pi-input-flex-wrapper">
        <div><?=$GLOBALS['lang'] == "fr" ? "Boutton 'Voir plus d'articles'" : "'See more articles' button"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="pi-meta-articles-see-more[<?=$key?>]" <?=($values['pi-meta-articles-see-more'][$key]) ? 'checked' : ''?> type="checkbox" data-js-pi-meta><br><br><br><br><br>
    </div>
    <div><?=$GLOBALS['lang'] == "fr" ? "Libellé du bouton 'Voir plus d'articles'" : "Label of the 'See more articles' button"; ?></div>
    <input type="text" name="pi-meta-more-articles-cta-label[<?=$key?>]" value="<?=$values['pi-meta-more-articles-cta-label'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
    <div><?=$GLOBALS['lang'] == "fr" ? "Url du bouton 'Voir plus d'articles'" : "URL of the 'See more articles' button"; ?></div>
    <input type="text" name="pi-meta-more-articles-cta-link[<?=$key?>]" value="<?=$values['pi-meta-more-articles-cta-link'][$key]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br><br>
</div>