<?php

function crud_load()
{
    $data = file_get_contents(DATA_LOCATION);
    $data = json_decode($data);
    return $data;
    //função para carregar os dados do banco, pegando seu conteudo no DATA LOCATION, decoficando e retornando
}

function crud_flush($data)
{
    $data = array_values($data);
    $data = json_encode($data);
    file_put_contents(DATA_LOCATION, $data);
    //função para enviar os dados para o banco, codificando ele e enviando para o DATA LOCATION
}

function crud_create($user)
{
    $data = crud_load();
    $data[] = $user;
    crud_flush($data);

    //simplificando a criação de dados no banco, pegando os dados do usuário, carregando os dados do banco, falando que o array dos dados e o index são iguais aos dados do usuário e enviando os dados para o banco com o crud flush
}

/*function crud_create($user) //função para criar usuário
{
    if (!empty('$user') && $_GET['page'] == 'register') { //verifica se o USER não está vazio e se a URL da página está como "register" através do GET.
        $data = json_decode(file_get_contents(DATA_LOCATION)); //vai atribuir a variável data, o conteúdo de DATA_LOCATION< decodificando o arquivo JSON
        $data[] = $user; //o array de $data é igual aos dados de user, sendo atribuido a eles assim
        file_put_contents(DATA_LOCATION, json_encode($data)); //vai colocar no arquivo DATA_LOCATION, codificando para json, os dados de $data.
    }
}*/

//voltando para controller, para fazer a função de criar o usuário.

function crud_restore($email)
{ //verificar se o email está cadastrado
    /*$data = file_get_contents(DATA_LOCATION); //aqui ele vai pegar o conteudo do arquivo data
    $data = json_decode($data); //decodificando estes dados*/
    $data = crud_load();
    foreach ($data as $item) { //percorreremos este array de dados DATA chamando seus index de ITEM
        if ($item->email === $email) { //se o item EMAIL for IDENTICO ao EMAIL cadastrado
            return $item; //retorna este email
        }
    }
    return false; //se não, ele retorna falso por padrão, ou seja, não há email cadastrado.
}

function crud_update($user)
{ //função para atualizar os dados do banco
    $data = crud_load(); //pega os dados do banco
    foreach ($data as &$item) { //para cada DADO como ITEM, ou seja, vai passar cada dado recebido do banco sendo chamado de dado
        if ($item->email === $user->email) { //se o item email for identico ao email do usuário
            $item = $user; //atualiza falando que o novo item é o mesmo que do usuário
            break; //para a execução
        }
    }
    crud_flush($data); //envia para o banco
}

function crud_delete($user)
{
    $data = crud_load(); //carrega os dados do banco na variavel
    foreach ($data as $key => $item) { //para cada DADO como CHAVE sendo ITEM
        if ($item->email === $user->email) { //se o index item email for identico ao email do usuário
            unset($data[$key]); //desfaz o registro do dado com os index da chave
            break; //break para parar a execução e não apagar os demais dados
        }
    }
    crud_flush($data); //envia para o banco essa linha vazia
}
