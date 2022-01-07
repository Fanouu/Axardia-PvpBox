<?php

namespace PvpBox\Forms\Form;

use pocketmine\player\Player;

use PvpBox\Forms\FormAPI\SimpleForm;
use PvpBox\Forms\FormAPI\CustomForm;
use PvpBox\Constants\UserInterface;
use PvpBox\Constants\RankPerm;
use PvpBox\Core;
use PvpBox\Managers\RankManager;

class CommandForm{

    private static $setrankplayer = [];
    private $att = [];

    public function openWiki(Player $player){
        $form = self::createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $player->sendMessage("§5- §dEpée §5-");
                break;

                case 1:
                    $player->sendMessage("§5- §dArmure §5-");
                break;

                case 2:
                    $player->sendMessage("§5- §dTool §5-");
                break;

                case 3:
                    $player->sendMessage("§5- §dBlock §5-");
                break;

                case 4:
                    $player->sendMessage("§5- §dAutres §5-");
                break;
            }
            return true;

        });
        $form->setTitle(UserInterface::WIKITITLE);
        $form->setContent(UserInterface::WIKICONTENT);
        $form->addButton(UserInterface::WIKICATEGORY_SWORD);
        $form->addButton(UserInterface::WIKICATEGORY_ARMOR);
        $form->addButton(UserInterface::WIKICATEGORY_TOOL);
        $form->addButton(UserInterface::WIKICATEGORY_BLOCK);
        $form->addButton(UserInterface::WIKICATEGORY_MORE);
        $player->sendForm($form);
    }

    public function openSetRank(Player $player){
        $form = self::createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            $this->setRank($player, self::$setrankplayer[$data]);
            return true;

        });
        $form->setTitle(UserInterface::SETRANK_TITLE);
        $number = 0;
        foreach($player->getServer()->getOnlinePlayers() as $play => $players){
            $form->addButton($players->getName());
            self::$setrankplayer[$number] = $players->getName();
            $number++;
        }
        $player->sendForm($form);
    }

    public function setRank(Player $player, $ToPlayer){
        $this->ToPlayer = $ToPlayer;
        $form = self::createCustomForm(function (Player $player, array $data = null,){
            $result = $data;
            if($result === null){
                return true;
            }
            $player2 = $player->getServer()->getPlayerExact($this->ToPlayer);
            $rankAPI = new RankManager();

            $old_rank = $rankAPI->getRank($player2);
            $player->clearAttachment();
            $rankAPI->setRank($player2, RankPerm::rank[(int)$data[0]]);
            foreach(RankPerm::perms[RankPerm::rank[(int)$data[0]]] as $valu => $perms){
                $player2->addAttachment(Core::getInstance(), $perms, true);
            }
            return true;
        });
        $form->setTitle(UserInterface::SETRANK_TITLE);
        $form->addDropdown("Choisissez un rank a ajouté a §l§7{$ToPlayer}", ["§7Joueur", "§9Guide", "§aModérateur", "§dResponsable", "§bDéveloppeur", "§cAdministrateur"]);
        $form->sendToPlayer($player);
    }

    private function getAttachment(Player $player){
		if(!isset($this->att[$player->getId()])){
			return $this->att[$player->getId()] = $player->addAttachment(Core::getInstance());
		}
		return $this->att[$player->getId()];
	}
    public static function createSimpleForm(callable $function = null) : SimpleForm {
        return new SimpleForm($function);
    }

    public static function createCustomForm(callable $function = null) : CustomForm {
        return new CustomForm($function);
    }
}