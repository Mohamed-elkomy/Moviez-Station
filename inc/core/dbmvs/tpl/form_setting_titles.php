<h2><?php _d('Customize titles'); ?></h2>
<p><?php _d('Configure the titles that are generated in importers'); ?>, <a href="https://dooplay.themes.pe/dbmovies/titles-customizer" target="_blank"><?php _d('Learn more'); ?></a></p>
<hr>
<table class="form-table dbmv">
    <tbody>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmv-input-titlemovies"><?php _d('Movies'); ?></label>
            </th>
            <td>
                <?php $this->field_text('titlemovies'); ?>
                <p><strong><?php _d('Usable tags'); ?>:</strong> <code>{name}</code> <code>{year}</code></p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmv-input-titletvshows"><?php _d('TVShows'); ?></label>
            </th>
            <td>
                <?php $this->field_text('titletvshows'); ?>
                <p><strong><?php _d('Usable tags'); ?>:</strong> <code>{name}</code> <code>{year}</code></p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmv-input-titleseasons"><?php _d('Seasons'); ?></label>
            </th>
            <td>
                <?php $this->field_text('titleseasons'); ?>
                <p><strong><?php _d('Usable tags'); ?>:</strong> <code>{name}</code> <code>{season}</code></p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmv-input-titlepisodes"><?php _d('Episodes'); ?></label>
            </th>
            <td>
                <?php $this->field_text('titlepisodes'); ?>
                <p><strong><?php _d('Usable tags'); ?>:</strong> <code>{name}</code> <code>{season}</code> <code>{episode}</code></p>
            </td>
        </tr>
    </tbody>
</table>
<hr>
<h2><?php _d('Customize Content'); ?></h2>
<p><?php _d('Customize how content for movies and tvshows will be imported'); ?>, <a href="https://dooplay.themes.pe/dbmovies/content-customizer" target="_blank"><?php _d('Learn more'); ?></a></p>
<table class="form-table dbmv">
    <tbody>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmv-textarea-composer-content-movies"><?php _d('Content for movies'); ?></label>
            </th>
            <td>
                <?php $this->field_textarea('composer-content-movies','<!-- wp:paragraph -->{synopsis}<!-- /wp:paragraph -->'); ?>
                <p>
                    <strong><?php _d('Usable tags'); ?>:</strong>
                    <code>{year}</code>
                    <code>{synopsis}</code>
                    <code>{title}</code>
                    <code>{title_original}</code>
                </p>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmv-textarea-composer-content-tvshows"><?php _d('Content for shows'); ?></label>
            </th>
            <td>
                <?php $this->field_textarea('composer-content-tvshows','<!-- wp:paragraph -->{synopsis}<!-- /wp:paragraph -->'); ?>
                <p>
                    <strong><?php _d('Usable tags'); ?>:</strong>
                    <code>{year}</code>
                    <code>{synopsis}</code>
                    <code>{title}</code>
                    <code>{title_original}</code>
                </p>
            </td>
        </tr>
    </tbody>
</table>
