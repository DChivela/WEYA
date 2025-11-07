# WEYA
O aplicativo tem como objetivo conectar turistas a motoristas locais, permitindo a seleção de atrações turísticas, cálculo de preços por trajeto ou pacote, e gestão de corridas em tempo real. O MVP foca em três perfis principais: Usuário, Motorista e Administrador.

## Integração com a IA
Para isto usou-se o `embedding`

### Mapeamento de quais campos indexar (sugestão)

- Corridas (Tour): id, título, descrição, duração, preço, horário, local, restrições.

- Motorista: id, nome, experiencia (resumo), idiomas, veículos (se útil).

- PacoteTuristicos: id, nome, descrição longa, inclusões, duracao, preco, itinerário, pontos de interesse.

