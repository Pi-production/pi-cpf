
<!-- Template pour le type : Titre Wordpress -->

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Titre Wordpress" : "Wordpress title"; ?></div>
    <div class="text-img-center-input"><?=$GLOBALS['lang'] == "fr" ? "Centrer le texte" : "Center the text"; ?> : &nbsp;&nbsp;&nbsp;<input type="checkbox" name="pi-meta-center-titleWp[<?=$key?>]" value="center" data-js-pi-meta <?=($values['pi-meta-center-titleWp'][$key] == 'center') ? 'checked' : '';?>></div>
</div>