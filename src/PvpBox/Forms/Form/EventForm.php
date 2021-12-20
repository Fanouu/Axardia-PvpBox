<?php

namespace PvpBox\Forms\Form;

use pocketmine\player\Player;

use PvpBox\Forms\FormAPI\SimpleForm;
use PvpBox\Constants\UserInterface;

class EventForm{

    public function openFirstJoin(Player $player){
        $form = self::createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }

            return true;

        });
        $form->setTitle(UserInterface::FISRTJOINTITLE);
        $form->setContent(UserInterface::FIRSTJOINCONTENT);
        $form->addButton(UserInterface::FIRSTJOIN_PLAY);
        $player->sendForm($form);
    }

    public static function createSimpleForm(callable $function = null) : SimpleForm {
        return new SimpleForm($function);
    }
}