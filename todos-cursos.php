<?php
require_once 'catalogo-dados.php';
function imgCatalogo($nome) { global $imagensCatalogo; return $imagensCatalogo[$nome] ?? ''; }
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Todos os cursos | Compuway</title><link rel="stylesheet" href="components/site.css"><link rel="stylesheet" href="components/catalogo-extra.css"></head><body class="pagina-catalogo">
<header class="catalogo-pagina-topo"><a class="catalogo-voltar" href="site.php#cursos">← Voltar ao site</a><a href="site.php"><img src="src/images/compuway.logo.png" alt="Compuway"></a></header>
<main class="catalogo-pagina"><div class="catalogo-pagina-intro"><span class="cursos-etiqueta">CATÁLOGO COMPLETO</span><h1>Explore nossos <span>cursos e pacotes</span></h1><p>Conheça as formações disponíveis e encontre o caminho de aprendizado que combina com seus objetivos.</p></div>
<section><h2>Cursos individuais</h2><div class="catalogo-grade">
<?php foreach($catalogoCursos as $curso): $slug=slugCatalogo($curso[0]); $img=imgCatalogo($curso[0]); ?>
<article class="catalogo-pagina-card"><?php if($img && file_exists($img)): ?><img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($curso[0]) ?>" loading="lazy"><?php else: ?><div class="catalogo-foto-vazia">Imagem do curso</div><?php endif; ?><div class="catalogo-pagina-card-corpo"><h3><?= htmlspecialchars($curso[0]) ?></h3><p><?= htmlspecialchars($curso[2]) ?></p><a class="botao-principal" href="curso-detalhe.php?tipo=curso&amp;slug=<?= urlencode($slug) ?>">Saiba mais</a></div></article>
<?php endforeach; ?></div></section>
<section><h2>Pacotes de cursos</h2><div class="catalogo-grade">
<?php foreach($catalogoPacotes as $pacote): $slug=slugCatalogo($pacote[0]); $img=imgCatalogo($pacote[0]); ?>
<article class="catalogo-pagina-card"><?php if($img && file_exists($img)): ?><img src="<?= htmlspecialchars($img) ?>" alt="<?= htmlspecialchars($pacote[0]) ?>" loading="lazy"><?php else: ?><div class="catalogo-foto-vazia">Imagem do pacote</div><?php endif; ?><div class="catalogo-pagina-card-corpo"><h3><?= htmlspecialchars($pacote[0]) ?></h3><p><?= htmlspecialchars($pacote[2]) ?></p><a class="botao-principal" href="curso-detalhe.php?tipo=pacote&amp;slug=<?= urlencode($slug) ?>">Ver pacote</a></div></article>
<?php endforeach; ?></div></section></main><footer class="catalogo-pagina-footer"><a href="site.php">← Voltar à página inicial</a></footer></body></html>
