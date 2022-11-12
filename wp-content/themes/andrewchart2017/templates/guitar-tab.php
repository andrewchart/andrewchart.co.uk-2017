<article class="guitar-tab">
    <?php if (strlen($tab_content) > 0) : ?>
        <pre><?= $tab_content ?></pre>
    <?php else: ?>
       <span class="error">Error, could not display guitar tab</span>';
    <?php endif ?>
</article>
<?php if($downloadable === true && strlen($download_path) > 0) : ?>
    <div class="guitar-tab-download-link">
        Not displaying correctly?<br />
        <a download href="<?= $download_path ?>">Download raw text version</a></div>
    </div>
<?php endif ?>