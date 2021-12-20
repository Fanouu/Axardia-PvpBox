<?php

namespace PvpBox\Managers;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use PvpBox\Core;

class RankManager{

    public const DEFAULTRANK = "Player";

    public function getRank(Player $player){
        $pdata = new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
        return $pdata->getNested("Rank.MyRank");
    }

    public function setRank(Player $player, $rank){
        $pdata = new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
        $pdata->setNested("Rank.MyRank", $rank);
        $pdata->save();
    }

    public function rankNoExists(Player $player){
        $pdata = new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
        if(!$this->getRank($player, "MyRank")){
            Core::getInstance()->getLogger("No rank found for player " . $player->getName() . " creation in progress");
            $this->setRank($player, self::DEFAULTRANK);
            Core::getInstance()->getLogger("progress finished data rank created for " . $player->getName());
        }
    }

    public function data(Player $player){
        return new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
    }

}