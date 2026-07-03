<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}



/**
 * Conteúdo Extra — região exibida abaixo do conteúdo principal, dentro de <main>.
 *
 * Ordem de leitura garantida pelo DOM: cabeçalho → corpo → conteúdo extra →
 * barra lateral → rodapé. É um landmark "region" (section + aria-label),
 * então usuários de leitor de telas podem saltar direto para ele.
 * Quando a área está vazia, nada é impresso — nenhuma marcação, nenhum espaço.
 */
function independent_content_extra() {
  if ( ! is_active_sidebar( 'content-extra' ) ) {
    return;
  }
  ?>
  <section class="content-extra" aria-label="<?php esc_attr_e( 'Conteúdo extra', 'independente' ); ?>">
    <?php dynamic_sidebar( 'content-extra' ); ?>
  </section>
  <?php
}