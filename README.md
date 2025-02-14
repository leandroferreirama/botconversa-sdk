# BotConversa SDK

Este é um SDK para consumir a API do BotConversa usando PHP e Composer.

## Instalação

1. Clone este repositório.
2. Rode `composer install` para instalar as dependências.

## Uso

```php
require 'vendor/autoload.php';

use BotConversa\BotConversaClient;

$apiKey = 'SUA_CHAVE_DE_API';
$client = new BotConversaClient($apiKey);

$response = $client->getContacts();
print_r($response);
```

## Testes

Para rodar os testes, execute:

```sh
vendor/bin/phpunit tests
```

---
Feito com ❤️
