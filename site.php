
<?php
$imagemLogo = "src/images/compuway.logo.png";
$imagemBanner = "src/images/banner-compuway.png";
$imagemFachada = "src/images/compuway-fachada.png";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Compuway | Educação e Tecnologia</title>

    <link rel="stylesheet" href="components/site.css">
</head>

<body>

    <header class="cabecalho">
        <div class="menu">

            <a href="#inicio" aria-label="Página inicial da Compuway">
                <img src="<?= $imagemLogo ?>" alt="Logo Compuway">
            </a>

            <nav aria-label="Navegação principal">
                <a href="#inicio">Início</a>
                <a href="#historia">Quem somos</a>
                <a href="#cursos">Cursos</a>
                <a href="#contato">Contato</a>
            </nav>

            <a class="botao-login" href="system/login.php">
                Login <span aria-hidden="true">↗</span>
            </a>

        </div>
    </header>

    <main>

        <!-- INÍCIO -->

        <section class="inicio" id="inicio">

            <div class="inicio-fundo"></div>

            <div class="inicio-conteudo">

                <div class="inicio-texto">

                    <h1>
                        Você será o Próximo
                        <span>Gênio da Informática!</span>
                    </h1>

                    <p>
                        Transformamos o aprendizado em oportunidades.
                        Nossa missão é preparar pessoas para o futuro
                        por meio da tecnologia, do conhecimento e de
                        uma formação prática de qualidade.
                    </p>

                    <div class="inicio-botoes">

                        <a class="botao-principal" href="#cursos">
                            Conheça nossos cursos
                        </a>

                        <a class="botao-secundario" href="#" onclick="return false;">
                            Converse com a escola
                        </a>

                    </div>

                </div>

                <div class="inicio-imagem">

                    <img
                        src="<?= $imagemBanner ?>"
                        alt="Estudante aprendendo informática"
                    >

                </div>

            </div>

        </section>

        <!-- HISTÓRIA -->

        <section class="historia" id="historia">

            <div class="historia-container">

                <div class="historia-conteudo">

                    <div class="historia-texto">

                        <h2>
                            Nossa <span>História</span>
                        </h2>

                        <h3>
                            Mais que cursos, construímos futuros!
                        </h3>

                        <p>
                            Há mais de 21 anos, a Compuway nasceu com
                            o propósito de transformar conhecimento
                            em novas oportunidades.
                        </p>

                        <p>
                            Acreditamos que a educação e a tecnologia
                            são ferramentas importantes para transformar
                            vidas e abrir portas para novas oportunidades.
                        </p>

                        <p>
                            Ao longo dessa trajetória, trabalhamos para
                            oferecer conhecimento prático e preparar
                            nossos alunos para os desafios do mercado
                            de trabalho.
                        </p>

                    </div>

                    <div class="historia-destaque">

                        <p>
                            <strong>21 anos de história</strong>, milhares
                            de alunos e um propósito: preparar você
                            para o futuro.
                        </p>

                    </div>

                </div>

                <div class="historia-imagem">

                    <img
                        src="<?= $imagemFachada ?>"
                        alt="Fachada da escola Compuway"
                        loading="lazy"
                    >

                </div>

                <div class="diferenciais">

                    <article class="diferencial-card">

                        <div class="icone" aria-hidden="true">✓</div>

                        <div>
                            <h3>Ensino prático</h3>

                            <p>
                                Aprendizado voltado para situações
                                reais do dia a dia.
                            </p>
                        </div>

                    </article>

                    <article class="diferencial-card">

                        <div class="icone" aria-hidden="true">★</div>

                        <div>
                            <h3>Profissionais qualificados</h3>

                            <p>
                                Orientação para desenvolver
                                habilidades e conhecimentos.
                            </p>
                        </div>

                    </article>

                    <article class="diferencial-card">

                        <div class="icone" aria-hidden="true">↗</div>

                        <div>
                            <h3>Novas oportunidades</h3>

                            <p>
                                Conhecimento para avançar nos
                                estudos e na carreira.
                            </p>
                        </div>

                    </article>

                </div>

            </div>

        </section>

        <!-- CURSOS -->

        <section class="cursos" id="cursos">

            <div class="cursos-container">

                <div class="cursos-cabecalho">

                    <div class="cursos-introducao">

                        <span class="cursos-etiqueta">
                            CURSOS E PACOTES
                        </span>

                        <h2>
                            Do básico ao avançado,
                            <span>você encontra aqui!</span>
                        </h2>

                        <p>
                            Conheça nossas formações e desenvolva
                            habilidades para ampliar suas oportunidades
                            no mercado de trabalho.
                        </p>

                    </div>

                    <div class="cursos-beneficios">

                        <div class="cursos-beneficio">
                            <span class="icone" aria-hidden="true">✓</span>
                            <span>
                                Aulas práticas e<br>dinâmicas
                            </span>
                        </div>

                        <div class="cursos-beneficio">
                            <span class="icone" aria-hidden="true">★</span>
                            <span>
                                Professores<br>especializados
                            </span>
                        </div>

                        <div class="cursos-beneficio">
                            <span class="icone" aria-hidden="true">▣</span>
                            <span>
                                Certificado de<br>conclusão
                            </span>
                        </div>

                    </div>

                </div>

                <!-- ABAS DOS CURSOS -->

                <div
                    class="cursos-abas"
                    role="tablist"
                    aria-label="Categorias de cursos"
                >

                    <button
                        type="button"
                        class="ativo"
                        role="tab"
                        id="aba-individuais"
                        aria-selected="true"
                        aria-controls="cursos-individuais"
                        tabindex="0"
                    >
                        Cursos individuais
                    </button>

                    <button
                        type="button"
                        role="tab"
                        id="aba-pacotes"
                        aria-selected="false"
                        aria-controls="pacotes-cursos"
                        tabindex="-1"
                    >
                        Pacotes de cursos
                    </button>

                    <button
                        type="button"
                        role="tab"
                        id="aba-todos"
                        aria-selected="false"
                        aria-controls="todos-cursos"
                        tabindex="-1"
                    >
                        Todos os cursos
                    </button>

                </div>

                <!-- CURSOS INDIVIDUAIS -->

                <div
                    class="cursos-painel"
                    id="cursos-individuais"
                    role="tabpanel"
                    aria-labelledby="aba-individuais"
                    tabindex="0"
                >

                    <div class="cursos-carrossel">

                        <button
                            class="seta-cursos seta-anterior"
                            type="button"
                            aria-label="Ver cursos anteriores"
                        >
                            &#10094;
                        </button>

                        <div class="cursos-lista">

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-hardware.png"
                                    alt="Componentes de computador para montagem e manutenção"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>T.I. em Hardware</h3>

                                    <p>
                                        Aprenda sobre componentes,
                                        montagem, manutenção e diagnóstico
                                        de computadores.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Saiba mais
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-excel.png"
                                    alt="Curso de Excel Essencial e Avançado"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>Excel Essencial e Avançado</h3>

                                    <p>
                                        Desenvolva habilidades com
                                        planilhas, fórmulas, funções
                                        e organização de dados.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Saiba mais
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-power-bi.png"
                                    alt="Curso de Power BI e análise de dados"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>Power BI</h3>

                                    <p>
                                        Aprenda a organizar dados e criar
                                        relatórios e painéis visuais.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Saiba mais
                                    </a>

                                </div>

                            </article>

                        </div>

                        <button
                            class="seta-cursos seta-proxima"
                            type="button"
                            aria-label="Ver próximos cursos"
                        >
                            &#10095;
                        </button>

                    </div>

                </div>

                <!-- PACOTES DE CURSOS -->

                <div
                    class="cursos-painel"
                    id="pacotes-cursos"
                    role="tabpanel"
                    aria-labelledby="aba-pacotes"
                    tabindex="0"
                    hidden
                >

                    <div class="cursos-carrossel">

                        <button
                            class="seta-cursos seta-anterior"
                            type="button"
                            aria-label="Ver pacotes anteriores"
                        >
                            &#10094;
                        </button>

                        <div class="cursos-lista">

                            <article class="curso-card">

                                <div class="curso-imagem-placeholder">
                                    Pacote Office
                                </div>

                                <div class="curso-conteudo">

                                    <h3>Pacote Office Completo</h3>

                                    <p>
                                        Domine as principais ferramentas
                                        do pacote Office para o dia a dia
                                        profissional.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Ver pacote
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <div class="curso-imagem-placeholder">
                                    Design Gráfico
                                </div>

                                <div class="curso-conteudo">

                                    <h3>Pacote de Design Gráfico</h3>

                                    <p>
                                        Aprenda a criar artes digitais,
                                        logotipos e materiais visuais
                                        utilizando ferramentas de design.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Ver pacote
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-excel.png"
                                    alt="Curso de Excel Essencial e Avançado"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>Excel Essencial e Avançado</h3>

                                    <p>
                                        Desenvolva conhecimentos em
                                        planilhas, fórmulas e recursos
                                        avançados do Excel.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Ver pacote
                                    </a>

                                </div>

                            </article>

                        </div>

                        <button
                            class="seta-cursos seta-proxima"
                            type="button"
                            aria-label="Ver próximos pacotes"
                        >
                            &#10095;
                        </button>

                    </div>

                </div>

                <!-- TODOS OS CURSOS -->

                <div
                    class="cursos-painel"
                    id="todos-cursos"
                    role="tabpanel"
                    aria-labelledby="aba-todos"
                    tabindex="0"
                    hidden
                >

                    <div class="cursos-carrossel">

                        <button
                            class="seta-cursos seta-anterior"
                            type="button"
                            aria-label="Ver cursos anteriores"
                        >
                            &#10094;
                        </button>

                        <div class="cursos-lista">

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-hardware.png"
                                    alt="Componentes de computador para montagem e manutenção"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>T.I. em Hardware</h3>

                                    <p>
                                        Aprenda sobre componentes,
                                        montagem, manutenção e diagnóstico
                                        de computadores.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Saiba mais
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-excel.png"
                                    alt="Curso de Excel Essencial e Avançado"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>Excel Essencial e Avançado</h3>

                                    <p>
                                        Desenvolva habilidades com
                                        planilhas, fórmulas, funções
                                        e organização de dados.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Saiba mais
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-power-bi.png"
                                    alt="Curso de Power BI e análise de dados"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>Power BI</h3>

                                    <p>
                                        Aprenda a organizar dados e criar
                                        relatórios e painéis visuais.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Saiba mais
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <div class="curso-imagem-placeholder">
                                    Pacote Office
                                </div>

                                <div class="curso-conteudo">

                                    <h3>Pacote Office Completo</h3>

                                    <p>
                                        Domine as principais ferramentas
                                        do pacote Office para o dia a dia
                                        profissional.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Ver pacote
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <div class="curso-imagem-placeholder">
                                    Design Gráfico
                                </div>

                                <div class="curso-conteudo">

                                    <h3>Pacote de Design Gráfico</h3>

                                    <p>
                                        Aprenda a criar artes digitais,
                                        logotipos e materiais visuais
                                        utilizando ferramentas de design.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Ver pacote
                                    </a>

                                </div>

                            </article>

                            <article class="curso-card">

                                <img
                                    src="src/images/curso-excel.png"
                                    alt="Curso de Excel Essencial e Avançado"
                                    loading="lazy"
                                >

                                <div class="curso-conteudo">

                                    <h3>Excel Essencial e Avançado</h3>

                                    <p>
                                        Desenvolva conhecimentos em
                                        planilhas, fórmulas e recursos
                                        avançados do Excel.
                                    </p>

                                    <a class="botao-principal" href="#contato">
                                        Ver pacote
                                    </a>

                                </div>

                            </article>

                        </div>

                        <button
                            class="seta-cursos seta-proxima"
                            type="button"
                            aria-label="Ver próximos cursos"
                        >
                            &#10095;
                        </button>

                    </div>

                </div>

            </div>

            <!-- CHAMADA FINAL DOS CURSOS -->

            <div class="cursos-chamada">

                <div>
                    <small>SEU PRÓXIMO PASSO</small>

                    <h3>
                        O seu futuro digital começa agora!
                    </h3>
                </div>

                <p>
                    Escolha seu caminho, desenvolva novas habilidades
                    e prepare-se para novas oportunidades.
                </p>

                <button
                    class="botao-todos-cursos"
                    id="botao-todos-cursos"
                    type="button"
                >
                    Ver todos os cursos
                    <span aria-hidden="true">→</span>
                </button>

            </div>

        </section>

        <!-- CONTATO -->

        <section class="contato" id="contato">

            <div class="contato-container">

                <div class="contato-informacoes">

                    <h2>Entre em contato</h2>

                    <p>
                        Quer saber mais sobre nossos cursos?
                        Estamos aqui para ajudar.
                    </p>

                    <h3>Vamos conversar?</h3>

                    <p>
                        Envie sua mensagem ou utilize um dos
                        nossos canais de atendimento.
                    </p>

                    <div class="contato-dados">

                        <div class="contato-item">

                            <div class="icone" aria-hidden="true">☎</div>

                            <div>
                                <h4>Telefone</h4>
                                <p>(34) 3333-0000</p>
                            </div>

                        </div>

                        <div class="contato-item">

                            <div class="icone" aria-hidden="true">@</div>

                            <div>
                                <h4>E-mail</h4>

                                <a href="mailto:contato@compuwayvarjaodeminas.com.br">
                                    contato@compuwayvarjaodeminas.com.br
                                </a>
                            </div>

                        </div>

                        <div class="contato-item">

                            <div class="icone" aria-hidden="true">⌖</div>

                            <div>
                                <h4>Endereço</h4>

                                <p>
                                    Av. Jovino Mariano Gomes, 1100
                                </p>
                            </div>

                        </div>

                    </div>

                </div>

                <!-- FORMULÁRIO -->

                <div class="contato-formulario">

                    <h3>Envie sua mensagem</h3>

                    <p>
                        Preencha os campos abaixo para entrar
                        em contato conosco.
                    </p>

                    <form action="#" method="post">

                        <div>
                            <label for="nome">Nome completo</label>

                            <input
                                type="text"
                                id="nome"
                                name="nome"
                                placeholder="Digite seu nome"
                                required
                            >
                        </div>

                        <div>
                            <label for="email">E-mail</label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="Digite seu e-mail"
                                required
                            >
                        </div>

                        <div>
                            <label for="telefone">Telefone</label>

                            <input
                                type="tel"
                                id="telefone"
                                name="telefone"
                                placeholder="Digite seu telefone"
                            >
                        </div>

                        <div>
                            <label for="assunto">Assunto</label>

                            <select id="assunto" name="assunto" required>
                                <option value="">Selecione um assunto</option>
                                <option value="cursos">Informações sobre cursos</option>
                                <option value="matricula">Matrícula</option>
                                <option value="outros">Outros assuntos</option>
                            </select>
                        </div>

                        <div>
                            <label for="mensagem">Mensagem</label>

                            <textarea
                                id="mensagem"
                                name="mensagem"
                                placeholder="Escreva sua mensagem"
                                required
                            ></textarea>
                        </div>

                        <button class="botao-principal" type="submit">
                            Enviar mensagem
                        </button>

                    </form>

                </div>

            </div>

            <!-- LOCALIZAÇÃO -->

            <div class="contato-localizacao">

                <h3>Onde estamos</h3>

                <iframe
                    src="https://www.google.com/maps?q=Av.%20Jovino%20Mariano%20Gomes%201100%2C%20Varj%C3%A3o%20de%20Minas%2C%20MG&output=embed"
                    title="Localização da Compuway no mapa"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>

            </div>

        </section>

    </main>

    <!-- RODAPÉ -->

    <footer class="rodape">

        <div class="rodape-container">

            <a href="#inicio" aria-label="Voltar ao início">

                <img
                    src="<?= $imagemLogo ?>"
                    alt="Logo Compuway"
                    loading="lazy"
                >

            </a>

            <nav aria-label="Links do rodapé">
                <a href="#inicio">Início</a>
                <a href="#historia">Quem somos</a>
                <a href="#cursos">Cursos</a>
                <a href="#contato">Contato</a>
            </nav>

            <div class="rodape-redes">

                <a href="#contato" aria-label="Entre em contato">
                    Contato ↗
                </a>

            </div>

        </div>

        <div class="rodape-final">

            <div>

                <p>
                    © <?= date("Y") ?> Compuway. Todos os direitos reservados.
                </p>

                <p>
                    Educação e tecnologia para o futuro.
                </p>

            </div>

        </div>

    </footer>

    <script src="js/cursos.js" defer></script>

</body>
</html>
