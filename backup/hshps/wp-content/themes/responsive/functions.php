<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 *
 * WARNING: Please do not edit this file in any way
 *
 * load the theme function files
 */
require ( get_template_directory() . '/includes/functions.php' );
require ( get_template_directory() . '/includes/theme-options.php' );
require ( get_template_directory() . '/includes/post-custom-meta.php' );
require ( get_template_directory() . '/includes/tha-theme-hooks.php' );
require ( get_template_directory() . '/includes/hooks.php' );
require ( get_template_directory() . '/includes/version.php' );

add_action( 'init', 'create_post_type' );
function create_post_type() {
	register_post_type( 'slides',
		array(
			'labels' => array(
				'name' => __( 'Slides' ),
				'singular_name' => __( 'slide' )
			),
                        'supports' => array(
						'title',
						'custom-fields',
						'editor',
						'excerpt',
                                                'thumbnail'),
		'public' => true,
		'has_archive' => true,
		)
	);
}

	register_post_type( 'services',
		array(
			'labels' => array(
				'name' => __( 'Services' ),
				'singular_name' => __( 'service' )
			),
                        'supports' => array(
						'title',
						'custom-fields',
						'editor',
						'excerpt',
                                                'thumbnail'),
		'public' => true,
		'has_archive' => true,
		)
	);
	
	register_post_type( 'testimonials',
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'testimonial' )
			),
                        'supports' => array(
						'title',
						'custom-fields',
						'editor',
						'excerpt',
                                                'thumbnail'),
		'public' => true,
		'has_archive' => true,
		)
	);


add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}