<?php

namespace BotConversa;

class BotConversaClient extends ApiClient implements BotConversaClientInterface
{
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
}