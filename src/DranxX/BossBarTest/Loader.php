<?php

namespace DranxX\BossBarTest;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\Task;
use pocketmine\player\Player;
use pocketmine\Server;
use DranxX\apibossbar\BossBar;

class Loader extends PluginBase implements Listener
{
    /** @var BossBar */
    public static $bar;

    public function onEnable() : void
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        self::$bar = (new BossBar())->setPercentage(1);
        $this->saveDefaultConfig();	
        $bar->setTitle(str_replace("&", "§", $this->getConfig()->get("title")));
    }
        	
    public function onJoin(PlayerJoinEvent $ev)
    {
        self::$bar->addPlayer($ev->getPlayer());
    }
}