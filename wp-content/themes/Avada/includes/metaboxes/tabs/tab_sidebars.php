<?php
/**
 * Sidebars Metabox options.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       http://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

$post_type          = get_post_type(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited
$sidebar_post_types = array(
	'page'            => array(
		'global'    => 'pages_global_sidebar',
		'sidebar'   => 'pages_sidebar',
		'sidebar_2' => 'pages_sidebar_2',
		'position'  => 'default_sidebar_pos',
	),
	'post'            => array(
		'global'    => 'posts_global_sidebar',
		'sidebar'   => 'posts_sidebar',
		'sidebar_2' => 'posts_sidebar_2',
		'position'  => 'blog_sidebar_position',
	),
	'avada_faq'       => array(
		'global'    => 'posts_global_sidebar',
		'sidebar'   => 'posts_sidebar',
		'sidebar_2' => 'posts_sidebar_2',
		'position'  => 'blog_sidebar_position',
	),
	'avada_portfolio' => array(
		'global'    => 'portfolio_global_sidebar',
		'sidebar'   => 'portfolio_sidebar',
		'sidebar_2' => 'portfolio_sidebar_2',
		'position'  => 'portfolio_sidebar_position',
	),
	'product'         => array(
		'global'    => 'woo_global_sidebar',
		'sidebar'   => 'woo_sidebar',
		'sidebar_2' => 'woo_sidebar_2',
		'position'  => 'woo_sidebar_position',
	),
	'tribe_events'    => array(
		'global'    => 'ec_global_sidebar',
		'sidebar'   => 'ec_sidebar',
		'sidebar_2' => 'ec_sidebar_2',
		'position'  => 'ec_sidebar_pos',
	),
	'forum'           => array(
		'global'    => 'bbpress_global_sidebar',
		'sidebar'   => 'ppbress_sidebar',
		'sidebar_2' => 'ppbress_sidebar_2',
		'position'  => 'bbpress_sidebar_position',
	),
	'topic'           => array(
		'global'    => 'bbpress_global_sidebar',
		'sidebar'   => 'ppbress_sidebar',
		'sidebar_2' => 'ppbress_sidebar_2',
		'position'  => 'bbpress_sidebar_position',
	),
	'reply'           => array(
		'global'    => 'bbpress_global_sidebar',
		'sidebar'   => 'ppbress_sidebar',
		'sidebar_2' => 'ppbress_sidebar_2',
		'position'  => 'bbpress_sidebar_position',
	),
);
$post_type_options  = '';
if ( isset( $sidebar_post_types[ $post_type ] ) ) {
	$post_type_options = $sidebar_post_types[ $post_type ];
}

if ( ! isset( $post_type_options['global'] ) || ( isset( $post_type_options['global'] ) && '1' !== Avada()->settings->get( $post_type_options['global'] ) ) ) {
	sidebar_generator::edit_form( $post_type_options );
	$this->radio_buttonset(
		'sidebar_position',
		esc_attr__( 'Sidebar 1 Position', 'Avada' ),
		array(
			'default' => esc_attr__( 'Default', 'Avada' ),
			'left'    => esc_attr__( 'Left', 'Avada' ),
			'right'   => esc_attr__( 'Right', 'Avada' ),
		),
		/* translators: Additional description (defaults). */
		sprintf( esc_html__( 'Select the sidebar 1 position. If sidebar 2 is selected, it will display on the opposite side. %s', 'Avada' ), ( ! empty( $post_type_options ) ) ? Avada()->settings->get_default_description( $post_type_options['position'], '', 'select' ) : '' ),
		'',
		array(
			array(
				'field'      => 'sidebar_1',
				'value'      => '',
				'comparison' => '!=',
			),
		)
	);

	$sidebar_order = explode( ',', Avada()->settings->get( 'responsive_sidebar_order' ) );

	$this->sortable(
		'responsive_sidebar_order',
		esc_attr__( 'Responsive Sidebar Order', 'Avada' ),
		array(
			'content'   => esc_html__( 'Content', 'Avada' ),
			'sidebar'   => esc_html__( 'Sidebar 1', 'Avada' ),
			'sidebar-2' => esc_html__( 'Sidebar 2', 'Avada' ),
		),
		/* translators: Additional description (defaults). */
		sprintf( esc_html__( 'Choose the order of sidebars and main content area on mobile layouts through drag & drop sorting. %s', 'Avada' ), Avada()->settings->get_default_description( 'responsive_sidebar_order', '', 'sortable', 'responsive_sidebar_order' ) ),
		array(),
		$sidebar_order
	);

	$this->select(
		'sidebar_sticky',
		esc_attr__( 'Sticky Sidebars', 'Avada' ),
		array(
			'default'     => esc_attr__( 'Default', 'Avada' ),
			'none'        => esc_attr__( 'None', 'Avada' ),
			'sidebar_one' => esc_attr__( 'Sidebar 1', 'Avada' ),
			'sidebar_two' => esc_attr__( 'Sidebar 2', 'Avada' ),
			'both'        => esc_attr__( 'Both', 'Avada' ),
		),
		/* translators: Additional description (defaults). */
		sprintf( esc_html__( 'Select the sidebar(s) that should remain sticky when scrolling the page. If the sidebar content is taller than the screen, it acts like a normal sidebar until the bottom of the sidebar is within the viewport, which will then remain fixed in place as you scroll down. %s', 'Avada' ), Avada()->settings->get_default_description( 'sidebar_sticky', '', 'select' ) ),
		array(
			array(
				'field'      => 'sidebar_1',
				'value'      => '',
				'comparison' => '!=',
			),
		)
	);
	$ec_sidebar_bg_color = Fusion_Color::new_color(
		array(
			'color'    => Avada()->settings->get( 'ec_sidebar_bg_color' ),
			'fallback' => '#f6f6f6',
		)
	);
	$ec_sidebar_bg_color = $ec_sidebar_bg_color->color;
	$sidebar_bg_color    = Fusion_Color::new_color(
		array(
			'color'    => Avada()->settings->get( 'sidebar_bg_color' ),
			'fallback' => 'rgba(255,255,255,0)',
		)
	);
	$sidebar_bg_color    = $sidebar_bg_color->color;

	$this->color(
		'sidebar_bg_color',
		esc_attr__( 'Sidebar Background Color', 'Avada' ),
		/* translators: Additional description (defaults). */
		sprintf( esc_html__( 'Controls the background color of the sidebar. Hex code, ex: #000. %s', 'Avada' ), ( 'tribe_events' === $post_type ) ? Avada()->settings->get_default_description( 'ec_sidebar_bg_color' ) : Avada()->settings->get_default_description( 'sidebar_bg_color' ) ),
		true,
		array(
			array(
				'field'      => 'sidebar_1',
				'value'      => '',
				'comparison' => '!=',
			),
		),
		( 'tribe_events' === $post_type ) ? $ec_sidebar_bg_color : $sidebar_bg_color
	);
} else {

	/* translators: URL. */
	$message = isset( $post_type_options['global'] ) ? sprintf( __( '<strong>IMPORTANT NOTE:</strong> The <a href="%s" target="_blank">Activate Global Sidebars</a> option is turned on which removes the ability to choose individual sidebars. Turn off that option to assign unique sidebars.', 'Avada' ), Avada()->settings->get_setting_link( $post_type_options['global'] ) ) : __( '<strong>IMPORTANT NOTE:</strong> The Activate Global Sidebars option is turned on which removes the ability to choose individual sidebars. Turn off that option to assign unique sidebars.', 'Avada' );

	$this->raw(
		'sidebar_global_to_enabled',
		'',
		'<div class="fusion-redux-important-notice">' . $message . '</div>'
	);
}

/* Omit closing PHP tag to avoid "Headers already sent" issues. */
