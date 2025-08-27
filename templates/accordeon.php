
<!-- Template pour le type : Accordéon -->

<?php

$meta_acc = get_post_meta(get_the_ID(), 'pi-meta-accordeon');

$blocAccordeon = $meta_acc[0];
end($blocAccordeon);
$blocAccordeon1 = prev($blocAccordeon);
$blocAccordeon2 = end($blocAccordeon);

$blocAccordeonTitles = $blocAccordeon1['title'];
$blocAccordeonTextes = $blocAccordeon2['text'];

?>

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Accordéon" : "Accordion"; ?></div>
    <div class="pi-meta-accordeon-container" data-js-accordeon-container>

        <?php foreach ($blocAccordeonTitles[$key] as $kkey => $value) { ?>

        <div class="pi-meta-accordeon-box" data-js-accordeon-bloc>

            <div class="pi-meta-accordeon-header">
                <div class="pi-meta-accordeon-title">
                    <input class="pi-meta-accordeon-input" name="pi-meta-accordeon-bloc-title[<?=$key?>][<?=$kkey?>]" type="text" value="<?=$value?>" data-js-pi-meta>
                </div>
                <div class="pi-control-panel" data-js-pi-meta-accordeon-controls>
                </div>
                <div class="pi-meta-container-buttons">
                    <label for="pi-meta-block-hide[<?=$key?>][<?=$kkey?>]">
                        <input class="pi-control-hide-section" id="pi-meta-block-hide[<?=$key?>][<?=$kkey?>]" type="checkbox" name="pi-meta-block-hide[<?=$key?>][<?=$kkey?>]"  value="1" <?php if($values['pi-meta-block-hide'][$key]){echo'checked';}?> data-js-pi-meta>
                        <img class="pi-control-hide-section-img" src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/eye.svg'?>" alt="">
                    </label>
                    <img name="pi-del[<?=$key?>][<?=$kkey?>]" class="pi-del-btn pi-icons" data-js-pi-accordeon-del-btn src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/trashbin.svg'?>" alt="">
                    <img name="pi-up[<?=$key?>][<?=$kkey?>]" class="pi-icons" data-js-pi-accordeon-up-btn src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/up-arrowhead.svg'?>" alt="">
                    <img name="pi-down[<?=$key?>][<?=$kkey?>]" class="pi-icons" data-js-pi-accordeon-down-btn src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/down-arrowhead.svg'?>" alt="">
                    <img class="pi-icons" style="transition: ease .3s; width: 10px;" src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/triangle.svg'?>" alt="" data-js-pi-triangle>
                </div>
                <div class="pi-supression-confirm" data-js-pi-accordeon-del-confirm-cont>
                    <div class="pi-cancel" data-js-pi-accordeon-del-cancel>
                        <img src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/x.svg'?>" alt="">
                    </div>
                    <div class="pi-confirm" data-js-pi-accordeon-del-confirm><?=$GLOBALS['lang'] == "fr" ? "Supprimer" : "Delete"; ?></div>
                </div>
            </div>

            <div class="pi-meta-accordeon-content pi-meta-container-closed">
                <textarea class="pi-meta-accordeon-input" name="pi-meta-accordeon-bloc-text[<?=$key?>][<?=$kkey?>]" id="" cols="30" rows="10" data-js-pi-meta><?=$blocAccordeonTextes[$key][$kkey]?></textarea>
            </div>

        </div>

        <?php } ?>

        <span>
            <div class="pi-add-btn"  data-js-accordeon-add-btn><?=$GLOBALS['lang'] == "fr" ? "Ajouter un bloc" : "Add block"; ?></div>
        </span>
    </div>
</div>