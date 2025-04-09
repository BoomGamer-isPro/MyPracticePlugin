<?php

declare(strict_types=1);

namespace boomgamer\welcome;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use pocketmine\plugin\PluginBase;
use pocketmine\world\sound\XpCollectSound;

class welcome extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("§aPlugin Enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerJoin(PlayerJoinEvent $event) {
        $player = $event->getPlayer();
        $event->setJoinMessage("§aWelcome To BridgeSplash" . $player->getName() . "!");
        $player->setGamemode(GameMode::ADVENTURE);
        $player->sendTitle("§cBridge§9Splash");
        $player->sendSubTitle("Welcome!");
        $onlinePlayer = count($this->getServer()->getOnlinePlayers());
        $player->sendMessage("There are §e" . $onlinePlayer . "players playing.");
        $location = $player->getLocation();
        $player->getWorld()->addSound($location, new XpCollectSound());
        $player->getInventory()->clearAll();
        $item = VanillaItems::COMPASS();
        $player->getInventory()->addItem($item);
        $player->setHealth($player->getMaxHealth());
        $player->getHungerManager()->setFood(20);

    }

    public function onDisable(): void {
        $this->getLogger()->info("§cPlugin Disabled!");
    }
}