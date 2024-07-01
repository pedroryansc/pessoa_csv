<!DOCTYPE html>
<html lang="pt-br">
<?php
    require_once "arvore_acao.php";

    $titulo = "Lista de Árvores";
    include "../trechos/cabecalho.php";
?>
<body>
    <main class="container">
        <?php
            include "../trechos/menuArvore.php";

            $dados = ler_csv("arvore.csv");
            if(($dados == NULL) || (count($dados) == 0))
                echo "<h1>Sem dados a serem exibidos.</h1>";
            else{
        ?>
        <table role="grid">
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Espécie</th>
                <th>Data em que foi plantada</th>
                <th>Data da última adubação</th>
                <th>Alterar</th>
                <th>Excluir</th>
            </tr>
            <?php
                foreach($dados as $key)
                    echo "<tr>
                            <td>{$key['id']}</td>
                            <td>{$key['codigo']}</td>
                            <td>{$key['especie']}</td>
                            <td>{$key['dataPlantada']}</td>
                            <td>{$key['dataAdubo']}</td>
                            <td align='center'>
                                <a role='button' href='arvore_cad.php?id={$key['id']}'>A</a>
                            </td>
                            <td align='center'>
                                <a role='button' href=javascript:excluir('arvore_acao.php?acao=Excluir&id={$key['id']}');>E</a>
                            </td>
                        </tr>";
            ?>
        </table>
        <?php
            }
        ?>
    </main>
</body>
</html>
<script>
    function excluir(url){
        if(confirm("Tem certeza que quer excluir esse registro?"))
            location.href = url;
    }    
</script>