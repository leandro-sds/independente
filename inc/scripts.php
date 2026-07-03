<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}



// Enfileiramento de scripts e estilos (com versionamento por filemtime)
function independent_theme_scripts() {
  $theme_uri  = get_template_directory_uri();
  $theme_path = get_template_directory();

  wp_enqueue_style(
    'independent-theme-style',
    get_stylesheet_uri(),
    [],
    file_exists( get_stylesheet_directory() . '/style.css' ) ? filemtime( get_stylesheet_directory() . '/style.css' ) : null
  );

  $custom_css = $theme_path . '/assets/css/custom.css';
  if ( file_exists( $custom_css ) ) {
    wp_enqueue_style(
      'independent-theme-custom',
      $theme_uri . '/assets/css/custom.css',
      [ 'independent-theme-style' ],
      filemtime( $custom_css )
    );
  }

  $responsive_css = $theme_path . '/assets/css/responsive.css';
  if ( file_exists( $responsive_css ) ) {
    wp_enqueue_style(
      'independent-theme-responsive',
      $theme_uri . '/assets/css/responsive.css',
      [ 'independent-theme-style', 'independent-theme-custom' ],
      filemtime( $responsive_css )
    );
  }

  // Carrega apenas o CSS do estilo ativo — o usuário não baixa CSS de outros estilos
  $active_style = get_theme_mod( 'independent_site_style', 'default' );
  $style_css    = $theme_path . '/assets/css/estilos/' . sanitize_file_name( $active_style ) . '.css';
  if ( file_exists( $style_css ) ) {
    // A versão combina o nome do estilo + a data do arquivo. Assim, ao TROCAR
    // de estilo, a versão muda e o navegador é forçado a buscar o CSS certo
    // (evita que o CSS de um estilo anterior fique em cache e "vaze" cores).
    $style_version = $active_style . '-' . filemtime( $style_css );
    wp_enqueue_style(
      'independent-theme-estilo',
      $theme_uri . '/assets/css/estilos/' . sanitize_file_name( $active_style ) . '.css',
      [ 'independent-theme-style', 'independent-theme-custom', 'independent-theme-responsive' ],
      $style_version
    );
  }

  // Fontes locais (self-hosted) — todas as famílias usadas pelos estilos visuais.
  // Carregadas do próprio tema (não do CDN do Google) para respeitar a
  // privacidade do visitante e cumprir as diretrizes do WordPress.org.
  // O navegador só baixa os arquivos .woff2 dos pesos realmente usados na página.
  $fonts_css = $theme_path . '/assets/css/fonts.css';
  if ( file_exists( $fonts_css ) ) {
    wp_enqueue_style(
      'independent-theme-fonts',
      $theme_uri . '/assets/css/fonts.css',
      [],
      filemtime( $fonts_css )
    );
  }

  $custom_js = $theme_path . '/assets/js/custom.js';
  if ( file_exists( $custom_js ) ) {
    wp_enqueue_script(
      'independent-theme-script',
      $theme_uri . '/assets/js/custom.js',
      [],
      filemtime( $custom_js ),
      true
    );
  }

  // Script de resposta a comentários — obrigatório em páginas singulares com comentários abertos
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
  }
}
add_action( 'wp_enqueue_scripts', 'independent_theme_scripts' );
