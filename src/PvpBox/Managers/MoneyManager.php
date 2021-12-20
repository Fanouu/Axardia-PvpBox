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

    public function getData(Player $player, $data){
        $pdata = new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
        return $pdata->getNested("Money.$data");
    }

    public function setData(Player $player, $data, $toSet){
        $this->data->setNested("Money.$data", $toSet);
    }

    public function data(Player $player){
        return new Config(Core::getInstance()->getDataFolder() . "PlayerData/" . $player->getName() . ".json", Config::JSON);
    }
    
}