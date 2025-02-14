<?php

namespace BotConversa;

class VariavelAmbiente
{
    public static function load(string $dir): void
    {
        // Verifica se o arquivo .env existe
        if (!file_exists($dir . '/.env')) {
            return;
        }

        // Lê o arquivo linha por linha e define as variáveis de ambiente
        $linhas = file($dir . '/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($linhas as $linha) {
            // Ignora comentários no arquivo .env
            if (strpos(trim($linha), '#') === 0) {
                continue;
            }
            putenv(trim($linha));
        }
    }
}
