<?php

namespace Octania\Faction\Commands\Staff;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use Octania\Faction\core;
use Octania\Faction\Forms\Form\CommandForm;

class WikiCommand extends Command{

    private $plugin;

    public function __construct() {
        parent::__construct("ban", "§9Octania §rBan", "/ban [player]", []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if ($sender instanceof Player) {
            $cmdForm = new CommandForm();
            $cmdForm->openBanUi($sender);
        }
    }

}