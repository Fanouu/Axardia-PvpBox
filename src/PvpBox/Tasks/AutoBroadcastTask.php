<?php

namespace PvpBox\Tasks;

use pocketmine\Server;
use pocketmine\scheduler\Task;
use pocketmine\utils\Config;

use PvpBox\Core;
use PvpBox\Constants\Messages;
use PvpBox\Constants\Prefix;

class AutoBroadcastTask extends Task{

    public static $counter = 0;
    public static $time = 0;

    public function onRun(): void{

        if(self::$time === 900){
            $serv = Core::getInstance()->getServer();
            $messages = Messages::AUTOBROADCAST;

            $serv->broadcastMessage(str_replace(["{prefix_server}", "{prefix_important}"], [Prefix::SERVER, Prefix::IMPORTANT], $messages[self::$counter]));

            self::$counter++;
            if(self::$counter == count($messages)){
                self::$counter = 0;
            }
            self::$time = 0;

        }
        self::$time++;
    }

}