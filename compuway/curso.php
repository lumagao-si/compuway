
<?php

$pagina_atual = 'curso.php';

$cursos = [

    'ti-hardware' => [
        'nome' => 'T.I. em Hardware',
        'categoria' => 'Curso individual',
        'imagem' => 'src/images/curso-hardware.png',
        'descricao' => 'Conheça os principais componentes de um computador e aprenda conceitos fundamentais de montagem, manutenção e identificação de problemas em equipamentos.',
        'conteudos' => [
            'Conhecimento dos componentes do computador',
            'Identificação de peças e periféricos',
            'Noções de montagem e manutenção',
            'Diagnóstico de problemas de hardware'
        ],
        'tipo' => 'individual'
    ],

    'excel-individual' => [
        'nome' => 'Excel Essencial e Avançado',
        'categoria' => 'Curso individual',
        'imagem' => 'src/images/curso-excel.png',
        'descricao' => 'Aprenda a utilizar o Microsoft Excel para organizar informações, realizar cálculos, criar planilhas e desenvolver análises com recursos essenciais e avançados.',
        'conteudos' => [
            'Conhecimento da interface do Excel',
            'Criação e formatação de planilhas',
            'Fórmulas e funções',
            'Organização e análise de dados',
            'Criação de gráficos',
            'Recursos avançados do Excel'
        ],
        'tipo' => 'individual'
    ],

    'power-bi' => [
        'nome' => 'Power BI',
        'categoria' => 'Curso individual',
        'imagem' => 'src/images/curso-power-bi.png',
        'descricao' => 'Aprenda a trabalhar com dados utilizando o Power BI, criando relatórios e painéis visuais que facilitam a interpretação das informações.',
        'conteudos' => [
            'Introdução ao Power BI',
            'Importação de dados',
            'Organização e transformação de informações',
            'Criação de gráficos e relatórios',
            'Desenvolvimento de painéis interativos'
        ],
        'tipo' => 'individual'
    ],

    'recursos-humanos' => [
        'nome' => 'Recursos Humanos',
        'categoria' => 'Curso individual',
        'imagem' => 'src/images/curso-rh.png',
        'descricao' => 'Conheça conceitos e práticas da área de Recursos Humanos, compreendendo atividades relacionadas à gestão de pessoas e à rotina organizacional.',
        'conteudos' => [
            'Introdução à área de Recursos Humanos',
            'Gestão de pessoas',
            'Recrutamento e seleção',
            'Treinamento e desenvolvimento',
            'Rotinas administrativas de RH'
        ],
        'tipo' => 'individual'
    ],

    'auxiliar-escritorio' => [
        'nome' => 'Auxiliar de Escritório',
        'categoria' => 'Curso individual',
        'imagem' => 'src/images/curso-auxiliar-escritorio.png',
        'descricao' => 'Desenvolva conhecimentos importantes para atuar em ambientes administrativos, conhecendo atividades de organização, atendimento e apoio ao funcionamento de empresas.',
        'conteudos' => [
            'Rotinas administrativas',
            'Organização de documentos',
            'Atendimento ao público',
            'Comunicação profissional',
            'Organização do ambiente de trabalho'
        ],
        'tipo' => 'individual'
    ],

    'word-2016' => [
        'nome' => 'Word 2016',
        'categoria' => 'Curso individual',
        'imagem' => 'src/images/curso-word-2016.png',
        'descricao' => 'Aprenda a utilizar o Microsoft Word 2016 para criar, editar e formatar documentos, utilizando ferramentas que facilitam as atividades do dia a dia.',
        'conteudos' => [
            'Conhecimento da interface do Word',
            'Criação e edição de documentos',
            'Formatação de textos',
            'Inserção de tabelas e imagens',
            'Configuração e impressão de documentos'
        ],
        'tipo' => 'individual'
    ],

    'pacote-office' => [
        'nome' => 'Pacote Office Completo',
        'categoria' => 'Pacote',
        'imagem' => 'src/images/curso-pacote-office.png',
        'descricao' => 'Amplie seus conhecimentos em informática e aprenda a utilizar ferramentas importantes do pacote Office para atividades acadêmicas e profissionais.',
        'conteudos' => [
            'Fundamentos de informática',
            'Microsoft Word',
            'Microsoft Excel',
            'Microsoft PowerPoint',
            'Utilização de ferramentas de escritório'
        ],
        'tipo' => 'pacote'
    ],

    'design-grafico' => [
        'nome' => 'Pacote de Design Gráfico',
        'categoria' => 'Pacote',
        'imagem' => 'src/images/curso-design-grafico.png',
        'descricao' => 'Desenvolva conhecimentos em ferramentas de criação e edição gráfica, explorando recursos utilizados na produção de materiais visuais e peças de comunicação.',
        'conteudos' => [
            'CorelDRAW',
            'Adobe Photoshop',
            'Adobe Illustrator',
            'Criação e edição de imagens',
            'Desenvolvimento de materiais gráficos'
        ],
        'tipo' => 'pacote'
    ],

    'excel-pacote' => [
        'nome' => 'Excel Essencial e Avançado',
        'categoria' => 'Pacote',
        'imagem' => 'src/images/curso-excel.png',
        'descricao' => 'Aprofunde seus conhecimentos em planilhas eletrônicas, desde os recursos essenciais até ferramentas avançadas para organização e análise de dados.',
        'conteudos' => [
            'Excel essencial',
            'Criação e formatação de planilhas',
            'Fórmulas e funções',
            'Excel avançado',
            'Análise e organização de dados'
        ],
        'tipo' => 'pacote'
    ]

];

