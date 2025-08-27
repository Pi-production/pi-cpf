
<!-- Template pour le type : Colonne -->

<?php

$meta_acc = get_post_meta(get_the_ID(), 'pi-meta-colonne');

$blocColonne = $meta_acc[0];

?>

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Contenue en colonne" : "Column layout"; ?></div>
    <div class="pi-input-flex-wrapper">
        <div><?=$GLOBALS['lang'] == "fr" ? "Nombre de colonne par rangée" : "Number of columns per row"; ?> <small>(min:2 - max:4)</small>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
        <input name="pi-meta-colonne-nbr[<?=$key?>]" value="<?=(!$values['pi-meta-colonne-nbr'][$key]) ? '2' : $values['pi-meta-colonne-nbr'][$key]?>" type="number" min="2" max="4" data-js-pi-meta><br><br><br><br><br>
    </div>
    <div class="pi-meta-colonne-container" data-js-colonne-container>

            <?php foreach ($blocColonne[$key]['title'] as $kkey => $value) { ?>
            <div class="pi-meta-colonne-box" data-js-colonne-bloc>
                <div class="pi-meta-colonne-header">
                    <div class="pi-meta-colonne-title">
                        <input class="pi-meta-colonne-input" name="pi-meta-colonne-bloc-label[<?=$key?>][<?=$kkey?>]" type="text" value="<?=$blocColonne[$key]['label'][$kkey]?>" data-js-pi-meta>
                    </div>
                    <div class="pi-control-panel" data-js-pi-meta-colonne-controls>
                    </div>
                    <div class="pi-meta-container-buttons">
                        <label for="pi-meta-block-hide[<?=$key?>][<?=$kkey?>]">
                            <input class="pi-control-hide-section" id="pi-meta-block-hide[<?=$key?>][<?=$kkey?>]" type="checkbox" name="pi-meta-block-hide[<?=$key?>][<?=$kkey?>]"  value="1" <?php if($values['pi-meta-block-hide'][$key]){echo'checked';}?> data-js-pi-meta>
                            <img class="pi-control-hide-section-img" src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/eye.svg'?>" alt="">
                        </label>
                        <img name="pi-del[<?=$key?>][<?=$kkey?>]" class="pi-del-btn pi-icons" data-js-pi-colonne-del-btn src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/trashbin.svg'?>" alt="">
                        <img name="pi-up[<?=$key?>][<?=$kkey?>]" class="pi-icons" data-js-pi-colonne-up-btn src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/up-arrowhead.svg'?>" alt="">
                        <img name="pi-down[<?=$key?>][<?=$kkey?>]" class="pi-icons" data-js-pi-colonne-down-btn src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/down-arrowhead.svg'?>" alt="">
                        <img class="pi-icons" style="transition: ease .3s; width: 10px;" src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/triangle.svg'?>" alt="" data-js-pi-triangle>
                    </div>
                    <div class="pi-supression-confirm" data-js-pi-colonne-del-confirm-cont>
                        <div class="pi-cancel" data-js-pi-colonne-del-cancel>
                            <img src="<?=get_template_directory_uri() . '/pi-cpf/assets/img/x.svg'?>" alt="">
                        </div>
                        <div class="pi-confirm" data-js-pi-colonne-del-confirm><?=$GLOBALS['lang'] == "fr" ? "Supprimer" : "Delete"; ?></div>
                    </div>
                </div>
                <div class="pi-meta-colonne-content pi-meta-container-closed">
                    <div>Titre</div>
                    <input class="pi-meta-colonne-input" name="pi-meta-colonne-bloc-title[<?=$key?>][<?=$kkey?>]" type="text" value="<?=$value?>" data-js-pi-meta><br><br>
                    <div>Texte</div>
                    <textarea class="pi-meta-colonne-input" name="pi-meta-colonne-bloc-text[<?=$key?>][<?=$kkey?>]" id="" cols="30" rows="10" data-js-pi-meta><?=$blocColonne[$key]['text'][$kkey]?></textarea><br><br>
                    <div>Libellé du boutton</div>
                    <input class="pi-meta-colonne-input" type="text" name="pi-meta-colonne-bloc-cta[<?=$key?>][<?=$kkey?>]" value="<?=$blocColonne[$key]['cta'][$kkey]?>" data-js-pi-meta><br><br>
                    
                    <div>Url de redirection</div>
                    <select class="pi-page-dropdown" data-input-target="pi-meta-colonne-bloc-link[<?=$key?>][<?=$kkey?>]">
                        <option value=""><?= $GLOBALS['lang'] == "fr" ? "Sélectionner une page" : "Select a page"; ?></option>
                        <?php
                        $current_lang = apply_filters('wpml_current_language', null);
                        $args = ['post_type' => 'page','post_status' => 'publish','posts_per_page' => -1,'suppress_filters' => false,'orderby' => 'title','order' => 'ASC',];
                        $pages = get_posts($args);foreach ($pages as $page): ?>
                        <option value="[HREF id='<?=$page->ID?>' slug='<?=get_post_field('post_name', $page->ID)?>' lang='<?=$current_lang?>']"><?= esc_html(get_the_title($page->ID)) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input class="pi-meta-colonne-input" type="text" name="pi-meta-colonne-bloc-link[<?=$key?>][<?=$kkey?>]" value="<?=$blocColonne[$key]['link'][$kkey]?>" style="width:100%; font-weight:lighter" data-js-pi-meta><br>
                    <br><br>

                    <div>
                        <button type="button" class="button pi-carrousel-img-btn" data-js-upload-img-btn>
                            Choisir un image
                        </button>
                        <input style="width: 100%;" class="pi-img-carrousel-input-hidden" type="text" name="pi-meta-colonne-bloc-img[<?=$key?>][<?=$kkey?>]" value="<?=$blocColonne[$key]['img'][$kkey]?>" data-js-pi-meta />
                    </div>

                </div>
            </div>
            <?php } ?>

        <span>
            <div class="pi-add-btn"  data-js-colonne-add-btn><?=$GLOBALS['lang'] == "fr" ? "Ajouter un bloc" : "Add a block"; ?></div>
        </span>
    </div>
</div>