<?php get_header(); ?>

<div class="site-content"><div class="container">
  <main id="primary" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="post-header">
          <h1 class="entry-title"><?php the_title(); ?></h1>
        </header>

        <div class="post-content">
          <?php if ( has_post_thumbnail() ) : ?>
            <figure class="post-featured-image">
              <?php the_post_thumbnail( 'large', [
                'loading' => 'eager',
                'alt'     => get_the_title(),
              ] ); ?>
            </figure>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>

        <?php independent_back_link(); ?>

        <section class="post-meta" aria-label="<?php esc_attr_e('Informações do post', 'independent-theme'); ?>">
          <p><strong><?php esc_html_e('Publicado em:', 'independent-theme'); ?></strong> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time></p>
          <p><strong><?php esc_html_e('Autor:', 'independent-theme'); ?></strong> <?php echo esc_html( get_the_author() ); ?></p>

          <?php if ( has_category() ) : ?>
            <p><strong><?php esc_html_e('Categorias:', 'independent-theme'); ?></strong> <?php the_category(', '); ?></p>
          <?php endif; ?>

          <?php if ( has_tag() ) : ?>
            <p><strong><?php esc_html_e('Tags:', 'independent-theme'); ?></strong> <?php the_tags('', ', '); ?></p>
          <?php endif; ?>
        </section>
      </article>

      <?php comments_template(); ?>

      <?php
      $categories = get_the_category();
      if ( $categories ) {
        $category_ids = array_map( function( $cat ) {
          return (int) $cat->term_id;
        }, $categories );

        $related_posts = new WP_Query([
          'category__in'          => $category_ids,
          'post__not_in'          => [ get_the_ID() ],
          'posts_per_page'        => 4,
          'ignore_sticky_posts'   => true,
          'no_found_rows'         => true,
        ]);

        if ( $related_posts->have_posts() ) : ?>
          <section class="related-posts" aria-label="<?php esc_attr_e('Posts relacionados', 'independent-theme'); ?>">
            <h2><?php esc_html_e('Posts relacionados', 'independent-theme'); ?></h2>
            <ul class="related-list">
              <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                <li>
                  <a href="<?php echo esc_url( get_permalink() ); ?>">
                    <?php if ( has_post_thumbnail() ) : ?>
                      <div class="thumb"><?php the_post_thumbnail( 'thumbnail', [ 'alt' => '' ] ); ?></div>
                    <?php endif; ?>
                    <span class="title"><?php the_title(); ?></span>
                  </a>
                </li>
              <?php endwhile; ?>
            </ul>
          </section>
          <?php wp_reset_postdata(); ?>
        <?php endif;
      }
      ?>
    <?php endwhile; endif; ?>
  </main>

  <?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
