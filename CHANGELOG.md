# Changelog — Independent Theme

## [5.4] — 2026-06-09

### Auditoria Completa de Estilos

Todos os 11 estilos (exceto Alvorada, já completo) auditados sistematicamente contra checklist de 23 componentes. Adicionados os componentes faltantes em cada estilo sem modificar o que já existia:

- **Componentes adicionados universalmente** — 404/busca sem resultados, thumbnail com hover suave, busca Gutenberg (`wp-block-search`), post-meta com borda colorida, excerpt, comentários, formulário de comentários, social links, paginação, back link, responsividade mobile e `prefers-reduced-motion`.
- **Todos os 12 estilos** agora cobrem **23/23 componentes** verificados.
- **Sintaxe CSS verificada** — chaves balanceadas em todos os 15 arquivos CSS.
- **Nenhum estilo existente foi modificado** — apenas adições, usando as cores corretas de cada estilo.

---

## [5.3] — 2026-06-07


### Melhorias

- **Alvorada — contraste do menu** — texto do menu de navegação alterado para dourado `#E5C158` sobre verde-oliva, garantindo contraste superior e reforçando a identidade visual.

- **Alvorada — botão Buscar** — texto do botão alterado de branco para verde-oliva escuro `#1E2B1D`. Texto escuro sobre fundo dourado elimina o estouro de luz.

- **Alvorada — componentes completos** — adicionados todos os componentes faltantes: post-meta, excerpt, thumbnail, comentários, formulário de comentários, busca Gutenberg, widget-title, links do conteúdo, 404, social links, responsividade mobile e `prefers-reduced-motion`. Total: 23 componentes verificados.

- **Alvorada — registrado no array de estilos** — adicionado ao `independent_theme_custom_style()` para que o Personalizador controle corretamente o tamanho da logo.

- **Layout — min-height no conteúdo principal** — adicionado `min-height: 60vh` no `main` para evitar vazio visual em páginas curtas com sidebar longa. Aplicado globalmente a todos os estilos, sem impacto na acessibilidade.

- **Colorado — contraste do menu** — fundo do `primary-nav` escurecido de `rgba(0,0,0,0.18)` para `rgba(0,0,0,0.38)`.

- **Rock — halação nos títulos** — cor suavizada de `#ffffff` para `#e8e4de` e `letter-spacing` aumentado para `0.08em`.

- **Marinelli — modernização** — gradientes suavizados, cantos arredondados minimalistas, botão laranja flat design, tipografia Inter com `line-height: 1.6`.

---

## [5.2] — 2026-06-06


### Refatoração Estrutural

- **Estilos separados em arquivos individuais** — cada um dos 11 estilos agora tem seu próprio arquivo em `assets/css/estilos/` (rock.css, ceuafe.css, noitedejogo.css, colorado.css, neonpop.css, moderno.css, marinelli.css, vintagecafe.css, campoepaixao.css, tintaepapel.css, default.css). Carregamento sob demanda: o usuário baixa apenas o CSS do estilo ativo.

### Novo Estilo: Alvorada 🌅

- **Minimalismo Orgânico / Calm Tech Design** — estilo exclusivo com paleta "Luz e Terra": fundo Alabastro `#F7F5F0`, header e footer em Verde Oliva `#2C3E2B`, acento Dourado Champagne `#C9A227`.
- **Tipografia dupla** — títulos em Playfair Display (serifada elegante), corpo e menus em Plus Jakarta Sans.
- **Glow espiritual** — cards com sombra dourada difusa, bordas arredondadas generosas (14-20px), microinterações suaves (0.4s ease).
- Cobre todos os componentes: header, nav, artigos, comments, formulários, widgets, busca, 404, rodapé, mobile e `prefers-reduced-motion`.

---

## [5.1] — 2026-06-04

### Correções de Bugs

- **Bug crítico: texto sobrepondo imagem no corpo do post** — imagens Gutenberg corrigidas com `display: block` e `clear: both`.
- **Imagens no corpo do post** — largura total, altura máxima 500px com `object-fit: cover`.

---

## [5.0] — 2026-06-04

### Melhorias

- **Imagem destacada normalizada** — altura máxima 350px desktop, 220px mobile com `object-fit: cover`.

