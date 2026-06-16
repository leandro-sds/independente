# Changelog — Independent Theme

## [6.2] — 2026-06-14

### Atualização automática

- **Botão "Ativar atualizações automáticas" agora aparece** na tela Aparência › Temas. O checker passou a registrar o tema também em `no_update` quando ele já está na versão mais recente — é esse registro que faz o WordPress exibir o controle de auto-atualização (antes, com o tema em dia, nada era registrado no transient e o botão não surgia). Com o controle visível, cada site pode ligar a auto-atualização pelo painel, sem editar código.
- Comentário interno corrigido: a fonte de atualização é o servidor próprio (wpacessivel.com.br), não GitHub.

---

## [6.1] — 2026-06-13

### Céu e Fé — refinamento visual (sem alterar HTML nem ordem de leitura)

- **Cabeçalho "céu profundo"**: gradiente do topo aprofundado para três paradas (#103358 → #0a2040 → #06152b), criando sensação de céu noturno. Menu branco permanece AAA (12.8).
- **Tipografia editorial**: títulos grandes (h1/h2/h3/entry-title) passam a usar Playfair Display (serifada elegante já carregada pelo tema), trazendo o peso de Bíblia impressa. Texto corrido e menus seguem em fonte reta.
- **Versículo monumental**: bloco de citação ampliado (1.12rem → 1.4rem), entrelinha maior (1.95) e fonte Playfair, tornando a Palavra a âncora visual da página. Ordem de leitura para leitor de tela inalterada.
- **Microinterações**: surgimento suave (fade-up) dos blocos de conteúdo ao abrir a página; flutuação dos banners/anúncios do Conteúdo Extra no hover (sobem 5px, sombra se espalha). Ambos respeitam prefers-reduced-motion (desativados para quem pede menos movimento).
- **Indicador de foco de alto contraste**: o anel de foco da navegação por teclado passou a usar o azul-marinho da identidade (#0d2b4a, contraste 12.7 sobre o fundo claro), em vez do amarelo-dourado do acento (que é ótimo como preenchimento de botão, mas fraco como anel fino sobre o bege). Atende ao ponto de contraste do parecer sem descaracterizar os botões dourados.

---

## [6.0] — 2026-06-13

Marco de lançamento. Consolida toda a série 5.x num release estável, focado em
preenchimento de layout, nova área de conteúdo e uma varredura completa de
acessibilidade (contraste WCAG) nos 13 estilos.

### Destaques desde a 5.7

- **Layout sem vãos** (5.8–5.15): cartão de conteúdo que estica até o rodapé em
  páginas curtas; coluna única centralizada quando sem sidebar; respiro correto
  antes do rodapé, no desktop e no mobile.
- **Nova área "Conteúdo Extra"** (5.10–5.11): região de widgets abaixo do
  conteúdo, na ordem de leitura correta para leitores de tela (cabeçalho → corpo
  → conteúdo extra → sidebar → rodapé), com visual herdado de cada estilo.
- **Blindagem de widgets** (5.12–5.13): títulos e conteúdo de widgets legíveis no
  rodapé escuro; articles de plugins de listagem deixam de virar cartões soltos.
- **Cobertura de elementos nativos do WordPress** (5.18): figcaption, mark,
  wp-block-quote, wp-block-table e select agora estilizados nos 13 estilos.
- **Acessibilidade de contraste** (5.16–5.21): auditoria WCAG real (cálculo de
  razão de contraste) de menus, ícones sociais, títulos, links, campos,
  placeholders e botões. Todos os pontos de texto e ícone nos 13 estilos passam
  AA; relatório em AUDITORIA-5.18.md.
- **Correção de número de estilos** na descrição do tema: 11 → 13.

Sem mudanças estruturais de HTML/PHP nesta série; a base flex/grid permaneceu
estável. Todas as correções foram de camada de apresentação (cor, espaçamento,
cobertura), preservando a identidade de cada estilo.

---

## [5.21] — 2026-06-13

### Melhorias (parecer UI/UX externo)

- **Céu e Fé: aspas do bloco de citação** — a aspa decorativa grande estava em laranja a 50% (`rgba(224,123,57,0.50)`), contraste ~2.8 sobre o fundo bege, apontado no parecer como difícil de ver. Trocada por ocre escuro `rgba(184,84,26,0.85)` (4.3, acima do limiar de elemento gráfico). Restrito ao Céu e Fé.
- **Alvorada: botão de busca mais vibrante** — dourado clareado de `#C9A227` para `#d4af37`, elevando o contraste sobre o cabeçalho verde-oliva (4.74 → 5.45) para o botão "saltar mais", mantendo o texto escuro legível (7.0).
- **Rádio Jovem (Neon Pop): botão de busca mais luminoso** — magenta clareado (`#e0226e/#c0135a` → `#f0317e/#d4165e`), botão mais destacado sobre o fundo escuro (4.13 → 4.86) preservando o texto branco acima de 3.0.

### Notas (avaliações do parecer já atendidas ou conscientemente mantidas)

- **Colorado**: o parecer sugeriu fundo de conteúdo branco em vez de pêssego; verificado que a área de conteúdo já é `#ffffff` (o tom rosado é o fundo da página atrás dos cartões, por design). Sem alteração.
- **Moderno**: o parecer sugeriu `box-shadow` para suavizar bordas neon finas; já implementado nas versões anteriores (cards têm brilho difuso, não borda crua). Sem alteração.
- **Rock**: o parecer (nota 6) pediu remover textos/bordas vermelhas finas; já atendido na 5.20 (títulos/links de widget e social-title elevados a `#ff3333`, AA). O vermelho restante é preenchimento de elementos grandes, como o próprio parecer recomenda.
- **Noite de Jogo**: sugestão de baixar saturação do verde é preferência estética sem impacto de contraste; identidade do estilo mantida.
- **Aspas decorativas de blockquote** nos demais estilos têm contraste baixo por serem ornamentais (isentas do critério WCAG como conteúdo); mantidas por design, exceto a do Céu e Fé que o parecer destacou.

---

## [5.20] — 2026-06-13

### Correções (estilo Rock)

- **Vermelho de baixo contraste no Rock** — o vermelho `#cc0000` usado em títulos e links de widget, no título "Redes Sociais" (.social-title) e nos títulos de widget do rodapé ficava ilegível sobre fundos escuros: 2.96 sobre o card de Conteúdo Extra (`#1a1a1a`, definido na 5.11) e 3.4 sobre o rodapé preto (`#080808`), ambos abaixo de AA. Elevado para `#ff3333` (o vermelho que o estilo já usava no hover), agora AA: títulos/links de widget 4.78, social-title e títulos de widget do rodapé 5.51. Hover dos links de widget ajustado para `#ff6666`. Mudança restrita ao estilo Rock. Observação: o card escuro do Conteúdo Extra no Rock veio da uniformização 5.11; esta correção fecha o contraste do texto sobre ele.

### Notas

- Reauditados os 13 estilos para o mesmo padrão (título/link de widget sobre card de widget). Confirmado por inspeção que apenas o Rock falhava; os demais usam título claro sobre card escuro ou título escuro sobre card claro, todos ≥ 4.5.

---

## [5.19] — 2026-06-13

### Correções

- **Contraste do placeholder do campo de busca** — o texto de pista ("Buscar...") tinha contraste abaixo de AA em seis estilos de cabeçalho escuro. Medido por composição das camadas translúcidas (campo sobre cabeçalho, placeholder sobre campo) e elevada a opacidade do placeholder, mantendo a cor de identidade de cada estilo: Alvorada (0.55→0.70), Colorado (0.60→0.70), Gospel (0.40→0.55), Moderno (0.50→0.60), Noite de Jogo (0.50→0.55) e Rock (0.40→0.55). Todos passam AA (≥4.8). Os outros sete estilos já passavam. Mudança restrita à cor do placeholder; nenhuma outra regra alterada.

---

## [5.18] — 2026-06-13

### Auditoria de acessibilidade e cobertura (relatório em AUDITORIA-5.18.md)

Auditoria completa dos 13 estilos com cálculo real de contraste WCAG 2.1 (menu, ícones sociais, corpo, títulos, links, campos de formulário) e varredura dos elementos nativos do WordPress.

### Correções

- **Tinta & Papel: menu com cor explícita** — links de menu inativos dependiam da herança da base e o tom de acento ficava no limite de contraste (4.2). Agora `#e8c478` (AA, 6.6) sobre o cabeçalho, sem depender de herança.
- **Cobertura de elementos nativos do WordPress** — adicionados ao CSS base, herdando os tokens do tema (válidos nos 13 estilos): `figcaption`/`.wp-element-caption` (legendas de imagem), `mark` (texto grifado), `.wp-block-quote` (citação do editor de blocos, herda o visual de blockquote), `.wp-block-table table` (tabela do editor de blocos, herda o visual de table) e `select` (campo de seleção, herda o visual dos demais campos). Antes esses elementos apareciam sem estilo / com aparência crua do navegador.

### Notas

- Confirmado por medição que texto de corpo, títulos, links de conteúdo e campos de formulário já passavam AA/AAA em todos os 13 estilos (resultado das correções 5.14–5.17). Nenhuma regressão; todas as mudanças são adições escopadas, sem alterar regras existentes dos estilos.

---

## [5.17] — 2026-06-13

### Correções

- **Estilo Padrão: menu e ícones sociais com cor explícita** — o estilo Padrão não declarava cor própria para os links de menu inativos nem para os ícones sociais em repouso; ambos dependiam da herança do CSS base. Agora declara explicitamente: links de menu em branco puro (`#ffffff`, era herança a 90%) e ícones sociais em branco 92%, com hover no laranja do estilo em opacidade plena. Elimina a fragilidade de depender da herança e maximiza o contraste sobre o cabeçalho/rodapé escuros.
- **Gospel: menu em contraste pleno** — links de menu inativos subiram de 82% para 95% de opacidade, acompanhando a correção dos ícones sociais da 5.16.

### Notas

- Auditoria completa de contraste de menu e ícones sociais nos 13 estilos. Colorado e Tinta & Papel não declaram cor de repouso para ícones sociais (herdam o branco da base, portanto visíveis); ficam como candidatos a declaração explícita numa próxima rodada, junto da decisão de uniformizar todos os estilos de uma vez.

---

## [5.16] — 2026-06-13

### Correções

- **Ícones sociais com contraste insuficiente no rodapé escuro** — em vários estilos de rodapé escuro os ícones sociais em repouso tinham contraste baixo e quase desapareciam: Gospel e Alvorada subiram de 70% para 95% de opacidade; Rock passou de cinza médio `#888880` para `#cfcfc8`; Noite de Jogo passou de `#7a9a7a` para `#b8d4b8`. As cores de hover (acento de cada estilo) foram preservadas. Mudanças restritas a esses quatro estilos.
- **Seletores de hover dos ícones sociais quebrados (base)** — as regras `.social-icons a:hover` e `.social-links a:hover` no CSS base terminavam em vírgula e se fundiam com as regras seguintes (`.child-pages` e `.site-title`), de modo que o estado hover dos ícones não tinha corpo próprio e herdava estilos errados. Cada seletor recebeu corpo próprio (cor de acento + leve elevação) e o `:focus-visible` foi incluído junto. Correção no CSS base, válida para os 13 estilos.

---

## [5.15] — 2026-06-13

### Correções

- **Respiro antes do rodapé corrigido no lugar certo** — a 5.14 adicionou respiro dentro do `main`, mas o ponto de contato visível era a borda inferior do bloco claro (`.site-content`, fundo `--bg-light`) contra o corte do rodapé escuro. Agora o respiro é `padding-bottom: var(--space-xl)` no `.site-content` (e `--space-lg` no mobile, via responsive.css), criando a faixa de respiro simétrica antes do corte para o rodapé. O `main` voltou ao padding uniforme e o `padding-bottom` redundante do Conteúdo Extra foi removido. O respiro fica no container externo, fora do `.container` que tem `align-items: stretch`, então não recria o vazio interno das versões 5.7/5.8. Vale para os 13 estilos.

---

## [5.14] — 2026-06-13

### Melhorias

- **Respiro antes do rodapé** — o conteúdo do `main` (e a região Conteúdo Extra, quando presente) encostava na borda inferior da área clara, criando assimetria com o respiro do topo do rodapé. Agora o `main` tem padding inferior maior e a região Conteúdo Extra tem `padding-bottom` próprio, garantindo respiro antes do corte para o rodapé. Vale para os 13 estilos; não recria o vazio das versões anteriores, pois é respiro fixo, não esticamento.
- **Céu e Fé: links de menu em branco puro** — os links inativos do menu superior passaram de branco 88% para branco 100%, elevando o contraste sobre o azul do cabeçalho e eliminando qualquer percepção de "apagado". Mudança restrita ao estilo Céu e Fé.

---

## [5.13] — 2026-06-13

### Correções

- **Articles dentro de widgets deixam de virar cartões de post** — corrige a causa raiz por trás das "caixas brancas" vistas em widgets de listagem (plugins de posts recentes / posts por categoria, que marcam cada item como `<article>`, uso correto de HTML). A regra global de cartão de post do tema — e os reforços que os 13 estilos aplicam em `article`, vários com `::before` decorativo, zebra `nth-child`, hover de elevação e `!important` — alcançavam esses articles aninhados, transformando cada item de lista num cartão branco com sombra: ilegível em rodapés escuros e visualmente duplicado em qualquer widget (sidebar, Conteúdo Extra ou rodapé). Agora, todo `<article>` dentro de `.widget`/`.footer-widget` tem fundo, borda, sombra, padding, raio, animação, pseudo-elementos e hover neutralizados, comportando-se como item de lista. Especificidade (0,1,3) calculada para vencer `body.style-X article` (0,1,2) em todos os estilos, com `!important` nas propriedades para cobrir os reforços que também usam `!important`. Correção única no CSS base; não toca no cartão do próprio widget (`.widget`) nem no player. Nenhum arquivo de estilo foi alterado.

---

## [5.12] — 2026-06-12

### Correções

- **Blindagem dos widgets do rodapé** — corrige dois defeitos que tornavam conteúdo ilegível em widgets do rodapé (colunas e faixa central) sobre os rodapés escuros dos 13 estilos: (1) títulos de widget ficavam na cor de título da barra lateral (escura, pensada para fundo claro) e sumiam sobre o rodapé — agora herdam a cor de texto do rodapé, com especificidade suficiente para vencer regras de título com `!important` dos estilos; (2) listas, grupos e blocos com fundo definido no editor mantinham caixas claras enquanto os estilos pintavam o texto do rodapé de branco, gerando "caixas brancas" com texto invisível — agora o conteúdo interno dos widgets perde fundos, bordas e sombras próprios e adota o visual do rodapé. Botões de bloco preservam seu fundo (intencional). Correção única no CSS base, válida para os 13 estilos sem alteração nos arquivos de estilo.

---

## [5.11] — 2026-06-11

### Melhorias

- **Conteúdo Extra com a cara do conteúdo** — os widgets da região Conteúdo Extra agora seguem o visual do cartão de conteúdo (article) em vez do visual da barra lateral: regra base aplica `background-color: var(--card-bg)` (a mesma variável do article, válida nos 13 estilos) e remove a listra decorativa `::before` que sete estilos usam como assinatura da sidebar. Ajustes pontuais por estilo: Rock perde a faixa vermelha de topo e alinha fundo/borda ao article; Tinta & Papel e Vintage Café trocam o cartão acinzentado/creme da sidebar pelo branco com a borda do article; Moderno preserva o brilho de vidro (shine + borderGlow) que o article também tem. Exceção consciente: no Neon Pop os widgets extras mantêm o cartão escuro na cor do main, pois os textos internos dos widgets foram projetados para fundo escuro e o cartão claro do article quebraria o contraste WCAG. Gospel e Alvorada já eram idênticos ao article de fábrica e não precisaram de ajuste.

---

## [5.10] — 2026-06-11

### Novidades

- **Nova área de widgets: "Conteúdo Extra — abaixo do conteúdo"** — região opcional renderizada dentro de `<main>`, após o conteúdo, em todos os templates (página, post, listagem, arquivo e busca). Ordem de leitura garantida pelo DOM para leitores de tela: cabeçalho → corpo → conteúdo extra → barra lateral → rodapé. É um landmark "region" (`section` + `aria-label="Conteúdo extra"`), permitindo salto direto via navegação por landmarks. Os widgets ficam lado a lado em telas largas (grid responsivo `auto-fit`, mínimo 240px) e empilham no celular. A região usa `margin-top: auto` para ancorar-se no pé da coluna, absorvendo a folga vertical de páginas curtas — complementa as correções 5.7/5.8 e ajuda a preencher páginas com sidebar longa. Usa o mesmo marcador `.widget` da barra lateral, herdando automaticamente o visual dos 13 estilos, sem nenhuma alteração nos arquivos de estilo. Quando vazia, nada é impresso — nenhuma marcação, nenhum espaço. No modo sem sidebar (`no-sidebar`), a região é centralizada junto com o restante do conteúdo.

---

## [5.9] — 2026-06-11

### Melhorias

- **Layout de coluna única centralizado** — quando a Barra Lateral está sem widgets (`body.no-sidebar`), o cartão de conteúdo (artigo, paginação, comentários, relacionados e subpáginas) agora é centralizado horizontalmente no `main` de largura total, com teto de `--prose-max + 2×espaço`. Antes, o texto ficava encostado na margem esquerda com grande vazio à direita em telas largas. Vale para todos os estilos — o `main` continua pintado de ponta a ponta com a identidade de cada estilo; apenas a coluna de leitura é centralizada.

---

## [5.8] — 2026-06-11

### Correções

- **Fim do "vão" branco em páginas curtas** — complemento da correção da 5.7: o `align-items: stretch` igualou a altura das colunas, mas o cartão do artigo continuava terminando junto com o texto, deixando um grande espaço vazio dentro do `main` quando a sidebar era mais longa que o conteúdo (ex.: página inicial com player + apoiador + recomendados). Agora o `main` é uma coluna flex e o cartão do artigo estica até o fim da coluna (`main > article:only-child, main > article:last-child { flex: 1 0 auto }`). Vale para todos os estilos, pois nenhum deles altera o layout do `main` (apenas cores e animações). Listagens (index/archive/search) e posts (single) não são afetados, pois o artigo nunca é o último filho do `main` nesses templates.

---

## [5.7] — 2026-06-10

### Correções e Infraestrutura

- **Sidebar sempre completamente visível** — corrigido `align-items: flex-start` para `align-items: stretch` no `.container`. Todos os widgets da sidebar aparecem independente do tamanho do conteúdo principal.

- **Migração do sistema de atualizações** — a partir desta versão, as atualizações automáticas são servidas pelo servidor próprio `wpacessivel.com.br` em vez do GitHub. O processo de publicação de novas versões é agora mais simples: upload do ZIP via FTP + acesso ao `updater.php`.

---

## [5.6] — 2026-06-10

Versão idêntica à 5.5 — republicada por problema técnico no GitHub.

---

## [5.5] — 2026-06-10

### Novo Estilo: Gospel ✨ — "Luz que Rompe"

Estilo criado do zero para rádios gospel, músicos, bandas, ministérios e portais de louvor contemporâneo. Inspirado nas grandes produções Elevation Worship, Hillsong United e Bethel Music.

- **Paleta "Luz que Rompe"** — fundo Midnight Indigo `#07071A`, acento Dourado Solar `#FFD166`, links em Lilás Divino `#A78BFA`, texto quase branco `#F0EFF8`.
- **Tipografia** — títulos em **Raleway ExtraBold 800** (impacto moderno, diferente de tudo no tema), corpo em Inter.
- **Linha dourada animada** no header — gradiente lilás→dourado→lilás que explode ao carregar.
- **Borda gradiente nos cards** — linha diagonal dourado→lilás via `::before`, com `box-shadow` de brilho dourado.
- **Glow dourado** em todos os elementos interativos — botões, widgets, cards têm uma aura dourada difusa.
- **Blockquote** — fundo indigo profundo, aspas ornamentais douradas, Raleway itálico.
- **23/23 componentes verificados** — header, nav, artigos, comentários, formulários, widgets, busca Gutenberg, 404, rodapé, social links, paginação, mobile e `prefers-reduced-motion`.
- **Google Fonts** carregadas apenas quando o Gospel está ativo.

---

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

