
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Compuway</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <main class="login-container">

        <section class="login-esquerda">
            <a href="../site.php" class="logo-link">
                <img src="../src/images/compuway.logo.png" alt="Compuway">
            </a>
        </section>

        <section class="login-direita">

            <div class="login-conteudo">

                <h1>Área administrativa</h1>

                <form action="" method="POST">

                    <div class="campo">
                        <label for="usuario">Usuário</label>
                        <input
                            type="text"
                            id="usuario"
                            name="usuario"
                            placeholder="Digite o usuário"
                            required
                        >
                    </div>

                    <div class="campo">
                        <label for="senha">Senha</label>
                        <input
                            type="password"
                            id="senha"
                            name="senha"
                            placeholder="Digite a senha"
                            required
                        >
                    </div>

                    <button type="submit">Entrar</button>

                    <a href="#" class="esqueceu-senha">
                        Esqueceu a senha?
                    </a>

                </form>

            </div>

        </section>

    </main>

</body>
</html>
