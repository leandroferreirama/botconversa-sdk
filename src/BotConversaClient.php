<?php

namespace BotConversa;

use Psr\Log\LoggerInterface;

class BotConversaClient extends ApiClient implements BotConversaClientInterface
{
    public function __construct(string $apiKey, ?LoggerInterface $logger = null)
    {
        parent::__construct($apiKey, $logger); // Chama o construtor da classe pai
    }
    
    public function createSubscriber(string $phone, string $firstName, string $lastName): array
    {
        $data = [
            'phone' => $phone,
            'first_name' => $firstName,
            'last_name' => $lastName
        ];
        return $this->request('POST', 'subscriber/', $data);
    }

    public function getSubscriberByPhone(string $phone): array
    {
        return $this->request('GET', "subscriber/get_by_phone/{$phone}");
    }

    public function sendMessageToSubscriber(string $subscriberId, string $type, string $value): array
    {
        return $this->request('POST', "subscriber/{$subscriberId}/send_message/", [
            'type' => $type,
            'value' => $value
        ]);
    }
    /**
     * Envia uma mensagem para um telefone específico.
     *
     * @param string $phone O número de telefone do assinante.
     * @param string $type O tipo da mensagem.
     * @param string $value O conteúdo da mensagem.
     * 
     * @return array A resposta da API após o envio da mensagem.
     */
    public function sendMessageToPhone(string $phone, string $type, string $value): array
    {
        $request = $this->request('GET', "subscriber/get_by_phone/{$phone}");
        if(!isset($request['id'])) {
            // Logando o erro antes de lançar a exceção
            if ($this->logger) {
                $this->logger->error("Nenhum assinante encontrado para o telefone: {$phone}");
            }

            return [
                'error' => true,
                'message' => "Nenhum assinante encontrado para o telefone: {$phone}"
            ];
        }
        return $this->request('POST', "subscriber/{$request['id']}/send_message/", [
            'type' => $type,
            'value' => $value
        ]);
    }

    public function saveCustomField(string $subscriberId, int $custom, string $value): array
    {
        return $this->request('POST', "subscriber/{$subscriberId}/custom_fields/{$custom}/", [
            'value' => $value
        ]);
    }
}