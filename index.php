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
    // CLICOU NO BOTÃO CADASTRAR OU EDITAR
    if (isset($_POST['nome'])) {
        //CLICOU EM EDITAR
        if(isset($_GET['edit']) && !empty($_GET['edit'])){

            $edit = addslashes($_GET['edit']);
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['tel']);
            $email = addslashes($_POST['email']);

            if (!empty($telefone) && !empty($email)) {
               $con->editar($edit, $nome, $telefone, $email);
               header("location: index.php");
                }
            } else {
                echo "PREENCHA TODOS OS CAMPOS";
            }
        }
         // CLICOU CADASTRAR
         if(isset($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $telefone = addslashes($_POST['tel']);
            $email = addslashes($_POST['email']);

            if (!empty($telefone) && !empty($email)) {
                
                if (!$con->cadastrar($nome, $telefone, $email)) {
                    echo "ESTE E-MAIL JÁ ESTÁ CADASTRADO !";
                }
            } else {
                echo "PREENCHA TODOS OS CAMPOS";
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
                <input type="text" name='nome' class="form-control" placeholder="Nome Completo"
                value="<?php if(isset($editar)){echo $editar['nome'];}?>">

                <br>
                <label for="tel">Telefone</label>
                <input type="text" name='tel' class="form-control" placeholder="(xx) 99999 - 1234"
                value="<?php if(isset($editar)){echo $editar['tel'];}?>">

                <br>
                <label for="email">E-mail</label>
                <input type="email" name='email' class="form-control" placeholder="Example@email.com"
                value="<?php if(isset($editar)){echo $editar['email'];}?>">

                <br><br>
                <input type="submit" name='cad_usuario' class="btn btn-primary form-control"
                value="<?php if(isset($editar)){echo 'Editar';}else{echo 'Cadastrar';}?>" >

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
                    //header("location: index.php");
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
                    echo "NÃO EXISTE CADASTRO NO BANCO DE DADOS";
                }
                echo "</tr>";
                ?>
            </table>
        </div>

    </div><!--DIV BOX-->

    <?php
    
       
        
        
        





    ?>



</body>

</html>