<?php
$pagina_atual = 'todos-cursos.php';

$cursos = [
    [
        'nome' => 'T.I. em Hardware',
        'imagem' => 'src/images/curso-hardware.png',
        'categoria' => 'Curso individual',
        'link' => 'curso.php?curso=ti-hardware'
    ],
    [
        'nome' => 'Excel Essencial e Avançado',
        'imagem' => 'src/images/curso-excel.png',
        'categoria' => 'Curso individual',
        'link' => 'curso.php?curso=excel-individual'
    ],
    [
        'nome' => 'Power BI',
        'imagem' => 'src/images/curso-power-bi.png',
        'categoria' => 'Curso individual',
        'link' => 'curso.php?curso=power-bi'
    ],
    [
        'nome' => 'Recursos Humanos',
        'imagem' => 'src/images/curso-rh.png',
        'categoria' => 'Curso individual',
        'link' => 'curso.php?curso=recursos-humanos'
    ],
    [
        'nome' => 'Auxiliar de Escritório',
        'imagem' => 'src/images/curso-auxiliar-escritorio.png',
        'categoria' => 'Curso individual',
        'link' => 'curso.php?curso=auxiliar-escritorio'
    ],
    [
        'nome' => 'Word 2016',
        'imagem' => 'src/images/curso-word-2016.png',
        'categoria' => 'Curso individual',
        'link' => 'curso.php?curso=word-2016'
    ],
    [
        'nome' => 'Pacote Office Completo',
        'imagem' => 'src/images/curso-pacote-office.png',
        'categoria' => 'Pacote',
        'link' => 'curso.php?curso=pacote-office'
    ],
    [
        'nome' => 'Pacote de Design Gráfico',
        'imagem' => 'src/images/curso-design-grafico.png',
        'categoria' => 'Pacote',
        'link' => 'curso.php?curso=design-grafico'
    ],
    [
        'nome' => 'Excel Essencial e Avançado',
        'imagem' => 'src/images/curso-excel.png',
        'categoria' => 'Pacote',
        'link' => 'curso.php?curso=excel-pacote'
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todos os Cursos | Compuway</title>

    <link rel="icon" href="src/images/compuway.logo.png" type="image/png">
    <link rel="stylesheet" href="components/site.css">

    <style>
    
.cabecalho .menu .botao-login {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 180px;
    height: 54px;
    padding: 0 25px;
    border: 1px solid #452078;
    border-radius: 30px;
    background-color: #ffffff;
    color: #452078;
    font-size: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: 0.3s;
}

.cabecalho .menu .botao-login:hover {
    background-color: #452078;
    color: #ffffff;
}




.cabecalho {
    width: 100%;
    background-color: #ffffff;
    position: relative;
    z-index: 10;
}

.cabecalho .container-cabecalho {
    width: 100%;
    max-width: 1280px;
    min-height: 80px;
    margin: 0 auto;
    padding: 10px 5.5%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 30px;
}

.cabecalho .logo {
    display: flex;
    align-items: center;
    flex-shrink: 0;
}

.cabecalho .logo img {
    width: 180px;
    max-height: 65px;
    height: auto;
    object-fit: contain;
    display: block;
}

.cabecalho .menu {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 28px;
    flex-wrap: wrap;
}

.cabecalho .menu a {
    text-decoration: none;
    white-space: nowrap;
}

@media (max-width: 800px) {
    .cabecalho .container-cabecalho {
        flex-direction: column;
        padding: 15px 5%;
    }

    .cabecalho .menu {
        justify-content: center;
        gap: 15px;
    }
}


        .pagina-todos-cursos {
            width: 100%;
            min-height: 70vh;
            padding: 70px 5.5% 90px;
            background-color: #ffffff;
        }

        .todos-cursos-cabecalho {
            max-width: 1280px;
            margin: 0 auto 45px;
            text-align: center;
        }

        .todos-cursos-cabecalho h1 {
            color: #452078;
            font-size: clamp(28px, 4vw, 40px);
            font-weight: 700;
            margin-bottom: 12px;
        }

        .todos-cursos-cabecalho p {
            color: #555260;
            font-size: 16px;
            margin: 0;
        }

        .todos-cursos-grid {
            width: 100%;
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 30px;
        }

        .todos-cursos-grid .curso-card {
            width: 100%;
            min-width: 0;
            height: 100%;
        }

        .todos-cursos-grid .curso-card > img {
            width: 100%;
            height: 210px;
            object-fit: cover;
            display: block;
        }

        .todos-cursos-grid .curso-conteudo {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .todos-cursos-grid .curso-conteudo h3 {
            color: #452078;
        }

        .todos-cursos-categoria {
            display: inline-block;
            width: fit-content;
            margin-bottom: 10px;
            padding: 5px 12px;
            border-radius: 20px;
            background-color: #f0eafa;
            color: #452078;
            font-size: 12px;
            font-weight: 600;
        }

        .todos-cursos-grid .curso-conteudo .botao-principal {
            align-self: flex-start;
            margin-top: auto;
        }

        @media (max-width: 900px) {
            .todos-cursos-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 24px;
            }
        }

        @media (max-width: 600px) {
            .pagina-todos-cursos {
                padding: 45px 20px 60px;
            }

            .todos-cursos-grid {
                grid-template-columns: 1fr;
                gap: 22px;
            }

            .todos-cursos-grid .curso-card > img {
                height: 200px;
            }

            .todos-cursos-cabecalho {
                margin-bottom: 30px;
            }
        }
    </style>
</head>

<body>

    <header class="cabecalho">
        <div class="container-cabecalho">

            <a href="site.php" class="logo">
                <img src="src/images/compuway.logo.png" alt="Compuway">
            </a>

            <nav class="menu">
                <a href="site.php#inicio">Início</a>
                <a href="site.php#historia">Nossa história</a>
                <a href="site.php#cursos" class="ativo">Cursos</a>
                <a href="site.php#contato">Contato</a>
                <a href="system/login.php" class="botao-login">login</a>
            </nav>

        </div>
    </header>

    <main class="pagina-todos-cursos">

        <section class="todos-cursos-cabecalho">
            <h1>Todos os nossos cursos</h1>

            <p>
                Invista no seu conhecimento e prepare-se para novas oportunidades.
                Encontre o curso ideal para você!
            </p>
        </section>

        <section class="todos-cursos-grid" aria-label="Lista de cursos da Compuway">

            <?php foreach ($cursos as $curso): ?>

                <article class="curso-card">

                    <img
                        src="<?= htmlspecialchars($curso['imagem'], ENT_QUOTES, 'UTF-8') ?>"
                        alt="<?= htmlspecialchars($curso['nome'], ENT_QUOTES, 'UTF-8') ?>"
                        loading="lazy"
                    >

                    <div class="curso-conteudo">

                        <span class="todos-cursos-categoria">
                            <?= htmlspecialchars($curso['categoria'], ENT_QUOTES, 'UTF-8') ?>
                        </span>

                        <h3>
                            <?= htmlspecialchars($curso['nome'], ENT_QUOTES, 'UTF-8') ?>
                        </h3>

                        <a
                            href="<?= htmlspecialchars($curso['link'], ENT_QUOTES, 'UTF-8') ?>"
                            class="botao-principal"
                            target="_self"
                        >
                            Saiba mais
                        </a>

                    </div>

                </article>

            <?php endforeach; ?>

        </section>

    </main>

    <footer class="rodape">
        <p>&copy; <?= date('Y') ?> Compuway. Todos os direitos reservados.</p>
    </footer>

</body>
</html>
