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
 * Atualização automática via GitHub
 * Verifica releases e notifica o painel do WordPress
 */
function independent_theme_check_update( $transient ) {
  if ( empty( $transient->checked ) ) {
    return $transient;
  }

  $theme_slug  = 'independent-theme';
  $github_user = 'leandro-sds';
  $github_repo = 'independent-theme';
  $current     = wp_get_theme( $theme_slug );
  $current_ver = $current->get( 'Version' );

  $api_url  = "https://api.github.com/repos/{$github_user}/{$github_repo}/releases/latest";
  $response = wp_remote_get( $api_url, [
    'timeout'    => 10,
    'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
  ] );

  if ( is_wp_error( $response ) ) return $transient;

  $data = json_decode( wp_remote_retrieve_body( $response ) );

  if ( empty( $data->tag_name ) ) return $transient;

  $latest_ver = ltrim( $data->tag_name, 'v' );

  if ( version_compare( $current_ver, $latest_ver, '<' ) ) {
    $zip_url = "https://github.com/{$github_user}/{$github_repo}/releases/download/{$data->tag_name}/independent-theme-{$latest_ver}.zip";
    $transient->response[ $theme_slug ] = [
      'theme'       => $theme_slug,
      'new_version' => $latest_ver,
      'url'         => "https://github.com/{$github_user}/{$github_repo}",
      'package'     => $zip_url,
      'requires'    => '6.0',
      'requires_php'=> '7.4',
    ];
  }

  return $transient;
}
add_filter( 'pre_set_site_transient_update_themes', 'independent_theme_check_update' );

/**
 * Exibe informações da versão mais recente na tela de detalhes do tema
 */
function independent_theme_update_details( $false, $action, $args ) {
  if ( $action !== 'theme_information' ) return $false;
  if ( ! isset( $args->slug ) || $args->slug !== 'independent-theme' ) return $false;

  $response = wp_remote_get( 'https://api.github.com/repos/leandro-sds/independent-theme/releases/latest', [
    'timeout'    => 10,
    'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' ),
  ] );

  if ( is_wp_error( $response ) ) return $false;

  $data = json_decode( wp_remote_retrieve_body( $response ) );
  if ( empty( $data->tag_name ) ) return $false;

  $latest_ver = ltrim( $data->tag_name, 'v' );

  return (object) [
    'name'          => 'Independent Theme',
    'slug'          => 'independent-theme',
    'version'       => $latest_ver,
    'author'        => 'Leandro Souza',
    'homepage'      => 'https://github.com/leandro-sds/independent-theme',
    'requires'      => '6.0',
    'requires_php'  => '7.4',
    'last_updated'  => $data->published_at ?? '',
    'sections'      => [
      'description' => $data->body ?? 'Tema WordPress acessível com 8 estilos visuais únicos.',
    ],
    'download_link' => "https://github.com/leandro-sds/independent-theme/releases/download/{$data->tag_name}/independent-theme-{$latest_ver}.zip",
  ];
}
add_filter( 'themes_api', 'independent_theme_update_details', 10, 3 );


/**
 * Define a largura máxima do conteúdo incorporado (embeds, iframes, vídeos).
 * Não afeta o layout — apenas informa ao WordPress o espaço disponível.
 */
if ( ! isset( $content_width ) ) {
  $content_width = 860;
}








function independent_theme_setup() {
  load_theme_textdomain( 'independent-theme', get_template_directory() . '/languages' );

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
    'main-menu' => __( 'Menu Principal', 'independent-theme' ),
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
          <?php esc_html_e( 'Seu comentário está aguardando moderação.', 'independent-theme' ); ?>
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
    'name'          => __( 'Barra Lateral', 'independent-theme' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Widgets na barra lateral', 'independent-theme' ),
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé', 'independent-theme' ),
    'id'            => 'footer-1',
    'description'   => __( 'Widgets no rodapé', 'independent-theme' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );
}
add_action( 'widgets_init', 'independent_theme_widgets_init' );

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
}
add_action( 'wp_enqueue_scripts', 'independent_theme_scripts' );

/**
 * Skip-link injetado via hook wp_body_open com estilo inline.
 * Nasce invisível por posicionamento — não depende de CSS externo
 * nem de JavaScript. Ao receber foco via Tab, o CSS o traz à tela.
 */
