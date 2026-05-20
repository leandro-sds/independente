# Changelog — Independent Theme

## [4.3.0] — 2026-05-21

> *Lancei esta versão no dia em que completei 43 anos.*
> *A versão e a idade alinhadas no mesmo dia — não é coincidência, é destino.*
> *Um presente que fiz para mim mesmo: código, acessibilidade e muito rock.* 🎸🎂
>
> — Leandro Souza

### Novo
- **Estilo Rock** — 10º e último estilo do tema, completo e detalhado:
  - Paleta preto profundo + vermelho sangue + branco sujo
  - Header preto com gradiente escuro e borda vermelha
  - Linha vermelha que rasga ao carregar (0.3s — rápida e agressiva)
  - Menu em caixa alta com fonte Oswald e chama vermelha no hover
  - Títulos com entrada de impacto — Oswald bold em caixa alta
  - Blockquote escuro com aspas em vermelho sangue
  - Widgets com borda vermelha no topo e fundo quase preto
  - Botão LEIA MAIS em vermelho sólido com hover brilhante
  - Botão VOLTAR em vermelho com borda — Oswald em caixa alta
  - Comentários com nome do autor em vermelho
  - Botão RESPONDER com borda vermelha — hover preenchido em vermelho
  - Formulário de comentários com campos escuros e foco vermelho
  - Paginação escura com destaque vermelho
  - Rodapé preto profundo com linha vermelha separando do conteúdo
  - Suporte completo a `prefers-reduced-motion`
  - Totalmente acessível — contraste WCAG AA validado em todos os pares

## [4.2.0] — 2026-05-20

### Acessibilidade
- Imagens na listagem de posts agora têm `alt="Imagem do post"` — o NVDA anuncia corretamente como **gráfico**
- Imagem da listagem movida para fora do link — elemento `<div class="post-thumbnail-wrap">` substitui `<a class="post-thumbnail-link">`
- Adicionado `aria-required="true"` nos campos obrigatórios do formulário de comentários
- Foco por teclado no menu corrigido — outline suprimido apenas para mouse; Tab mantém indicador visual de 3px
- Botão "← Voltar" agora usa `<nav aria-label="Navegação de retorno">`
- `aria-label` da barra lateral agora passa pelo sistema de tradução do WordPress

### Layout
- `main` reformulado com `flex: 1 1 0` — expande naturalmente para 100% quando não há sidebar
- `aside` reformulado com `flex: 0 0 300px` — ocupa espaço fixo apenas quando presente no DOM
- Sidebar não renderiza o `<aside>` quando não há widgets ativos
- `align-items: flex-start` adicionado globalmente no `.container`
- `margin-bottom: 1.4em` em listas adicionado globalmente

### Estilos
- **Campo e Paixão:** linha vermelha abaixo do menu reduzida de 3px para 2px
- **Colorado:** busca e menu fixados à direita com flex global
- **Moderno:** fallback de cor sólida no nome do site para browsers sem suporte a `background-clip: text`

### Código
- 4 keyframes órfãos do Céu e Fé removidos
- Bloco `@media (prefers-reduced-motion)` com seletor incompleto no Colorado corrigido
- Hover duplicado em `.post-thumbnail-link` removido

### Personalizador
- Tamanho padrão da logo reduzido de 320×160px para 200×80px

### Excerpt
- Tamanho padrão do resumo aumentado de 15 para 25 palavras
