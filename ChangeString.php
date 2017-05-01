
<?php

class ChangeString {

    function build($cadenaIngreso) {
        $arrayCadenaIngreso = str_split($cadenaIngreso);
        $abecedario = "abcdefghijklmnñopqrstuvwxyz";
        $totalCaracteresAbecedario = strlen($abecedario);
        $retorno = "";
        foreach($arrayCadenaIngreso as & $letra) {
				$pos = strripos($abecedario, $letra);
            if ($pos ===  false) {
                $pos = $letra;
            } else {
                $pos = $pos + 1;
                if ($pos >= $totalCaracteresAbecedario) {
                    $pos = 0;
                }
                if (ctype_upper($letra)) {
                    $pos = strtoupper(substr($abecedario, $pos, 1));
                } else {
                    $pos = substr($abecedario, $pos, 1);
                }
            };
            $retorno.= $pos;
        }
        return $retorno;
    }
}

$foo = new ChangeString; 
print $foo->build("**Casa 52Z");


?>
