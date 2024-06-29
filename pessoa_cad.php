<?php 
/*
* Código de exemplo da utilização de CSV como persistencia
* Página reponsável pelo formulário de cadastro da entidade Pessoa
* @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
* @version 0.1
*
*/
?>
<!DOCTYPE html>
<html lang="pt-BR">
<?php include 'cabecalho.php'; ?>
<?php
include "pessoa_acao.php";
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$dados = array();
if ($id != 0)
    $dados = carregar($id);
?>

<body>
    <header class="container">
        <?php include 'menu.php'; ?>
    </header>
    <main class="container">

        <form action="pessoa_acao.php" method="post">
            <fieldset>
                <legend>Cadastro de Pessoas</legend>

                <label for="id">Id</label>
                <input type="text" name="id" id="id" value="<?= $id ?>" readonly><br>

                <label for="nome">Nome</label>
                <input type="text" size="40" name="nome" id="nome" value="<?php if ($id != 0)
                    echo $dados['nome']; ?>" required><br>

                <label for="peso">Peso</label>
                <input type="text" name="peso" id="peso" value="<?php if ($id != 0)
                    echo $dados['peso']; ?>"><br>

                <label for="altura">Altura</label>
                <input type="text" name="altura" id="altura" value="<?php if ($id != 0)
                    echo $dados['altura']; ?>"><br>
                
                <label for="endereco">Endereço</label>
                <input type="text" name="endereco" id="endereco" value="<?php if($id != 0)
                    echo $dados["endereco"]; ?>"><br>
                
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" value="<?php if($id != 0)
                    echo $dados["numero"]; ?>"><br>

                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade" value="<?php if($id != 0)
                    echo $dados["cidade"]; ?>"><br>
                
                <label for="estado">Estado</label>
                <?php
                    include "estados.php";
                ?>

                <label for="salario">Salário</label>
                <input type="text" name="salario" id="salario" value="<?php if($id != 0)
                    echo $dados["salario"]; ?>"><br>

                <input class="primary" type="submit" name="acao" id="acao" value="<?php if ($id == 0)
                    echo "Salvar";
                else
                    echo "Alterar";
                ?>">
                <input type="reset" value="Cancelar" />

            </fieldset>
        </form>
    </main>
    <footer class="container"></footer>
</body>

</html>