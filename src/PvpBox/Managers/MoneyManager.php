<?php

namespace PvpBox\Managers;

use pocketmine\player\Player;
use pocketmine\utils\Config;
use PvpBox\Core;

class MoneyManager{

    public function getMoney(Player $player){
        return (int)$this->getData($player, "CurrentMoney");
    }

    public function setMoney(Player $player, int $currency){
        $this->setData($player, "CurrentMoney", $currency);
    }

    public function addMoney(Player $player, int $currency){
        $this->setData($player, "CurrentMoney", $this->getData($player, "CurrentMoney") + $currency);
    }

    public function substractMoney(Player $player){
        $this->setData($player, "CurrentMoney", 0);
    }

    public function moneyNoExists(Player $player){
        if($this->getData($player, "CurrentMoney") == null){
            $this->setData($player, "CurrentMoney", 2000);
        }
    }

    public function getData(Player $player, $data){
        $pdata = new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
        return $pdata->getNested("Money.$data");
    }

    public function setData(Player $player, $datas, $toSet){
        $pdata = new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
        $pdata->setNested("Money.$datas", $toSet);
        $pdata->save();
    }

    
}