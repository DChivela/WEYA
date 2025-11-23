    const html = document.documentElement;
    const themeToggle = document.getElementById('theme-toggle');

    // Carregar preferência guardada
    if (localStorage.theme === 'dark') {
        html.classList.add('dark');
    } else if (localStorage.theme === 'light') {
        html.classList.remove('dark');
    }

    themeToggle.addEventListener('click', () => {
        if (html.classList.contains('dark')) {
            html.classList.remove('dark');
            localStorage.theme = 'light';
        } else {
            html.classList.add('dark');
            localStorage.theme = 'dark';
        }
    });
