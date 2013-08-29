<?php

namespace SE\Bundle\BmecatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $builder = new TreeBuilder();
        $builder->root('se_bmecat')
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('documents')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('loader')
                                ->prototype('scalar')->end()
                            ->end()
                            ->booleanNode('nullable')
                                ->defaultFalse()
                            ->end()
                            ->arrayNode('document')
                                ->children()
                                    ->arrayNode('header')
                                        ->children()
                                            ->scalarNode('generator_info')
                                                ->defaultValue('SE BMEcat')
                                            ->end()
                                            ->variableNode('catalog')
                                                ->defaultValue([])
                                            ->end()
                                            ->variableNode('supplier')
                                                ->defaultValue([])
                                            ->end()
                                        ->end()
                                    ->end()
                                    ->arrayNode('attributes')
                                        ->prototype('scalar')->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $builder;
    }
}
