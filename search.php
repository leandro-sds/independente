<?php get_header(); ?>

<div class="site-content"><div class="container">
  <main id="primary" role="main">
    <header class="search-header">
      <h1>
        <?php esc_html_e('Resultados da busca por:', 'independent-theme'); ?>
        <em><?php echo esc_html( get_search_query() ); ?></em>
      </h1>
    </header>

    <?php if ( have_posts() ) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h2 class="entry-title">
            <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark">
              <?php the_title(); ?>
            </a>
          </h2>
          <div class="excerpt">
            <?php the_excerpt(); ?>
            <a class="read-more" href="<?php echo esc_url( get_permalink() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Leia mais sobre %s', 'independent-theme' ), get_the_title() ) ); ?>">
              <?php esc_html_e('Leia mais', 'independent-theme'); ?>
            </a>
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
      <article class="no-results">
        <h2><?php esc_html_e('Nenhum resultado encontrado', 'independent-theme'); ?></h2>
        <p><?php esc_html_e('Tente refinar sua busca ou explore outras seções do site.', 'independent-theme'); ?></p>
        <?php get_search_form(); ?>
        <?php independent_back_link(); ?>
      </article>
    <?php endif; ?>
  </main>

  <?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
