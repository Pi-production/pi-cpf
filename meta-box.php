<?php add_shortcode('HREF', 'href_shortcode');
if (!function_exists('href_shortcode')) {
    function href_shortcode($atts) {
		function href_shortcode($atts) {$atts = shortcode_atts(array('id' => 0, ), $atts, 'HREF'); $id = intval($atts['id']); if ($id <= 0) {return '';} $permalink = get_permalink($id); if ($permalink === false) {return '';} $parsed_url = wp_parse_url($permalink); $request_uri = isset($parsed_url['path']) ? $parsed_url['path'] : ''; return esc_html($request_uri);}
    }
}

//must be included in functions.php

function create_cookie_meta_box () {
    //global $post;
    if ( 'page-template-pi.php' == get_post_meta( get_the_ID(), '_wp_page_template', true ) ||  'page-accueil.php' == get_post_meta( get_the_ID(), '_wp_page_template', true ) ||  'page-realisations.php' == get_post_meta( get_the_ID(), '_wp_page_template', true ) ||  'page-service.php' == get_post_meta( get_the_ID(), '_wp_page_template', true )) {
        add_meta_box(
        'pi_meta_box', // Unique ID
        'Pi Builder', // Box title
        'pi_custom_box',
        'page',
        'normal',
        'high'
    );
    }
}
add_action('add_meta_boxes', 'create_cookie_meta_box');

if (get_locale() == 'en_US' || get_locale() == 'en_CA') {
    $GLOBALS['lang'] = 'en';
}else {
    $GLOBALS['lang'] = 'fr';
}

