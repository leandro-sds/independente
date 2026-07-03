<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}



/**
 * Callback de comentário individual
 * Estrutura acessível e semântica
 */
function independent_theme_comment( $comment, $args, $depth ) {
  $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
  ?>
  <<?php echo esc_attr( $tag ); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( [ 'comment-item' ], $comment ); ?>>

    <article class="comment-body">

      <header class="comment-meta">
        <div class="comment-author-avatar">
          <?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>
        <div class="comment-author-info">
          <span class="comment-author-name"><?php comment_author_link( $comment ); ?></span>
          <time class="comment-date" datetime="<?php comment_time( 'c' ); ?>">
            <?php echo esc_html( get_comment_date( '', $comment ) ); ?>
          </time>
        </div>
      </header>

      <?php if ( '0' === $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation">
          <?php esc_html_e( 'Seu comentário está aguardando moderação.', 'independente' ); ?>
        </p>
      <?php endif; ?>

      <div class="comment-content">
        <?php comment_text(); ?>
      </div>

      <footer class="comment-footer">
        <?php
        comment_reply_link( array_merge( $args, [
          'add_below'  => 'comment',
          'depth'      => $depth,
          'max_depth'  => $args['max_depth'],
          'before'     => '<span class="comment-reply">',
          'reply_text' => __('Responder <span>&darr;</span>', 'independente'),
          'after'      => '</span>',
        ] ) );
        ?>
      </footer>

    </article>
  <?php
}








/**
 * Skip-link injetado via hook wp_body_open com estilo inline.
 * Nasce invisível por posicionamento — não depende de CSS externo
 * nem de JavaScript. Ao receber foco via Tab, o CSS o traz à tela.
 */
function independent_theme_skip_link() {
  echo '<a class="skip-link" href="#primary">';
  echo esc_html__( 'Pular para o conteúdo', 'independente' );
  echo '</a>';
}
add_action( 'wp_body_open', 'independent_theme_skip_link', 1 );







/**
 * Sanitiza o ano de fundação: deve ser inteiro entre 1900 e o ano atual.
 */
function independent_theme_sanitize_founding_year( $value ) {
  $value = absint( $value );
  $current = (int) gmdate( 'Y' );
  if ( $value >= 1900 && $value <= $current ) {
    return $value;
  }
  return '';
}





/**
 * Sanitiza o layout do cabeçalho: aceita apenas valores permitidos.
 */
function independent_theme_sanitize_header_layout( $value ) {
  $allowed = [ 'left', 'center', 'stacked' ];
  return in_array( $value, $allowed, true ) ? $value : 'left';
}





/**
 * Sanitiza checkbox retornando 0 ou 1.
 */
function independent_theme_sanitize_checkbox( $value ) {
  return $value ? 1 : 0;
}





/**
 * Sanitiza valor booleano.
 */
function independent_theme_sanitize_boolean( $value ) {
  return (bool) $value;
}




// Adiciona classe ao body com base no estilo
function independent_theme_body_class( $classes ) {
  $style = get_theme_mod( 'independent_site_style', 'default' );
  // Sempre adiciona a classe de estilo — inclusive 'style-default'.
  // Isso garante que body.style-default dispare as regras CSS dedicadas.
  $classes[] = 'style-' . sanitize_html_class( $style );

  $layout = get_theme_mod( 'independent_header_layout', 'left' );
  $classes[] = 'header-layout-' . sanitize_html_class( $layout );

  // Quando não há widgets na sidebar, main ocupa 100% da largura
  if ( ! is_active_sidebar( 'sidebar-1' ) ) {
    $classes[] = 'no-sidebar';
  }

  return $classes;
}
add_filter( 'body_class', 'independent_theme_body_class' );





// Personaliza a classe da logo (mantém compatibilidade)
add_filter( 'get_custom_logo', function ( $html ) {
  return str_replace( 'class="custom-logo"', 'class="custom-logo ls-logo"', $html );
} );




// Personaliza o resumo dos posts
// Resumo dos posts
add_filter( 'excerpt_length', function () {
  return 25;
} );





add_filter( 'excerpt_more', function () {
  return '...';
} );





// Remove o prefixo "Categoria:" do título da página de categoria
add_filter( 'get_the_archive_title', function ( $title ) {
  if ( is_category() ) {
    $title = single_cat_title( '', false );
  }
  return $title;
} );





/**
 * Link "Voltar" seguro (evita javascript:history.back).
 */
function independent_back_link() {
  if ( is_front_page() ) {
    return;
  }

  $referer = wp_get_referer();
  $url     = ( $referer && wp_validate_redirect( $referer, '' ) ) ? $referer : home_url( '/' );

  echo '<nav class="back-link" aria-label="' . esc_attr__( 'Navegação de retorno', 'independente' ) . '">';
  echo '<a href="' . esc_url( $url ) . '">' . esc_html__( '← Voltar', 'independente' ) . '</a>';
  echo '</nav>';
}






/**
 * Exibe categorias filhas na página de categoria, similar à lista de subpáginas.
 * - Se a categoria atual tiver filhas: mostra as filhas.
 * - Se não tiver filhas e for uma filha: mostra as irmãs (outras filhas do mesmo pai).
 */
function independent_render_category_children() {
  if ( ! is_category() ) {
    return false;
  }

  $term = get_queried_object();
  if ( ! $term || empty( $term->term_id ) ) {
    return false;
  }

  $parent_id = (int) $term->term_id;

  $children = get_categories( [
    'taxonomy'   => 'category',
    'parent'     => $parent_id,
    'hide_empty' => false,
    'orderby'    => 'term_order',
    'order'      => 'ASC',
  ] );

  // Se não houver subcategorias filhas, não mostra nada — lista os posts normalmente
  if ( empty( $children ) ) {
    return false;
  }

  echo '<section class="child-pages child-categories" aria-label="' . esc_attr__( 'Seções', 'independente' ) . '">';
  echo '<h2 class="child-pages-title">' . esc_html__( 'Seções', 'independente' ) . '</h2>';
  echo '<ul class="child-page-list">';

  foreach ( $children as $cat ) {
    $is_current = (int) $cat->term_id === (int) $term->term_id;
    $class      = $is_current ? ' class="is-current"' : '';

    echo '<li' . $class . '>';
    echo '<a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a>';
    echo '</li>';
  }

  echo '</ul>';
  echo '</section>';

  return true;
}




/**
 * Aviso no painel admin: orienta o usuário sobre classes CSS em itens de menu.
 * Aparece apenas na tela de Menus (nav-menus.php).
 */
function independent_theme_admin_menu_notice() {
  $screen = get_current_screen();
  if ( ! $screen || 'nav-menus' !== $screen->id ) {
    return;
  }
  echo '<div class="notice notice-info is-dismissible">';
  echo '<p><strong>' . esc_html__( 'Independent Theme — Dica de Menu', 'independente' ) . '</strong><br>';
  echo esc_html__( 'Para destacar um item de menu como botão, adicione a classe CSS "btn-primary" ou "btn-secondary" no campo de classes CSS do item (Opções de tela → marque "Classes CSS").', 'independente' );
  echo '</p></div>';
}
add_action( 'admin_notices', 'independent_theme_admin_menu_notice' );