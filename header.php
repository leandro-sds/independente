<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" role="banner">
  <div class="wrap header-wrap">
    <div class="header-top">
      <div class="branding">
        <?php if ( has_custom_logo() ) : ?>
          <div class="logo">
            <?php the_custom_logo(); ?>
          </div>
        <?php endif; ?>

        <div class="site-title">
          <?php if ( is_front_page() || is_home() ) : ?>
            <h1 class="site-name">
              <a href="<?php echo esc_url( home_url('/') ); ?>">
                <?php echo esc_html( get_bloginfo('name') ); ?>
              </a>
            </h1>
          <?php else : ?>
            <p class="site-name">
              <a href="<?php echo esc_url( home_url('/') ); ?>">
                <?php echo esc_html( get_bloginfo('name') ); ?>
              </a>
            </p>
          <?php endif; ?>
          <?php $desc = get_bloginfo('description'); if ( $desc ) : ?>
            <p class="site-description"><?php echo esc_html( $desc ); ?></p>
          <?php endif; ?>
        </div>
      </div>

      <div class="header-actions" role="group" aria-label="<?php esc_attr_e('Ações do cabeçalho', 'independente'); ?>">

        <?php if ( get_theme_mod( 'independent_header_show_search', 1 ) ) : ?>
        <button
          class="search-toggle"
          type="button"
          aria-controls="header-search"
          aria-expanded="false"
          aria-label="<?php esc_attr_e('Abrir campo de busca', 'independente'); ?>"
        >
          <span aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" focusable="false" aria-hidden="true">
              <circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/>
            </svg>
          </span>
          <span class="search-toggle-text"><?php esc_html_e('Pesquisar', 'independente'); ?></span>
        </button>

        <div
          class="header-search"
          id="header-search"
          aria-label="<?php esc_attr_e('Pesquisar no site', 'independente'); ?>"
        >
          <?php get_search_form(); ?>
        </div>
        <?php endif; ?>

<button
  class="menu-toggle"
  type="button"
  aria-controls="main-menu"
  aria-expanded="false"
  aria-label="<?php esc_attr_e('Abrir menu de navegação', 'independente'); ?>"
>
          <span class="menu-toggle-icon" aria-hidden="true">
            <svg width="20" height="20" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
              <path d="M3 6h18M3 12h18M3 18h18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </span>
          <span class="menu-toggle-text"><?php esc_html_e('Menu', 'independente'); ?></span>
        </button>
      </div>
    </div>

    <nav class="primary-nav" role="navigation" aria-label="<?php esc_attr_e('Menu principal', 'independente'); ?>">
      <?php
        wp_nav_menu([
          'theme_location' => 'main-menu',
          'menu_class'     => 'menu',
          'container'      => false,
          'fallback_cb'    => 'wp_page_menu',
          'items_wrap'     => '<ul id="main-menu" class="%2$s">%3$s</ul>',
        ]);
      ?>
    </nav>
  </div>
</header>

<?php
$hero_enabled = get_theme_mod( 'independent_hero_enabled', 0 );
if ( $hero_enabled ) :
  $hero_title      = get_theme_mod( 'independent_hero_title', '' );
  $hero_subtitle   = get_theme_mod( 'independent_hero_subtitle', '' );
  $hero_btn_text   = get_theme_mod( 'independent_hero_button_text', '' );
  $hero_btn_url    = get_theme_mod( 'independent_hero_button_url', '' );
?>
<section class="hero-section" aria-label="<?php esc_attr_e( 'Seção de destaque', 'independente' ); ?>">
  <div class="hero-inner">
    <?php if ( $hero_title ) : ?>
      <h2 class="hero-title"><?php echo esc_html( $hero_title ); ?></h2>
    <?php endif; ?>
    <?php if ( $hero_subtitle ) : ?>
      <p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
    <?php endif; ?>
    <?php if ( $hero_btn_text && $hero_btn_url ) : ?>
      <a href="<?php echo esc_url( $hero_btn_url ); ?>" class="hero-button">
        <?php echo esc_html( $hero_btn_text ); ?>
      </a>
    <?php endif; ?>
  </div>
</section>
<?php endif; ?>
