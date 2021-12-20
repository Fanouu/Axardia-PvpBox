<?php

namespace PvpBox\Events\Player;

use pocketmine\event\Listener;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\player\Player;

use PvpBox\Managers\RankManager;

class PlayerChat implements Listener{
    use CancellableTrait;

    public function onChat(PlayerChatEvent $event){
        $player = $event->getPlayer();
        $messages = $event->getMessage();
        $event->setFormat($this->getFormat($player, $messages));
    }

    public function getFormat(Player $player, $messages){
        $rankAPI = new RankManager();
        $rank = $rankAPI->getRank($player);
        $rankAPI->rankNoExists($player);

        if($rank === "Player"){
            return "§5[§7Joueur§5] §f{$player->getName()} §r§5» §f$messages";
        }

        if($rank === "Admin"){
            return "§4[§cAdministrateur§4] §f{$player->getName()} §r§5» §f$messages";
        }
        if($rank === "Modérateur"){
            return "§2[§aModérateur§2] §f{$player->getName()} §r§5» §f$messages";
        }

        if($rank === "Responsable"){
            return "§5[§dRésponsable§5] §f{$player->getName()} §r§5» §f$messages";
        }

        /*if($rank === "Responsable"){
            return "§5[§dRésponsable§5] §f{$player->getName()} §r§5» §f$messages";
        }*/

        if($rank === "Développeur"){
            return "§9[§bDéveloppeur§9] §f{$player->getName()} §r§5» §f$messages";
        }

        if($rank === "Guide"){
            return "§1[§9Guide§1] §f{$player->getName()} §r§5» §f$messages";
        }
        
    }
}