function pi_custom_box() {
 ?>

	<div id="styleBox" style="font-weight:bold; padding: 20px 15px;">
		<div data-js-pi-parent-container>
			<?php $meta_array = get_post_meta(get_the_ID(), 'pi-meta-cpf');
			if ($meta_array[0]) {
				foreach ($meta_array as $keyy => $values) {
					foreach ($values['pi-meta-container-title'] as $key => $value) { ?>

				<div name="pi-cont[<?=$key?>]" class="pi-meta-container" data-js-pi-meta-container>
					<div class="pi-meta-container-controls">
						<div class="pi-meta-container-title">
							<input id="pi-meta-container-title[<?=$key?>]" type="text" name="pi-meta-container-title[<?=$key?>]" value="<?=$values['pi-meta-container-title'][$key]?>" style="width: 45%;" data-js-pi-meta>
							<select class="pi-meta-mains-select" name="pi-meta-block-type[<?=$key?>]" style="width: 50%;" data-js-pi-meta>
								<option value=""><?=$GLOBALS['lang'] == "fr" ? "Type du contenue" : "Content type"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'textImage') ? 'selected' : '';?> class="pi-option-textImage" value="textImage"><?=$GLOBALS['lang'] == "fr" ? "Texte avec image" : "Text with image"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'galerie') ? 'selected' : '';?> class="pi-option-galerie" value="galerie"><?=$GLOBALS['lang'] == "fr" ? "Galerie d'image" : "Image gallery"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'carrousel') ? 'selected' : '';?> class="pi-option-carrousel" value="carrousel"><?=$GLOBALS['lang'] == "fr" ? "Carrousel" : "Carrousel"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'colonne') ? 'selected' : '';?> class="pi-option-colonne" value="colonne"><?=$GLOBALS['lang'] == "fr" ? "Contenue en colonne" : "Colonne content"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'html') ? 'selected' : '';?> class="pi-option-html" value="html"><?=$GLOBALS['lang'] == "fr" ? "HTML personnalisé" : "Custom HTML"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'video') ? 'selected' : '';?> class="pi-option-video" value="video"><?=$GLOBALS['lang'] == "fr" ? "Vidéo" : "Video"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'accordeon') ? 'selected' : '';?> class="pi-option-accordeon" value="accordeon"><?=$GLOBALS['lang'] == "fr" ? "Accordéon" : "Accordeon"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'articles') ? 'selected' : '';?> class="pi-option-articles" value="articles"><?=$GLOBALS['lang'] == "fr" ? "Extraits d'articles" : "Articles snippets"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'titreWp') ? 'selected' : '';?> class="pi-option-titreWp" value="titreWp"><?=$GLOBALS['lang'] == "fr" ? "Titre Wordpress" : "Wordpress Title"; ?></option>
								<option <?=($values['pi-meta-block-type'][$key] == 'contenuWp') ? 'selected' : '';?> class="pi-option-contenuWp" value="contenuWp"><?=$GLOBALS['lang'] == "fr" ? "Contenu Wordpress" : "Wordpress Content"; ?></option>
							</select>
						</div>
						<div class="pi-control-panel" data-js-pi-meta-controls>
						</div>
						<div class="pi-meta-container-buttons">
							<label for="pi-meta-block-hide[<?=$key?>]">
								<input class="pi-control-hide-section" id="pi-meta-block-hide[<?=$key?>]" type="checkbox" name="pi-meta-block-hide[<?=$key?>]"  value="1" <?php if($values['pi-meta-block-hide'][$key]){echo'checked';}?> data-js-pi-meta>
								<img class="pi-control-hide-section-img" src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/eye.svg'?>" alt="">
							</label>
							<img name="pi-del[<?=$key?>]" class="pi-del-btn pi-icons" data-js-pi-del-btn src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/trashbin.svg'?>" alt="">
							<img name="pi-up[<?=$key?>]" class="pi-icons" data-js-pi-up-btn src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/up-arrowhead.svg'?>" alt="">
							<img name="pi-down[<?=$key?>]" class="pi-icons" data-js-pi-down-btn src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/down-arrowhead.svg'?>" alt="">
							<img class="pi-icons" style="transition: ease .3s; width: 10px;" src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/triangle.svg'?>" alt="" data-js-pi-triangle>
						</div>
						<div class="pi-supression-confirm" data-js-pi-del-confirm-cont>
							<div class="pi-cancel" data-js-pi-del-cancel>
								<img src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/x.svg'?>" alt="">
							</div>
							<div class="pi-confirm" data-js-pi-del-confirm><?=$GLOBALS['lang'] == "fr" ? "Supprimer" : "Delete"; ?></div>
						</div>
					</div>
					<div class="pi-meta-container-content pi-meta-container-closed" data-js-pi-meta-content>

						<div class="pi-input-section-parameters">
							<div class="pi-input-flex-wrapper">
								<div><?=$GLOBALS['lang'] == "fr" ? "ID pour le défilement automatique (aucun caractères spéciaux)" : "Section ID for 'scrollTo' (no special characters)"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
								<input name="pi-meta-section-id[<?=$key?>]" value="<?=$values['pi-meta-section-id'][$key]?>" data-js-pi-meta>
							</div>
							<div class="pi-input-flex-wrapper">
								<div class="pi-input-flex-wrapper">
									<div><?=$GLOBALS['lang'] == "fr" ? "Marge du haut" : "Top margin"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
									<input style="width: 55px;" name="pi-meta-padding-top[<?=$key?>]" value="<?=$values['pi-meta-padding-top'][$key]?>" type="number" data-js-pi-meta>
								</div>&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="pi-input-flex-wrapper">
									<div><?=$GLOBALS['lang'] == "fr" ? "Marge du bas" : "Bot margin"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
									<input style="width: 55px;" name="pi-meta-padding-bottom[<?=$key?>]" value="<?=$values['pi-meta-padding-bottom'][$key]?>" type="number" data-js-pi-meta>
								</div>&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="pi-input-flex-wrapper">
									<div><?=$GLOBALS['lang'] == "fr" ? "Utilisation de la pleine largeur" : "Use the full width"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
									<input name="pi-meta-full-width[<?=$key?>]" <?=(!$values['pi-meta-full-width'][$key]) ? '' : 'checked'?> type="checkbox" data-js-pi-meta>
								</div>&nbsp;&nbsp;&nbsp;&nbsp;
								<div class="pi-input-flex-wrapper">
									<div><?=$GLOBALS['lang'] == "fr" ? "Classe CSS supplémentaire" : "Extra CSS class"; ?>&nbsp;:</div>&nbsp;&nbsp;&nbsp;&nbsp;
									<input name="pi-meta-extra-class[<?=$key?>]" value='<?=$values['pi-meta-extra-class'][$key]?>' type="text" data-js-pi-meta>
								</div>
							</div>
						</div>
						<!-- Call le bon template par rapport au type de cpf après reload -->
						<?php if($values['pi-meta-block-type'][$key]){ include('templates/'.$values['pi-meta-block-type'][$key].'.php');}  ?>

					</div>
				</div>

			<?php }}}?>

		</div>
		<div class="pi-add-btn" data-js-pi-add-btn><?=$GLOBALS['lang'] == "fr" ? "Ajouter une section" : "Add a section"; ?></div><br><br><br>
		<div class="pi-input-flex-wrapper"><small><?=$GLOBALS['lang'] == "fr" ? "Propulsé par" : "Powered by"; ?></small>&nbsp;&nbsp;<img width="100" src="<?='https://dev.pubinteractive.ca/pi-cpf/assets/img/logo-pubinteractive-color.svg'?>" alt=""></div>
	</div>

