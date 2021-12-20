<?php

namespace PvpBox\Commands\Staff;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use PvpBox\core;
use PvpBox\Forms\Form\CommandForm;

class SetRankCommand extends Command{

    private $plugin;

    public function __construct() {
        parent::__construct("setrank", "Acceder au menu des rank", "/setrank", []);
        $this->setPermission("levelTwo_extends.axardia.perm");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if ($sender instanceof Player) {
            $cmdForm = new CommandForm();
            $cmdForm->openSetRank($sender);
        }
    }

}