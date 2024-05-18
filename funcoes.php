<?php
//FUNÇÕES DO BOT
require_once "api.php";

function tabela($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];

    $txt = "🧸 | _ PLANOS  INDIVIDUAIS:

🔘 100 créditos = R$10,00
🔘 250 créditos = R$20,00
🔘 450 créditos = R$35,00

⚠️ Cada Consulta Individual É Descontado 2 Créditos

👥 | PLANOS PARA GRUPOS

🔘 150 créditos = R$15,00
🔘 250 créditos = R$20,00
🔘 450 créditos = R$40,00
🔘 650 créditos = R$55,00

⚠️ Cada Consulta Para Grupos É Descontado 3 Créditos
_";

    $button[] = ['text' => "🔙", "callback_data" => "start"];

    $menu['inline_keyboard'] = array_chunk($button, 2);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function voltar($dados) {
    $chat_id = $dados["chat_id"];
    $id = $dados["id"];
    $message_id = $dados["query_message_id"];
    $nome = $dados["nome"];

 $txt = "
🧸 | *Bem Vindo! {$nome}*
Meu Nome é Teddyzinho Fui Desenvolvido Para Consultar Dados
[ ](https://telegra.ph/file/3384d2eb9ca94d4099e09.jpg)
_Navegue pelo meu menu abaixo:_";
    // BOTÕES 

$button[] = ['text' => "👤 Informação 👤", 'callback_data' => "infouser"];

$button[] = ['text' => "🔅 Rest Apis", 'url' => "https://t.me/nyoxwtf"];

$button[] = ['text' => "Comandos 📄", 'callback_data' => "comandos"];

$button[] = ['text' => "💰 Planos", 'callback_data' => "tabela"];

$button[] = ['text' => "Canal ⚠️", 'url' => "t.me/teddy_buscas_canal"];

$button[] = ['text' => "</> Dev </>", 'url' => "t.me/teddykatchau"];

$menu['inline_keyboard'][] = [$button[0]];
$menu['inline_keyboard'][] = [$button[1], $button[2]];
$menu['inline_keyboard'][] = [$button[3], $button[4]];
$menu['inline_keyboard'][] = [$button[5]];

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function exibir_planos($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];
    
    $txt = "☄️ | *Planos*

O BOT TEM:
✅ CONSULTA DE CPF  | RECEITA 
✅ Consulta De CPF1 | COMPLETA
✅ Consulta De CPF2 | E-SUS
✅ Consulta De TELEFONE1
✅ Consulta De RG 
✅ Consulta De TELEFONE2
✅ Consulta De TELEFONE3
✅ Consulta De NOME
✅ Consulta De SCORE | ATUALIZADO
✅ Consulta De BENEFICIOS
✅ Consulta De CNPJ
✅ Consulta De PLACA
✅ Consulta De CEP
✅ Consulta De IP
✅ Consulta De SITE
⚙️ FERRAMENTAS ⚙️
_CHK GG_ CHECKER
━━━━━━━━━━━━━━━━━━━━━
🛒 PLANOS  INDIVIDUAIS:

🔘 DIARIO = R$10,00
🔘 1 SEMANA = R$20,00
🔘 15 DIAS = R$29,00
🔘 1 MÊS = R$40,00
🔘 BIMESTRAL = R$60,00
🔘 ANUAL = R$450,00

━━━━━━━━━━━━━━━━━━━━━

Para mais informações, entre em contato com o suporte.";

    $button[] = ['text' => "🔙", 'callback_data' => "voltar"];
    $menu['inline_keyboard'] = array_chunk($button, 1);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function comandos($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];

    $txt = "*☆ | COMANDOS BOT @teddykatchau | ☆*
*🔄 Bases de dados atualizada, servidores otimizados!*

*● | PARÂMETROS | ●*
🟢 *STATUS 》* ONLINE
🟡 *STATUS 》* MANUTENÇÃO
🔴 *STATUS 》* OFFLINE

*• | MÓDULOS | •*
🟢 SCORE: `/score 00000000000`
🟢 CPF1: `/cpf1 00000000000`
🟢 CPF2: `/cpf2 00000000000`
🟢 CPF3: `/cpf3 00000000000`
🔴 CPF4: `/cpf4 00000000000`

🔴 TEL1: `/tel1 81971185449`
🔴 TEL2: `/tel2 81971185449`
🔴 TEL3: `/tel3 81971185449`
🟢 NOME: `/nome Jamilly Cambui`
🔴 PARENTES: `/parentes 00000000000`
🔴 VIZINHOS: `/vizinhos 00000000000`
🔴 BIN: `/bin 000000`
🔴 CEP: `/cep 54520015`

🔴 IP:
🟢 PLACA1:
🔴 EMAIL: `/email joao@hotmail.com`
🟢 CNPJ: `/cnpj 0000000000000`
🔴 RG: `/rg 0000000`

🔴 PLACA2:
🔴 SITE:

*● | CHECKERS | ●*

🟡 CHK: `/chk`
🟢 CHK SIPNI: `/chksip email:senha`

⚡️ *Use os comandos em Grupos e no Privado do Robô*
👤 *Suporte: @teddykatchau*
━━━━━━━━━━━━━━━━━━━━━";

    $button[] = ['text' => "🔙", "callback_data" => "voltar"];

    $menu['inline_keyboard'] = array_chunk($button, 1);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function planos($dados) {
    $chat_id = $dados["chat_id"];
    $message_id = $dados["query_message_id"];

    $txt = "🧸 | _ PLANOS  INDIVIDUAIS:

🔘 DIARIO = R$10,00
🔘 1 SEMANA = R$20,00
🔘 15 DIAS = R$29,00
🔘 1 MÊS = R$40,00
🔘 BIMESTRAL = R$60,00
🔘 ANUAL = R$450,00
_";

    $button[] = ['text' => "🔙", "callback_data" => "start"];

    $menu['inline_keyboard'] = array_chunk($button, 2);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function start($dados) {
    $chat_id = $dados["chat_id"];
    $id = $dados["id"];
    $message_id = $dados["query_message_id"];
    $nome = $dados["nome"];

 $txt = "
🧸 | *Bem Vindo! {$nome}*
Meu Nome é Teddyzinho Fui Desenvolvido Para Consultar Dados
[ ](https://telegra.ph/file/3384d2eb9ca94d4099e09.jpg)
_Navegue pelo meu menu abaixo:_";
    // BOTÕES 
$button[] = ['text' => "👤 Informação 👤", 'callback_data' => "infouser"];

$button[] = ['text' => "🔅 Rest Apis", 'url' => "https://t.me/nyoxwtf"];

$button[] = ['text' => "Comandos 📄", 'callback_data' => "comandos"];

$button[] = ['text' => "💰 Planos", 'callback_data' => "tabela"];

$button[] = ['text' => "Canal ⚠️", 'url' => "t.me/teddy_buscas_canal"];

$button[] = ['text' => "</> Dev </>", 'url' => "t.me/teddykatchau"];

$menu['inline_keyboard'][] = [$button[0]];
$menu['inline_keyboard'][] = [$button[1], $button[2]];
$menu['inline_keyboard'][] = [$button[3], $button[4]];
$menu['inline_keyboard'][] = [$button[5]];  

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}

function infouser($dados) {
    $chat_id = $dados["chat_id"];
    $id = $dados["id"];
    $message_id = $dados["query_message_id"];
    $usuarios = 'user/' . $id . ".json";
    $cuser = json_decode(file_get_contents($usuarios), true);
    $saldo = $cuser['saldo'];
    $creditos = $cuser['creditos'];
    $adm = $cuser['adm'];
    $rs = 'R$';

    $txt = "👤 *INFORMAÇÕES DO USUÁRIO*

🆔 | *CHAT_ID*: `$chat_id`
🆔 | *USER_ID*: `$id`
🍷 | *ADM*: `$adm`
🪙 | *SALDO*: `$saldo $rs`
💎 | *CRÉDITOS*: `$creditos`
[ ](https://telegra.ph/file/3384d2eb9ca94d4099e09.jpg)";

    $button[] = ['text' => "🔙", "callback_data" => "start"];

    $menu['inline_keyboard'] = array_chunk($button, 2);

    bot("editMessageText", array(
        "chat_id" => $chat_id,
        "text" => $txt,
        "message_id" => $message_id,
        "reply_markup" => $menu,
        "parse_mode" => 'Markdown'
    ));
}