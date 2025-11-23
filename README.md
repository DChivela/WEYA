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
**_Importante:_** Para rodar o projecto devemos usar sempre o ``composer run dev`` ou o ``npm run dev`` para que todas as dependências sejam usadas, pois o ``php artisan serve`` levanta apenas o servidor do **Laravel** e não as demais como o **Tailwind CSS** ou o **Vite** que são os responsáveis por outras funcionalidades da beleza ou execução de algum recurso.
## Navigation - Visão Geral
O sistema de navegação utiliza **TailwindCSS**, **Blade Components** e **Alpine.js** para fornecer um menu responsivo com duas versões:
**Menu Desktop** – exibido a partir de **sm**: ``(≥ 640px)``

**Menu Mobile (Hamburger)** – exibido abaixo de **sm**: ``(< 640px)``

Ambos utilizam os componentes do Breeze:
* <x-nav-link> (versão desktop)
* <x-responsive-nav-link> (versão mobile)

O estado de abertura do menu mobile é controlado pelo Alpine.js usando a variável open.
A navegação está envolvida por um container Alpine:
<nav x-data="{ open: false }">

- A variável open controla:
- Visibilidade do menu mobile
- Alternância dos ícones do botão hamburger

### Códigos da versão desktop
Código do menu normal
``
                ``<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">``
                    ``<x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">``
                       `` {{ __('Dashboard') }}``
                    ``</x-nav-link>``
                ``</div>``

#### Características:
- Utiliza o espaço horizontal **(space-x-4)**;
- Componente padrão <x-nav-link>;
- Não aparece em telas pequenas **(hidden sm:flex)**.

### Cdigo da versão mobile
O botão do menu aparece apenas em telas pequenas (sm:hidden):
``<button @click="open = !open" class="sm:hidden">``

Código do menu-mobile - para usar dentro da classe do Hamburguer (menu colapsável:):
``    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden"> ``
       `` <div class="pt-2 pb-3 space-y-1">``
            ``<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">``
                ``{{ __('Dashboard') }}``
            ``</x-responsive-nav-link>``
        ``</div>``
``</div>``
        

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
