<?php

function ssl_decrypt($data)
{
    $open_ssl = openssl_decrypt(base64_decode($data), 'AES-128-CBC', SECRET, 0, SECRET_IV); //decripta os dados, passando primeiramente o dado decodificado em base 64, depois fornece a cifra, a senha, as opções (que sempre vai ser 0 pelo que entendi), e a ultima string não entendi mt bem, pesquisar dps
    $open_ssl = str_replace('"', "", $open_ssl);
    return $open_ssl;
}

function ssl_crypt($data)
{
    $open_ssl = openssl_encrypt(json_encode($data), 'AES-128-CBC', SECRET, 0, SECRET_IV); //encripta os dados, passando primeiramente o dado para o encode de json, encriptando ele, depois fornece a cifra, a senha, as opções (que sempre vai ser 0 pelo que entendi), e a ultima string não entendi mt bem, pesquisar dps
    return base64_encode($open_ssl);
}
