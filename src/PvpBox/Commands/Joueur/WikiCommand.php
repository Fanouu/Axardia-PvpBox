<?php

namespace PvpBox\Commands\Joueur;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use  PvpBox\core;
use  PvpBox\Forms\Form\CommandForm;

class WikiCommand extends Command{

    private $plugin;

    public function __construct() {
        parent::__construct("wiki", "Acceder au Wiki", "/wiki", []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if ($sender instanceof Player) {
            $cmdForm = new CommandForm();
            $cmdForm->openWiki($sender);
        }
    }

}