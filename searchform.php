<?php
/**
 * Template do formulário de busca.
 *
 * Usa apenas a classe "search-form" — sem "header-search-form".
 * Os estilos do cabeçalho são aplicados via contexto:
 *   .header-search .search-form  (no header.php)
 *   .widget .search-form         (nos widgets/sidebar)
 * Isso evita que o min-width e cores do cabeçalho vazem para a sidebar.
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

$unique_id = wp_unique_id( 'search-form-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
  <label for="<?php echo esc_attr( $unique_id ); ?>">
    <span class="screen-reader-text">
      <?php echo esc_html_x( 'Pesquisar por:', 'label', 'independent-theme' ); ?>
    </span>
  </label>

  <input
    type="search"
    id="<?php echo esc_attr( $unique_id ); ?>"
    class="search-field"
    placeholder="<?php echo esc_attr_x( 'Buscar…', 'placeholder', 'independent-theme' ); ?>"
    value="<?php echo esc_attr( get_search_query() ); ?>"
    name="s"
    inputmode="search"
    autocomplete="off"
    aria-label="<?php echo esc_attr_x( 'Campo de busca', 'aria-label', 'independent-theme' ); ?>"
  />

  <button
    type="submit"
    class="search-submit"
    aria-label="<?php echo esc_attr_x( 'Realizar busca', 'button aria-label', 'independent-theme' ); ?>"
  >
    <?php echo esc_html_x( 'Buscar', 'submit button', 'independent-theme' ); ?>
  </button>
</form>