// Identifica o curso selecionado pela URL
$codigoCurso = $_GET['curso'] ?? '';

if (!isset($cursos[$codigoCurso])) {
    http_response_code(404);
    $curso = null;
} else {
    $curso = $cursos[$codigoCurso];
}

// Define a carga horária
if ($curso !== null) {
    $cargaHoraria = $curso['tipo'] === 'pacote' ? 150 : 18;
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?= $curso ? htmlspecialchars($curso['nome'], ENT_QUOTES, 'UTF-8') . ' | Compuway' : 'Curso não encontrado | Compuway' ?>
    </title>

    <link rel="icon" href="src/images/compuway.logo.png" type="image/png">

    <style>
        :root {
            --roxo: #452078;
            --roxo-claro: #5b2da0;
            --laranja: #ff7900;
            --fundo: #ffffff;
            --fundo-lilas: #f5f1fa;
            --texto: #292d40;
            --texto-secundario: #626174;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: var(--fundo);
            color: var(--texto);
        }

        a {
            text-decoration: none;
        }

        .cabecalho-curso {
            width: 100%;
            background: #ffffff;
            border-bottom: 1px solid #eee9f4;
            padding: 15px 5.5%;
        }

        .cabecalho-conteudo {
            max-width: 1280px;
            margin: auto;
            min-height: 65px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
        }

        .logo-curso img {
            width: 145px;
            max-height: 65px;
            object-fit: contain;
        }

        .voltar-cursos {
            color: var(--roxo);
            font-weight: 600;
            font-size: 15px;
            transition: 0.3s;
        }

        .voltar-cursos:hover {
            color: var(--laranja);
        }

        .pagina-detalhes {
            max-width: 1180px;
            width: 89%;
            margin: 55px auto 80px;
        }

        .caminho-curso {
            margin-bottom: 30px;
            color: var(--texto-secundario);
            font-size: 14px;
        }

        .caminho-curso a {
            color: var(--roxo);
            font-weight: 600;
        }

        .detalhes-principais {
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 55px;
            margin-bottom: 55px;
        }

        .imagem-curso {
            width: 100%;
            min-height: 300px;
            border-radius: 18px;
            overflow: hidden;
            background: var(--fundo-lilas);
        }

        .imagem-curso img {
            width: 100%;
            height: 350px;
            display: block;
            object-fit: cover;
        }

        .categoria-curso {
            display: inline-block;
            background: #f0eafa;
            color: var(--roxo);
            font-size: 13px;
            font-weight: 700;
            padding: 8px 15px;
            border-radius: 20px;
            margin-bottom: 18px;
        }

        .informacoes-curso h1 {
            color: var(--roxo);
            font-size: clamp(28px, 4vw, 38px);
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .informacoes-curso > p {
            color: var(--texto-secundario);
            font-size: 16px;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .carga-horaria {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 17px;
            background: var(--fundo-lilas);
            border-left: 4px solid var(--laranja);
            border-radius: 10px;
        }

        .icone-carga {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: var(--roxo);
            border-radius: 50%;
            font-size: 22px;
            font-weight: bold;
        }

        .carga-horaria strong {
            display: block;
            color: var(--roxo);
            font-size: 17px;
            margin-bottom: 4px;
        }

        .carga-horaria span {
            color: var(--texto-secundario);
            font-size: 13px;
        }

        .secao-conteudo {
            background: var(--fundo-lilas);
            border-radius: 16px;
            padding: 35px;
            margin-bottom: 30px;
        }

        .secao-conteudo h2 {
            color: var(--roxo);
            font-size: 25px;
            margin-bottom: 25px;
        }

        .lista-conteudos {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            list-style: none;
        }

        .lista-conteudos li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: var(--texto);
            font-size: 15px;
            line-height: 1.6;
        }

        .lista-conteudos li::before {
            content: "✓";
            flex-shrink: 0;
            width: 23px;
            height: 23px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--roxo);
            color: #ffffff;
            font-weight: bold;
            font-size: 13px;
        }

        .secao-certificado {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 28px;
            border: 1px solid #e9e1f2;
            border-radius: 15px;
        }

        .icone-certificado {
            width: 55px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            border-radius: 12px;
            background: #f0eafa;
            color: var(--roxo);
            font-size: 27px;
        }

        .secao-certificado h2 {
            color: var(--roxo);
            font-size: 19px;
            margin-bottom: 8px;
        }

        .secao-certificado p {
            color: var(--texto-secundario);
            font-size: 14px;
            line-height: 1.7;
        }

        .rodape-curso {
            background: var(--roxo);
            padding: 25px 5%;
            text-align: center;
            color: #ffffff;
        }

        .rodape-curso p {
            font-size: 14px;
        }

        .curso-nao-encontrado {
            min-height: 65vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 40px 20px;
        }

        .curso-nao-encontrado h1 {
            color: var(--roxo);
            margin-bottom: 15px;
        }

        .curso-nao-encontrado p {
            color: var(--texto-secundario);
            margin-bottom: 25px;
        }

        .botao-voltar {
            display: inline-block;
            background: var(--laranja);
            color: #ffffff;
            padding: 13px 24px;
            border-radius: 8px;
            font-weight: 700;
            transition: 0.3s;
        }

        .botao-voltar:hover {
            background: var(--roxo);
            color: #ffffff;
        }

        @media (max-width: 800px) {
            .detalhes-principais {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .imagem-curso img {
                height: 300px;
            }

            .lista-conteudos {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 500px) {
            .cabecalho-curso {
                padding: 12px 5%;
            }

            .logo-curso img {
                width: 115px;
            }

            .voltar-cursos {
                font-size: 13px;
            }

            .pagina-detalhes {
                width: 90%;
                margin: 35px auto 55px;
            }

            .imagem-curso img {
                height: 230px;
            }

            .secao-conteudo {
                padding: 23px 18px;
            }

            .secao-conteudo h2 {
                font-size: 21px;
            }

            .secao-certificado {
                align-items: flex-start;
                padding: 20px;
            }
        }
    </style>

</head>

<body>

    <header class="cabecalho-curso">
        <div class="cabecalho-conteudo">

            <a href="site.php" class="logo-curso">
                <img src="src/images/compuway.logo.png" alt="Compuway">
            </a>

            <a href="todos-cursos.php" class="voltar-cursos">
                ← Voltar aos cursos
            </a>

        </div>
    </header>

    <?php if ($curso === null): ?>

        <main class="curso-nao-encontrado">
            <h1>Curso não encontrado</h1>

            <p>
                Não conseguimos localizar esse curso.
                Confira a página de todos os cursos.
            </p>

            <a href="todos-cursos.php" class="botao-voltar">
                Ver todos os cursos
            </a>
        </main>

    <?php else: ?>

        <main class="pagina-detalhes">

            <div class="caminho-curso">
                <a href="site.php">Início</a>
                /
                <a href="todos-cursos.php">Cursos</a>
                /
                <?= htmlspecialchars($curso['nome'], ENT_QUOTES, 'UTF-8') ?>
            </div>

            <section class="detalhes-principais">

                <div class="imagem-curso">
                    <img
                        src="<?= htmlspecialchars($curso['imagem'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="<?= htmlspecialchars($curso['nome'], ENT_QUOTES, 'UTF-8') ?>"
                    >
                </div>

                <div class="informacoes-curso">

                    <span class="categoria-curso">
                        <?= htmlspecialchars($curso['categoria'], ENT_QUOTES, 'UTF-8') ?>
                    </span>

                    <h1>
                        <?= htmlspecialchars($curso['nome'], ENT_QUOTES, 'UTF-8') ?>
                    </h1>

                    <p>
                        <?= htmlspecialchars($curso['descricao'], ENT_QUOTES, 'UTF-8') ?>
                    </p>

                    <div class="carga-horaria">

                        <div class="icone-carga">
                            ◷
                        </div>

                        <div>
                            <strong>
                                <?= $cargaHoraria ?> horas
                            </strong>

                            <span>Carga horária do curso</span>
                        </div>

                    </div>

                </div>

            </section>

            <section class="secao-conteudo">

                <h2>O que você vai aprender</h2>

                <ul class="lista-conteudos">

                    <?php foreach ($curso['conteudos'] as $conteudo): ?>

                        <li>
                            <?= htmlspecialchars($conteudo, ENT_QUOTES, 'UTF-8') ?>
                        </li>

                    <?php endforeach; ?>

                </ul>

            </section>

            <section class="secao-certificado">

                <div class="icone-certificado">
                    ✦
                </div>

                <div>
                    <h2>Certificado de conclusão</h2>

                    <p>
                        Consulte a equipe da Compuway para obter informações
                        sobre os critérios e a emissão do certificado deste curso.
                    </p>
                </div>

            </section>

        </main>

    <?php endif; ?>

    <footer class="rodape-curso">
        <p>
            &copy; <?= date('Y') ?> Compuway. Todos os direitos reservados.
        </p>
    </footer>

</body>

</html>
