document.addEventListener("DOMContentLoaded", () => {
    const abasCursos = Array.from(
        document.querySelectorAll('.cursos-abas [role="tab"]')
    );

    const paineisCursos = Array.from(
        document.querySelectorAll('.cursos-painel[role="tabpanel"]')
    );

    const botaoTodos = document.querySelector("#botao-todos-cursos");

    function selecionarAba(aba) {
        const idPainel = aba.getAttribute("aria-controls");
        const painelSelecionado = document.getElementById(idPainel);

        if (!painelSelecionado) {
            return;
        }

        abasCursos.forEach((item) => {
            const selecionada = item === aba;

            item.classList.toggle("ativo", selecionada);
            item.setAttribute("aria-selected", String(selecionada));
            item.setAttribute("tabindex", selecionada ? "0" : "-1");
        });

        paineisCursos.forEach((painel) => {
            painel.hidden = painel !== painelSelecionado;
        });

        const lista = painelSelecionado.querySelector(".cursos-lista");

        if (lista) {
            lista.scrollTo({
                left: 0,
                behavior: "smooth"
            });
        }
    }

    abasCursos.forEach((aba, indice) => {
        aba.addEventListener("click", () => {
            selecionarAba(aba);
        });

        aba.addEventListener("keydown", (evento) => {
            let proximoIndice = indice;

            if (evento.key === "ArrowRight") {
                proximoIndice = (indice + 1) % abasCursos.length;
            } else if (evento.key === "ArrowLeft") {
                proximoIndice = (indice - 1 + abasCursos.length) % abasCursos.length;
            } else if (evento.key === "Home") {
                proximoIndice = 0;
            } else if (evento.key === "End") {
                proximoIndice = abasCursos.length - 1;
            } else {
                return;
            }

            evento.preventDefault();

            abasCursos[proximoIndice].focus();
            selecionarAba(abasCursos[proximoIndice]);
        });
    });

    if (botaoTodos) {
        botaoTodos.addEventListener("click", () => {
            const abaTodos = document.querySelector("#aba-todos");

            if (!abaTodos) {
                return;
            }

            selecionarAba(abaTodos);

            document.querySelector("#cursos").scrollIntoView({
                behavior: "smooth"
            });

            abaTodos.focus({
                preventScroll: true
            });
        });
    }

    paineisCursos.forEach((painel) => {
        const lista = painel.querySelector(".cursos-lista");
        const anterior = painel.querySelector(".seta-anterior");
        const proxima = painel.querySelector(".seta-proxima");

        if (!lista || !anterior || !proxima) {
            return;
        }

        anterior.addEventListener("click", () => {
            lista.scrollBy({
                left: -lista.clientWidth,
                behavior: "smooth"
            });
        });

        proxima.addEventListener("click", () => {
            lista.scrollBy({
                left: lista.clientWidth,
                behavior: "smooth"
            });
        });
    });
});