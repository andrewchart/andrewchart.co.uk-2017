<section class="gallery photo-gallery">
    <h2 class="visually-hidden">Full Photo Gallery</h2>
    <ul id="photo-gallery-thumbnails" class="<?= $hide_thumbnails ? "visually-hidden" : ""; ?>">
        <?= $thumbnails_html . "\n\t"; ?>
    </ul>
    <button class="button button__primary" id="open-photo-gallery">
        <?= $hide_thumbnails ? "Open in gallery" : "Open Gallery"; ?>
    </button>
</section>