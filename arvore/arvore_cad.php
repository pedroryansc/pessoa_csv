<!DOCTYPE html>
<html lang="pt-br">
<?php
    include "arvore_acao.php";
    
    $id = isset($_GET["id"]) ? $_GET["id"] : 0;
    if($id != 0)
        $dados = carregar($id);

    $titulo = "Cadastro de Árvores";
    include "../trechos/cabecalho.php";
?>
<body>
    <main class="container">
        <?php
            include "../trechos/menuArvore.php";
        ?>
        <form action="arvore_acao.php?id=<?php echo $id; ?>" method="post">
            <fieldset>
                <legend><?php echo $titulo; ?></legend>
                <br>
                <label for="codigo">Código:</label>
                <input type="text" name="codigo" id="codigo" value="<?php if($id != 0) echo $dados["codigo"]; ?>" required><br>

                <label for="especie">Espécie:</label>
                <input type="text" name="especie" id="especie" value="<?php if($id != 0) echo $dados["especie"]; ?>" required><br>

                <label for="dataPlantada">Data em que foi plantada:</label>
                <input type="date" name="dataPlantada" id="dataPlantada" value="<?php if($id != 0) echo $dados["dataPlantada"] ?>" required><br>
                
                <label for="dataAdubo">Data da última adubação:</label>
                <input type="date" name="dataAdubo" id="dataAdubo" value="<?php if($id != 0) echo $dados["dataAdubo"] ?>" required><br>
            
                <input class="primary" type="submit" name="acao" id="acao" value="<?php if($id == 0) echo "Salvar"; else echo "Alterar"; ?>">
                <input type="reset" value="Reiniciar"/>
            </fieldset>
        </form>
    </main>
</body>
</html>