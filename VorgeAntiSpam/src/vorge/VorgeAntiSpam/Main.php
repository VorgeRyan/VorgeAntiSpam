<?php

namespace vorge\VorgeAntiSpam;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;

class AntiSpam implements Listener {

    private $antispam;
    public function onChat(PlayerChatEvent $event){
        $player=$event->getPlayer();
        $cooldown = 2;
        if(!isset($this->antispam[strtolower($player->getName())])){
            $this->antispam[strtolower($player->getName())]=time();
            }else{
                if(!$player->isOp() && time() - $this->antispam[strtolower($player->getName())] < $cooldown){
                    $event->setCancelled(true);
                    $time=time() - $this->antispam[strtolower($player->getName())];
                    $cd = $cooldown - $time;
                    $player->sendMessage("§6Please stop spaming this may result in a mute or a ban!");
                    }else{
                        $this->antispam[strtolower($player->getName())] = time();
            }
        }
    }
}