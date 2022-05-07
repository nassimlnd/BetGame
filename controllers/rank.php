<?php

function setRank($points)
{
    if (isset($points)) {
        switch ($points) {
            case $points <= 100:
                $rankdesc = "Iron";
                return $rankdesc;
                break;

            case $points < 200 && $points >= 100:
                $rankdesc = "Bronze";
                return $rankdesc;
                break;

            case $points < 300 && $points >= 200:
                $rankdesc = "Silver";
                return $rankdesc;
                break;

            case $points < 400 && $points >= 300:
                $rankdesc = "Gold";
                return $rankdesc;
                break;

            case $points < 600 && $points >= 500:
                $rankdesc = "Platinium";
                return $rankdesc;
                break;

            case $points < 700 && $points >= 600:
                $rankdesc = "Diamond";
                return $rankdesc;
                break;

            case $points < 1000 && $points >= 800:
                $rankdesc = "Immortal";
                return $rankdesc;
                break;

            case $points >= 1000:
                $rankdesc = "Professional";
                return $rankdesc;
                break;
        }
    }
}
