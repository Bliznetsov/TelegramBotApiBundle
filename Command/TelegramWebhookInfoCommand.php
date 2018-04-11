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
use Symfony\Component\DependencyInjection\ContainerInterface;

class TelegramWebhookInfoCommand extends Command
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
            ->setName('telegram:webhook:info')
            ->setDescription('Get Bot webhook information')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
    	$io = new SymfonyStyle($input, $output);

	    $result = $this->container->get('telegram_bot_api')->getWebhookInfo();
	    if($result->isOk())
	    {
		    $result = (array) $result->result;

            $io->success('Information recived');

		    $table = new Table($output);
            $table->setHeaders(['Field', 'Value'])
		          ->setRows([
                      ['URL', $result['url'] ? $result['url'] : 'Empty'],
                      new TableSeparator(),
			          ['Has custom certificate', $result['has_custom_certificate'] ? 'Yes' : 'No'],
			          new TableSeparator(),
                      ['Pending update count', isset($result['pending_update_count']) ? $result['pending_update_count'] : 'Empty'],
                      new TableSeparator(),
                      ['Last error date', isset($result['last_error_date']) ? $result['last_error_date'] : 'Empty'],
                      new TableSeparator(),
                      ['Last error message', isset($result['last_error_message']) ? $result['last_error_message'] : 'Empty'],
                      new TableSeparator(),
                      ['Max connections', isset($result['max_connections']) ? $result['max_connections'] : 'Empty'],
                      new TableSeparator(),
                      ['Allowed updates', isset($result['allowed_updates']) ? $result['allowed_updates'] : 'All'],
		          ]);
		    $table->render();
	    }
	    else
	    {
	    	$io->error('Information was not received');
	    }
    }

}
