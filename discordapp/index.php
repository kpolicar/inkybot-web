<?php namespace DiscordApp;

use DiscordApp\Controllers\MessageController;
use DiscordApp\Controllers\WebhookController;
use Discord\Discord;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;
use Discord\Parts\Guild\Guild;

include __DIR__.'/../vendor/autoload.php';
const GUILD_ID = 764510615049076797;
const WEBHOOK_USER_ID = 795037986592391178;

$discord = new \Discord\Discord([
    'token' => 'NzY0NTYyNTI3NzUyMjkwMzE2.X4IEVw.d7ncwQTjpOirR7QrmqQ1yoipLEs',
    'loadAllMembers' => true,
]);

$discord->on('ready', function (\Discord\Discord $discord) {

    $discord->guilds->fetch(GUILD_ID)->then(function (Guild $guild) use ($discord) {

        $discord->on('message', function (Message $message, Discord $discord) use ($guild) {
            if ($message->author->id == WEBHOOK_USER_ID && str_starts_with($message->content, "!"))
                return (new WebhookController($guild))->handleMessage($message);

            if ($discord->username == $message->author->username ||
                $message->channel->type != Channel::TYPE_DM)
                return;

            return (new MessageController($guild))->handle($message);

            echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;
        });
    });
    echo "Bot is ready.", PHP_EOL;

    // Listen for events here


});

$discord->run();
