## [4.6.0] — 2026-05-25

### Padronização Estrutural
Todos os estilos agora têm a mesma estrutura — apenas cores, tipografia e decorações mudam entre eles:

- **Line-height do texto corrido** — padronizado para `1.80` em todos os estilos (Campo e Paixão, Moderno, Tinta & Papel, Colorado, Rock estavam com valores distintos: 1.75 ou 1.85)
- **Line-height dos comentários** — padronizado para `1.80` (base estava em 1.75)
- **Blockquote padding** — padronizado para `1.4rem 1.8rem` em todos (Vintage Café e Tinta & Papel tinham `1.6rem 2rem`)
- **Blockquote font-size** — padronizado para `1.05rem` em todos (Vintage Café e Tinta & Papel tinham `1.08rem`)
- **Blockquote line-height** — padronizado para `1.80` em todos os estilos
- **Widget h3 font-size** — padronizado para `0.85rem` em todos (Colorado e Rock tinham `0.82rem`)
- **Botão Voltar (back-link) padding** — padronizado para `8px 18px` (Colorado e Rock tinham `6px 16px`)
- **Botão Publicar comentário padding** — padronizado para `0.65rem 1.6rem` (Rock tinha `10px 28px`)
- **Widget margin-bottom Marinelli** — removido override de `15px`, usa o padrão do tema
- **Menu font-size Marinelli** — corrigido de `0.92rem` para `0.95rem` (igual ao restante)
- **Widget padding Campo e Paixão** — removido override de `1.4rem 1.2rem`, usa o padrão
- **Widget texto Campo e Paixão** — removido override de `font-size: 0.93rem`
- **Widget texto Colorado** — removido `font-size` e `line-height: 1.70`, usa o padrão

### Novo Estilo
- **⚽ Noite de Jogo — Portal Esportivo** — 11º estilo do tema. Verde noturno de estádio (`#0d1f0f`) com verde gramado vibrante (`#00b140`) e amarelo de gol (`#f5c842`). Pensado para portais de futebol, placares ao vivo e cobertura de campeonatos. Tipografia Montserrat bold, faixa de gramado no topo dos widgets, linha animada verde-gramado→amarelo no header, atmosfera de jogo noturno

