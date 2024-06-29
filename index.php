<?php 
/*
* Código de exemplo da utilização de CSV como persistencia
* Página reponsável pela listagem da entidade Pessoa
* @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
* @version 0.1
*
*/

require_once "pessoa_acao.php";
?>
<!DOCTYPE html>
<html lang="pt-BR" data-theme="ligth">
<?php include 'cabecalho.php'; ?>

<body>
    <main class="container">
        <?php include 'menu.php'; ?>
        <table role="grid">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Altura</th>
                <th>Peso</th>
                <th>Endereço</th>
                <th>Número</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Salário</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
            $dados = ler_csv('pessoa.csv');
            if(($dados == NULL) || (count($dados)==0)){
                echo "<h1>sem dados a serem exibidos</h1>";
            }
            foreach ($dados as $key)
                echo "<tr><td>{$key['id']}</td>
                  <td>{$key['nome']}</td>
                  <td>{$key['altura']}</td>
                  <td>{$key['peso']}</td>
                  <td>{$key['endereco']}</td>
                  <td>{$key['numero']}</td>
                  <td>{$key['cidade']}</td>
                  <td>{$key['estado']}</td>
                  <td>R$ {$key['salario']}</td>
                  <td align='center'><a role='button' href='pessoa_cad.php?id=" . $key['id'] . "';>A</a></td>
                  <td align='center'><a role='button' href=javascript:excluirRegistro('pessoa_acao.php?acao=excluir&id=" . $key['id'] . "');>E</a></td>
              </tr>";
            ?>
        </table>
    </main>
    <!-- funcao de confirmacacao em javascript para a exclusao-->
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url;
        }
    </script>
</body>

</html>