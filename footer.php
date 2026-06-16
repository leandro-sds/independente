<footer role="contentinfo">

  <?php
    $whatsapp  = sanitize_text_field( get_theme_mod( 'independent_whatsapp_url', '' ) );
    $facebook  = sanitize_text_field( get_theme_mod( 'independent_facebook_url', '' ) );
    $instagram = sanitize_text_field( get_theme_mod( 'independent_instagram_url', '' ) );
    $youtube   = sanitize_text_field( get_theme_mod( 'independent_youtube_url', '' ) );

    $whatsapp_digits = $whatsapp ? preg_replace( '/\D/', '', $whatsapp ) : '';
    $whatsapp_link   = $whatsapp_digits ? 'https://wa.me/' . $whatsapp_digits : '';
    $facebook_link   = $facebook  ? 'https://www.facebook.com/' . ltrim( $facebook, '/' ) : '';
    $instagram_link  = $instagram ? 'https://www.instagram.com/' . ltrim( $instagram, '/' ) : '';
    $youtube_handle  = $youtube   ? ( str_starts_with( $youtube, '@' ) ? $youtube : '@' . $youtube ) : '';
    $youtube_link    = $youtube   ? 'https://www.youtube.com/' . $youtube_handle : '';

    $has_columns = is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4');
    $has_full    = is_active_sidebar('footer-full');
  ?>

  <?php if ( $has_columns ) : ?>
  <div class="footer-columns" role="complementary" aria-label="<?php esc_attr_e('Rodapé — colunas', 'independente'); ?>">
    <div class="wrap footer-columns-inner">

      <?php if ( is_active_sidebar('footer-1') ) : ?>
      <div class="footer-col footer-col-1">
        <?php dynamic_sidebar('footer-1'); ?>
      </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar('footer-2') ) : ?>
      <div class="footer-col footer-col-2">
        <?php dynamic_sidebar('footer-2'); ?>
      </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar('footer-3') ) : ?>
      <div class="footer-col footer-col-3">
        <?php dynamic_sidebar('footer-3'); ?>
      </div>
      <?php endif; ?>

      <?php if ( is_active_sidebar('footer-4') ) : ?>
      <div class="footer-col footer-col-4">
        <?php dynamic_sidebar('footer-4'); ?>
      </div>
      <?php endif; ?>

    </div>
  </div>
  <?php endif; ?>

  <?php if ( $has_full ) : ?>
  <div class="footer-full-area" role="complementary" aria-label="<?php esc_attr_e('Rodapé — faixa central', 'independente'); ?>">
    <div class="wrap">
      <?php dynamic_sidebar('footer-full'); ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="container">

    <?php if ( $whatsapp_link || $facebook_link || $instagram_link || $youtube_link ) : ?>
    <div class="social-icons" role="navigation" aria-label="<?php esc_attr_e('Redes sociais', 'independente'); ?>">
      <h4 class="social-title"><?php esc_html_e('Redes Sociais', 'independente'); ?></h4>
      <div class="social-links">

        <?php if ( $whatsapp_link ) : ?>
        <a href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('WhatsApp', 'independente'); ?>">
          <span class="social-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
              <path d="M20.5 3.5A11 11 0 0 0 3.7 17.7L3 21l3.4-.7A11 11 0 0 0 20.5 3.5Z" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
              <path d="M8.3 7.9c-.2-.4-.4-.4-.6-.4H7c-.2 0-.4.1-.5.3-.2.2-.7.7-.7 1.8 0 1 .7 2 0 2.1.1.1 1.4 2.2 3.5 3 .5.2.9.4 1.2.5.5.2.9.2 1.2.2.4 0 1.3-.5 1.5-1 .2-.5.2-.9.1-1-.1-.1-.2-.2-.4-.3l-1.1-.5c-.2-.1-.4-.1-.6.1l-.4.5c-.2.2-.3.2-.6.1-.3-.1-1.2-.4-2.2-1.4-.8-.7-1.4-1.7-1.5-2-.2-.3 0-.4.1-.5l.3-.3c.1-.1.2-.2.2-.3.1-.1.1-.3 0-.4l-.5-1.1Z" fill="currentColor"/>
            </svg>
          </span>
          <span class="sr-only">WhatsApp</span>
        </a>
        <?php endif; ?>

        <?php if ( $facebook_link ) : ?>
        <a href="<?php echo esc_url( $facebook_link ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Facebook', 'independente'); ?>">
          <span class="social-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
              <path d="M14 9h2V6h-2c-2.2 0-4 1.8-4 4v2H8v3h2v7h3v-7h2.1l.9-3H13v-2c0-.6.4-1 1-1Z" fill="currentColor"/>
            </svg>
          </span>
          <span class="sr-only">Facebook</span>
        </a>
        <?php endif; ?>

        <?php if ( $instagram_link ) : ?>
        <a href="<?php echo esc_url( $instagram_link ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Instagram', 'independente'); ?>">
          <span class="social-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
              <path d="M7 3h10a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4Z" fill="none" stroke="currentColor" stroke-width="1.8"/>
              <path d="M12 8.5A3.5 3.5 0 1 0 12 15.5 3.5 3.5 0 0 0 12 8.5Z" fill="none" stroke="currentColor" stroke-width="1.8"/>
              <path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
            </svg>
          </span>
          <span class="sr-only">Instagram</span>
        </a>
        <?php endif; ?>

        <?php if ( $youtube_link ) : ?>
        <a href="<?php echo esc_url( $youtube_link ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('YouTube', 'independente'); ?>">
          <span class="social-icon" aria-hidden="true">
            <svg width="22" height="22" viewBox="0 0 24 24" focusable="false" aria-hidden="true">
              <path d="M21.6 7.2a3 3 0 0 0-2.1-2.1C17.8 4.6 12 4.6 12 4.6s-5.8 0-7.5.5A3 3 0 0 0 2.4 7.2 31.3 31.3 0 0 0 2 12a31.3 31.3 0 0 0 .4 4.8 3 3 0 0 0 2.1 2.1c1.7.5 7.5.5 7.5.5s5.8 0 7.5-.5a3 3 0 0 0 2.1-2.1A31.3 31.3 0 0 0 22 12a31.3 31.3 0 0 0-.4-4.8Z" fill="currentColor"/>
              <path d="M10 15.5v-7l6 3.5-6 3.5Z" fill="#000"/>
            </svg>
          </span>
          <span class="sr-only">YouTube</span>
        </a>
        <?php endif; ?>

      </div>
    </div>
    <?php endif; ?>

    <?php
      $dev_show = get_theme_mod( 'independent_developer_show', true );
      $dev_name = sanitize_text_field( get_theme_mod( 'independent_developer_name', 'Independent Theme' ) );
      $dev_url  = esc_url( get_theme_mod( 'independent_developer_url', 'https://github.com/leandro-sds/independent-theme' ) );

      if ( $dev_show && $dev_name ) :
        $dev_link = $dev_url
          ? '<a href="' . $dev_url . '" target="_blank" rel="noopener noreferrer">' . esc_html( $dev_name ) . '</a>'
          : esc_html( $dev_name );
    ?>
    <div class="site-info site-info--developer">
      <p><?php echo wp_kses( sprintf( __( 'Desenvolvido por %s', 'independente' ), $dev_link ), [ 'a' => [ 'href' => [], 'target' => [], 'rel' => [] ] ] ); ?></p>
    </div>
    <?php endif; ?>

    <div class="site-info">
      <?php
        $founding_year = get_theme_mod( 'independent_founding_year', '' );
        $current_year  = (int) gmdate( 'Y' );
        if ( $founding_year && (int) $founding_year < $current_year ) {
          $year_display = esc_html( $founding_year ) . '–' . $current_year;
        } else {
          $year_display = $current_year;
        }
      ?>
      <p>&copy; <?php echo esc_html( $year_display ); ?> <?php echo esc_html( get_bloginfo('name') ); ?>. <?php esc_html_e('Todos os direitos reservados.', 'independente'); ?></p>
    </div>

  </div>

  <?php wp_footer(); ?>
</footer>
</body>
</html>
