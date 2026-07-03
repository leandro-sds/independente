<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}


// Customizações via Personalizador
function independent_theme_customize_register( $wp_customize ) {
  // -------------------------------------------------------
  // Logo — Tamanho e Escala (dentro de "Identidade do Site")
  // -------------------------------------------------------
  $logo_section = 'title_tagline';

  // Largura máxima (px)
  $wp_customize->add_setting( 'independent_logo_width', [
    'default'           => 200,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_width', [
    'label'       => __( 'Largura máxima da logo (px)', 'independente' ),
    'description' => __( 'Ex.: 120 = compacta · 200 = padrão · 400 = grande. Intervalo: 40 – 800 px.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 10,
    'input_attrs' => [
      'min'         => 40,
      'max'         => 800,
      'step'        => 1,
      'placeholder' => '200',
    ],
  ] );

  // Altura máxima (px)
  $wp_customize->add_setting( 'independent_logo_height', [
    'default'           => 80,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_height', [
    'label'       => __( 'Altura máxima da logo (px)', 'independente' ),
    'description' => __( 'Ex.: 50 = baixa · 80 = padrão · 160 = alta. Intervalo: 20 – 400 px.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 11,
    'input_attrs' => [
      'min'         => 20,
      'max'         => 400,
      'step'        => 1,
      'placeholder' => '80',
    ],
  ] );

  // Escala adicional (%)
  $wp_customize->add_setting( 'independent_logo_scale', [
    'default'           => 100,
    'sanitize_callback' => 'absint',
    'transport'         => 'refresh',
  ] );
  $wp_customize->add_control( 'independent_logo_scale', [
    'label'       => __( 'Escala da logo (%)', 'independente' ),
    'description' => __( '100% = tamanho normal. Aumente para ampliar a logo sem precisar substituir o arquivo.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'number',
    'priority'    => 12,
    'input_attrs' => [
      'min'         => 50,
      'max'         => 300,
      'step'        => 5,
      'placeholder' => '100',
    ],
  ] );

	// Cabeçalho (autonomia + acessibilidade)
  $wp_customize->add_setting( 'independent_header_layout', [
    'default'           => 'left',
    'sanitize_callback' => 'independent_theme_sanitize_header_layout',
  ] );

  $wp_customize->add_control( 'independent_header_layout', [
    'label'       => __( 'Layout do cabeçalho', 'independente' ),
    'description' => __( 'Dica: "Logo à esquerda" costuma ser o mais previsível. Use "Centralizado" para destaque máximo. "Logo acima" ajuda quando a logo é grande.', 'independente' ),
    'section'     => $logo_section,
    'type'        => 'select',
    'choices'     => [
      'left'    => __( 'Logo à esquerda, ações à direita', 'independente' ),
      'center'  => __( 'Centralizado (logo + nome no centro)', 'independente' ),
      'stacked' => __( 'Logo acima do nome (em coluna)', 'independente' ),
    ],
  ] );

  $wp_customize->add_setting( 'independent_header_show_search', [
    'default'           => 1,
    'sanitize_callback' => 'independent_theme_sanitize_checkbox',
  ] );

  $wp_customize->add_control( 'independent_header_show_search', [
    'label'   => __( 'Mostrar busca no cabeçalho', 'independente' ),
    'section' => $logo_section,
    'type'    => 'checkbox',
  ] );


  // Rodapé — Ano de fundação
  $wp_customize->add_section( 'independent_footer_section', [
    'title'    => __( 'Rodapé', 'independente' ),
    'priority' => 38,
  ] );

  $wp_customize->add_setting( 'independent_founding_year', [
    'default'           => '',
    'sanitize_callback' => 'independent_theme_sanitize_founding_year',
  ] );

  $wp_customize->add_control( 'independent_founding_year', [
    'label'       => __( 'Ano de fundação do projeto', 'independente' ),
    'description' => __( 'Se preenchido, o copyright exibirá o intervalo. Ex.: 2013 → © 2013–2026. Deixe em branco para exibir apenas o ano atual.', 'independente' ),
    'section'     => 'independent_footer_section',
    'type'        => 'number',
    'input_attrs' => [
      'min'         => 1900,
      'max'         => (int) gmdate( 'Y' ),
      'step'        => 1,
      'placeholder' => gmdate( 'Y' ),
    ],
  ] );

  // Crédito do desenvolvedor
  $wp_customize->add_setting( 'independent_developer_show', [
    'default'           => true,
    'sanitize_callback' => 'rest_sanitize_boolean',
  ] );

  $wp_customize->add_control( 'independent_developer_show', [
    'label'   => __( 'Exibir crédito do desenvolvedor', 'independente' ),
    'section' => 'independent_footer_section',
    'type'    => 'checkbox',
  ] );

  $wp_customize->add_setting( 'independent_developer_name', [
    'default'           => 'Independent Theme',
    'sanitize_callback' => 'sanitize_text_field',
  ] );

  $wp_customize->add_control( 'independent_developer_name', [
    'label'       => __( 'Nome do desenvolvedor', 'independente' ),
    'description' => __( 'Ex.: João Silva, Agência XYZ. Deixe em branco para ocultar o nome.', 'independente' ),
    'section'     => 'independent_footer_section',
    'type'        => 'text',
  ] );

  $wp_customize->add_setting( 'independent_developer_url', [
    'default'           => 'https://github.com/leandro-sds/independent-theme',
    'sanitize_callback' => 'esc_url_raw',
  ] );

  $wp_customize->add_control( 'independent_developer_url', [
    'label'       => __( 'URL do desenvolvedor', 'independente' ),
    'description' => __( 'Deixe em branco para exibir o nome sem link.', 'independente' ),
    'section'     => 'independent_footer_section',
    'type'        => 'url',
  ] );

  // Redes sociais
  $wp_customize->add_section( 'independent_social_section', [
    'title'    => __( 'Redes Sociais', 'independente' ),
    'priority' => 40,
  ] );

  // WhatsApp — número com código do país
  $wp_customize->add_setting( 'independent_whatsapp_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_whatsapp_url', [
    'label'       => __( 'WhatsApp', 'independente' ),
    'description' => __( 'Apenas os números com código do país. Ex.: 5544997540049', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Facebook — nome de usuário
  $wp_customize->add_setting( 'independent_facebook_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_facebook_url', [
    'label'       => __( 'Facebook', 'independente' ),
    'description' => __( 'Apenas o nome de usuário. Ex.: radiomaioramoroficial', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Instagram — nome de usuário
  $wp_customize->add_setting( 'independent_instagram_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_instagram_url', [
    'label'       => __( 'Instagram', 'independente' ),
    'description' => __( 'Apenas o nome de usuário. Ex.: radiomaioramoroficial', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // YouTube — nome do canal
  $wp_customize->add_setting( 'independent_youtube_url', [
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
  ] );
  $wp_customize->add_control( 'independent_youtube_url', [
    'label'       => __( 'YouTube', 'independente' ),
    'description' => __( 'Nome do canal com ou sem @. Ex.: @radiomaioramor', 'independente' ),
    'section'     => 'independent_social_section',
    'type'        => 'text',
  ] );

  // Estilo visual
  $wp_customize->add_section( 'independent_style_section', [
    'title'    => __( 'Estilo Visual', 'independente' ),
    'priority' => 50,
  ] );

  $wp_customize->add_setting( 'independent_site_style', [
    'default'           => 'default',
    'sanitize_callback' => 'sanitize_text_field',
  ] );

  $wp_customize->add_control( 'independent_site_style', [
    'label'   => __( 'Escolha o estilo do site', 'independente' ),
    'section' => 'independent_style_section',
    'type'    => 'select',
    'choices' => [
      'default'      => __( 'Padrão do Tema', 'independente' ),
      'ceuafe'       => __( '✝️ Site Cristão – Céu e Fé', 'independente' ),
      'marinelli'    => __( '🏛️ Institucional – Marinelli Drupal', 'independente' ),
      'colorado'     => __( '🔴 Colorado – Vermelho e Branco', 'independente' ),
      // 'alvorada'     => __( '🌅 Alvorada – Minimalismo Orgânico', 'independente' ), // estacionado
      'gospel'       => __( '✨ Gospel – Luz que Rompe', 'independente' ), // estacionado
      // 'neonpop'      => __( '🎧 Rádio Jovem – Neon Pop', 'independente' ),
      // 'vintagecafe'  => __( '📻 Rádio Retrô – Vintage Café', 'independente' ),
      // 'campoepaixao' => __( '⚽ Site de Futebol – Campo e Paixão', 'independente' ), // estacionado: Rock/Noite de Jogo cobriam outros nichos
      'tintaepapel'  => __( '✍️ Site para Escritor – Tinta & Papel', 'independente' ),
      'moderno'      => __( '⚡ Moderno – Vibrante & Contemporâneo', 'independente' ),
      // 'rock'         => __( '🎸 Rock – Preto, Vermelho e Metal', 'independente' ),
      // 'noitedejogo'  => __( '⚽ Noite de Jogo – Portal Esportivo', 'independente' ), // estacionado: Rock ficou no lugar
    ],
  ] );

  // Opção: listar subpáginas
  $wp_customize->add_section( 'independent_pages_section', [
    'title'    => __( 'Páginas', 'independente' ),
    'priority' => 55,
  ] );

  $wp_customize->add_setting( 'independent_listar_subpaginas', [
    'default'           => true,
    'sanitize_callback' => 'independent_theme_sanitize_boolean',
    'transport'         => 'refresh',
  ] );

  $wp_customize->add_control( 'independent_listar_subpaginas', [
    'label'       => __( 'Listar subpáginas', 'independente' ),
    'description' => __( 'Quando ativado, as subpáginas de uma página são listadas abaixo do seu conteúdo.', 'independente' ),
    'section'     => 'independent_pages_section',
    'type'        => 'checkbox',
  ] );

}
add_action( 'customize_register', 'independent_theme_customize_register' );