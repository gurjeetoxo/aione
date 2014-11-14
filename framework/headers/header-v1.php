
<?php global $theme_options; $theme_options = $theme_options;?>
<div class="header-v1">
	<header id="header">
		<div class="aione-row" style="padding-top:<?php echo $theme_options['margin_header_top']; ?>;padding-bottom:<?php echo $theme_options['margin_header_bottom']; ?>;" data-padding-top="<?php echo $theme_options['margin_header_top']; ?>" data-padding-bottom="<?php echo $theme_options['margin_header_bottom']; ?>">
			<div class="logo" data-margin-right="<?php echo $theme_options['margin_logo_right']; ?>" data-margin-left="<?php echo $theme_options['margin_logo_left']; ?>" data-margin-top="<?php echo $theme_options['margin_logo_top']; ?>" data-margin-bottom="<?php echo $theme_options['margin_logo_bottom']; ?>" style="margin-right:<?php echo $theme_options['margin_logo_right']; ?>;margin-top:<?php echo $theme_options['margin_logo_top']; ?>;margin-left:<?php echo $theme_options['margin_logo_left']; ?>;margin-bottom:<?php echo $theme_options['margin_logo_bottom']; ?>;">
				<a href="<?php bloginfo('url'); ?>">
					<?php //$image_size = getimagesize( $theme_options['logo'] ); ?>
					<img src="<?php echo $theme_options['logo']; ?>" alt="<?php bloginfo('name'); ?>" class="normal_logo" data-width="<?php echo $image_size[0]; ?>" data-height="<?php echo $image_size[1]; ?>" />
					<?php if($theme_options['logo_retina'] && $theme_options['retina_logo_width'] && $theme_options['retina_logo_height']): ?>
					<?php
					$pixels ="";
					if(is_numeric($theme_options['retina_logo_width']) && is_numeric($theme_options['retina_logo_height'])):
					$pixels ="px";
					endif; ?>
					<img src="<?php echo $theme_options["logo_retina"]; ?>" alt="<?php bloginfo('name'); ?>" style="width:<?php echo $theme_options["retina_logo_width"].$pixels; ?>;max-height:<?php echo $theme_options["retina_logo_height"].$pixels; ?>; height: auto !important" class="retina_logo" />
					<?php endif; ?>
				</a>
			</div>
			<?php if($theme_options['ubermenu']): ?>
			<nav id="nav-uber">
			<?php else: ?>
			<nav id="nav" class="nav-holder" data-height="<?php echo $theme_options['nav_height']; ?>px">
			<?php endif; ?>
				<?php get_template_part('framework/headers/header-main-menu'); ?>
			</nav>
			<?php if(tf_checkIfMenuIsSetByLocation('main_navigation')): ?>
			<div class="mobile-nav-holder main-menu"></div>
			<?php endif; ?>
		</div>
	</header>
</div>