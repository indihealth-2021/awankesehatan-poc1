<?php
 
function noxss($x){
    echo htmlentities($x, ENT_QUOTES, 'UTF-8');
}