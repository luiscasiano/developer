<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>
        <div class="container bs-docs-container"> <div class="row"> <div class="col-md-9" role="main"> 
                    <?php
                    $url = "employees.json";
                    if (!empty($_GET['id'])) {
                        $url = 'http://localhost/developer/apirest.php/empleados/' . $_GET['id'];
                        $data = json_decode(file_get_contents($url), true);
                        $html = '<h1>Detalle de Empleado</h1>';
                        $html.= '<table class="table">';
                        $html.='<thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Position</th><th>Salary</th><th>Skills</th></tr></thead>';
                        $html.='<tbody>';
                        $html.='<tr>';
                        $html.='<td>' . $data['name'] . '</td>';
                        $html.='<td>' . $data['email'] . '</td>';
                        $html.='<td>' . $data['phone'] . '</td>';
                        $html.='<td>' . $data['address'] . '</td>';
                        $html.='<td>' . $data['position'] . '</td>';
                        $html.='<td>' . $data['salary'] . '</td>';
                        $html.='<td>';
                        foreach ($data['skills'] as $key => $value) {
                            $html.=$value['skill'] . '<br>';
                        }
                        $html.='</td>';
                        $html.='</tr>';
                        $html.='</tbody>';
                        $html.='</table>';
                    } else {

                        $data = json_decode(file_get_contents($url), true);
                        $html = '<h1>Listado de Empleados</h1>';
                        $html .= '<form action="" method="post">
								  <input type="text" id="email" name="email" value="" placeholder="Ingrese email a buscar" />
												  <input type="submit" value="Click para buscar" />
								 </form>';
                        $html.= '<table class="table">';
                        $html.='<thead><tr><th>Name</th><th>Email</th><th>Position</th><th>Salary</th><th>Detalle</th></tr></thead>';
                        $html.='<tbody>';

                        if (!empty($_POST['email'])) {
                            $i = 0;
                            foreach ($data as $key => $value) {
                                if ($value['email'] == $_POST['email']) {
                                    $html.='<tr>';
                                    $html.='<td>' . $value['name'] . '</td>';
                                    $html.='<td>' . $value['email'] . '</td>';
                                    $html.='<td>' . $value['position'] . '</td>';
                                    $html.='<td>' . $value['salary'] . '</td>';
                                    $html.='<td><a href="/developer?id=' . $value['id'] . '">Ver detalle</a></td>';
                                    $html.='</tr>';
                                }
                                $i++;
                            }
                        } else {
                            foreach ($data as $key => $value) {
                                $html.='<tr>';
                                $html.='<td>' . $value['name'] . '</td>';
                                $html.='<td>' . $value['email'] . '</td>';
                                $html.='<td>' . $value['position'] . '</td>';
                                $html.='<td>' . $value['salary'] . '</td>';
                                $html.='<td><a href="/developer?id=' . $value['id'] . '">Ver detalle</a></td>';
                                $html.='</tr>';
                            }
                        }
                        $html.='</tbody>';
                        $html.='</table>';
                    }
                    echo $html;
                    ?>
                    <a href="/developer"> Listado de Empleados</a>
                </div>
            </div>
        </div>
    </body>
</html>