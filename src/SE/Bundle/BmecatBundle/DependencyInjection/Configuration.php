<?php
/**
 * This file is part of the BMEcat php library
 *
 * (c) Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SE\Bundle\BmecatBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 *
 * @package SE\Bundle\BmecatBundle
 * @author Sven Eisenschmidt <sven.eisenschmidt@gmail.com>
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
