<article class="w_item_c"  id="post-<?php the_id(); ?>">
	<a href="<?php the_permalink() ?>">
		<?php $values = doo_get_postmeta(DOO_MAIN_RATING); ?><div class="rating"><i class="fas fa-star"></i> <?php if($c = $values) { echo $c; } else { echo '0'; } ?></div>
		<div class="data">
			<h3><?php the_title(); ?></h3>
			<?php if($mostrar = $terms = strip_tags( $terms = get_the_term_list( $post->ID, 'dtyear'))) {  ?><span><?php echo $mostrar; ?></span><?php } ?>
		</div>
	</a>
</article>
