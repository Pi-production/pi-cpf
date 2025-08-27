
<!-- Template frontend pour le type : Contenu Wordpress -->

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Contenu Wordpress" : "Wordpress content"; ?></div>
    <div class="text-img-center-input"><?=$GLOBALS['lang'] == "fr" ? "Centrer le texte" : "Center the text"; ?> : &nbsp;&nbsp;&nbsp;<input type="checkbox" name="pi-meta-center-contentWp[<?=$key?>]" value="center" data-js-pi-meta <?=($values['pi-meta-center-contentWp'][$key] == 'center') ? 'checked' : '';?>></div>
</div>