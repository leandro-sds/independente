<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
<aside role="complementary" class="sidebar" aria-label="<?php esc_attr_e( 'Barra lateral', 'independente' ); ?>">
  <div class="sidebar-widgets">
    <?php dynamic_sidebar( 'sidebar-1' ); ?>
  </div>
</aside>
<?php endif; ?>
