<?php

/*function renderView($template) {
    $viewFilePath = VIEW_FOLDER . $template . '.view';
    $viewContent = file_get_contents($viewFilePath);
    echo $viewContent; 
}*/

/*class View
{

     //* Renderiza a view de acordo com o template enviado
     *
     //* @param string $template Nome da template a ser renderizado
     
    public function render_view($template)
    {
        $viewFilePath = VIEW_FOLDER . $template . '.view';
        $viewContent = file_get_contents($viewFilePath);
        echo $viewContent;
    }
}*/

//revisao aula

function render_view($template, $messages = [])
{
    $content = load_content($template, $messages);
    echo $content;
    exit;
}

function load_content($template, $messages)
{
    $validation_errors = $messages['errors'] ?? []; //mensanges de erro, verifica se está setado o arrray
    $fields = $messages['fields'] ?? '';
    $success_msg = $messages['success'] ?? ''; //mensagens de sucesso, verifica se está setado vazio
    $content = file_get_contents(VIEW_FOLDER . "$template.view"); //pega o conteúdo da página
    $content = put_error_data($content, $validation_errors);
    $content = put_success_msg($content, $success_msg);
    $content = put_old_values($content);
    $content = put_field_values($content, $fields);
    //coloca as mensagens na parte de conteúdo
    return $content; //retorna o conteudo
}

function put_field_values($content, $fields)
{
    $field_places = get_field_places($content); //pega os lugares dos campos
    $field_values = prepare_field_values($fields, $field_places); //prepara os valores dos campos
    $content = data_binding($content, $field_values); //procura os valores dos campos no conteudo
    return $content; //retorna o conteudo com os campos e seus devidos valores
}

function prepare_field_values($fields, $field_places)
{
    $field_values = []; //atribui os valores dos campos um array
    foreach ($field_places as $place) { //para cada lugar de campo como lugar
        $field = str_replace('{{field_', '', $place);
        $field = str_replace('}}', '', $field);
        $field = str_replace('_', '-', $field);
        $field_values[$place] = $fields->{$field} ?? '';
    }
    return $field_values;
}

function put_success_msg($content, $success_msg)
{
    $success_msg = success_msg_maker($success_msg);
    $content = data_binding($content, ['{{success}}' => $success_msg]);
    //cria a mensagem de sucesso, procura no conteúdo a palavra de {{success}} e reproduz a mensagem retornando ela.
    return $content;
}

function put_old_values($content)
{
    $value_places = get_value_places($content);
    $values = prepare_old_values($value_places);
    $content = data_binding($content, $values);
    //pega o valor no conteudo, prepara ele e combina no conteudo, retornando ele
    return $content;
}

function prepare_old_values($value_places)
{
    $values = [];
    foreach ($value_places as $place) {
        $field = str_replace('{{value_', '', $place);
        $field = str_replace('}}', '', $field);
        $field = str_replace('_', '-', $field);
        $values[$place] = $_POST['person'][$field] ?? '';
    }
    //declara o array, procura para cada lugar de valor como valor substituindo os campos com vazio ou traço e atribui ao lugar como array de valor o campo e os dados da pessoa que está setado como vazio.
    return $values;
}

function put_error_data($content, $validation_errors)
{
    $error_places = get_error_places($content); //pega os lugares onde tem erro no conteúdo.
    $errors_msg = create_errors_msg($validation_errors, $error_places); //cria as mensagens de erro pegando os erros validados e os lugares.
    $content = data_binding($content, $errors_msg); //junta o conte

}

function data_binding($content, $values)
{
    foreach ($values as $place => $value) {
        $content = str_replace($place, $value, $content); //para cada valores como lugar sendo valor, ele vai substituir a string do conteúdo no lugar, com o valor novo, no conteúdo.
    }
    return $content;
}

function create_errors_msg($validation_errors, $error_places)
{
    $errors_msg = [];
    foreach ($error_places as $place) {
        $field = str_replace('{{error_', '', $place);
        $field = str_replace('}}', '', $field);
        $field = str_replace('_', '-', $field);
        $errors_msg[$place] = isset($validation_errors[$field]) ? error_msg_maker($validation_errors[$field]) : '';
    }
    //cria array para as mensagens de erro, e pega os lugares com erros para verificar os lugares, pegando o campo de error_ buscando seu lugar, e os demais campos, substituindo com os campos dos erros. Fazendo assim a mensagem de erro, onde tiver seu lugar como index ($place), ele vai verificar se está setado o campo com a validação de erro, caso esteja, ele produz a mensagem, se não, ele deixa em branco ('').
    return $errors_msg;
}

function error_msg_maker($msg)
{
    $error = '<span class="mensagem-erro">' . $msg . '</span>';
    return $error;
}

function success_msg_maker($msg)
{
    $sucess = '<div class="mensagem-sucesso"> <p>' . $msg . '</p> </div>';
    return $sucess;
}

function get_sucess_places($content)
{
    return get_place_of('sucess', $content);
}

function get_error_places($content)
{
    return get_place_of('error', $content);
}

function get_field_places($content)
{
    return get_place_of('field', $content);
}

function get_value_places($content)
{
    return get_place_of('value', $content);
}

function get_place_of($field, $content)
{
    $pattern = "/{{" . $field . "\w+}}/";
    preg_match_all($pattern, $content, $match);
    return $match[0] ?? []; //vai retornar caso o match setado no 0 exista, se não, retorna vazio.
}
