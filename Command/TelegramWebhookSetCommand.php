<?php

namespace EricomGroup\TelegramBotApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TelegramWebhookSetCommand extends Command
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            ->setName('telegram:webhook:set')
            ->setDescription('Set Bot webhook')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
    	$io = new SymfonyStyle($input, $output);
    	$data = [];

        $question = new Question("Web hook URL");
        $data['url'] = $io->askQuestion($question);

        $question = new Question("Max connections");
        $data['max_connections'] = $io->askQuestion($question);

        $question = new Question("Allowed updates");
        $data['allowed_updates'] = $io->askQuestion($question);

        if($data['allowed_updates'] == ''){
            unset($data['allowed_updates']);
        }
        if($data['max_connections'] == ''){
            unset($data['max_connections']);
        }

	    $result = $this->container->get('telegram_bot_api')->setWebhook($data);

	    if($result->isOk()) {
	    	$io->success($result->getRawData()['description']);
	    } else {
	    	$io->error('Web Hook failed');
	    }
    }

}
