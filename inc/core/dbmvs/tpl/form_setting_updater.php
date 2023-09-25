<h2><?php _d('Metadata Updater'); ?></h2>
<p><?php _d('This tool updates and repairs metadata of all content published or imported by Dbmovies'); ?>, <a href="https://dooplay.themes.pe/dbmovies/meta-updater" target="_blank"><?php _d('Learn more'); ?></a></p>
<hr>
<table class="form-table dbmv">
    <tbody>
        <tr valign="top">
            <th scope="row" class="titledesc"><?php _d('Method'); ?></th>
            <td>
                <?php $this->field_radio('updatermethod', self::UpdaterMethod(),'wp-ajax'); ?>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <?php _d('Post Types'); ?>
            </th>
            <td>
                <?php $this->field_checkbox('updatermovies', __d('Movies')); ?>
                <?php $this->field_checkbox('updatershows', __d('TV Shows')); ?>
                <?php $this->field_checkbox('updaterseasons', __d('TV Shows > Seasons')); ?>
                <?php $this->field_checkbox('updaterepisodes', __d('TV Shows > Episodes')); ?>
            </td>
        </tr>
    </tbody>
</table>
