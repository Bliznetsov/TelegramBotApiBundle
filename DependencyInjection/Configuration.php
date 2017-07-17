<?php

namespace TelegramBotApiBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('telegram_bot_api');


        $rootNode
                ->children()
                    ->scalarNode("token")->isRequired()->end()
                    ->scalarNode("bot_name")->end()
                    ->arrayNode("webhook")
                    ->children()
                        ->scalarNode("domain")->end()
                        ->scalarNode("path_prefix")->end()
                        ->scalarNode("update_receiver")->defaultValue("telegram_bot.my_update_receiver")->end()
                    ->end()
                    ->end()
                ->end();


        return $treeBuilder;
    }

}
