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
        
        $eloLevel = str_replace([0, 1, 2, 3], ["", "I", "II", "III"], $rankAPI->getEloLevel($player));
        $eloRank = $rankAPI->getEloRank($player);
        $elo = $rankAPI->getEloLevel($player) === 0 ? "$eloRank" : "$eloRank §d$eloLevel";
      
        if($rank === "Player"){
            return "$elo §5[§7Joueur§5] §f{$player->getName()} §r§5» §f$messages";
        }

        if($rank === "Admin"){
            return "$elo §4[§cAdministrateur§4] §f{$player->getName()} §r§5» §f$messages";
        }
        if($rank === "Modérateur"){
            return "$elo §2[§aModérateur§2] §f{$player->getName()} §r§5» §f$messages";
        }

        if($rank === "Responsable"){
            return "$elo §5[§dRésponsable§5] §f{$player->getName()} §r§5» §f$messages";
        }

        /*if($rank === "Responsable"){
            return "§5[§dRésponsable§5] §f{$player->getName()} §r§5» §f$messages";
        }*/

        if($rank === "Developpeur"){
            return "$elo §9[§bDéveloppeur§9] §f{$player->getName()} §r§5» §f$messages";
        }

        if($rank === "Guide"){
            return "$elo §1[§9Guide§1] §f{$player->getName()} §r§5» §f$messages";
        }
        
    }
}