<?php

namespace PvpBox\Managers;

use pocketmine\network\mcpe\protocol\RemoveObjectivePacket;
use pocketmine\network\mcpe\protocol\SetDisplayObjectivePacket;
use pocketmine\network\mcpe\protocol\SetScorePacket;
use pocketmine\network\mcpe\protocol\types\ScorePacketEntry;

use pocketmine\player\Player;

class ScoreboardManager
{
    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var string $displayname
     */
    public $displayname = "";

    /**
     * @var array $datas
     */
    public $datas = [];

    /**
     * @var string|null
     */
    public $objectiveName = null;

    /**
     * ScoreboardManager constructor.
     * @param Player $player
     */
    public function __construct(Player $player) 
    {

        $this->player = $player;
        $this->objectiveName = "" . $player->getId() . "";
        $this->displayname = " ";

    }
    /**
     * @return Player
     */
    public function getPlayer() : Player 
    {

        return $this->player;

    }

    public function addScoreboard(string $displayName) {
        $pack = new SetDisplayObjectivePacket();
        $pack->displaySlot = "sidebar";
        $pack->objectiveName = $this->objectiveName;
        $pack->displayName = $displayName;
        $pack->criteriaName = "dummy";
        $pack->sortOrder = 0;
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pack);
    }

    public function setLine(int $line, string $message) {
        $entry = new ScorePacketEntry();
        $entry->scoreboardId = $line;
        $entry->objectiveName = $this->objectiveName;
        $entry->score = $line;
        $entry->type = $entry::TYPE_FAKE_PLAYER;
        $entry->customName = $message;
        $pack = new SetScorePacket();
        $pack->type = $pack::TYPE_CHANGE;
        $pack->entries[] = $entry;
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pack);
    }

    public function removeScoreboard() {
        $pack = new RemoveObjectivePacket();
        $pack->objectiveName = $this->objectiveName;
        $this->getPlayer()->getNetworkSession()->sendDataPacket($pack);
    }

}