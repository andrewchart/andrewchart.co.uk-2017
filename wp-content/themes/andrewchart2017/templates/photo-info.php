<aside class="photo-info">

    <h3 class="visually-hidden">Lead Photo: Metadata</h3>

    <div class="photo-metadata">
        
        <section class="camera-details">
            <table>
                <tbody>

                    <?php if(isset($img_meta['camera'])) : ?>
                    <tr>
                        <th>Camera & Lens</th>
                        <td>
                            <?= $img_meta['camera']; ?>
                            <?php if(isset($img_meta['lens'])) : ?>
                            <br /><?= $img_meta['lens']; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <?php if(isset($img_meta['date_taken'])) : ?>
                    <tr>
                        <th>Date Taken</th>
                        <td><?= $img_meta['date_taken']; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if(isset($img_meta['focal_length'])) : ?>
                    <tr>
                        <th>Focal Length</th>
                        <td><?= $img_meta['focal_length']; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if(isset($img_meta['aperture'])) : ?>
                    <tr>
                        <th>Aperture</th>
                        <td><?= $img_meta['aperture']; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if(isset($img_meta['shutter_speed'])) : ?>
                    <tr>
                        <th>Shutter Speed</th>
                        <td><?= $img_meta['shutter_speed']; ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if(isset($img_meta['iso'])) : ?>
                    <tr>
                        <th>ISO</th>
                        <td><?= $img_meta['iso']; ?></td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <small>(metadata for main photo)</small>

</aside>