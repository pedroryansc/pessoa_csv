<?php

/*
 * Código de exemplo da utilização de CSV como persistencia
 * Controlador reponsável pela manutenção do cadastro da entidade Pessoa
 * @author Wesley R. Bezerra <wesley.bezerra@ifc.edu.br>
 * @version 0.1
 *
 */

/* definição de constantes */
define("DESTINO", "index.php");
define("PESSOA_CSV", "pessoa.csv");
define("ARVORE_CSV", "arvore.csv");

/* escolha da ação que processará a requisição */
$acao = "";
switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
        break;
    case 'POST':
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        break;
}

switch ($acao) {
    case 'Salvar':
        salvar();
        break;
    case 'Alterar':
        alterar();
        break;
    case 'excluir':
        excluir();
        break;
}

/*
 * Método que converte formulário html para array com respectivos dados
 * @return array
 */
function tela2array()
{
    $novo = array(
        'id' => isset($_POST['id']) ? $_POST['id'] : date("YmdHis"),
        'nome' => isset($_POST['nome']) ? $_POST['nome'] : "",
        'peso' => isset($_POST['peso']) ? $_POST['peso'] : "",
        'altura' => isset($_POST['altura']) ? $_POST['altura'] : "",
        "endereco" => isset($_POST["endereco"]) ? $_POST["endereco"] : "",
        "numero" => isset($_POST["numero"]) ? $_POST["numero"] : "",
        "cidade" => isset($_POST["cidade"]) ? $_POST["cidade"] : "",
        "estado" => isset($_POST["estado"]) ? $_POST["estado"] : "",
        "salario" => isset($_POST["salario"]) ? $_POST["salario"] : 0
    );
    if ($novo['id'] == "0") {
        $novo['id'] = date("YmdHis");
    }
    return $novo;
}

/*
 * Método que salva os dados no formato json no arquivo em disco
 * @param $dados String dados codificados no formato json
 * @param $arquivo String nome do arquivo onde serão salvos os dados
 * @return void
 */
function salvar_csv($dados, $arquivo)
{
    $fp = fopen($arquivo, "w");
    // Popular os dados
    foreach ($dados as $linha) {
        fputcsv($fp, $linha);
    }
    fclose($fp);
}
/*
 * Método que lê os dados no formato json do arquivo em disco
 * @param $arquivo String nome do arquivo onde serão salvos os dados
 * @return String dados codificados no formato json
 */
function ler_csv($arquivo)
{
    $keys = ['id', 'nome', 'peso', 'altura', "endereco", "numero", "cidade", "estado", "salario"];
    $fp = fopen($arquivo, "r");
    $dados = array();
    if ($fp) {
        while ($row = fgetcsv($fp, 1000, ",")) {
            $dados[] = array_combine($keys, $row);
        }
    }
    return $dados;
}
/*
 * Método que lê os dados e os carrega em um variável chamada json
 * @param $id int identificador numérico do registro
 * @return String dados codificados no formato json
 */
function carregar($id)
{
    $dados = ler_csv(PESSOA_CSV);

    foreach ($dados as $key) {
        if ($key['id'] == $id)
            return $key;
    }
}

/*
 * Método que altera os dados de um registro
 * @return void
 */
function alterar()
{
    $novo = tela2array();

    $dados = ler_csv(PESSOA_CSV);

    for ($x = 0; $x < count($dados); $x++) {
        if ($dados[$x]['id'] == $novo['id']) {
            $dados[$x] = $novo;
        }
    }

    salvar_csv($dados, PESSOA_CSV);

    header("location:" . DESTINO);

}


/*
1 - abrir json em formato php;
2 - percorrer e achar o item pelo ID;
3 - estratégia de deletar;
4 - gravar em json novamente, sem o item;
5 - redirecionar para a página index.php
*/

/*
 * Método exclui um registro
 * @return void
 */
function excluir()
{
    $id = isset($_GET['id']) ? $_GET['id'] : "";
    $dados = ler_csv(PESSOA_CSV);
    if ($dados == null)
        $dados = array();

    $novo = array();
    for ($x = 0; $x < count($dados); $x++) {
        if ($dados[$x]['id'] != $id)
            array_push($novo, $dados[$x]);
    }
    salvar_csv($novo, PESSOA_CSV);

    header("location:" . DESTINO);

}
/*
 * Método salva alterações feitas em um registro
 * @return void
 */
function salvar()
{
    $dados = NULL;
    $novo = tela2array();

    $dados = ler_csv(PESSOA_CSV);

    if ($dados == NULL) {
        $dados = array();
    }

    array_push($dados, $novo);

    salvar_csv($dados, PESSOA_CSV);

    header("location:" . DESTINO);
}

?>