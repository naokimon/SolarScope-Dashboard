    (function () {
        const knoppen = document.querySelectorAll('.tijdspanne-knop');
        knoppen.forEach(knop => {
            knop.addEventListener('click', () => {
                knoppen.forEach(k => k.classList.remove('actief'));
                knop.classList.add('actief');

                document.dispatchEvent(new CustomEvent('tijdspanne-change', {
                    detail: { periode: knop.dataset.periode }
                }));
            });
        });
    })();