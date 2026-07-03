<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}


// Aplica estilo visual e tamanho da logo via variáveis CSS
function independent_theme_custom_style() {
  $style       = get_theme_mod( 'independent_site_style', 'default' );
  // Tamanho padrão da logo
  // O usuário pode ajustar livremente no Personalizador
  $logo_width  = absint( get_theme_mod( 'independent_logo_width', 200 ) );
  $logo_height = absint( get_theme_mod( 'independent_logo_height', 80 ) );
  $logo_scale  = absint( get_theme_mod( 'independent_logo_scale', 100 ) );

  // Limites mínimo e máximo
  $logo_width  = max( 40, min( 800, $logo_width ) );
  $logo_height = max( 20, min( 400, $logo_height ) );
  $logo_scale  = max( 50, min( 300, $logo_scale ) );
  $logo_scale_decimal = round( $logo_scale / 100, 3 ); // ex: 100 → 1.0, 140 → 1.4

  $css_vars = [
    '--logo-max-width'  => $logo_width . 'px',
    '--logo-max-height' => $logo_height . 'px',
    '--logo-scale'      => rtrim( rtrim( number_format( max( 0.5, min( 3.0, $logo_scale_decimal ) ), 3, '.', '' ), '0' ), '.' ),
  ];

  $out = ':root{';
  foreach ( $css_vars as $var => $value ) {
    // $var é controlado pelo tema, $value é sanitizado acima.
    $out .= $var . ':' . $value . ';';
  }
  $out .= '}';

  /* Reforço de robustez: imprime AQUI, inline no <head>, as variáveis de cor
     do estilo ativo, lendo-as do arquivo assets/css/estilos/NOME.css.
     Os arquivos .css continuam sendo a FONTE ÚNICA (editamos lá); este bloco
     apenas ECOA o que está lá, garantindo que as cores do estilo apareçam
     mesmo que o arquivo externo não carregue (cache, ordem de carregamento,
     ou leitura intermitente da configuração). Não há duplicação de manutenção:
     o valor vem sempre do arquivo do estilo. */
  $active_style = sanitize_file_name( get_theme_mod( 'independent_site_style', 'default' ) );
  $style_file   = get_template_directory() . '/assets/css/estilos/' . $active_style . '.css';
  if ( $active_style && file_exists( $style_file ) ) {
    $css_content = file_get_contents( $style_file );
    // Extrai o primeiro bloco "body.style-NOME { ... }" (onde ficam as variáveis)
    if ( preg_match( '/body\.style-' . preg_quote( $active_style, '/' ) . '\s*\{([^}]*)\}/', $css_content, $m ) ) {
      // Mantém só as linhas de variáveis (--algo: valor;) por segurança
      preg_match_all( '/(--[\w-]+)\s*:\s*([^;]+);/', $m[1], $vars, PREG_SET_ORDER );
      if ( ! empty( $vars ) ) {
        $out .= 'body.style-' . $active_style . '{';
        foreach ( $vars as $v ) {
          $out .= $v[1] . ':' . trim( $v[2] ) . ';';
        }
        $out .= '}';
      }
    }
  }

  echo '<style id="independent-theme-vars">' . $out . '</style>';
}
add_action( 'wp_head', 'independent_theme_custom_style' );







/**
 * Injeta CSS de normalização DEPOIS dos estilos do Gutenberg/plugins (priority 999).
 * Isso garante que o menu e outros elementos do tema não sejam sobrescritos.
 */
function independent_theme_late_style() {
  ?>
  <style id="independent-theme-late">
    /* Menu: remove tap-highlight em mobile (estético, não afeta acessibilidade) */
    .primary-nav .menu a,
    .primary-nav .menu li > a {
      -webkit-tap-highlight-color: transparent;
    }
    /* Suprime outline padrão apenas quando NÃO é navegação por teclado */
    .primary-nav .menu a:focus:not(:focus-visible),
    .primary-nav .menu li > a:focus:not(:focus-visible) {
      outline: none !important;
      box-shadow: none !important;
    }
    /* Foco por teclado (Tab): indicador visual obrigatório — WCAG 2.4.7 */
    .primary-nav .menu a:focus-visible,
    .primary-nav .menu li > a:focus-visible {
      outline: 3px solid var(--accent-color) !important;
      outline-offset: 2px !important;
      box-shadow: 0 0 0 5px rgba(0,0,0,0.15) !important;
      border-radius: 4px !important;
    }
    /* Busca no cabeçalho: campo e botão mesma altura */
    .header-search .search-form { align-items: center !important; }
    .header-search .search-form .search-field,
    .header-search .search-form .search-submit { height: 44px !important; box-sizing: border-box !important; }

    /* Logo: respeita valores do Personalizador */
    .logo img,
    img.custom-logo,
    .custom-logo {
      width: calc(var(--logo-max-width) * var(--logo-scale)) !important;
      height: calc(var(--logo-max-height) * var(--logo-scale)) !important;
      max-width: min(calc(var(--logo-max-width) * var(--logo-scale)), 90vw) !important;
      max-height: min(calc(var(--logo-max-height) * var(--logo-scale)), 35vh) !important;
      object-fit: contain !important;
    }

    /* Moderno: título h1 em ciano vibrante — compatível com todos os browsers */
    body.style-moderno h1,
    body.style-moderno h1.entry-title,
    body.style-moderno .entry-title {
      color: #00f5d4 !important;
      -webkit-text-fill-color: #00f5d4 !important;
      background: none !important;
      background-clip: unset !important;
      -webkit-background-clip: unset !important;
    }
  </style>
  <?php
}
add_action( 'wp_head', 'independent_theme_late_style', 999 );