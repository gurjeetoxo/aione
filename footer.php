		<?php get_template_part('template/aione-pagebottom');  ?>
		<?php get_template_part('template/aione-footer');  ?>
		<?php get_template_part('template/aione-copyright');  ?>
		
		</div><!-- .wrapper -->
	</div><!-- .aione-wrapper -->

	<?php wp_footer(); ?>
	<?php
	global $post;
	global $theme_options;
	$pyre_custom_js = get_aione_page_option($post->ID,'pyre_custom_js');
	if($theme_options['custom_js'] != "" ){
		echo "<script type='text/javascript'>".$theme_options['custom_js']."</script>";
	}
	if($pyre_custom_js != "") {
		echo "<script type='text/javascript'>".$pyre_custom_js."</script>";
	}
	?>

	</body>
</html>
