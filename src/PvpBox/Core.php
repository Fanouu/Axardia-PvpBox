<?php

namespace PvpBox;

use pocketmine\plugin\PluginBase;

use PvpBox\Utils\Loader;

class Core extends PluginBase{

    private static $instance;

    public function onEnable(): void {
        $this->getLogger()->info("AxardiaCore - PvpBox, Loading...");
        self::$instance = $this;
        Loader::loadEvents();
        Loader::loadCommands();
        Loader::loadTasks();
        Loader::loadCustomItem();
        Loader::loadDirectory();
        $this->getLogger()->info("§dAxaridaCore §5-§d PvpBox§f, loaded !");
    }

    public static function getInstance(): Core{
        return self::$instance;
    }
}