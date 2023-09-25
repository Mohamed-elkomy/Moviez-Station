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

if( isset( $_GET[ 's' ] ) ) {  
	$s = $_GET[ 's' ];  
	} else {
		$s = '';
	}
?>
<ul class="abc">
	<li><a href="<?php echo esc_url( home_url('/') ); ?>?letter=true&s=title-09" <?php echo $s == 'title-09' ? 'class="select"' : ''; ?>>#</a></li>
	<?php for ($l="a";$l!="aa";$l++){?>
	<li><a href="<?php echo esc_url( home_url('/') ); ?>?letter=true&s=title-<?php echo $l; ?>" <?php echo $s == "title-$l" ? 'class="select"' : ''; ?>><?php echo strtoupper($l); ?></a></li> 
	<?php } ?>
</ul>