### Melhorias Visuais
- **Aspas decorativas dos blockquotes** — estavam invisíveis em todos os 9 estilos (contraste ~1.1:1). Corrigidas com opacidade adequada em cada paleta: Padrão, Campo e Paixão, Vintage Café, Tinta & Papel, Neon Pop, Colorado, Rock, Moderno e Céu e Fé
- **Céu e Fé** — aspas decorativas adicionadas ao blockquote (estilo estava sem elas)
- **Tinta & Papel** — diferenciado visualmente do Vintage Café: fundo agora azul-acinzentado frio (#e8ecf0) em vez de creme quente, conteúdo em tom neutro (#f2f4f6), aside em azul-cinza (#dde3e8). Antes os dois estilos pareciam idênticos na tela
- **Tinta & Papel** — linha de acento do header mais espessa (4px) e mais brilhante para reforçar a identidade visual distinta
- **Colorado** — textos de widgets com `word-break: break-word` mais agressivo para evitar quebra de palavras com hífen em plugins de terceiros

### Correções de Bugs
- **6 blocos `@media (prefers-reduced-motion)` inválidos corrigidos** — cada um tinha um seletor CSS com vírgula solta e linha vazia, causando erro de sintaxe CSS nos estilos Campo e Paixão, Tinta & Papel, Padrão, Moderno, Neon Pop e Vintage Café
- **Seletor `body.style-moderno h1` duplicado removido** — `h1` aparecia três vezes na mesma regra; reduzido para um seletor válido
- **Bloco `.social-icons` duplicado removido** — havia duas definições do seletor causando conflito de propriedades (a segunda sobrescrevia `display:flex` e `gap` da primeira)
- **Seletor universal `footer * :not(a)` substituído** em 7 estilos — o seletor `*` forçava cor sobre todos os elementos filhos, incluindo textos com gradiente (`-webkit-text-fill-color: transparent`), quebrando títulos em gradiente no rodapé. Substituído por seletores específicos (`p`, `span`, `li`)
- **Foco por teclado no menu corrigido (WCAG 2.4.7)** — o CSS tinha `outline: 0 !important` aplicado inclusive em `:focus-visible`, tornando invisível o indicador de foco para usuários de teclado. Corrigido: `:focus:not(:focus-visible)` suprime o outline no mouse; `:focus-visible` exibe o anel de foco adequado
- **`back-link` removido da listagem de posts** — o botão "Voltar" aparecia na página inicial/blog onde não faz sentido semântico
- **Função de aviso admin incompleta completada** — `independent_theme_admin_menu_notice()` estava declarada sem corpo; agora exibe dica sobre classes CSS em itens de menu na tela de Menus
- **Regra CSS `.widget` do estilo Rock com `position: relative` fora de ordem** — o pseudo-elemento `::before` era definido antes de `position: relative` no elemento pai, causando comportamento inconsistente em alguns navegadores; regra consolidada

### Acessibilidade
- **`aria-label` dos links "Leia mais" corrigido** — era genérico (`aria-label="Leia mais"`), agora inclui o título do post: `aria-label="Leia mais sobre {título}"` (corrigido em `index.php`, `archive.php` e `search.php`)
- **`alt` das miniaturas de posts relacionados corrigido** — era `alt=""` (ignorado por leitores de tela); agora usa o título do post
- **`alt` das miniaturas na listagem corrigido** — era genérico `"Imagem do post"`; agora usa o título do post

### Estilos
- **Céu e Fé** — estilos completos adicionados (o estilo existia no Personalizador mas o CSS de conteúdo, sidebar, rodapé e interações estava ausente — apenas comentários vazios)
- **Cor dos títulos de comentários** — `.comments-title` e `#reply-title` usavam `var(--primary-color)` (cor do header); corrigido para `var(--text-color)` que é legível no contexto de conteúdo
- **Cor do link de resposta a comentários** — `.comment-reply a` e `.comment-author-name` usavam cor fixa `#1a1a1a !important` que quebrava estilos escuros; corrigido para `var(--text-color)`
- **Cor do botão "Voltar"** — `.back-link a` usava `color: #1a1a1a !important` inapropriado em estilos escuros; corrigido para `var(--text-color)`

## [4.5.0] — 2026-05-22

### Novo
- **Rodapé em 4 colunas** — nova estrutura profissional em três camadas:
  - **Faixa de 4 colunas** lado a lado — Rodapé Coluna 1, 2, 3 e 4, configuráveis em Aparência → Widgets
  - **Faixa central** de largura total — área abaixo das colunas para conteúdo institucional
  - **Redes sociais + créditos + copyright** — igual ao padrão anterior, preservado
  - Responsivo: no mobile as colunas empilham verticalmente
  - Compatível com todos os 10 estilos automaticamente

### Código
- 5 keyframes órfãos removidos — `ceuafeAurora`, `ceuafeTitleGlow`, `ceuafeWidgetPulse`, `ceuafeButtonGlow`, `coloradoWidgetPulse`
- 3 keyframes incompletos corrigidos — `gradientShift`, `modernoNebula`, `neonPopGradient` estavam sem os frames intermediários e sem fechamento

## [4.4.0] — 2026-05-21

### Visual
- **Colorado reformulado** — header metálico em três camadas, linha dourada, botão Buscar dourado, indicador dourado no item ativo, widgets com faixa gradiente dourado→vermelho, rodapé com borda dourada

### Layout
- **Imagem destacada nas páginas** — `page.php` exibe a imagem no topo do conteúdo, igual aos posts. Não exibe na página inicial estática

### Acessibilidade
- **Foco por teclado global** — `*:focus:not(:focus-visible)` remove outline azul do browser. `*:focus-visible` usa `--accent-color` de cada estilo
- **Imagens na listagem padronizadas** — 160×110px com `object-fit: cover` em todos os estilos

## [4.3.0] — 2026-05-21

> *Lancei esta versão no dia em que completei 43 anos.*
> *A versão e a idade alinhadas no mesmo dia — não é coincidência, é destino.*
> *Um presente que fiz para mim mesmo: código, acessibilidade e muito rock.* 🎸🎂
>
> — Leandro Souza

### Novo
- **Estilo Rock** — 10º e último estilo do tema
- **Personalizador:** opção "Listar subpáginas"

## [4.2.0] — 2026-05-20

### Acessibilidade
- NVDA anuncia imagens da listagem como gráfico
- `aria-required="true"` nos campos de comentários
- Foco por teclado no menu corrigido
- Botão Voltar com `<nav aria-label>`
- Sidebar com `aria-label` traduzível

### Layout
- `main` com `flex: 1 1 0` — expande sem sidebar
- `aside` com `flex: 0 0 300px`
- Sidebar não renderiza quando vazia
- `align-items: flex-start` global no container

### Estilos
- **Marinelli** reescrito fiel ao Drupal 7
- **Campo e Paixão** linha do menu de 3px para 2px
- **Moderno** fallback de cor no nome do site

### Personalizador
- Logo padrão de 320×160px para 200×80px

### Excerpt
- Resumo de 15 para 25 palavras
