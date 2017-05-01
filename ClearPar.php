<?php
class ClearPar {
    function build($CadenaIngreso) {
		$retorno="";
		$count = strlen ($CadenaIngreso);
		$i=0;
		while ($i < $count) {
			$valorPresente= substr($CadenaIngreso, $i, 1);
     		$valorPosterior=substr($CadenaIngreso, $i+1, 1);
			if (substr($CadenaIngreso, 0, 1)=='('){
				if ($valorPresente!=$valorPosterior){
					$retorno.=$valorPresente;
				}
			}
			$i=$i+1;
		}
	    echo $retorno;
    }
}
$foo = new ClearPar; 
$foo->build(')(');
?>
