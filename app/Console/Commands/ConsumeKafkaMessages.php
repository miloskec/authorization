<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Junges\Kafka\Contracts\ConsumerMessage;
use Junges\Kafka\Contracts\MessageConsumer;
use Junges\Kafka\Facades\Kafka;

class ConsumeKafkaMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:consume-kafka-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Consume messages from Kafka topic';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting Kafka consumer...');
        $consumer = Kafka::consumer([config('kafka.topics.user_created.topic')])
            ->withBrokers(config('brokers'))
            ->withConsumerGroupId(config('kafka.topics.user_created.topic').'_authorization')
            ->withAutoCommit()
            ->withHandler(function (ConsumerMessage $message, MessageConsumer $consumer) {
                $user = $this->handleUser($message);
                $this->createUser($user);
            })
            ->build();

        $consumer->consume();
    }

    protected function handleUser(ConsumerMessage $message): array
    {
        $user = json_decode($message->getBody()['user'], true);
        $user['user_id'] = $user['id'];
        unset($user['id']);

        return $user;
    }

    protected function createUser(array $user): void
    {
        $isAdmin = $user['is_admin'] ?? false;
        if (! $isAdmin) {
            unset($user['is_admin']);
        }

        $user = User::create($user);

        if ($isAdmin) {
            $user->assignRole('admin');

            return;
        }
        $user->assignRole('user');

    }
}
