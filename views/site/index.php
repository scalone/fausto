<!DOCTYPE html>
<html>
		<head>
				<meta charset="utf-8" />
				<meta lang="pt-BR" />
				<title>O NOTICIOSO - Portal de Notícias</title>
				<style>
						body {
								margin: 0;
								font-family: Arial, Helvetica, "Liberation Sans", sans-serif;
								font-size: 12pt;
						}
						header {
								background-color: #303030;
						}
						h1 {
								font-family: Cambria, "Times New Roman", Times, serif;
								font-size: 200%;
						}
						p {
								text-indent: 50px;
						}
						section {
								margin-left: 10%;
								margin-right: 10%;
						}
				</style>
		</head>

		<body>

				<header>
						<img src="_images/logo.png" alt="O NOTICIOSO: a verdade está aqui dentro." />
				</header>

				<nav>Aqui é o menu</nav>

				<section>
						<?php foreach($model as $instance): ?>
								<article>
										<h1><?= $instance->getAttrValue('title'); ?></h1>
										<h4>
<?php
// Obtém a data do BD em formato de string
$createdAt = $instance->getAttrValue('created_at');
// Converte a string de data em data real
// e formata de acordo com o costume brasileiro
echo date('d/m/Y H:i', strtotime($createdAt));
?>
										</h4>
<?php
$body = $instance->getAttrValue('body');

// Converte todos as quebras de linha em marcas
// de parágrafo HTML
$body = '<p>' . str_replace("\n", "</p>\n<p>", $body) . '</p>';

echo $body;
?>
								</article>
						<?php endforeach; ?>
				</section>
				<footer>
						Aqui é o rodapé
				</footer>
		</body>

</html>