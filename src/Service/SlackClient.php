<?php

namespace App\Service;

use Nexy\Slack\Client;
use Psr\Log\LoggerInterface;
use App\Helper\LoggerTrait;

class SlackClient
{
    use LoggerTrait;
    /**
     * @var Client
     */
    private $slack;

    /**
     * @var LoggerInterface|null
     */
    private $logger;

    /**
     * SlackClient constructor.
     */
    public function __construct(Client $slack)
    {
        $this->slack = $slack;
    }

    /**
     * @required
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function sendMessage(string $from, string $message)
    {
        $this->logInfo('Beaming a message to Slack!', [
            'message' => $message
        ]);
        $message = $this->slack->createMessage()
            ->from($from)
            ->withIcon(':ghost:')
            ->setText($message);
        $this->slack->sendMessage($message);
    }
}