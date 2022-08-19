<?php
require_once('/xampp/htdocs/argon/database/Connection.php');

$user = "";
$email = "";

$connection = Connection::connection();
$stmt = $connection->prepare("select * from tbUser");
$stmt->execute();

//contador
$totalUser = $connection->prepare("SELECT COUNT(id) as total from tbUser");
$totalUser->execute();
$total = $totalUser->fetchAll(PDO::FETCH_ASSOC);
$abc = $total[0]['total'];

while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
    $user .= $row['name'] . "<br />";
    $email .= $row['email'] . "<br />";
}

// include autoloader
require_once("/xampp/htdocs/argon/dompdf/autoload.inc.php");

//referenciar o DomPDF com namespace
use Dompdf\Dompdf;

//Criando a Instancia
$dompdf = new DOMPDF();

// Carrega seu HTML (Conteúdo)
$dompdf->load_html(
    "
    <div style='text-align: center; background-color: #1266F1; padding: 10px; border-radius: 10px; font-family: Arial, Helvetica, sans-serif;'>
		<h1 style='color: #ffffff;'>
        Relatório de Usuários
        </h1>
        <h3 style='color: #ffffff;'>Total $abc</h3>
        <table style='width: 100%; text-align: center; border-collapse: collapse;'>
            <tr>
              <th style='border: px solid white; color: #1266F1; padding: 10px; background-color: white;'>
                Nome
              </th>
              <th style='border: px solid white; color: #1266F1; padding: 10px; background-color: white;'>
                Email
              </th>
            </tr>
            <td style='border: 2px solid white; border-collapse: collapse; padding: 10px; color: #202020; background-color: #90b4ed;'>
                <h3 style='margin:10px 0';>$user</h3>
            </td>
            <td style='border: 2px solid white; border-collapse: collapse; padding: 10px; color: black; background-color: #90b4ed;'>
                <h3 style='margin:10px 0';>$email</h3>
            </td>
        </table>
    </div>
	"
);

$dompdf->setPaper('A4', 'portrait'); //landscape	

//Renderizar o html
$dompdf->render();

//Exibibir a página
$dompdf->stream(
    "usuario.pdf",
    array(
        "Attachment" => false //Para realizar o download somente alterar para true
    )
);
