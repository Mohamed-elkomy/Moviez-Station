<?php
/*
* -------------------------------------------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2021 Doothemes. All rights reserved
* -------------------------------------------------------------------------------------
*
* @since 2.5.0
*
*/


$posttype = get_post_type();

switch($posttype) {

    case 'movies':
        $postmeta = doo_postmeta_movies($post->ID);
        break;

    case 'tvshows':
        $postmeta = doo_postmeta_tvshows($post->ID);
        break;
}

// Compose data
$quality = get_the_term_list($post->ID, 'dtquality');
$urating = doo_isset($postmeta, '_starstruck_avg');
$imdbrat = doo_isset($postmeta, 'imdbRating');
$release = doo_isset($postmeta, 'release_date');
$airdate = doo_isset($postmeta, 'first_air_date');
$viewsco = doo_isset($postmeta, 'dt_views_count');
$runtime = doo_isset($postmeta, 'runtime');
$maxwidth = dooplay_get_option('max_width','1200');
$playicon = dooplay_get_option('play_icon','play1');
$imdbrat = ($imdbrat) ? $imdbrat : '0';
// End PHP
?>
<article id="post-<?php the_ID(); ?>" class="item <?php echo $posttype; ?>">
	<div class="poster">
		<img src="<?php echo dbmovies_get_poster($post->ID); ?>" alt="<?php the_title(); ?>">
		<div class="rating"><?php echo ( $urating ) ? $urating : $imdbrat; ?></div>
		<div class="mepo">
        <?php echo ($quality) ? '<span class="quality">'.strip_tags($quality).'</span>' : false; ?>
		</div>
		<a href="<?php the_permalink() ?>"><div class="see <?php echo $playicon; ?>"></div></a>
	</div>
	<div class="data">
		<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3>
        <span><?php
            if($posttype == 'movies') echo ($release) ? doo_date_compose($release) : '&nbsp;';
            if($posttype == 'tvshows') echo ($airdate) ? doo_date_compose($airdate) : '&nbsp;';
        ?></span>
	</div>
	<?php if(is_archive() === true && $maxwidth < 1400) { ?>
    <div class="animation-1 dtinfo">
    	<div class="title">
    		<h4><?php the_title(); ?></h4>
    	</div>
    	<div class="metadata">
    		<?php echo ($imdbrat) ? '<span class="imdb">IMDb: '.$imdbrat.'</span>' : false; ?>
    		<?php echo ($release) ? '<span>'. date('Y', strtotime($release)) .'</span>' : false; ?>
            <?php echo ($airdate) ? '<span>'. date('Y', strtotime($airdate)) .'</span>' : false; ?>
    		<?php echo ($runtime) ? '<span>'.$runtime.' '. __d('min') .'</span>' : false; ?>
    		<?php if(DOO_THEME_VIEWS_COUNT) echo ($viewsco) ? '<span>'.$viewsco.' '. __d('views') .'</span>' : false; ?>
    	</div>
    	<div class="texto"><?php dt_content_alt('150'); ?></div>
    	<?php echo get_the_term_list($post->ID, 'genres', '<div class="genres"><div class="mta">', '', '</div></div>'); ?>
    </div>
    <?php } ?>
</article>
