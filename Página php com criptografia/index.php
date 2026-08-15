<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Criptografia no PHP</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff4fa;
            color: #080808;
        }

        /* CABEÇALHO */

        header {
            background: #d23e8b;
            color: white;
            text-align: center;
            padding: 30px;
        }

        header h1 {
            margin: 0 0 10px;
        }

        header p {
            margin: 0;
        }


        /* CONTAINER */

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
        }


        /* FORMULÁRIO */

        .formulario {
            background: white;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 25px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .formulario input {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 16px;
        }

        .formulario button {
            margin-top: 15px;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            background: #3f7d3c;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .formulario button:hover {
            background: #397436;
        }

        .titulo {
            background: #d54d8f;
            color: white;
            text-align: center;
            padding: 18px;
            margin-top: 35px;
            margin-bottom: 20px;
            font-size: 22px;
            font-weight: bold;
        }


        /* RESULTADOS */

        .resultado {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .resultado h2 {
            margin-top: 0;
            color: #11491c;
        }

        .resultado p {
            line-height: 1.5;
        }


        .codigo {
            background: #113c0f;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 6px;
            word-break: break-all;
            overflow-wrap: break-word;
        }


        footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
        }

    </style>

</head>


<body>


<header>

    <h1>Criptografia e proteção de dados no PHP</h1>

    <p>
        Demonstração de hash, codificação e criptografia
        disponíveis no PHP.
    </p>

</header>


<div class="container">


    <!-- FORMULÁRIO -->

    <div class="formulario">

        <h2>Digite um texto</h2>

        <form method="POST">

            <input
                type="text"
                name="texto"
                placeholder="Digite uma senha ou texto..."
                required
            >

            <button type="submit">
                Processar
            </button>

        </form>

    </div>


<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $texto = $_POST["texto"];


    echo "<div class='titulo'>Hash</div>";


    /*
            MD5
    */

    $md5 = md5($texto);

    echo "

    <div class='resultado'>

        <h2>1. MD5</h2>

        <p>
            MD5 transforma o texto em um hash de 32 caracteres.
            Atualmente não é recomendado para armazenar senhas.
        </p>

        <div class='codigo'>
            $md5
        </div>

        <p>
            <strong>Código usado:</strong>
            md5(\$texto)
        </p>

    </div>

    ";


    /*
            SHA-1
    */

    $sha1 = sha1($texto);

    echo "

    <div class='resultado'>

        <h2>2. SHA-1</h2>

        <p>
            SHA-1 gera um hash de 40 caracteres.
            É considerado inseguro para aplicações modernas.
        </p>

        <div class='codigo'>
            $sha1
        </div>

        <p>
            <strong>Código usado:</strong>
            sha1(\$texto)
        </p>

    </div>

    ";


    /*
           SHA-256
    */

    $sha256 = hash("sha256", $texto);

    echo "

    <div class='resultado'>

        <h2>3. SHA-256</h2>

        <p>
            SHA-256 gera um hash de 256 bits.
            É muito utilizado para verificar a integridade de dados.
        </p>

        <div class='codigo'>
            $sha256
        </div>

        <p>
            <strong>Código usado:</strong>
            hash('sha256', \$texto)
        </p>

    </div>

    ";


    /*
           SHA-512
    */

    $sha512 = hash("sha512", $texto);

    echo "

    <div class='resultado'>

        <h2>4. SHA-512</h2>

        <p>
            SHA-512 produz um hash de 512 bits.
        </p>

        <div class='codigo'>
            $sha512
        </div>

        <p>
            <strong>Código usado:</strong>
            hash('sha512', \$texto)
        </p>

    </div>

    ";


    /*
           BCRYPT
    */

    $bcrypt = password_hash($texto, PASSWORD_BCRYPT);

    $bcryptVerificado = password_verify($texto, $bcrypt);

    echo "

    <div class='resultado'>

        <h2>5. BCrypt</h2>

        <p>
            BCrypt é utilizado principalmente para proteger
            senhas. O resultado não deve ser descriptografado.
        </p>

        <div class='codigo'>
            $bcrypt
        </div>

        <p>
            <strong>Verificação:</strong>
            " . ($bcryptVerificado
                ? "Senha correta!"
                : "Senha incorreta!") . "
        </p>

        <p>
            <strong>Código usado:</strong>
            password_hash(\$texto, PASSWORD_BCRYPT)
        </p>

    </div>

    ";


    /*
           ARGON2ID

    */

    if (defined("PASSWORD_ARGON2ID")) {

        $argon2 = password_hash($texto, PASSWORD_ARGON2ID);

        $argon2Verificado = password_verify($texto, $argon2);

        echo "

        <div class='resultado'>

            <h2>6. Argon2id</h2>

            <p>
                Argon2id é um algoritmo moderno utilizado
                para proteger senhas.
            </p>

            <div class='codigo'>
                $argon2
            </div>

            <p>
                <strong>Verificação:</strong>
                " . ($argon2Verificado
                    ? "Senha correta!"
                    : "Senha incorreta!") . "
            </p>

            <p>
                <strong>Código usado:</strong>
                password_hash(\$texto, PASSWORD_ARGON2ID)
            </p>

        </div>

        ";

    } else {

        echo "

        <div class='resultado'>

            <h2>6. Argon2id</h2>

            <p>
                O servidor PHP atual não possui suporte ao Argon2id.
            </p>

        </div>

        ";

    }



    echo "<div class='titulo'>Codificação</div>";


    /*
           BASE64
    */

    $base64 = base64_encode($texto);

    $base64Decodificado = base64_decode($base64);

    echo "

    <div class='resultado'>

        <h2>7. Base64</h2>

        <p>
            Base64 não é um método de criptografia.
            É uma forma de codificação utilizada para
            representar dados em outro formato.
        </p>

        <div class='codigo'>
            $base64
        </div>

        <p>
            <strong>Texto decodificado:</strong>
            $base64Decodificado
        </p>

        <p>
            <strong>Código usado:</strong>
            base64_encode(\$texto)
        </p>

    </div>

    ";


    echo "<div class='titulo'>Criptografia</div>";


    /*
       OPENSSL / AES
    */

    $metodo = "AES-256-CBC";

    $chave = "minha-chave-secreta";

    $iv = substr(
        hash("sha256", "meu-vetor-inicializacao"),
        0,
        16
    );


    $criptografado = openssl_encrypt(
        $texto,
        $metodo,
        $chave,
        0,
        $iv
    );


    $descriptografado = openssl_decrypt(
        $criptografado,
        $metodo,
        $chave,
        0,
        $iv
    );


    echo "

    <div class='resultado'>

        <h2>8. OpenSSL - AES-256-CBC</h2>

        <p>
            OpenSSL permite realizar criptografia reversível.
            O conteúdo pode ser recuperado utilizando
            a chave correta.
        </p>

        <p>
            <strong>Texto criptografado:</strong>
        </p>

        <div class='codigo'>
            $criptografado
        </div>

        <p>
            <strong>Texto descriptografado:</strong>
        </p>

        <div class='codigo'>
            $descriptografado
        </div>

        <p>
            <strong>Método utilizado:</strong>
            AES-256-CBC
        </p>

    </div>

    ";

}


?>


</div>


<footer>

    <p>
        Criptografia no PHP <br><br> Maria Eduarda Nascimento dos Santos

    </p>

</footer>


</body>

</html>
```
