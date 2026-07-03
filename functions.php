<?php
/**
 * Independent Theme functions and definitions
 *
 * Foco: leveza, segurança e responsividade.
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}


/**
 * Define a largura máxima do conteúdo incorporado (embeds, iframes, vídeos).
 * Não afeta o layout — apenas informa ao WordPress o espaço disponível.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 860;
}


$includes = array(
    'inc/sidebar.php',
    'inc/widgets.php',
    'inc/customizer.php',
    'inc/functions.php',
    'inc/custom-style.php',
    'inc/scripts.php',
);

foreach ( $includes as $file ) {
    locate_template( $file, true, true );
}





function independent_theme_setup() {
  load_theme_textdomain( 'independente', get_template_directory() . '/languages' );

  add_theme_support( 'title-tag' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'automatic-feed-links' );

  add_theme_support( 'custom-logo', [
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
  ] );

  add_theme_support( 'html5', [ 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ] );
  add_theme_support( 'align-wide' );
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'wp-block-styles' );
  add_theme_support( 'editor-styles' );

  add_editor_style( 'assets/css/editor-style.css' );

  register_nav_menus( [
    'main-menu' => __( 'Menu Principal', 'independente' ),
  ] );
}
add_action( 'after_setup_theme', 'independent_theme_setup' );