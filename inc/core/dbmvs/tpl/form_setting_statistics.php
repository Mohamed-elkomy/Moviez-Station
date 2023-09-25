<h2><?php _d('My stats'); ?></h2>
<p><?php _d('A brief summary of the statistics related to your api key.'); ?></p>
<hr>
<table id="dbmovies-apistats" class="form-table dbmv">
    <tbody>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs-credits"><?php _d('Available credits'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs-credits">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs-credits-used"><?php _d('Credits used'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs-credits-used">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs-requests"><?php _d('Total requests'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs-requests">0</span>
            </td>
        </tr>
    </tbody>
</table>
<hr>
<h2><?php _d('Global Statistics'); ?></h2>
<p><?php _d('Global summary of the metric status of our services for Dbmovies.'); ?></p>
<hr>
<table id="dbmvs_global_stats" class="form-table dbmv">
    <tbody>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs_total_credits"><?php _d('Credits in reserve'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs_total_credits">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs_total_used_credits"><?php _d('Credits used'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs_total_used_credits">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs_total_requests"><?php _d('Total requests'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs_total_requests">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs_total_caching"><?php _d('Stored requests'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs_total_caching">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs_total_licenses"><?php _d('Active licenses'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs_total_licenses">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="dbmvs_total_sites"><?php _d('Active sites'); ?></label>
            </th>
            <td>
                <span class="number" id="dbmvs_total_sites">0</span>
            </td>
        </tr>
        <tr valign="top">
            <th scope="row" class="titledesc">
                <label for="last_cache"><?php _d('Last stats cache'); ?></label>
            </th>
            <td>
                <span class="number" id="last_cache">0</span>
            </td>
        </tr>		
    </tbody>
</table>
