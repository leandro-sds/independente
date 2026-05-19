<?php get_header(); ?>

<div class="site-content"><div class="container">
  <main id="primary" role="main">

    <header class="archive-header">
      <h1 class="archive-title"><?php the_archive_title(); ?></h1>
      <?php the_archive_description('<div class="archive-description">', '</div>'); ?>
    </header>

    <?php $has_related_categories = independent_render_category_children(); ?>

    <?php if ( ! $has_related_categories && have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <div class="post-list-inner">
            <?php if ( has_post_thumbnail() ) : ?>
              <a class="post-thumbnail-link" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-label="<?php esc_attr_e( 'Imagem do post', 'independent-theme' ); ?>">
                <?php the_post_thumbnail( 'medium', [
                  'class' => 'post-thumbnail-img',
                  'loading' => 'lazy',
                  'alt' => get_the_title(),
                ] ); ?>
              </a>
            <?php endif; ?>
            <div class="post-list-content">
              <h2 class="entry-title">
                <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                  <?php the_title(); ?>
                </a>
              </h2>
              <div class="excerpt">
                <?php the_excerpt(); ?>
                <a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e('Leia mais', 'independent-theme'); ?></a>
              </div>
            </div><!-- .post-list-content -->
          </div><!-- .post-list-inner -->
        </article>
      <?php endwhile; ?>

      <nav class="pagination" aria-label="<?php esc_attr_e('Paginação', 'independent-theme'); ?>">
        <?php
          the_posts_pagination([
            'mid_size'  => 2,
            'prev_text' => __('« Anterior', 'independent-theme'),
            'next_text' => __('Próximo »', 'independent-theme'),
          ]);
        ?>
      </nav>

      <?php independent_back_link(); ?>

    <?php else : ?>
      <?php if ( empty( $has_related_categories ) ) : ?>
        <article class="no-posts">
          <h2><?php esc_html_e('Ainda não há publicações aqui', 'independent-theme'); ?></h2>
          <p><?php esc_html_e('Quando houver posts nesta categoria, eles aparecerão aqui. Você também pode pesquisar no site:', 'independent-theme'); ?></p>
          <div class="no-posts-search"><?php get_search_form(); ?></div>
        </article>
      <?php endif; ?>
    <?php endif; ?>

  </main>

  <?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
