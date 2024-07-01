<?php

    define("DESTINO", "index.php");
    define("ARQUIVO", "arvore.csv");

    switch($_SERVER["REQUEST_METHOD"]){
        case "GET":
            $acao = isset($_GET["acao"]) ? $_GET["acao"] : "";
            break;
        case "POST":
            $acao = isset($_POST["acao"]) ? $_POST["acao"] : "";
            break;
    }

    switch($acao){
        case "Salvar":
            salvar();
            break;
        case "Alterar":
            alterar();
            break;
        case "Excluir":
            excluir();
            break;
    }

    function tela2array(){
        $novo = array(
            "id" => isset($_GET["id"]) ? $_GET["id"] : date("YmdHis"),
            "codigo" => isset($_POST["codigo"]) ? $_POST["codigo"] : "",
            "especie" => isset($_POST["especie"]) ? $_POST["especie"] : "",
            "dataPlantada" => isset($_POST["dataPlantada"]) ? $_POST["dataPlantada"] : "",
            "dataAdubo" => isset($_POST["dataAdubo"]) ? $_POST["dataAdubo"] : "");
        
        if($novo["id"] == 0)
            $novo["id"] = date("YmdHis");
        
        return $novo;
    }

    function ler_csv($arquivo){
        $dados = array();

        if(file_exists($arquivo)){
            $indices = ["id", "codigo", "especie", "dataPlantada", "dataAdubo"];
            
            $fp = fopen($arquivo, "r");
            if($fp){
                while($linhas = fgetcsv($fp, 1000, ","))
                    $dados[] = array_combine($indices, $linhas);
            }
        }

        return $dados;
    }

    function salvar_csv($dados, $arquivo){
        $fp = fopen($arquivo, "w");

        foreach($dados as $linha)
            fputcsv($fp, $linha);

        fclose($fp);
    }

    function salvar(){
        $novo = tela2array();

        $dados = ler_csv(ARQUIVO);

        if($dados == NULL)
            $dados = array();

        array_push($dados, $novo);

        salvar_csv($dados, ARQUIVO);

        header("location:".DESTINO);
    }

    function alterar(){
        $novo = tela2array();

        $dados = ler_csv(ARQUIVO);

        for($i = 0; $i < count($dados); $i++){
            if($dados[$i]["id"] == $novo["id"])
                $dados[$i] = $novo;
        }

        salvar_csv($dados, ARQUIVO);

        header("location:".DESTINO);
    }

    function excluir(){
        $id = isset($_GET["id"]) ? $_GET["id"] : 0;

        $dados = ler_csv(ARQUIVO);
        
        if($dados == NULL)
            $dados = array();

        $novo = array();

        for($i = 0; $i < count($dados); $i++){
            if($dados[$i]["id"] != $id)
                array_push($novo, $dados[$i]);
        }

        salvar_csv($novo, ARQUIVO);

        header("location:".DESTINO);
    }

    function carregar($id){
        $dados = ler_csv(ARQUIVO);

        foreach($dados as $linha){
            if($linha["id"] == $id)
                return $linha;
        }
    }

?>