<?php

require 'vendor/autoload.php';
$app = new \Slim\Slim();
$archivo = "employees.json";
$app->get('/empleadosxml/:salaryMin/:salaryMax', function ($salaryMin, $salaryMax) use ($app,$archivo) {
    try {
        $data = json_decode(file_get_contents($archivo), true);
        $empleados = '<empleados>';
        foreach ($data as $key => $value) {
            $valoresareemplazar = array("$", ",");
            $valorsalario = str_replace($valoresareemplazar, "", $value['salary']);

            if ($salaryMin <= $valorsalario && $salaryMax > $valorsalario) {
                $empleados.='<empleado>
		<id>' . $value['id'] . '</id>
		<isOnline>' . $value['isOnline'] . '</isOnline>
		<salary>' . $valorsalario . '</salary>
		<age>' . $value['salary'] . '</age>
		<position>' . $value['position'] . '</position>
		<name>' . $value['name'] . '</name>
		<gender>' . $value['gender'] . '</gender>
		<email>' . $value['email'] . '</email>
		<phone>' . $value['phone'] . '</phone>
		<address>' . $value['address'] . '</address>';
                foreach ($value['skills'] as $key2 => $value2) {
                    $empleados.='<skills><skill>' . $value2['skill'] . '</skill></skills>';
                }
                $empleados.='</empleado>';
            }
        }
        $empleados.='</empleados>';

        if ($empleados) {
            $app->response()->header('Content-Type', 'application/xml');
            echo $empleados;
        } else {
            $mensaje = array("Mensaje"=>"No existe data", "valor"=>"0");
			echo(json_encode($mensaje));
        }
    } catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    } 
});

$app->get('/empleados/:id', function ($id) use ($app,$archivo) {
    try {
        $data = json_decode(file_get_contents($archivo), true);
		$empleados='';
		$i=0;
		foreach ($data as $key => $value)
		{
			if ($value['id']==$id){
				$empleados=$data[$i];
			}
			$i++;
		}
        if ($empleados) {
            $app->response()->header('Content-Type', 'application/json');
            echo json_encode($empleados);
        } else {
			$mensaje = array("Mensaje"=>"No existe el empleado", "valor"=>"0");
			echo(json_encode($mensaje));
        }
    } catch (ResourceNotFoundException $e) {
        $app->response()->status(404);
    } 
});


$app->run();
