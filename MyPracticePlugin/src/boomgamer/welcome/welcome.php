<?php

declare(strict_types=1);

namespace Boomgamer\MinigamesPlugin;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\XpLevelUpSound;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {

        $this->getLogger()->info("Plugin Enabled");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event): void {
        $player = $event->getPlayer();
        $player->sendTitle(TextFormat::GREEN . "Welcome!");
        $player->setGamemode(GameMode::ADVENTURE);
        $player->sendSubTitle(TextFormat::WHITE . $this->getName());
        $event->setJoinMessage(TextFormat::WHITE . "Welcome To the server " . TextFormat::GREEN . $this->getName());
        $location = $player->getLocation();
        $player->getWorld()->addSound($location, new XpLevelUpSound());
        $player->setHealth($player->getMaxHealth());
        $player->getHungerManager()->setFood(20);
        $player->getInventory()->clearAll();
        $item = VanillaItems::COMPASS();
        $item->setCustomName(TextFormat::GREEN . "Teleporter");
        $player->getInventory()->setItem(4, $item);
    }
    
    public function onDisable(): void
    {
        $this->getLogger()->info("Plugin Disabled");
    }

}
