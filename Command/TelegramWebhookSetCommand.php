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
            ->addArgument('url', InputArgument::OPTIONAL, 'Url to set webhook')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
    	$io = new SymfonyStyle($input, $output);

    	$url = $input->getArgument('url');
    	if(empty($url))
	    {
		    $question = new Question("Web hook url");
		    $url = $io->askQuestion($question);
	    }

	    $result = $this->container->get('telegram_bot_api')->setWebhook(['url' => $url]);
	    if($result->isOk())
	    {
	    	$io->success($result->getRawData()['description']);
	    }
	    else
	    {
	    	$io->error('Web Hook failed');
	    }
    }

}
