<?php

namespace PvpBox\Items;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\math\Vector3;
use PvpBox\Constants\Messages;

class MageStick implements Listener{

    private static $coold = [];
    private static $coolds = 120;

    public function onInteract(PlayerInteractEvent $event){
        $player = $event->getPlayer();
        $pname = $player->getName();
        $Ids = $event->getItem()->getId();
        $meta = $event->getItem()->getDamage();
        $id = "$Ids:$meta";
        $actions = $event->getAction();
        if($actions === PlayerInteractEvent::RIGHT_CLICK_AIR || $actions === PlayerInteractEvent::RIGHT_CLICK_BLOCK || $actions === PlayerInteractEvent::LEFT_CLICK_BLOCK || $actions === PlayerInteractEvent::LEFT_CLICK_AIR){
        if($id === 1000){
            if(!isset(self::$coold[$pname]) || self::$coold[$pname] - time() <= 0){
                self::$coold[$pname] = time() + self::$coolds;
                $direction = $player->getDirectionVector();
                $player->setMotion(new Vector3($direction->getX(), $direction->getY() + 1, $direction->getZ()));
                $this->playSounds($player);
            }else{
                $timer = intval(self::$coold[$player->getName()] - time());
                $minutes = intval(abs($timer / 60));
                $secondes = intval(abs($timer  - $minutes * 60));
                if($minutes > 0){
                    $TempRestant = "{$minutes} minute(s)";
                } else {
                    $TempRestant = "{$secondes} second(s)";
                }
                $player->sendPopup(str_replace("{time}", $TempRestant, Messages::MAGESTICK));
            }
        }
      }
    }

    public function playSounds($player){
        $son = new PlaySoundPacket();
        $son->soundName = "tools.break.sound";
        $son->volume = 100;
        $son->pitch = 2;
        $son->x = $player->x;
        $son->y = $player->y;
        $son->z = $player->z;
        $player->getNetworkSession()->sendDataPacket($son);
    }
}