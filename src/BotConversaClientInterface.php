<?php

namespace BotConversa;

interface BotConversaClientInterface
{
    public function createSubscriber(string $phone, string $firstName, string $lastName): array;
    public function getSubscriberByPhone(string $phone): array;
    public function sendMessageToSubscriber(string $subscriberId, string $type, string $value): array;
}