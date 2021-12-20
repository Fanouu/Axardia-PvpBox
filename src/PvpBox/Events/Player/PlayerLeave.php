<?php

namespace PvpBox\Events\Player;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use PvpBox\Constants\Messages;

class PlayerLeave implements Listener{

    public function playerLeave(PlayerQuitEvent $event){
        $event->setQuitMessage("");
        $player = $event->getPlayer();
        $pname = $player->getName();

        $player->getServer()->broadcastMessage(str_replace("{player}", $pname, Messages::PLAYERQUIT));
    }
}