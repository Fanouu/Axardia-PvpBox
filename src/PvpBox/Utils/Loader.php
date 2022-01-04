<?php

namespace PvpBox\Utils;

use PvpBox\Core;

#Events
use PvpBox\Events\Player\{PlayerJoin, PlayerLeave, PlayerChat};

#Tasks
use PvpBox\Tasks\{AutoBroadcastTask};

#Command
use PvpBox\Commands\Joueur\WikiCommand;
use PvpBox\Commands\Staff\{SetRankCommand};

class Loader{

    public static function loadEvents(){

        $Events = [
            new PlayerJoin(),
            new PlayerLeave(),
            new PlayerChat()
        ];

        foreach($Events as $ev => $event){
            Core::getInstance()->getServer()->getPluginManager()->registerEvents($event, Core::getInstance());
        }
        $count = count($Events);
        Core::getInstance()->getLogger()->info("§5- §d$count §fEvent(s) load §5-");
    }

    public static function loadTasks(){

        $Tasks = [
            new AutoBroadcastTask()
        ];

        foreach($Tasks as $ta => $task){
            Core::getInstance()->getScheduler()->scheduleRepeatingTask($task, 20);
        }

        $count = count($Tasks);
        Core::getInstance()->getLogger()->info("§5- §d$count §fTask(s) loaded §5-");
    }

    public static function loadCommands(){

        $Commands = [
            "Wiki" => new WikiCommand(),
            "SetRank" => new SetRankCommand()
        ];

        foreach($Commands as $com => $cmd){
            Core::getInstance()->getServer()->getCommandMap()->register($com, $cmd);
        }

        $count = count($Commands);
        Core::getInstance()->getLogger()->info("§5- §d$count §fCommand(s) loaded §5-");
    }
}