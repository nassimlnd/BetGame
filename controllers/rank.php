<?php
//rank definition :
    function attributerank($ranknum){
        if(isset($ranknum)){
            switch($ranknum){

                case $ranknum <= 100:
                    $rankdesc = "iron";
                    return $rankdesc;
                    break;
                
                case $ranknum < 200 && $ranknum >= 100:
                    $rankdesc = "bronze";
                    return $rankdesc;
                    break;
     
                case $ranknum < 300 && $ranknum >= 200:
                    $rankdesc = "silver";
                    return $rankdesc;
                    break;
                
                case $ranknum < 400 && $ranknum >= 300:
                    $rankdesc = "gold";
                    return $rankdesc;
                    break;
    
                case $ranknum < 500 && $ranknum >= 400:
                    $rankdesc = "gold";
                    return $rankdesc;
                    break;
    
                case $ranknum < 600 && $ranknum >= 500:
                    $rankdesc = "platinium";
                    return $rankdesc;
                    break;
    
                case $ranknum < 700 && $ranknum >= 600:
                    $rankdesc = "diamond";
                    return $rankdesc;
                    break;
                
                case $ranknum < 800 && $ranknum >= 700:
                    $rankdesc = "platinium";
                    return $rankdesc;
                    break;
                
                case $ranknum < 1000 && $ranknum >= 800:
                    $rankdesc = "immortal";
                    return $rankdesc;
                    break;
    
                case $ranknum >= 1000 :
                    $rankdesc = "radiant";
                    return $rankdesc;
                    break;
            }

        } else {
            return " ";
        }
        
} 
?>