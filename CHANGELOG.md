# Changelog — Independent Theme

## [4.2.0] — 2026-05-20

### Acessibilidade
- Imagens na listagem de posts agora têm `alt="Imagem do post"` — o NVDA anuncia corretamente como **gráfico**
- Removido `aria-hidden` do link da imagem na listagem — imagem agora está diretamente no fluxo de leitura
- Adicionado `aria-required="true"` nos campos obrigatórios do formulário de comentários — compatibilidade com versões antigas do NVDA
- Foco por teclado no menu corrigido — `outline` agora é suprimido apenas para mouse (`:focus:not(:focus-visible)`); navegação por Tab mantém indicador visual de 3px
- Botão "← Voltar" agora usa `<nav aria-label="Navegação de retorno">` em vez de `<div>`
- `aria-label` da barra lateral agora passa pelo sistema de tradução do WordPress

### Layout
- `main` reformulado com `flex: 1 1 0` — expande naturalmente para 100% quando não há sidebar
- `aside` reformulado com `flex: 0 0 300px` — ocupa espaço fixo apenas quando presente no DOM
- Sidebar não renderiza o elemento `<aside>` quando não há widgets ativos — elimina bloco cinza vazio
- `align-items: flex-start` adicionado globalmente no `.container` — main e aside sempre se alinham pelo topo
- `margin-bottom: 1.4em` em listas (`li`) adicionado globalmente — mesmo espaçamento dos parágrafos

### Estilos
- **Campo e Paixão:** linha vermelha abaixo do menu reduzida de 3px para 2px
- **Colorado:** busca e menu fixados à direita com `flex` global — sem mais quebra de linha
- **Moderno:** fallback de cor sólida `#00f5d4` no nome do site — texto visível em browsers sem suporte a `background-clip: text`
- **Todos os estilos:** regras de layout redundantes removidas de estilos específicos — layout agora é verdadeiramente global

### Código
- 4 keyframes órfãos do Céu e Fé removidos (`ceuafeAurora`, `ceuafeTitleGlow`, `ceuafeWidgetPulse`, `ceuafeButtonGlow`)
- Bloco `@media (prefers-reduced-motion)` com seletor incompleto no Colorado corrigido
- Hover duplicado em `.post-thumbnail-link` removido
- Código morto de `--muted-text` no Vintage Café e Campo e Paixão removido
- Imagem da listagem movida para fora do link — elemento `<div class="post-thumbnail-wrap">` substitui `<a class="post-thumbnail-link">`

### Personalizador
- Tamanho padrão da logo reduzido de 320×160px para 200×80px — evita logo grande empurrando o menu
- Exemplos e placeholders dos controles de logo atualizados

### Excerpt
- Tamanho padrão do resumo aumentado de 15 para 25 palavras — mais contexto para o leitor de tela antes do "Leia mais"
