<?php

class CompleteRange {

    function build($arrayCadenaIngreso) {
	$retorno="";
		$count = count ($arrayCadenaIngreso)-1;
		$ultimovalorarray=$arrayCadenaIngreso[$count];
		$i=0;
		while ($i < $count) {
			$valorPresente=$arrayCadenaIngreso[$i];
			echo '<span style="color:#0000ff">'.$valorPresente.'</span>';
			$m=$i+1;
			$valorPosterior=$arrayCadenaIngreso[$m];
			$valorPresenteMasUno=$arrayCadenaIngreso[$i]+1;
			if ($valorPresenteMasUno!=$valorPosterior){
				$f=$valorPresenteMasUno;
				while ($f < $valorPosterior) {
					echo '<span style="color:#ff0000">'.$f.'</span>';
					$f++;
				}
			}
			$i++;
		}
	    echo '<span style="color:#0000ff">'.$ultimovalorarray.'</span>';
    }
}

$foo = new CompleteRange; 
$foo->build([1,4,6,7,9,12,15]);


?>
