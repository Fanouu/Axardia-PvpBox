<?php

namespace PvpBox\Constants;

class RankPerm{

    public const rank = [ "Joueur", "Guide", "Modérateur", "Responsable", "Developpeur", "Admin" ];
    public const perms = [
        "Joueur" => ["player.axardia.perm"],
        "Guide" => ["levelOne.axardia.perm"],
        "Modérateur" => ["levelOne.axardia.perm", "levelTwo.axardia.perm"],
        "Responsable" => ["levelOne.axardia.perm", "levelTwo.axardia.perm", "levelTwo_extends.axardia.perm"],
        "Developpeur" => ["levelOne.axardia.perm", "levelTwo.axardia.perm", "levelTwo_extends.axardia.perm", "levelThree.axardia.perm"],
        "Admin" => ["levelOne.axardia.perm", "levelTwo.axardia.perm", "levelTwo_extends.axardia.perm", "levelThree.axardia.perm"]
    ];
}