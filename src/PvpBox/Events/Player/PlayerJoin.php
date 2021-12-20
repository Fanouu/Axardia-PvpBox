<?php

namespace PvpBox\Events\Player;

use pocketmine\event\Listener;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Cancellable;
use pocketmine\event\player\PlayerJoinEvent;

use PvpBox\Constants\Messages;
use PvpBox\Constants\Prefix;
use PvpBox\Forms\Form\EventForm;
use PvpBox\Managers\ScoreboardManager;
use PvpBox\Managers\RankManager;

class PlayerJoin implements Listener{

    private static $scoreboard = [];

    public function PlayerJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $pname = $player->getName();

        $event->setJoinMessage("");
        $player->getServer()->broadcastMessage(str_replace("{player}", $pname, Messages::PLAYERJOIN));

        if(!$player->hasPlayedBefore()){
            $player->getServer()->broadcastMessage(str_replace(["{player}", "{prefix_server}"], [$pname, Prefix::SERVER], Messages::FIRSTJOIN));
            $api = new EventForm();
            $api->openFirstJoin($player);
        }

        $rankAPI = new RankManager();
        $rankAPI->rankNoExists($player);

        $allPlayer = count($player->getServer()->getOnlinePlayers());
        $maxPlayer = $player->getServer()->getMaxPlayers();

        self::$scoreboard[$pname] = new ScoreboardManager($player);

        self::$scoreboard[$pname]->addScoreboard("§5- §dAxardia §5-");
        self::$scoreboard[$pname]->setLine(0, "      ");
        self::$scoreboard[$pname]->setLine(1, "§5§l» §r§fStats de §d{$pname}");
        self::$scoreboard[$pname]->setLine(2, "      ");
        self::$scoreboard[$pname]->setLine(3, "Kill/Death §5§l» §r§f0§d/§f0");
        self::$scoreboard[$pname]->setLine(4, "Ratio K/D §5§l» §r§f0§d.§f0");
        self::$scoreboard[$pname]->setLine(5, "Money §5§l» §r§f0");
        self::$scoreboard[$pname]->setLine(6, "Jetons §5§l» §r§f0");
        self::$scoreboard[$pname]->setLine(7, "Rank §5§l» §r§fBronze II");
        self::$scoreboard[$pname]->setLine(8, "----------------");
        self::$scoreboard[$pname]->setLine(9, "§5§l» §r§fStats du §dServeur");
        self::$scoreboard[$pname]->setLine(10, "Joueur §5§l» §r§f{$allPlayer}§d/§f$maxPlayer");
        self::$scoreboard[$pname]->setLine(11, "      ");
        self::$scoreboard[$pname]->setLine(12, "§5§l» §r§faxardia.eu");
    }
}