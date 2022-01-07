<?php

namespace PvpBox\Commands\Joueur;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

use PvpBox\core;
use PvpBox\Managers\MoneyManager;

class MyMoneyCommand extends Command{

    private $plugin;

    public function __construct() {
        parent::__construct("mymoney", "voir votre money actuel", "/mymoney", []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) {

        if ($sender instanceof Player) {
            $moneyAPI = new MoneyManager();
            $money = $moneyAPI->getMoney($sender);
            $sender->sendMessage("§dVous avez actuellement §5§l$money §r");
        }
    }

}