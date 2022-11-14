<article class="guitar-tab">
    <?php if (strlen($tab_content) > 0) : ?>
        <div class="font-size-controls">
            <label>Font size</label>
            <button type="button" class="font-size-decrease" aria-label="Decrease font size">–</button>
            <button type="button" class="font-size-increase" aria-label="Increase font size">+</button>
        </div>
        <pre class="font-size-resizeable"><?= $tab_content ?></pre>
    <?php else: ?>
       <span class="error">Error, could not display guitar tab</span>
    <?php endif ?>
</article>
<?php if($downloadable === true && strlen($file_path_relative) > 0) : ?>
    <div class="guitar-tab-download-link">
        Hard to read? Raw text:
        <a target="_blank" href="<?= $file_path_relative ?>">Open</a> | 
        <a download href="<?= $file_path_relative ?>">Download</a>
    </div>
<?php endif ?>