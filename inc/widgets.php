<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}




// Registro de áreas de widgets
function independent_theme_widgets_init() {
  register_sidebar( [
    'name'          => __( 'Destaque — abaixo do cabeçalho', 'independente' ),
    'id'            => 'destaque',
    'description'   => __( 'Área de largura total logo abaixo do cabeçalho, antes do conteúdo. No celular aparece no topo, sendo o primeiro elemento visível. Ideal para um player de rádio, banner, imagem em destaque ou chamada para ação. Quando vazia, nada é exibido.', 'independente' ),
    'before_widget' => '<div class="widget destaque-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h2 class="destaque-title">',
    'after_title'   => '</h2>',
  ] );

  register_sidebar( [
    'name'          => __( 'Barra Lateral', 'independente' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Widgets na barra lateral', 'independente' ),
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ] );

  register_sidebar( [
    'name'          => __( 'Conteúdo Extra — abaixo do conteúdo', 'independente' ),
    'id'            => 'content-extra',
    'description'   => __( 'Aparece abaixo do conteúdo principal, antes da barra lateral na ordem de leitura. Em telas largas, os widgets ficam lado a lado, ajudando a preencher páginas curtas. Quando vazio, nada é exibido.', 'independente' ),
    'before_widget' => '<div class="widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 1', 'independente' ),
    'id'            => 'footer-1',
    'description'   => __( 'Primeira coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 2', 'independente' ),
    'id'            => 'footer-2',
    'description'   => __( 'Segunda coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 3', 'independente' ),
    'id'            => 'footer-3',
    'description'   => __( 'Terceira coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Coluna 4', 'independente' ),
    'id'            => 'footer-4',
    'description'   => __( 'Quarta coluna do rodapé (de 4)', 'independente' ),
    'before_widget' => '<div class="footer-widget">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );

  register_sidebar( [
    'name'          => __( 'Rodapé — Faixa Central', 'independente' ),
    'id'            => 'footer-full',
    'description'   => __( 'Área de largura total abaixo das 4 colunas', 'independente' ),
    'before_widget' => '<div class="footer-widget footer-widget--full">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>',
  ] );
}
add_action( 'widgets_init', 'independent_theme_widgets_init' );