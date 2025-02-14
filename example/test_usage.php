<?php

require __DIR__ . '/../vendor/autoload.php';

use BotConversa\VariavelAmbiente;
use BotConversa\BotConversaClient;

// Carregar variáveis de ambiente
VariavelAmbiente::load(__DIR__.'/..');

// Obter chave de API do ambiente
$apiKey = getenv('BOTCONVERSA_API_KEY');

// Criar cliente da API
$client = new BotConversaClient($apiKey);
echo '<hr>';

// Teste: Adicionar contato
//$response = $client->createSubscriber('5541996055012', 'João', 'da Silva');
//print_r($response);

// Teste: Obter contato
$response = $client->getSubscriberByPhone('5541996055012');
print_r($response);
echo '<hr>';

// Teste: Enviar mensagem
$response = $client->sendMessageToSubscriber($response['id'], 'text', 'eee, faz um pão com ovo pra mim?');
print_r($response);
echo '<hr>';

/*// Teste: Adicionar etiqueta ao contato
$response = $client->addTagToContact('123456', 'Cliente VIP');
print_r($response);

// Teste: Atribuir contato a um agente
$response = $client->assignContactToAgent('123456', 'agent_id_123');
print_r($response);*/
