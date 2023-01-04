<?php
require_once 'classes.php';
$con = new Conection('cadastro', 'localhost', 'root', '');
?>

<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- LINK JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- FONT GOOGLE -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik+Vinyl&display=swap" rel="stylesheet">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Lobster', cursive;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background-color: #171923;
        }

        h2 {
            text-align: center;
            color: silver;
            font-weight: 500;
        }

        .container {
            background-color: #212529;
            margin-top: 2em;
            margin-left: 2em;
            border-radius: 0.5em;
            position: relative;
        }

        .alert {
            font-weight: bold;
        }

        #slide {
            overflow: hidden;
            margin-top: 1em;
            /* background-color: red; */
        }

        #logo {
            /* background-color: green; */
            position: relative;
            color: white;
            width: 30%;
            height: 1.8em;
            text-align: center;
            font-size: 2em;
            font-family: 'Rubik Vinyl', cursive;
            animation: mymove 50s infinite linear;

        }

        #logo h6 {
            margin-top: -4em;
        }


        @keyframes mymove {
            from {
                left: 100%;
            }

            to {
                left: -32%;
            }
        }

        #box {
            /* background-color: blue; */
            display: flex;
        }

        #tabela {
            /* background-color: yellow; */
            width: 60%;
            font-weight: bold;
            margin-top: 2em;
            margin-right: 2em;
            position: relative;
        }
    </style>
</head>

<body>

    <div id="slide">
        <div id="logo">
            Tag_Nativa &nbsp;&nbsp; Sistemas
        </div>
    </div>

    <?php
    // CLICOU NO BOTÃO
    if (isset($_POST['nome'])) {
        //CLICOU EM EDITAR
        if (isset($_GET['edit']) && !empty($_GET['edit'])) {

            $edit = addslashes($_GET['edit']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['tel']);
            $email = addslashes($_POST['email']);

            if (!empty($telefone) && !empty($email)) {
                $con->editar($edit, $nome, $telefone, $email);
                header("location: index.php");
            } else {
    ?>
                <!-- ALERTA PARA PREENCHER TODOS OS CAMPOS -->
                <div class="alert alert-danger text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    PREENCHA TODOS OS CAMPOS !
                </div>
            <?php
            }
        }
    }
    // CLICOU CADASTRAR
    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['tel']);
        $email = addslashes($_POST['email']);

        if (!empty($telefone) && !empty($email)) {

            if (!$con->cadastrar($nome, $telefone, $email)) { // SE O E-MAIL JA ESTIVER CADASTRADO
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    ESTE E-MAIL JÁ ESTÁ CADASTRADO !
                </div>

            <?php
            } else { // QUANDO CADASTRAR
            ?>
                <div class="alert alert-success text-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-check2-all" viewBox="0 0 16 16">
                        <path d="M12.354 4.354a.5.5 0 0 0-.708-.708L5 10.293 1.854 7.146a.5.5 0 1 0-.708.708l3.5 3.5a.5.5 0 0 0 .708 0l7-7zm-4.208 7-.896-.897.707-.707.543.543 6.646-6.647a.5.5 0 0 1 .708.708l-7 7a.5.5 0 0 1-.708 0z" />
                        <path d="m5.354 7.146.896.897-.707.707-.897-.896a.5.5 0 1 1 .708-.708z" />
                    </svg>
                        USUARIO CADASTRADO COM SUCESSO !
                </div>

            <?php

            }
        } else { // QUANDO TIVER CAMPO SEM PREENCHER
            ?>

            <div class="alert alert-danger text-center" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                </svg>
                PREENCHA TODOS OS CAMPOS !
            </div>

    <?php
        }
    }



    // EDITAR USUARIO
    if (isset($_GET['edit'])) {
        $id_up = $_GET['edit'];
        $editar = $con->buscar_editar($id_up);
    }

    ?>
    <div id="box">
        <div class="container text-white col-4 p-5 ">
            <form method="post" class="form-group">

                <h2>CADASTRAR &nbsp;&nbsp;USUARIO</h2>

                <label for="nome">Nome</label>
                <input type="text" name='nome' class="form-control" placeholder="Nome Completo" value="<?php if (isset($editar)) {
                                                                                                            echo $editar['nome'];
                                                                                                        } ?>">

                <br>
                <label for="tel">Telefone</label>
                <input type="text" name='tel' class="form-control" placeholder="(xx) 99999 - 1234" value="<?php if (isset($editar)) {
                                                                                                                echo $editar['tel'];
                                                                                                            } ?>">

                <br>
                <label for="email">E-mail</label>
                <input type="email" name='email' class="form-control" placeholder="Example@email.com" value="<?php if (isset($editar)) {
                                                                                                                    echo $editar['email'];
                                                                                                                } ?>">

                <br><br>
                <input type="submit" name='cad_usuario' class="btn btn-primary form-control" value="<?php if (isset($editar)) {
                                                                                                        echo 'Editar';
                                                                                                    } else {
                                                                                                        echo 'Cadastrar';
                                                                                                    } ?>">

        </div>

        <div id="tabela">
            <table class="table table-dark table-striped">
                <tr class="table-dark">
                    <th class="table-dark">NOME</th>
                    <th class="table-dark">TELEFONE</th>
                    <th colspan="4" class="table-dark">E-MAIL</th>
                </tr>

                <?php
                // EXCLUIR UM USUARIO
                if (isset($_GET['exc'])) {
                    $excluir = $_GET['exc'];
                    $con->deletar($excluir);
                }

                //EXIBE OS DADOS DO BANCO NA TABELA        
                $dados = $con->buscar_dados();

                if (count($dados) > 0) {
                    for ($i = 0; $i < count($dados); $i++) {
                        echo "<tr class='table-secondary'>";
                        foreach ($dados[$i] as $k => $v) {
                            if ($k != 'id') {
                                echo "<td class='table-secondary'>$v</td>";
                            }
                        }
                ?>
                        <td>
                            <a class="btn btn-danger" href="index.php?exc=<?= $dados[$i]['id'] ?>">EXCLUIR</a>
                            <a class="btn btn-success" href="index.php?edit=<?= $dados[$i]['id'] ?>">EDITAR</a>
                        </td>
                    <?php
                    }
                } else { //BANCO ESTA VAZIO
                    ?>
                    <div class="alert alert-success text-center" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-database-exclamation" viewBox="0 0 16 16">
                            <path d="M12.096 6.223A4.92 4.92 0 0 0 13 5.698V7c0 .289-.213.654-.753 1.007a4.493 4.493 0 0 1 1.753.25V4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16c.536 0 1.058-.034 1.555-.097a4.525 4.525 0 0 1-.813-.927C8.5 14.992 8.252 15 8 15c-1.464 0-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13h.027a4.552 4.552 0 0 1 0-1H8c-1.464 0-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10c.262 0 .52-.008.774-.024a4.525 4.525 0 0 1 1.102-1.132C9.298 8.944 8.666 9 8 9c-1.464 0-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777ZM3 4c0-.374.356-.875 1.318-1.313C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4Z" />
                            <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1.5a.5.5 0 0 0 1 0V11a.5.5 0 0 0-.5-.5Zm0 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Z" />
                        </svg>
                        NÃO EXISTE CADASTRO NO BANCO DE DADOS !

                    </div>

                <?php

                }
                echo "</tr>";
                ?>
            </table>
        </div>

    </div><!--DIV BOX-->

</body>

</html>