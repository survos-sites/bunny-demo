<?php

// src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Survos\BunnyBundle\Service\BunnyService;

class AppMenu
{

    /**
     * Add any other dependency you need...
     */
    public function __construct(
        private FactoryInterface $factory,
        private BunnyService $bunnyService,
    )
    {
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'app_homepage']);
        // ... add more children

        foreach ($this->bunnyService->getZones() as $zone) {
            $menu->addChild($zone['name'], ['route' => 'survos_bunny_zone', 'routeParameters' => ['zoneName' => $zone['name'], 'id' => $zone['id']]]);
        }

        return $menu;
    }
}
