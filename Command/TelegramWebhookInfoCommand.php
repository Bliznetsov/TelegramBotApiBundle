<?php

namespace EricomGroup\TelegramBotApiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;

class TelegramWebhookInfoCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('telegram:webhook:info')
            ->setDescription('Get Bot webhook information')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
    	$io = new SymfonyStyle($input, $output);

	    $result = $this->getContainer()->get('telegram_bot_api')->getWebhookInfo();
	    if($result->isOk())
	    {
		    $result = (array) $result->result;

		    $table = new Table($output);
		    $table->setHeaders(['Url', $result['url']])
		          ->setRows([
			          ['Has custom certificate', $result['has_custom_certificate'] ? 'Yes' : 'No'],
			          new TableSeparator(),
			          ['Pending update count', $result['pending_update_count']],
			          new TableSeparator(),
			          ['Max connections', $result['max_connections']],
		          ]);
		    $table->render();

		    $io->success('Information recived');
	    }
	    else
	    {
	    	$io->error('Information was not received');
	    }
    }

}
