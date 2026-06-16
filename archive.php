<?php get_header(); ?>

<div class="site-content"><div class="container">
  <main id="primary" role="main">

    <header class="archive-header">
      <h1 class="archive-title"><?php the_archive_title(); ?></h1>
      <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
    </header>

    <?php $has_related_categories = independent_render_category_children(); ?>

    <?php if ( ! $has_related_categories && have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="post-list-inner">
            <?php if ( has_post_thumbnail() ) : ?>
              <div class="post-thumbnail-wrap">
                <?php the_post_thumbnail( 'medium', [
                  'class'   => 'post-thumbnail-img',
                  'loading' => 'lazy',
                  'alt'     => esc_attr( get_the_title() ),
                ] ); ?>
              </div>
            <?php endif; ?>
            <div class="post-list-content">
              <h2 class="entry-title">
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                  <?php the_title(); ?>
                </a>
              </h2>
              <div class="excerpt">
                <?php the_excerpt(); ?>
              </div>
              <a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>"
                aria-label="<?php echo esc_attr( sprintf( __( 'Leia mais sobre %s', 'independente' ), get_the_title() ) ); ?>">
                <?php esc_html_e( 'Leia mais', 'independente' ); ?>
              </a>
            </div><!-- .post-list-content -->
          </div><!-- .post-list-inner -->
        </article>
      <?php endwhile; ?>

      <nav class="pagination" aria-label="<?php esc_attr_e( 'Paginação', 'independente' ); ?>">
        <?php
          the_posts_pagination( [
            'mid_size'  => 2,
            'prev_text' => __( '« Anterior', 'independente' ),
            'next_text' => __( 'Próximo »', 'independente' ),
          ] );
        ?>
      </nav>

      <?php independent_back_link(); ?>

    <?php else : ?>
      <?php if ( empty( $has_related_categories ) ) : ?>
        <article class="no-posts">
          <h2><?php esc_html_e( 'Ainda não há publicações aqui', 'independente' ); ?></h2>
          <p><?php esc_html_e( 'Quando houver posts nesta categoria, eles aparecerão aqui. Você também pode pesquisar no site:', 'independente' ); ?></p>
          <div class="no-posts-search"><?php get_search_form(); ?></div>
        </article>
      <?php endif; ?>
    <?php endif; ?>


    <?php independent_content_extra(); ?>
  </main>

  <?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