<?php }

function pi_save_meta() {

	$post_id = get_the_ID();

	$values = array();
	$valuesGalerie = array();
	$valuesAccordeon = array();
	$valuesColonne = array();

	$tracker = 0;

	foreach ($_POST as $name => $val){
		
		if ($name == 'pi-meta-galerie-image') {
			$valuesGalerie[$tracker] = $val;

			$tracker = $tracker+1;
		}else if ($name == 'pi-meta-multiple-ti') {
			$valuesMultipleTI[$tracker] = $val;

			$tracker = $tracker+1;
		}else if ($name == 'pi-meta-carrousel-image') {
			$valuesCarrousel[$tracker] = $val;

			$tracker = $tracker+1;
		}else if ($name == 'pi-meta-carrousel-text') {
			$valuesCarrouselText[$tracker] = $val;

			$tracker = $tracker+1;
		}else if($name == 'pi-meta-accordeon-bloc-title'){
			$valuesAccordeon[$tracker]['title'] = $val;

			$tracker = $tracker+1;
		}else if($name == 'pi-meta-accordeon-bloc-text'){
			$valuesAccordeon[$tracker]['text'] = $val;

			$tracker = $tracker+1;
		}else if($name == 'pi-meta-colonne-bloc-title'){
			foreach ($val as $i => $title) {
				$valuesColonne[$i]['title'] = $title;
			}
		}else if($name == 'pi-meta-colonne-bloc-text'){
			foreach ($val as $i => $text) {
				$valuesColonne[$i]['text'] = $text;
			}
		}else if($name == 'pi-meta-colonne-bloc-label'){
			foreach ($val as $i => $label) {
				$valuesColonne[$i]['label'] = $label;
			}
		}else if($name == 'pi-meta-colonne-bloc-cta'){
			foreach ($val as $i => $cta) {
				$valuesColonne[$i]['cta'] = $cta;
			}
		}else if($name == 'pi-meta-colonne-bloc-link'){
			foreach ($val as $i => $link) {
				$valuesColonne[$i]['link'] = $link;
			}
		}else if($name == 'pi-meta-colonne-bloc-img'){
			foreach ($val as $i => $img) {
				$valuesColonne[$i]['img'] = $img;
			}
		}else {
			$values[$name] = $val;
		}
	}
			

	update_post_meta($post_id, 'pi-meta-cpf', $values);
	update_post_meta($post_id, 'pi-meta-galerie', $valuesGalerie);
	update_post_meta($post_id, 'pi-meta-multiple-ti', $valuesMultipleTI);
	update_post_meta($post_id, 'pi-meta-carrousel-image', $valuesCarrousel);
	update_post_meta($post_id, 'pi-meta-carrousel-text', $valuesCarrouselText);
	update_post_meta($post_id, 'pi-meta-accordeon', $valuesAccordeon);
	update_post_meta($post_id, 'pi-meta-colonne', $valuesColonne);
	empty($values);
	empty($valuesGalerie);
	empty($valuesAccordeon);
	empty($valuesColonne);
	empty($valuesMultipleTI);
	empty($valuesCarrousel);
	empty($valuesCarrouselText);
}

add_action('save_post', 'pi_save_meta');