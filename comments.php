<?php
/**
 * Template de comentários — Independent Theme
 * Acessível, semântico e estilizado por cada estilo visual
 */

if ( post_password_required() ) {
  return;
}
?>

<section id="comments" class="comments-area" aria-label="<?php esc_attr_e( 'Comentários', 'independente' ); ?>">

  <?php if ( have_comments() ) : ?>

    <h2 class="comments-title">
      <?php
      $count = get_comments_number();
      if ( '1' === $count ) {
        printf(
          esc_html__( '1 comentário em "%s"', 'independente' ),
          esc_html( get_the_title() )
        );
      } else {
        printf(
          esc_html__( '%1$s comentários em "%2$s"', 'independente' ),
          esc_html( number_format_i18n( $count ) ),
          esc_html( get_the_title() )
        );
      }
      ?>
    </h2>

    <ol class="comment-list">
      <?php
      wp_list_comments( [
        'style'       => 'ol',
        'short_ping'  => true,
        'avatar_size' => 48,
        'callback'    => 'independent_theme_comment',
      ] );
      ?>
    </ol>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    <nav class="comment-navigation" aria-label="<?php esc_attr_e( 'Navegação de comentários', 'independente' ); ?>">
      <div class="nav-previous"><?php previous_comments_link( esc_html__( '← Comentários anteriores', 'independente' ) ); ?></div>
      <div class="nav-next"><?php next_comments_link( esc_html__( 'Próximos comentários →', 'independente' ) ); ?></div>
    </nav>
    <?php endif; ?>

  <?php endif; ?>

  <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
    <p class="no-comments"><?php esc_html_e( 'Os comentários estão fechados.', 'independente' ); ?></p>
  <?php endif; ?>

  <?php
  comment_form( [
    'title_reply'          => esc_html__( 'Deixe um comentário', 'independente' ),
    'title_reply_to'       => esc_html__( 'Responder para %s', 'independente' ),
    'cancel_reply_link'    => esc_html__( 'Cancelar resposta', 'independente' ),
    'label_submit'         => esc_html__( 'Publicar comentário', 'independente' ),
    'comment_notes_before' => '',
    'comment_notes_after'  => '',
    'fields' => [
      'author' => '<div class="comment-field"><label for="author">' . esc_html__( 'Nome', 'independente' ) . ' <span aria-hidden="true">*</span></label><input id="author" name="author" type="text" required aria-required="true" autocomplete="name" /></div>',
      'email'  => '<div class="comment-field"><label for="email">' . esc_html__( 'E-mail', 'independente' ) . ' <span aria-hidden="true">*</span></label><input id="email" name="email" type="email" required aria-required="true" autocomplete="email" /><p class="comment-field-note">' . esc_html__( 'Seu e-mail não será publicado.', 'independente' ) . '</p></div>',
      'url'    => '<div class="comment-field"><label for="url">' . esc_html__( 'Site (opcional)', 'independente' ) . '</label><input id="url" name="url" type="url" autocomplete="url" /></div>',
    ],
    'comment_field' => '<div class="comment-field"><label for="comment">' . esc_html__( 'Comentário', 'independente' ) . ' <span aria-hidden="true">*</span></label><textarea id="comment" name="comment" rows="6" required aria-required="true"></textarea></div>',
  ] );
  ?>

</section>
