<?php

namespace ArturDoruch\ListBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class ArturDoruchListExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('arturdoruch_list.query_parameter_names', $config['query_parameter_names']);
        $paginationConfig = $config['pagination'];
        $container->setParameter('arturdoruch_list.pagination.item_limits', $paginationConfig['item_limits']);
        $container->setParameter('arturdoruch_list.pagination.page_items', $paginationConfig['page_items']);
        $container->setParameter('arturdoruch_list.paginators', $config['paginators']);
        $container->setParameter('arturdoruch_list.query_sort_direction', $config['query_sort_direction'] ?? []);
        $container->setParameter('arturdoruch_list.filter_form', $config['filter_form']);
    }
}
