<?php
global $theme_options;
global $post;

// _to_be_deleted
// echo "<br>ID = ".$post->ID;
/*$posts_page_id = get_option( 'page_for_posts' );


echo "*****************".$posts_page_id;*/
$post_type 				= get_post_type( $post->ID );
$aione_components 		= get_option( 'aione-components' );
$aione_component 		= $aione_components[$post_type];
$single_template_slug 	= $aione_component['single_template'];
$archive_template_slug 	= $aione_component['archive_template'];

$aione_templates 		= get_option( 'aione-templates' );
$aione_template_single 	= $aione_templates[$single_template_slug]['content'];
$aione_template_archive = $aione_templates[$archive_template_slug]['content'];


if( isset( $archive_template_slug ) && $archive_template_slug != "archive" ) {

	global $wp_query;

	$ppp 		= $aione_templates[$archive_template_slug]['template_posts_per_page'];
	$order_by 	= $aione_templates[$archive_template_slug]['template_posts_order_by'];
	$order 		= $aione_templates[$archive_template_slug]['template_posts_order'];
	$template_posts_status_array = $aione_templates[$archive_template_slug]['template_posts_status'];
	$template_filter_enable = $aione_templates[$archive_template_slug]['template_filter_enable'];

	$post_status = array( 'publish' );
	
	if( !empty( $template_posts_status_array ) ) {
		$post_status = array_keys( $template_posts_status_array );
	}


	// $big = 999999999; // need an unlikely integer
    // $current_page = get_query_var('paged');

    // echo "<br>current_page = ".$current_page;
    // $total_pages = $wp_query->max_num_pages;
    // $total_pages = $wp_query->max_num_pages;
    // $offset = null;
	/*
    if( $current_page > 0 ){
    	$offset = $ppp * ( $current_page - 1);

    }
    */

	
	$args = array_merge( 
		$wp_query->query, 
		array( 
			'posts_per_page'	=> $ppp, 
			'orderby'			=> $order_by, 
			'offset'			=> $offset, 
			'order'				=> $order,
			'post_status'		=> $post_status
		) 
	);

	
	/*if($template_filter_enable == "yes"){
		if( isset( $_POST["aione_filters_searchsubmit"]) && isset($_POST["search"]) && $_POST["search"] == "aione_filters_search"){

			$args['tax_query']  = array(
		        array(
		            'taxonomy' => 'category',
		            'field'    => 'term_id',
		            'terms'    => array( $_POST["filter_cat"] ),
		            'operator' => 'IN',
		        ),
		    ); 
			
		}
	}*/
	query_posts( $args );
}

if ( have_posts() ) :
	if(is_home()  || is_archive()){
		if( isset($archive_template_slug) && $archive_template_slug != 'archive' ){
			echo "<div class='aione-template type-archive ".$archive_template_slug."'>";
			/*if($template_filter_enable == "yes"){
				echo aione_filters($wp_query);
			}*/
		}
	}
	while ( have_posts() ) : the_post();
		if( is_search() ){ 
			get_template_part( 'template-parts/content', 'search' );
		} else if ( is_home() ) {  
		    //_to_be_deleted 
			//get_template_part( 'template-parts/blog', get_post_format() );
			if( isset($archive_template_slug) && $archive_template_slug != 'archive' ) { 				
				echo do_shortcode($aione_template_archive);				
			} else { 
				get_template_part( 'template-parts/blog', get_post_format() );
			}
		} else if ( is_archive() ) {  
			if( isset($archive_template_slug) && $archive_template_slug != 'archive' ) { 
				echo do_shortcode($aione_template_archive);
			} else { 
				get_template_part( 'template-parts/content', get_post_format() );
			}			
		} else if( is_single() ) {   
			if( isset($single_template_slug) && $single_template_slug != 'single' ) { 
				echo do_shortcode($aione_template_single);
			} else { 
				get_template_part( 'template-parts/content', get_post_format() );
			}
		} elseif ( is_attachment() ){
			if( isset($single_template_slug) && $single_template_slug != 'single' ) { 
				echo do_shortcode($aione_template_single);
			} else { 
				get_template_part( 'template-parts/content', get_post_format() );
			}
		} else {
			get_template_part( 'template-parts/content', get_post_type() );
		}

		if( is_single() ) {
			the_post_navigation( array(
				'prev_text' => '<i class="ion-ios-arrow-back"></i> Previous',
				'next_text' => 'Next <i class="ion-ios-arrow-forward"></i>',
			) );
		}

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
	endif;
endwhile;
if(is_home()  || is_archive()){
	if( isset($archive_template_slug) && $archive_template_slug != 'archive' ){
		echo "</div>";
	}
}
wp_reset_postdata();
else :
	get_template_part( 'template-parts/content', 'none' );
endif;

if( is_post_type_archive() || is_archive() || is_home() || is_search()) {
	echo aione_pagination( $wp_query );
}