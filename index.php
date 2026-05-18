<?php get_header(); ?>

<div class="site-content"><div class="container">
  <main id="primary" role="main">
    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <?php if ( has_post_thumbnail() ) : ?>
            <a class="post-thumbnail-link" href="<?php echo esc_url( get_permalink() ); ?>" tabindex="-1" aria-hidden="true">
              <?php the_post_thumbnail( 'medium', [ 'class' => 'post-thumbnail-img', 'loading' => 'lazy' ] ); ?>
            </a>
          <?php endif; ?>
          <header>
            <h2 class="entry-title">
              <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
                <?php the_title(); ?>
              </a>
            </h2>
          </header>

          <div class="excerpt">
            <?php the_excerpt(); ?>
            <a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>"><?php esc_html_e('Leia mais', 'independent-theme'); ?></a>
          </div>
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
      <article class="no-posts">
        <h2><?php esc_html_e('Nenhum conteúdo encontrado', 'independent-theme'); ?></h2>
        <p><?php esc_html_e('Desculpe, não há posts disponíveis no momento.', 'independent-theme'); ?></p>
      </article>
    <?php endif; ?>
  </main>

  <?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
