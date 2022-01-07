<?php

namespace PvpBox\Managers;

use pocketmine\player\Player;
use pocketmine\utils\Config;

class SanctionManager{

    public static function isBanned(Player $player){
        $ban = self::banData()->get($player->getName());
        if($ban === null) return false;
        if($ban === true) return "def";
    }

    public static function isFreezed(Player $player){}

    public static function isMuted(Player $player){}

    public static function toBan(Player $player){}

    public static function toFreeze(Player $player){}

    public static function toMute(Player $player){}

    public static function unBan($player){}
    
    public static function unFreeze($player){}

    public static function unMute($player){}

    public static function banData(){
        $data = new Config(Core::getInstance()->getDataFolder() . "PlayerBan.json", Config::JSON);
        return $data;
    }

    public static function freezeData(){
        $data = new Config(Core::getInstance()->getDataFolder() . "PlayerFreeze.json", Config::JSON);
        return $data;
    }

    public static function mueData(){
        $data = new Config(Core::getInstance()->getDataFolder() . "PlayerMute.json", Config::JSON);
        return $data;
    }
}