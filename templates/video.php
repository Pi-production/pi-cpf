
<!-- Template pour le type : Vidéo -->

<div class="pi-meta-content" data-js-pi-meta-content-container="<?=$values['pi-meta-block-type'][$key]?>">
    <div class="pi-meta-content-title"><?=$GLOBALS['lang'] == "fr" ? "Vidéo" : "Video"; ?></div>
    <div><?=$GLOBALS['lang'] == "fr" ? "Lien embed youtube" : "Embed youtube link"; ?></div>
    <input style="width: 100%;" name="pi-meta-section-video-url[<?=$key?>]" value="<?=$values['pi-meta-section-video-url'][$key]?>" type="text" data-js-pi-meta><br><br>
    <div class="pi-video-controls-meta-container">
        <div class="pi-video-controls-meta-wrapper">
            <div class="pi-video-controls-meta"><?=$GLOBALS['lang'] == "fr" ? "Autoplay" : "Autoplay"; ?></div>&nbsp;&nbsp;
            <input class="pi-video-controls-meta" type="checkbox" name="pi-meta-video-controls-autoplay[<?=$key?>]"  value="1" <?php if($values['pi-meta-video-controls-autoplay'][$key]){echo'checked';}?> data-js-pi-meta>
        </div>
        <div class="pi-video-controls-meta-wrapper">
            <div class="pi-video-controls-meta"><?=$GLOBALS['lang'] == "fr" ? "Sourdine" : "Mute"; ?></div>&nbsp;&nbsp;
            <input class="pi-video-controls-meta" type="checkbox" name="pi-meta-video-controls-mute[<?=$key?>]"  value="1" <?php if($values['pi-meta-video-controls-mute'][$key]){echo'checked';}?> data-js-pi-meta>
        </div>
        <div class="pi-video-controls-meta-wrapper">
            <div class="pi-video-controls-meta"><?=$GLOBALS['lang'] == "fr" ? "Masquer les contrôles" : "Hide controls"; ?></div>&nbsp;&nbsp;
            <input class="pi-video-controls-meta" type="checkbox" name="pi-meta-video-controls-controls[<?=$key?>]"  value="1" <?php if($values['pi-meta-video-controls-controls'][$key]){echo'checked';}?> data-js-pi-meta>
        </div>
        <div class="pi-video-controls-meta-wrapper">
            <div class="pi-video-controls-meta"><?=$GLOBALS['lang'] == "fr" ? "Rejouer automatiquement" : "Loop"; ?></div>&nbsp;&nbsp;
            <input class="pi-video-controls-meta" type="checkbox" name="pi-meta-video-controls-loop[<?=$key?>]"  value="1" <?php if($values['pi-meta-video-controls-loop'][$key]){echo'checked';}?> data-js-pi-meta>
        </div>
    </div>
</div>