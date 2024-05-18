<?php
require_once "api.php";
require_once "funcoes.php";

$usuarios = 'user/' . $id . ".json";



$conteudo = [
"id" => $id,
"chat_id" => $chat_id,
"adm" => "não"
];

$duser = json_encode($conteudo, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

if ($callback_query) {
    $query_data = $callback_query['data'];
    $query_message_id = $callback_query['message']['message_id'];
    $query_chat_id = $callback_query['message']['chat']['id'];
    $query_nome = $callback_query['message']['chat']['first_name'];
    $query_id = $callback_query['id'];

    if ($query_data == "exibir_planos") {
        exibir_planos($query_chat_id, $query_message_id);
    } elseif ($query_data == "voltar") {
        voltar($query_chat_id, $query_message_id);
    }
}

// COMANDOS COM PREFIXO

$comando = explode(' ', $texto)[0];

/* [ ](https://telegra.ph/file/3384d2eb9ca94d4099e09.jpg) */

switch ($comando) {

case "/menu":
case "/start":

if (!file_exists($usuarios)) {

file_put_contents($usuarios, $duser);

    $msg = "✅ | Arquivo `$id` Criado com sucesso";
    echo $msg;
} else {
    $msg = "⚠️ | `$id` Já existe";
    echo $msg;
}

$cuser = json_decode(file_get_contents($usuarios), true);

$saldo = $cuser['saldo'];
$creditos = $cuser['creditos'];

 $txt = "
🧸 | *Bem Vindo! {$nome}*

Bom uso!


_Navegue pelo meu menu abaixo:_";
    // BOTÕES 



$button[] = ['text' => "👤 Informação 👤", 'callback_data' => "infouser"];


$button[] = ['text' => "Comandos 📄", 'callback_data' => "comandos"];


$button[] = ['text' => "</> Dev </>", 'url' => "t.me/teddykatchau"];

$menu['inline_keyboard'][] = [$button[0], $button[1]];
$menu['inline_keyboard'][] = [$button[2]];
 

         bot("sendChatAction", array(
        "chat_id" => $chat_id,
        "action" => "typing"
        ));

        bot("sendMessage", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));

break;
            
//IA

case "/ia":

$q = substr($texto, 4);

try {
  
  if ($q.len > 2) {
  
$api = "https://shadow-apis.xyz/api/gemini-pro?q=$q&apikey=Developers30";

$data = json_decode(file_get_contents($api), true);

$resultado = $json['resultado']['resposta'];

bot("sendChatAction", array(
  "chat_id" => $chat_id,
  "action" => "typing"
  ));

bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $resultado,
"message_id" => $message_id,
"reply_markup" => $menu,
"parse_mode" => 'Markdown'
));

} else {
   
   $txt = "Olá $nome use o comando desse jeito: `/ia Quem descobriu o Brasil?`";
   
  bot("sendChatAction", array(
  "chat_id" => $chat_id,
  "action" => "typing"
  ));

bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $txt,
"message_id" => $message_id,
"reply_markup" => $menu,
"parse_mode" => 'Markdown'
));

}
} catch {
 $erro = "Algo deu errado";
 
  bot("sendChatAction", array(
  "chat_id" => $chat_id,
  "action" => "typing"
  ));
  
 bot("sendMessage", array(
"chat_id" => $chat_id,
"text" => $erro,
"message_id" => $message_id,
"reply_markup" => $menu,
"parse_mode" => 'Markdown'
)); 
}
break;


default:
}

if ($callback_query) {
    $query_data = $callback_query['data'];
    $query_message_id = $callback_query['message']['message_id'];
    $query_chat_id = $callback_query['message']['chat']['id'];
    $query_nome = $callback_query['message']['chat']['first_name'];
    $query_usuario = $callback_query['message']['chat']['username'];
    $query_id = $callback_query['id'];

    $callback = explode("|", $query_data)[0];
    $optional = isset(explode("|", $query_data)[1]) ? explode("|", $query_data)[1] : null;

    if ($callback === "delete_message") {
        bot("deleteMessage", array(
            "chat_id" => $query_chat_id,
            "message_id" => $query_message_id
        ));
    } elseif (function_exists($callback)) {
        $dados = array(
            "chat_id" => $query_chat_id,
            "id" => $query_chat_id,
            "nome" => $query_nome,
            "usuario" => $query_usuario,
            "message_id" => $query_message_id,
            "query_message_id" => $query_message_id,
            "query_nome" => $query_nome,
            "query_id" => $query_id,
            "optional" => $optional,
            "query_usuario" => $query_usuario
        );
        $callback($dados);
    } else {
        bot("answerCallbackQuery", array(
            "callback_query_id" => $query_id,
            "text" => "⚠️ | Função em desenvolvimento!",
            "show_alert" => false,
            "cache_time" => 10
        ));
    }
}

?>