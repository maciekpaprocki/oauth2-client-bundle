<?php

/*
 * OAuth2 Client Bundle
 * Copyright (c) KnpUniversity <http://knpuniversity.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KnpU\OAuth2ClientBundle\Tests\app;

use KnpU\OAuth2ClientBundle\KnpUOAuth2ClientBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;

class TestKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new KnpUOAuth2ClientBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function (ContainerBuilder $container) {
            $container->loadFromExtension('framework', [
                'secret' => 'this is a cool bundle. Shhh..., it\'s a secret...',
                'router' => [
                    'resource' => __DIR__ . '/routing.yml',
                ],
            ]);

            $container->loadFromExtension('knpu_oauth2_client', [
                'clients' => [
                    'my_facebook' => [
                        'type' => 'facebook',
                        'client_id' => 'FOOO',
                        'client_secret' => 'BAR',
                        'graph_api_version' => 'v2.5',
                        'redirect_route' => 'my_test_route',
                    ],
                ],
            ]);
        });
    }
}
