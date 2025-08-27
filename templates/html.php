
<!-- Template pour le type : HTML personnalisé -->

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "HTML personnalisé" : "Personalised HTML"; ?></div>
</div>

<div>
    <textarea style="width: 100%;" name="pi-meta-custom-html[<?=$key?>]" id="" cols="30" rows="10" placeholder="Custom HTML..." data-js-pi-meta><?=$values['pi-meta-custom-html'][$key]?></textarea>
</div>