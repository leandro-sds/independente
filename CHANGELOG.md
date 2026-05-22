# Changelog — Independent Theme

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
