
document.addEventListener("DOMContentLoaded", () => {

    // ABAS DE CURSOS

    const abas = document.querySelectorAll(".cursos-abas button");
    const paineis = document.querySelectorAll(".cursos-painel");

    abas.forEach((aba) => {
        aba.addEventListener("click", () => {

            abas.forEach((item) => {
                item.classList.remove("ativo");
                item.setAttribute("aria-selected", "false");
                item.setAttribute("tabindex", "-1");
            });

            paineis.forEach((painel) => {
                painel.classList.remove("ativo");
                painel.hidden = true;
            });

            aba.classList.add("ativo");
            aba.setAttribute("aria-selected", "true");
            aba.setAttribute("tabindex", "0");

            const painelId = aba.getAttribute("aria-controls");
            const painel = document.getElementById(painelId);

            if (painel) {
                painel.classList.add("ativo");
                painel.hidden = false;
            }
        });
    });


    // CARROSSEL DE CURSOS E PACOTES

    const carrosseis = document.querySelectorAll(".cursos-carrossel");

    carrosseis.forEach((carrossel) => {

        const lista = carrossel.querySelector(".cursos-lista");
        const anterior = carrossel.querySelector(".seta-anterior");
        const proxima = carrossel.querySelector(".seta-proxima");

        if (!lista || !anterior || !proxima) return;

        const calcularDeslocamento = () => {
            const card = lista.querySelector(".curso-card");

            if (!card) return 0;

            const estilo = window.getComputedStyle(lista);
            const espacamento = parseFloat(estilo.columnGap) || 0;

            return card.getBoundingClientRect().width + espacamento;
        };

        anterior.addEventListener("click", () => {
            lista.scrollBy({
                left: -calcularDeslocamento(),
                behavior: "smooth"
            });
        });

        proxima.addEventListener("click", () => {
            lista.scrollBy({
                left: calcularDeslocamento(),
                behavior: "smooth"
            });
        });

    });

});
