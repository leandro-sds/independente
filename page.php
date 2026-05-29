<?php get_header(); ?>

<div class="site-content"><div class="container">
  <main id="primary" role="main">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="page-header">
          <?php if ( is_front_page() ) : ?>
            <h2 class="entry-title"><?php the_title(); ?></h2>
          <?php else : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
          <?php endif; ?>
        </header>

        <div class="page-content">
          <?php if ( ! is_front_page() && has_post_thumbnail() ) : ?>
            <figure class="post-featured-image">
              <?php the_post_thumbnail( 'large', [
                'loading' => 'eager',
                'alt'     => get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ?: get_the_title(),
              ] ); ?>
            </figure>
          <?php endif; ?>
          <?php the_content(); ?>
        </div>

        <?php
        // Lista subpáginas apenas se a opção estiver ativada no Personalizador
        $listar_subpaginas = get_theme_mod( 'independent_listar_subpaginas', true );

        if ( $listar_subpaginas ) :
          $paged = get_query_var('page') ? absint( get_query_var('page') ) : 1;

          $child_pages_query = new WP_Query([
            'post_type'      => 'page',
            'posts_per_page' => 10,
            'paged'          => $paged,
            'post_parent'    => get_the_ID(),
            'orderby'        => 'date',
            'order'          => 'DESC',
            'no_found_rows'  => false,
          ]);

          if ( $child_pages_query->have_posts() ) :
        ?>
          <section class="child-pages" aria-label="<?php esc_attr_e('Conteúdo relacionado', 'independent-theme'); ?>">
            <h2 class="child-pages-title"><?php esc_html_e( 'Páginas relacionadas', 'independent-theme' ); ?></h2>
            <ul class="child-page-list">
              <?php while ( $child_pages_query->have_posts() ) : $child_pages_query->the_post(); ?>
                <li>
                  <a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_title(); ?></a>
                </li>
              <?php endwhile; ?>
            </ul>

            <?php
            echo paginate_links([
              'total'     => $child_pages_query->max_num_pages,
              'current'   => $paged,
              'mid_size'  => 2,
              'prev_text' => __('« Anterior', 'independent-theme'),
              'next_text' => __('Próximo »', 'independent-theme'),
            ]);
            ?>
          </section>
        <?php
          wp_reset_postdata();
          endif;
        endif;
        ?>

        <?php independent_back_link(); ?>
      </article>
    <?php endwhile; endif; ?>
  </main>

  <?php get_sidebar(); ?>
</div></div>

<?php get_footer(); ?>