function independent_theme_skip_link() {
  echo '<a class="skip-link" href="#primary" style="position:fixed!important;top:-200px!important;left:1rem!important;opacity:0!important;pointer-events:none!important;z-index:10000;">';
  echo esc_html__( 'Pular para o conteúdo', 'independent-theme' );
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
    'default'           => 320,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_width', [
    'label'       => __( 'Largura máxima da logo (px)', 'independent-theme' ),
    'description' => __( 'Ex.: 200 = compacta · 320 = padrão · 500 = grande. Intervalo: 40 – 800 px.', 'independent-theme' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 10,
    'input_attrs' => [
      'min'         => 40,
      'max'         => 800,
      'step'        => 1,
      'placeholder' => '320',
    ],
  ] );

  // Altura máxima (px)
  $wp_customize->add_setting( 'independent_logo_height', [
    'default'           => 160,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_height', [
    'label'       => __( 'Altura máxima da logo (px)', 'independent-theme' ),
    'description' => __( 'Ex.: 80 = baixa · 160 = padrão · 260 = alta. Intervalo: 20 – 400 px.', 'independent-theme' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 11,
    'input_attrs' => [
      'min'         => 20,
      'max'         => 400,
      'step'        => 1,
      'placeholder' => '160',
    ],
  ] );

  // Escala adicional (%)
  $wp_customize->add_setting( 'independent_logo_scale', [
    'default'           => 100,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_scale', [
    'label'       => __( 'Escala da logo (%)', 'independent-theme' ),
    'description' => __( '100% = tamanho normal. Aumente para ampliar a logo sem precisar substituir o arquivo.', 'independent-theme' ),
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
    'sanitize_callback' => function ( $value ) {
      $allowed = [ 'left', 'center', 'stacked' ];
      return in_array( $value, $allowed, true ) ? $value : 'left';
    },
  ] );

  $wp_customize->add_control( 'independent_header_layout', [
    'label'       => __( 'Layout do cabeçalho', 'independent-theme' ),
    'description' => __( 'Dica: "Logo à esquerda" costuma ser o mais previsível. Use "Centralizado" para destaque máximo. "Logo acima" ajuda quando a logo é grande.', 'independent-theme' ),
    'section'     => $logo_section,
    'type'        => 'select',
    'choices'     => [
      'left'    => __( 'Logo à esquerda, ações à direita', 'independent-theme' ),
      'center'  => __( 'Centralizado (logo + nome no centro)', 'independent-theme' ),
      'stacked' => __( 'Logo acima do nome (em coluna)', 'independent-theme' ),
    ],
  ] );

  $wp_customize->add_setting( 'independent_header_show_search', [
    'default'           => 1,
    'sanitize_callback' => function ( $v ) { return $v ? 1 : 0; },
  ] );

  $wp_customize->add_control( 'independent_header_show_search', [
    'label'   => __( 'Mostrar busca no cabeçalho', 'independent-theme' ),
    'section' => $logo_section,
    'type'    => 'checkbox',
  ] );


  // Rodapé — Ano de fundação
  $wp_customize->add_section( 'independent_footer_section', [
    'title'    => __( 'Rodapé', 'independent-theme' ),
    'priority' => 38,
  ] );

  $wp_customize->add_setting( 'independent_founding_year', [
    'default'           => '',
    'sanitize_callback' => 'independent_theme_sanitize_founding_year',
  ] );

  $wp_customize->add_control( 'independent_founding_year', [
    'label'       => __( 'Ano de fundação do projeto', 'independent-theme' ),
    'description' => __( 'Se preenchido, o copyright exibirá o intervalo. Ex.: 2013 → © 2013–2026. Deixe em branco para exibir apenas o ano atual.', 'independent-theme' ),
    'section'     => 'independent_footer_section',
    'type'        => 'number',
    'input_attrs' => [
      'min'         => 1900,
      'max'         => (int) gmdate( 'Y' ),
      'step'        => 1,
      'placeholder' => gmdate( 'Y' ),
    ],
  ] );

  // Redes sociais
  $wp_customize->add_section( 'independent_social_section', [
    'title'    => __( 'Redes Sociais', 'independent-theme' ),
    'priority' => 40,
  ] );

  // WhatsApp — número com código do país
  $wp_customize->add_setting( 'independent_whatsapp_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_whatsapp_url', [
    'label'       => __( 'WhatsApp', 'independent-theme' ),
    'description' => __( 'Apenas os números com código do país. Ex.: 5544997540049', 'independent-theme' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Facebook — nome de usuário
  $wp_customize->add_setting( 'independent_facebook_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_facebook_url', [
    'label'       => __( 'Facebook', 'independent-theme' ),
    'description' => __( 'Apenas o nome de usuário. Ex.: radiomaioramoroficial', 'independent-theme' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Instagram — nome de usuário
  $wp_customize->add_setting( 'independent_instagram_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_instagram_url', [
    'label'       => __( 'Instagram', 'independent-theme' ),
    'description' => __( 'Apenas o nome de usuário. Ex.: radiomaioramoroficial', 'independent-theme' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // YouTube — nome do canal
  $wp_customize->add_setting( 'independent_youtube_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_youtube_url', [
    'label'       => __( 'YouTube', 'independent-theme' ),
    'description' => __( 'Nome do canal com ou sem @. Ex.: @radiomaioramor', 'independent-theme' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Hero Section
  $wp_customize->add_section( 'independent_hero_section', [
    'title'    => __( 'Seção de Destaque (Hero)', 'independent-theme' ),
    'priority' => 35,
  ] );

  $wp_customize->add_setting( 'independent_hero_enabled', [
    'default'           => 0,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_enabled', [
    'label'   => __( 'Ativar seção de destaque', 'independent-theme' ),
    'section' => 'independent_hero_section',
    'type'    => 'checkbox',
  ] );

  $wp_customize->add_setting( 'independent_hero_title', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_title', [
    'label'       => __( 'Título', 'independent-theme' ),
    'description' => __( 'Título principal da seção de destaque.', 'independent-theme' ),
    'section'     => 'independent_hero_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_hero_subtitle', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_subtitle', [
    'label'       => __( 'Subtítulo', 'independent-theme' ),
    'description' => __( 'Texto secundário abaixo do título.', 'independent-theme' ),
    'section'     => 'independent_hero_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_hero_button_text', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_button_text', [
    'label'       => __( 'Texto do botão', 'independent-theme' ),
    'description' => __( 'Deixe em branco para não exibir o botão.', 'independent-theme' ),
    'section'     => 'independent_hero_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_hero_button_url', [
    'default'           => '',
    'sanitize_callback' => 'esc_url_raw',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_hero_button_url', [
    'label'       => __( 'URL do botão', 'independent-theme' ),
    'section'     => 'independent_hero_section',
    'type'        => 'url',
  ] );

  // Estilo visual
  $wp_customize->add_section( 'independent_style_section', [
    'title'    => __( 'Estilo Visual', 'independent-theme' ),
    'priority' => 50,
  ] );

  $wp_customize->add_setting( 'independent_site_style', [
    'default'           => 'default',
    'sanitize_callback' => 'sanitize_text_field',
  ] );

  $wp_customize->add_control( 'independent_site_style', [
    'label'   => __( 'Escolha o estilo do site', 'independent-theme' ),
    'section' => 'independent_style_section',
    'type'    => 'select',
    'choices' => [
      'default'      => __( 'Padrão do Tema', 'independent-theme' ),
      'neonpop'      => __( '🎧 Rádio Jovem – Neon Pop', 'independent-theme' ),
      'vintagecafe'  => __( '📻 Rádio Retrô – Vintage Café', 'independent-theme' ),
      'campoepaixao' => __( '⚽ Site de Futebol – Campo e Paixão', 'independent-theme' ),
      'ceuafe'       => __( '✝️ Site Cristão – Céu e Fé', 'independent-theme' ),
      'tintaepapel'  => __( '✍️ Site para Escritor – Tinta & Papel', 'independent-theme' ),
      'marinelli'    => __( '🏛️ Institucional – Marinelli Drupal', 'independent-theme' ),
      'moderno'      => __( '⚡ Moderno – Vibrante & Contemporâneo', 'independent-theme' ),
      'colorado'     => __( '🔴 Colorado – Vermelho e Branco', 'independent-theme' ),
    ],
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

// Aplica estilo visual e tamanho da logo via variáveis CSS
function independent_theme_custom_style() {
  $style       = get_theme_mod( 'independent_site_style', 'default' );
  // Padrões maiores por acessibilidade (o usuário pode reduzir no Personalizador)
  $logo_width  = absint( get_theme_mod( 'independent_logo_width', 320 ) );
  $logo_height = absint( get_theme_mod( 'independent_logo_height', 160 ) );
  $logo_scale  = absint( get_theme_mod( 'independent_logo_scale', 100 ) );

  // Limites de segurança para evitar que um valor absurdo quebre o layout
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
      '--bg-light'           => '#f0f7f1',   // verde muito claro — fundo da página
      '--card-bg'            => '#ffffff',   // branco — conteúdo
      '--accent-color'       => '#cc0000',   // vermelho forte — botões e destaques
      '--on-accent'          => '#ffffff',
      '--link-color'         => '#0d5c28',   // verde médio — links legíveis
      '--text-color'         => '#0a1f0f',   // verde quase preto — texto
      '--muted-text'         => '#4a6a52',   // verde acinzentado
      '--border-color'       => 'rgba(13,51,24,0.15)',
      '--header-title-color' => '#ffffff',
      '--header-muted'       => 'rgba(255,255,255,0.80)',
      '--header-border'      => 'rgba(255,255,255,0.18)',
      '--focus-ring'         => '3px solid #cc0000',
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
      '--bg-light'           => '#ede8dd',
      '--card-bg'            => '#fdfaf4',
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
    /* Menu: sem outline em nenhum browser */
    .primary-nav .menu a,
    .primary-nav .menu li > a {
      -webkit-tap-highlight-color: transparent;
      outline: 0 !important;
      outline-width: 0 !important;
      outline-offset: 0 !important;
      outline-color: transparent !important;
      outline-style: none !important;
    }
    .primary-nav .menu a:focus,
    .primary-nav .menu li > a:focus {
      outline: 0 !important;
      outline-width: 0 !important;
      outline-offset: 0 !important;
      box-shadow: none !important;
    }
    /* Apenas teclado (Tab) recebe indicador visual */
    .primary-nav .menu a:focus-visible,
    .primary-nav .menu li > a:focus-visible {
      outline: 0 !important;
      box-shadow: 0 0 0 2px var(--accent-color) !important;
    }
    /* Busca: campo e botão mesma altura */
    .header-search-form { align-items: stretch !important; }
    .header-search-form .search-field,
    .header-search-form .search-submit { height: 44px !important; box-sizing: border-box !important; }

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
  if ( 'default' !== $style ) {
    $classes[] = 'style-' . sanitize_html_class( $style );
  }

  $layout = get_theme_mod( 'independent_header_layout', 'left' );
  $classes[] = 'header-layout-' . sanitize_html_class( $layout );

  return $classes;
}
add_filter( 'body_class', 'independent_theme_body_class' );

// Personaliza a classe da logo (mantém compatibilidade)
add_filter( 'get_custom_logo', function ( $html ) {
  return str_replace( 'class="custom-logo"', 'class="custom-logo ls-logo"', $html );
} );

// Personaliza o resumo dos posts
add_filter( 'excerpt_length', function () {
  return 15;
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

// Otimizações de segurança e performance (WP Head)
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

/**
 * Link "Voltar" seguro (evita javascript:history.back).
 */
function independent_back_link() {
  if ( is_front_page() ) {
    return;
  }

  $referer = wp_get_referer();
  $url     = $referer ? $referer : home_url( '/' );

  echo '<div class="back-link">';
  echo '<a href="' . esc_url( $url ) . '">' . esc_html__( '← Voltar', 'independent-theme' ) . '</a>';
  echo '</div>';
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
    'orderby'    => 'name',
    'order'      => 'ASC',
  ] );

  // Se não houver filhas, tenta mostrar irmãs (categorias do mesmo pai)
  if ( empty( $children ) && ! empty( $term->parent ) ) {
    $children = get_categories( [
      'taxonomy'   => 'category',
      'parent'     => (int) $term->parent,
      'hide_empty' => false,
      'orderby'    => 'name',
      'order'      => 'ASC',
    ] );
  }

  if ( empty( $children ) ) {
    return false;
  }

  echo '<section class="child-pages child-categories" aria-label="' . esc_attr__( 'Categorias relacionadas', 'independent-theme' ) . '">';
  echo '<h2 class="child-pages-title">' . esc_html__( 'Categorias', 'independent-theme' ) . '</h2>';
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

