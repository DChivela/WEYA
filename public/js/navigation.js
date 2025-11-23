//{{-- Para minimizar a conversar com o assistente --}}
    (function() {
        const widget = document.getElementById('ai-widget');
        const body = document.getElementById('ai-body');
        const toggleBtn = document.getElementById('ai-toggle');
        const miniBtn = document.getElementById('ai-mini');

        const historyDiv = document.getElementById('ai-history');
        const inputEl = document.getElementById('ai-q');

        // enviar (mantive teu fetch)
        document.getElementById('ai-send').addEventListener('click', async () => {
            const q = inputEl.value.trim();
            if (!q) return alert('Escreve a pergunta');

            const userMsg = document.createElement('div');
            userMsg.style.fontWeight = '700';
            userMsg.style.color = '#0b5aa6';
            userMsg.style.marginBottom = '6px';
            userMsg.textContent = "Tu: " + q;
            historyDiv.appendChild(userMsg);

            const loadingMsg = document.createElement('div');
            loadingMsg.style.color = '#333';
            loadingMsg.style.marginBottom = '8px';
            loadingMsg.textContent = "Assistente: A processar...";
            historyDiv.appendChild(loadingMsg);
            historyDiv.scrollTop = historyDiv.scrollHeight;

            inputEl.value = '';

            try {
                const resp = await fetch('/ai/query', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        q
                    })
                });

                const data = await resp.json();

                loadingMsg.textContent = data && typeof data.answer === 'string' ?
                    "Assistente: " + data.answer :
                    "Erro: resposta inválida";

                historyDiv.scrollTop = historyDiv.scrollHeight;

            } catch (err) {
                loadingMsg.textContent = 'Erro ao contactar o servidor: ' + err.message;
                historyDiv.scrollTop = historyDiv.scrollHeight;
            }
        });

        // estado persistente
        const STATE_KEY = 'ai-widget-collapsed';

        function isCollapsed() {
            return localStorage.getItem(STATE_KEY) === '1';
        }

        function setCollapsed(val) {
            localStorage.setItem(STATE_KEY, val ? '1' : '0');
        }

        // aplicar estado UI
        function applyState() {
            if (isCollapsed()) {
                // mostra mini botão e esconde widget (mas posiciona histórico/textarea ocultos)
                widget.style.transform = 'translateY(20px)';
                widget.style.opacity = '0';
                widget.style.pointerEvents = 'none';
                miniBtn.style.display = 'block';
                miniBtn.setAttribute('aria-hidden', 'false');
                toggleBtn.setAttribute('aria-expanded', 'false');
            } else {
                widget.style.transform = 'translateY(0)';
                widget.style.opacity = '1';
                widget.style.pointerEvents = 'auto';
                miniBtn.style.display = 'none';
                miniBtn.setAttribute('aria-hidden', 'true');
                toggleBtn.setAttribute('aria-expanded', 'true');
            }
        }

        // toggle a partir do header
        toggleBtn.addEventListener('click', () => {
            const next = !isCollapsed();
            setCollapsed(next);
            applyState();
        });

        // abrir clicando no mini botão
        miniBtn.addEventListener('click', () => {
            setCollapsed(false);
            applyState();
            // foco no input
            setTimeout(() => inputEl.focus(), 120);
        });

        // atalhos de teclado: Enter/Space no toggle
        toggleBtn.addEventListener('keyup', (e) => {
            if (e.key === 'Enter' || e.key === ' ') toggleBtn.click();
        });
        miniBtn.addEventListener('keyup', (e) => {
            if (e.key === 'Enter' || e.key === ' ') miniBtn.click();
        });

        // inicia com estado salvo
        applyState();

        // se o widget estiver a cobrir muito em mobile: reduzir largura automaticamente
        function responsiveAdjust() {
            if (window.innerWidth < 420) {
                widget.style.right = '12px';
                widget.style.bottom = '12px';
                widget.style.width = '92%';
            } else {
                widget.style.right = '20px';
                widget.style.bottom = '20px';
                widget.style.width = '320px';
            }
        }
        window.addEventListener('resize', responsiveAdjust);
        responsiveAdjust();

    })();
