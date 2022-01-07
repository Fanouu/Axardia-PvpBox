<?php

namespace PvpBox\Forms\Form;

use pocketmine\player\Player;

use PvpBox\Forms\FormAPI\SimpleForm;
use PvpBox\Forms\FormAPI\CustomForm;
use PvpBox\Constants\UserInterface;
use PvpBox\Constants\RankPerm;
use PvpBox\Core;
use PvpBox\Managers\RankManager;

class BlockForm{

    public static function createSimpleForm(callable $function = null) : SimpleForm {
        return new SimpleForm($function);
    }

    public static function createCustomForm(callable $function = null) : CustomForm {
        return new CustomForm($function);
    }
}