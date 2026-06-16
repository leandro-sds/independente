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
          'add_below' => 'comment',
          'depth'     => $depth,
          'max_depth' => $args['max_depth'],
          'before'    => '<span class="comment-reply">',
          'after'     => '</span>',
        ] ) );
        ?>
      </footer>

    </article>
  <?php
}

// Registro de áreas de widgets
function independent_theme_widgets_init() {
  register_sidebar( [
    'name'          => __( 'Barra Lateral', 'independente' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Widgets na barra lateral', 'independente' ),
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ] );

  register_sidebar( [
    'name'          => __( 'Conteúdo Extra — abaixo do conteúdo', 'independente' ),
    'id'            => 'content-extra',
    'description'   => __( 'Aparece abaixo do conteúdo principal, antes da barra lateral na ordem de leitura. Em telas largas, os widgets ficam lado a lado, ajudando a preencher páginas curtas. Quando vazio, nada é exibido.', 'independente' ),
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 1', 'independente' ),
    'id'            => 'footer-1',
    'description'   => __( 'Primeira coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 2', 'independente' ),
    'id'            => 'footer-2',
    'description'   => __( 'Segunda coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 3', 'independente' ),
    'id'            => 'footer-3',
    'description'   => __( 'Terceira coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 4', 'independente' ),
    'id'            => 'footer-4',
    'description'   => __( 'Quarta coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Faixa Central', 'independente' ),
    'id'            => 'footer-full',
    'description'   => __( 'Área de largura total abaixo das 4 colunas', 'independente' ),
    'before_widget' => '<div class="footer-widget footer-widget--full">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );
}
add_action( 'widgets_init', 'independent_theme_widgets_init' );

/**
 * Conteúdo Extra — região exibida abaixo do conteúdo principal, dentro de <main>.
 *
 * Ordem de leitura garantida pelo DOM: cabeçalho → corpo → conteúdo extra →
 * barra lateral → rodapé. É um landmark "region" (section + aria-label),
 * então usuários de leitor de telas podem saltar direto para ele.
 * Quando a área está vazia, nada é impresso — nenhuma marcação, nenhum espaço.
 */
function independent_content_extra() {
  if ( ! is_active_sidebar( 'content-extra' ) ) {
    return;
  }
  ?>
  <section class="content-extra" aria-label="<?php esc_attr_e( 'Conteúdo extra', 'independente' ); ?>">
    <?php dynamic_sidebar( 'content-extra' ); ?>
  </section>
  <?php
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
    wp_enqueue_style(
      'independent-theme-estilo',
      $theme_uri . '/assets/css/estilos/' . sanitize_file_name( $active_style ) . '.css',
      [ 'independent-theme-style', 'independent-theme-custom', 'independent-theme-responsive' ],
      filemtime( $style_css )
    );
  }

  // Google Fonts: fontes padrão do tema (Inter, Montserrat, Poppins)
  // Carregadas sempre, exceto nos estilos que substituem a tipografia por completo
  $styles_with_own_fonts = [ 'alvorada', 'gospel', 'vintagecafe', 'tintaepapel', 'marinelli' ];
  if ( ! in_array( $active_style, $styles_with_own_fonts, true ) ) {
    wp_enqueue_style(
      'independent-theme-fonts-default',
      'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Montserrat:wght@700;800;900&family=Poppins:wght@400;600;700;800&display=swap',
      [],
      null
    );
  }

  // Google Fonts: carrega apenas quando o estilo ativo precisar
  if ( 'alvorada' === $active_style ) {
    wp_enqueue_style(
      'independent-theme-fonts-alvorada',
      'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400;1,600&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap',
      [],
      null
    );
  }

  if ( 'gospel' === $active_style ) {
    wp_enqueue_style(
      'independent-theme-fonts-gospel',
      'https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700;800&display=swap',
      [],
      null
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

/**
 * Skip-link injetado via hook wp_body_open com estilo inline.
 * Nasce invisível por posicionamento — não depende de CSS externo
 * nem de JavaScript. Ao receber foco via Tab, o CSS o traz à tela.
 */
function independent_theme_skip_link() {
  echo '<a class="skip-link" href="#primary" style="position:fixed!important;top:-200px!important;left:1rem!important;opacity:0!important;pointer-events:none!important;z-index:10000;">';
  echo esc_html__( 'Pular para o conteúdo', 'independente' );
  echo '</a>';
}
add_action( 'wp_body_open', 'independent_theme_skip_link', 1 );

// Customizações via Personalizador
function independent_theme_customize_register( $wp_customize ) {
  // -------------------------------------------------------
  // Logo — Tamanho e Escala (dentro de "Identidade do Site")
  // -------------------------------------------------------
  $logo_section = 'title_tagline';

  // Largura máxima (px)
  $wp_customize->add_setting( 'independent_logo_width', [
    'default'           => 200,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_width', [
    'label'       => __( 'Largura máxima da logo (px)', 'independente' ),
    'description' => __( 'Ex.: 120 = compacta · 200 = padrão · 400 = grande. Intervalo: 40 – 800 px.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 10,
    'input_attrs' => [
      'min'         => 40,
      'max'         => 800,
      'step'        => 1,
      'placeholder' => '200',
    ],
  ] );

  // Altura máxima (px)
  $wp_customize->add_setting( 'independent_logo_height', [
    'default'           => 80,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_height', [
    'label'       => __( 'Altura máxima da logo (px)', 'independente' ),
    'description' => __( 'Ex.: 50 = baixa · 80 = padrão · 160 = alta. Intervalo: 20 – 400 px.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 11,
    'input_attrs' => [
      'min'         => 20,
      'max'         => 400,
      'step'        => 1,
      'placeholder' => '80',
    ],
  ] );

  // Escala adicional (%)
  $wp_customize->add_setting( 'independent_logo_scale', [
    'default'           => 100,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_scale', [
    'label'       => __( 'Escala da logo (%)', 'independente' ),
    'description' => __( '100% = tamanho normal. Aumente para ampliar a logo sem precisar substituir o arquivo.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 12,
    'input_attrs' => [
      'min'         => 50,
      'max'         => 300,
      'step'        => 5,
      'placeholder' => '100',
    ],
  ] );

	// Cabeçalho (autonomia + acessibilidade)
  $wp_customize->add_setting( 'independent_header_layout', [
    'default'           => 'left',
    'sanitize_callback' => 'independent_theme_sanitize_header_layout',
  ] );

  $wp_customize->add_control( 'independent_header_layout', [
    'label'       => __( 'Layout do cabeçalho', 'independente' ),
    'description' => __( 'Dica: "Logo à esquerda" costuma ser o mais previsível. Use "Centralizado" para destaque máximo. "Logo acima" ajuda quando a logo é grande.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'select',
    'choices'     => [
      'left'    => __( 'Logo à esquerda, ações à direita', 'independente' ),
      'center'  => __( 'Centralizado (logo + nome no centro)', 'independente' ),
      'stacked' => __( 'Logo acima do nome (em coluna)', 'independente' ),
    ],
  ] );

  $wp_customize->add_setting( 'independent_header_show_search', [
    'default'           => 1,
    'sanitize_callback' => 'independent_theme_sanitize_checkbox',
  ] );

  $wp_customize->add_control( 'independent_header_show_search', [
    'label'   => __( 'Mostrar busca no cabeçalho', 'independente' ),
    'section' => $logo_section,
    'type'    => 'checkbox',
  ] );


  // Rodapé — Ano de fundação
  $wp_customize->add_section( 'independent_footer_section', [
    'title'    => __( 'Rodapé', 'independente' ),
    'priority' => 38,
  ] );

  $wp_customize->add_setting( 'independent_founding_year', [
    'default'           => '',
    'sanitize_callback' => 'independent_theme_sanitize_founding_year',
  ] );

  $wp_customize->add_control( 'independent_founding_year', [
    'label'       => __( 'Ano de fundação do projeto', 'independente' ),
    'description' => __( 'Se preenchido, o copyright exibirá o intervalo. Ex.: 2013 → © 2013–2026. Deixe em branco para exibir apenas o ano atual.', 'independente' ),
    'section'     => 'independent_footer_section',
    'type'        => 'number',
    'input_attrs' => [
      'min'         => 1900,
      'max'         => (int) gmdate( 'Y' ),
      'step'        => 1,
      'placeholder' => gmdate( 'Y' ),
    ],
  ] );

  // Crédito do desenvolvedor
  $wp_customize->add_setting( 'independent_developer_show', [
    'default'           => true,
    'sanitize_callback' => 'rest_sanitize_boolean',
  ] );

  $wp_customize->add_control( 'independent_developer_show', [
    'label'   => __( 'Exibir crédito do desenvolvedor', 'independente' ),
    'section' => 'independent_footer_section',
    'type'    => 'checkbox',
  ] );

  $wp_customize->add_setting( 'independent_developer_name', [
    'default'           => 'Independent Theme',
    'sanitize_callback' => 'sanitize_text_field',
  ] );

  $wp_customize->add_control( 'independent_developer_name', [
    'label'       => __( 'Nome do desenvolvedor', 'independente' ),
    'description' => __( 'Ex.: João Silva, Agência XYZ. Deixe em branco para ocultar o nome.', 'independente' ),
    'section'     => 'independent_footer_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_developer_url', [
    'default'           => 'https://github.com/leandro-sds/independent-theme',
    'sanitize_callback' => 'esc_url_raw',
  ] );

  $wp_customize->add_control( 'independent_developer_url', [
    'label'       => __( 'URL do desenvolvedor', 'independente' ),
    'description' => __( 'Deixe em branco para exibir o nome sem link.', 'independente' ),
    'section'     => 'independent_footer_section',
    'type'        => 'url',
  ] );

  // Redes sociais
  $wp_customize->add_section( 'independent_social_section', [
    'title'    => __( 'Redes Sociais', 'independente' ),
    'priority' => 40,
  ] );

  // WhatsApp — número com código do país
  $wp_customize->add_setting( 'independent_whatsapp_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_whatsapp_url', [
    'label'       => __( 'WhatsApp', 'independente' ),
    'description' => __( 'Apenas os números com código do país. Ex.: 5544997540049', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Facebook — nome de usuário
  $wp_customize->add_setting( 'independent_facebook_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_facebook_url', [
    'label'       => __( 'Facebook', 'independente' ),
    'description' => __( 'Apenas o nome de usuário. Ex.: radiomaioramoroficial', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Instagram — nome de usuário
  $wp_customize->add_setting( 'independent_instagram_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_instagram_url', [
    'label'       => __( 'Instagram', 'independente' ),
    'description' => __( 'Apenas o nome de usuário. Ex.: radiomaioramoroficial', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // YouTube — nome do canal
  $wp_customize->add_setting( 'independent_youtube_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_youtube_url', [
    'label'       => __( 'YouTube', 'independente' ),
    'description' => __( 'Nome do canal com ou sem @. Ex.: @radiomaioramor', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Hero Section
  $wp_customize->add_section( 'independent_hero_section', [
    'title'    => __( 'Seção de Destaque (Hero)', 'independente' ),
    'priority' => 35,
  ] );

  $wp_customize->add_setting( 'independent_hero_enabled', [
    'default'           => 0,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_enabled', [
    'label'   => __( 'Ativar seção de destaque', 'independente' ),
    'section' => 'independent_hero_section',
    'type'    => 'checkbox',
  ] );

  $wp_customize->add_setting( 'independent_hero_title', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_title', [
    'label'       => __( 'Título', 'independente' ),
    'description' => __( 'Título principal da seção de destaque.', 'independente' ),
    'section'     => 'independent_hero_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_hero_subtitle', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_subtitle', [
    'label'       => __( 'Subtítulo', 'independente' ),
    'description' => __( 'Texto secundário abaixo do título.', 'independente' ),
    'section'     => 'independent_hero_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_hero_button_text', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_button_text', [
    'label'       => __( 'Texto do botão', 'independente' ),
    'description' => __( 'Deixe em branco para não exibir o botão.', 'independente' ),
    'section'     => 'independent_hero_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_hero_button_url', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_button_url', [
    'label'       => __( 'URL do botão', 'independente' ),
    'section'     => 'independent_hero_section',
    'type'        => 'url',
  ] );

  // Estilo visual
  $wp_customize->add_section( 'independent_style_section', [
    'title'    => __( 'Estilo Visual', 'independente' ),
    'priority' => 50,
  ] );

  $wp_customize->add_setting( 'independent_site_style', [
    'default'           => 'default',
    'sanitize_callback' => 'sanitize_text_field',
  ] );

  $wp_customize->add_control( 'independent_site_style', [
    'label'   => __( 'Escolha o estilo do site', 'independente' ),
    'section' => 'independent_style_section',
    'type'    => 'select',
    'choices' => [
      'default'      => __( 'Padrão do Tema', 'independente' ),
      'alvorada'     => __( '🌅 Alvorada – Minimalismo Orgânico', 'independente' ),
      'gospel'       => __( '✨ Gospel – Luz que Rompe', 'independente' ),
      'neonpop'      => __( '🎧 Rádio Jovem – Neon Pop', 'independente' ),
      'vintagecafe'  => __( '📻 Rádio Retrô – Vintage Café', 'independente' ),
      'campoepaixao' => __( '⚽ Site de Futebol – Campo e Paixão', 'independente' ),
      'ceuafe'       => __( '✝️ Site Cristão – Céu e Fé', 'independente' ),
      'tintaepapel'  => __( '✍️ Site para Escritor – Tinta & Papel', 'independente' ),
      'marinelli'    => __( '🏛️ Institucional – Marinelli Drupal', 'independente' ),
      'moderno'      => __( '⚡ Moderno – Vibrante & Contemporâneo', 'independente' ),
      'colorado'     => __( '🔴 Colorado – Vermelho e Branco', 'independente' ),
      'rock'         => __( '🎸 Rock – Preto, Vermelho e Metal', 'independente' ),
      'noitedejogo'  => __( '⚽ Noite de Jogo – Portal Esportivo', 'independente' ),
    ],
  ] );

  // Opção: listar subpáginas
  $wp_customize->add_section( 'independent_pages_section', [
    'title'    => __( 'Páginas', 'independente' ),
    'priority' => 55,
  ] );

  $wp_customize->add_setting( 'independent_listar_subpaginas', [
    'default'           => true,
    'sanitize_callback' => 'independent_theme_sanitize_boolean',
    'transport'         => 'refresh',
  ] );

  $wp_customize->add_control( 'independent_listar_subpaginas', [
    'label'       => __( 'Listar subpáginas', 'independente' ),
    'description' => __( 'Quando ativado, as subpáginas de uma página são listadas abaixo do seu conteúdo.', 'independente' ),
    'section'     => 'independent_pages_section',
    'type'        => 'checkbox',
  ] );

}
add_action( 'customize_register', 'independent_theme_customize_register' );

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
$styles = [

    /*
     * 🎧 Rádio Jovem – Neon Pop
     */
    'neonpop' => [
      '--primary-color'      => '#0d0d1a',   // azul-violeta profundo
      '--bg-light'           => '#07070f',   // fundo ultra escuro
      '--card-bg'            => '#12122a',   // roxo-escuro distinto do fundo
      '--accent-color'       => '#ff2d78',   // magenta neon — energia de rádio jovem
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#00cfff',   // ciano elétrico para links
      '--text-color'         => '#E8E8F8',   // branco levemente azulado
      '--muted-text'         => '#8888aa',
      '--border-color'       => 'rgba(255,45,120,0.20)',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(0,207,255,0.75)',
      '--header-border'      => 'rgba(255,45,120,0.25)',
      '--focus-ring'         => '3px solid #ff2d78',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Montserrat', 'Inter', system-ui, sans-serif",
      '--radius-sm'          => '4px',
      '--radius-md'          => '8px',
      '--radius-lg'          => '12px',
    ],

    /*
     * 📻 Rádio Retrô – Vintage Café
     * card-bg mais claro que primary para distinguir header de conteúdo
     */
    'vintagecafe' => [
      '--primary-color'      => '#2e1a0e',   // marrom escuro — header
      '--bg-light'           => '#f5efe6',   // creme claro — fundo da página
      '--card-bg'            => '#fffaf3',   // quase branco — conteúdo
      '--accent-color'       => '#8B5E1A',   // âmbar escuro — botões
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#7a3e10',   // marrom avermelhado — links legíveis
      '--text-color'         => '#1a0f00',   // marrom quase preto — máxima legibilidade
      '--muted-text'         => '#7a6040',   // marrom médio
      '--border-color'       => 'rgba(139,94,26,0.20)',
      '--header-title-color' => '#F5DEB3',   // creme no header escuro
      '--header-muted'       => 'rgba(245,222,179,0.75)',
      '--header-border'      => 'rgba(212,175,55,0.25)',
      '--focus-ring'         => '3px solid #D4AF37',
      '--font-main'          => "'Georgia', 'Times New Roman', serif",
      '--font-title'         => "'Georgia', serif",
      '--radius-sm'          => '4px',
      '--radius-md'          => '8px',
      '--radius-lg'          => '12px',
    ],

    /*
     * ⚽ Site de Futebol – Campo e Paixão
     * card-bg com contraste claro em relação ao bg-light
     */
    'campoepaixao' => [
      '--primary-color'      => '#0d3318',   // verde escuro — header
      '--bg-light'           => '#edf4ee',   // verde muito claro — fundo da página
      '--card-bg'            => '#ffffff',   // branco — conteúdo
      '--accent-color'       => '#e8a020',   // ouro esportivo — botões e destaques
      '--on-accent'          => '#0a1f0f',   // verde escuro — texto nos botões dourados
      '--link-color'         => '#7a5500',   // marrom-dourado — links legíveis no branco
      '--text-color'         => '#0a1f0f',   // verde quase preto — texto
      '--muted-text'         => '#4a6a52',   // verde acinzentado
      '--border-color'       => 'rgba(13,51,24,0.15)',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(255,255,255,0.80)',
      '--header-border'      => 'rgba(255,255,255,0.18)',
      '--focus-ring'         => '3px solid #e8a020',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Montserrat', 'Inter', system-ui, sans-serif",
      '--radius-sm'          => '6px',
      '--radius-md'          => '10px',
      '--radius-lg'          => '14px',
    ],

    /*
     * ✝️ Site Cristão – Céu e Fé
     */
    'ceuafe' => [
      '--primary-color'      => '#0d2b4a',   // azul profundo — header e rodapé
      '--bg-light'           => '#eaf2fb',   // azul céu claro — fundo da página
      '--card-bg'            => '#ffffff',   // branco — cards e conteúdo
      '--accent-color'       => '#e07b39',   // coral/laranja suave — botões e destaques
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#1a6aaa',   // azul médio — links legíveis
      '--text-color'         => '#1a2535',   // quase preto — máxima legibilidade
      '--muted-text'         => '#4a5e72',   // cinza azulado
      '--border-color'       => 'rgba(13,43,74,0.12)',
      '--header-title-color' => '#ffffff',   // branco no header — mais limpo
      '--header-muted'       => 'rgba(255,255,255,0.75)',
      '--header-border'      => 'rgba(255,255,255,0.15)',
      '--focus-ring'         => '3px solid #e07b39',
      '--font-main'          => "'Inter', 'Roboto', system-ui, sans-serif",
      '--font-title'         => "'Poppins', 'Montserrat', 'Inter', system-ui, sans-serif",
      '--radius-sm'          => '6px',
      '--radius-md'          => '10px',
      '--radius-lg'          => '16px',
    ],

    /*
     * ✍️ Site para Escritor – Tinta & Papel
     * aside com bg distinto do main para separar conteúdo de sidebar
     */
    'tintaepapel' => [
      '--primary-color'      => '#2C3E50',
      '--bg-light'           => '#e8ecf0',
      '--card-bg'            => '#f2f4f6',
      '--accent-color'       => '#8B4513',
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#2C6A9A',
      '--text-color'         => '#1a1a1a',
      '--muted-text'         => '#5c5c52',
      '--border-color'       => '#c8c0b0',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(255,255,255,0.78)',
      '--header-border'      => 'rgba(255,255,255,0.18)',
      '--focus-ring'         => '3px solid #8B4513',
      '--font-main'          => "'Georgia', 'Times New Roman', serif",
      '--font-title'         => "'Georgia', serif",
      '--radius-sm'          => '4px',
      '--radius-md'          => '6px',
      '--radius-lg'          => '10px',
    ],

    /*
     * 🏛️ Institucional – Marinelli Drupal
     * Fiel ao visual clássico do tema Marinelli do Drupal:
     * header azul-aço, fundo branco, cinza claro no aside,
     * tipografia sans-serif limpa, links azul clássico,
     * bordas sutis separando seções. Visual sóbrio e profissional.
     */
    'marinelli' => [
      '--primary-color'      => '#054b81',   // azul-escuro original do Marinelli
      '--bg-light'           => '#dde1e7',   // cinza médio — contraste claro com fundo branco
      '--card-bg'            => '#ffffff',   // branco do conteúdo
      '--accent-color'       => '#f97e05',   // laranja — cor de hover/destaque do Marinelli
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#156aa3',   // azul médio dos links — exato do original
      '--text-color'         => '#333333',   // cor de texto do original
      '--muted-text'         => '#666666',
      '--border-color'       => '#e2e2e2',   // cinza claro das bordas
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(255,255,255,0.85)',
      '--header-border'      => 'rgba(255,255,255,0.15)',
      '--focus-ring'         => '3px solid #f97e05',
      '--font-main'          => '"Helvetica Neue", Arial, Helvetica, sans-serif',
      '--font-title'         => '"Helvetica Neue", Arial, Helvetica, sans-serif',
      '--radius-sm'          => '3px',
      '--radius-md'          => '5px',
      '--radius-lg'          => '5px',
    ],

    /*
     * ⚡ Moderno — Vibrante & Contemporâneo
     * Roxo profundo + ciano elétrico + glassmorphism
     * Gradientes, brilhos, animações com personalidade
     * O que há de mais atual em design web 2026
     */
    'moderno' => [
      '--primary-color'      => '#0f0c29',   // roxo profundo quase preto
      '--bg-light'           => '#0a0818',   // fundo ultra escuro
      '--card-bg'            => '#1a1535',   // roxo escuro para cards
      '--accent-color'       => '#00f5d4',   // ciano elétrico vibrante
      '--on-accent'          => '#0a0818',
      '--link-color'         => '#c77dff',   // violeta claro para links
      '--text-color'         => '#f0eeff',   // branco levemente violeta
      '--muted-text'         => 'rgba(200,180,255,0.70)',
      '--border-color'       => 'rgba(199,125,255,0.20)',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(0,245,212,0.75)',
      '--header-border'      => 'rgba(0,245,212,0.20)',
      '--focus-ring'         => '3px solid #00f5d4',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Montserrat', 'Inter', system-ui, sans-serif",
      '--radius-sm'          => '10px',
      '--radius-md'          => '16px',
      '--radius-lg'          => '24px',
    ],

    /*
     * 🔴 Colorado – Vermelho e Branco
     * Vermelho vibrante (#E8291C) + branco puro — estilo Colorado
     * Header vermelho intenso, conteúdo limpo em branco, energia de estádio.
     */
    'colorado' => [
      '--primary-color'      => '#b01c12',   // vermelho escuro — header e rodapé
      '--bg-light'           => '#fff5f5',   // vermelho levíssimo — fundo da página
      '--card-bg'            => '#ffffff',   // branco puro — conteúdo
      '--accent-color'       => '#E8291C',   // vermelho vibrante do escudo — botões
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#b01c12',   // vermelho escuro — links
      '--text-color'         => '#1a0000',   // quase preto levemente vermelho — texto
      '--muted-text'         => '#7a3530',   // vermelho acinzentado
      '--border-color'       => 'rgba(232,41,28,0.18)',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(255,255,255,0.82)',
      '--header-border'      => 'rgba(255,255,255,0.20)',
      '--focus-ring'         => '3px solid #E8291C',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Montserrat', 'Inter', system-ui, sans-serif",
      '--radius-sm'          => '6px',
      '--radius-md'          => '10px',
      '--radius-lg'          => '14px',
    ],

    'rock' => [
      '--primary-color'      => '#0a0a0a',
      '--bg-light'           => '#111111',
      '--card-bg'            => '#1a1a1a',
      '--accent-color'       => '#cc0000',
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#cc0000',
      '--text-color'         => '#e8e4de',
      '--muted-text'         => '#888880',
      '--border-color'       => '#2a2a2a',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(232,228,222,0.65)',
      '--header-border'      => 'rgba(204,0,0,0.30)',
      '--focus-ring'         => '3px solid #cc0000',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Oswald', 'Barlow Condensed', 'Arial Narrow', Impact, sans-serif",
      '--radius-sm'          => '4px',
      '--radius-md'          => '6px',
      '--radius-lg'          => '8px',
    ],

    /*
     * ⚽ Noite de Jogo — Portal Esportivo
     * Verde noturno de estádio · Verde gramado vibrante · Amarelo de gol
     * Para portais de futebol, placares ao vivo, cobertura de campeonatos
     */
    'noitedejogo' => [
      '--primary-color'      => '#0d1f0f',   // verde noturno — header
      '--bg-light'           => '#141414',   // grafite neutro — fundo da página
      '--card-bg'            => '#1e1e1e',   // grafite — cards e conteúdo
      '--accent-color'       => '#00b140',   // verde gramado vibrante — botões
      '--on-accent'          => '#0a1a0a',   // verde noturno — texto nos botões
      '--link-color'         => '#4dcc70',   // verde médio — links
      '--text-color'         => '#f0f0f0',   // branco neutro — texto principal
      '--muted-text'         => '#888888',   // cinza neutro — texto secundário
      '--border-color'       => '#2a2a2a',   // cinza escuro — bordas
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(255,255,255,0.75)',
      '--header-border'      => 'rgba(0,177,64,0.30)',
      '--focus-ring'         => '3px solid #00b140',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Montserrat', 'Inter', system-ui, sans-serif",
      '--radius-sm'          => '6px',
      '--radius-md'          => '10px',
      '--radius-lg'          => '14px',
    ],

    /*
     * 🌅 Alvorada — Minimalismo Orgânico / Calm Tech Design
     * Verde Oliva · Alabastro · Dourado Champagne
     */
    'alvorada' => [
      '--primary-color'      => '#2C3E2B',   // verde oliva profundo — header
      '--bg-light'           => '#EDEBE4',   // alabastro escurecido — sidebar
      '--card-bg'            => '#FFFFFF',   // branco puro — cards
      '--accent-color'       => '#C9A227',   // dourado champagne — botões e destaques
      '--on-accent'          => '#1E2B1D',   // verde escuro — texto nos botões dourados
      '--link-color'         => '#4A7C59',   // verde suave — links
      '--text-color'         => '#2D2D2D',   // grafite caloroso — texto principal
      '--muted-text'         => '#6B6858',   // bege acinzentado — texto secundário
      '--border-color'       => '#E2DDD4',   // bege claro — bordas
      '--header-title-color' => '#F7F5F0',   // alabastro — título no header
      '--header-muted'       => 'rgba(247,245,240,0.68)',
      '--header-border'      => 'rgba(201,162,39,0.25)',
      '--focus-ring'         => '2px solid #C9A227',
      '--font-main'          => "'Plus Jakarta Sans', 'Inter', system-ui, sans-serif",
      '--font-title'         => "'Playfair Display', 'Lora', Georgia, serif",
      '--radius-sm'          => '8px',
      '--radius-md'          => '14px',
      '--radius-lg'          => '20px',
    ],

    /*
     * ✨ Gospel — Luz que Rompe
     * Midnight Indigo · Dourado Solar · Lilás Divino
     */
    'gospel' => [
      '--primary-color'      => '#07071A',
      '--bg-light'           => '#0D0D2B',
      '--card-bg'            => '#0F0F24',
      '--accent-color'       => '#FFD166',
      '--on-accent'          => '#07071A',
      '--link-color'         => '#A78BFA',
      '--text-color'         => '#F0EFF8',
      '--muted-text'         => '#8B8AA8',
      '--border-color'       => '#1E1E3F',
      '--header-title-color' => '#F0EFF8',
      '--header-muted'       => 'rgba(240,239,248,0.65)',
      '--header-border'      => 'rgba(255,209,102,0.20)',
      '--focus-ring'         => '2px solid #FFD166',
      '--font-main'          => "'Inter', system-ui, sans-serif",
      '--font-title'         => "'Raleway', system-ui, sans-serif",
      '--radius-sm'          => '8px',
      '--radius-md'          => '14px',
      '--radius-lg'          => '20px',
    ],

  ];

  $css_vars = [
    '--logo-max-width'  => $logo_width . 'px',
    '--logo-max-height' => $logo_height . 'px',
    '--logo-scale'      => rtrim( rtrim( number_format( max( 0.5, min( 3.0, $logo_scale_decimal ) ), 3, '.', '' ), '0' ), '.' ),
  ];

  if ( 'default' !== $style && isset( $styles[ $style ] ) ) {
    $css_vars = array_merge( $css_vars, $styles[ $style ] );
  }

  $out = ':root{';
  foreach ( $css_vars as $var => $value ) {
    // $var é controlado pelo tema, $value é sanitizado acima.
    $out .= $var . ':' . $value . ';';
  }
  $out .= '}';

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
