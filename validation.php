<?php

function valdate_register($data)
{ //para validar o registro, utilizado no controller
    $errors = []; //array para os erros
    if (strlen($data['password']) < 10) { //verifica se a senha é menor que 10 caracteres
        $errors['password'] = 'A senhe deve ter 10 caracteres ou mais'; //mensagem de erro para senha pequena
    }
    if ($data['password'] !== $data['password-confirm']) { //se o dado da senha for estritamente diferente do dado da confirmação de senha
        $errors['password-confirm'] = 'A senha e a confirmação estão diferentes'; //mensagem de erro para senhas diferentes
    }
    if (crud_restore($data['email'])) { //se o crud_restore retornar com um dado de email já cadastrado
        $errors['email'] = 'Email já cadastrado no sistema, informe outro';
    }
    return $errors;
}

function validade_change_password($data)
{
    $errors = [];
    if (strlen($data['password']) < 10) {
        $errors['password'] = 'A senha deve ter 10 caracteres ou mais';
    }
    if ($data['password'] !== $data['password-confirm']) {
        $errors['password-confirm'] = 'A senha e a confirmação estão diferentes';
    }
    return $errors;
}
