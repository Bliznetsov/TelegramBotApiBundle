<?php

namespace EricomGroup\TelegramBotApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
	    $treeBuilder->root('telegram_bot_api')
                ->children()
			        ->scalarNode( 'username' )
		            ->end()
			        ->scalarNode( 'token' )
				        ->isRequired()
			        ->end()
	                ->arrayNode('development')
	                    ->children()
	                        ->arrayNode('developers_id')
	                            ->prototype('scalar')
		                        ->end()
                            ->end()
	                        ->arrayNode('maintenance')
	                            ->children()
	                                ->booleanNode('enable')
	                                    ->defaultFalse()
                                    ->end()
	                                ->scalarNode('text')
	                                    ->defaultValue('The robot is being repaired! Please come back later.')
                                    ->end()
	                            ->end()
	                        ->end()
	                    ->end()
	                ->end()
                ->end();

        return $treeBuilder;
    }

}
