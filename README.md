# WEYA
O aplicativo tem como objetivo conectar turistas a motoristas locais, permitindo a seleção de atrações turísticas, cálculo de preços por trajeto ou pacote, e gestão de corridas em tempo real. O MVP foca em três perfis principais: Usuário, Motorista e Administrador.

## Objetivo
Desenvolver um MVP de aplicação web para turismo/transporte, com perfis de usuário, motorista e administrador, incluindo mapa interativo, cálculo de preços, notificações em tempo real e gestão de corridas/pacotes.

### O que já foi feito
1. Projeto Laravel criado com sucesso.

2. Banco de dados criado (BD existente e conectada ao Laravel).


### Tecnologias
Configuração inicial do ambiente com as seguintes tecnologias:
**PHP**, **Composer**, **Node.js**, **npm**, **Laravel**, **Vite**.

### Problemas técnicos resolvidos:
* Erro de permissões na pasta bootstrap/cache corrigido.
* Erro de dependência do autoprefixer resolvido com instalação e configuração do PostCSS.

### Planeamento técnico definido:
* Stack escolhida: Laravel (back-end) + Vue.js/Tailwind (front-end) + MySQL/PostgreSQL (BD).
* Definidos componentes principais do front-end e funcionalidades-chave do back-end.
* Fluxo de funcionamento do MVP mapeado.

## Integração com a IA
Para isto usou-se o `embedding` (algorítimos de modelos de aprendizado de máquina (ML) e pesquisa semântica).

### Mapeamento de quais campos indexar

- Corridas (Tour): id, título, descrição, duração, preço, horário, local, restrições.

- Motorista: id, nome, experiencia (resumo), idiomas, veículos (se útil).

- PacoteTuristicos: id, nome, descrição longa, inclusões, duracao, preco, itinerário, pontos de interesse.

# Considerações CSS

## Páginas do Brevemente
A ideia foi aplicar um fundo com imagem suave, um leve gradiente escuro transparente e um texto central com um efeito ``“coming soon”`` animado (brilho, fade, e escrita suave).
Toques técnicos para as páginas de **Brevemente**:
* Camada bg-opacity-40: cria um leve véu escuro para dar contraste ao texto sem apagar a imagem.
* Efeito “pulse”: dá brilho discreto à palavra **Disponível Brevemente**.
* Tipografia: o texto é elegante, centrado e legível em qualquer modo (claro ou escuro).
* O bloco central ``(div.fade-in)`` aparece com transição vertical e aumento de opacidade.
* O efeito é suave e só ocorre uma vez ao carregar a página.
* Continua leve e elegante, sem distrair do resto da interface.
* O ``backdrop-blur-sm`` (na page ``index`` do restaurante) aplica um leve desfoque apenas sobre o fundo, deixando o texto perfeitamente nítido.
* Continua leve, sem perder desempenho (não é um blur pesado).
* O **_Blur_** funciona bem com TailwindCSS 3+ e browsers modernos.
