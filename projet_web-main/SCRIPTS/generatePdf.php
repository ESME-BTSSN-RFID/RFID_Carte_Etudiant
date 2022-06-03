<?php 

require_once('Modele.php');
require_once('DotEnv.php');
require('../libs/fpdf.php');

(new DotEnv('/home/.env'))->load();
$DB_HOST = getenv('DB_HOST');
$DB_NAME = getenv('DB_NAME');
$DB_USER = getenv('DB_USER');
$DB_PASS = getenv('DB_PASS');


$debut = $_POST['debut'];
$fin = $_POST['fin'];
$classe = $_POST['classe'];
$label = $_POST['label'];


class PDF extends FPDF{

    function FancyTable($header, $data){
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(144, 150, 145);
        $this->SetTextColor(255);
        $this->SetDrawColor(144, 150, 145);
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B');
        //$this->SetFont('','B');
        // En-tête
        $w = array(40, 35, 45);
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224,235,255);
        $this->SetTextColor(0);
        //$this->SetFont('');
        // Données
        $fill = false;
        foreach($data as $row){

            $this->Cell($w[0],6,utf8_decode($row[0]),'LR',0,'L',$fill);
            $this->Cell($w[1],6,utf8_decode($row[1]),'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row[2],'LR',0,'C',$fill);
            $this->Ln();
            $fill = !$fill;
    }
    // Trait de terminaison
    $this->Cell(array_sum($w),0,'','T');
    }


    /*
    function Header(){
        // Police Arial gras 15
        $this->SetXY(0,0);
        $this->SetFont('Arial','B',10);
        // Titre encadré
        $this->Cell(30,10, $label.'_'.substr($debut, 0, 10)."_".substr($debut, -8, 2)."h_a_".substr($fin, -8, 2),0, 0,'C');
        // Saut de ligne
        $this->Ln(20);
    }*/
}


$data = array();
$cnx = Connexion($DB_HOST,$DB_NAME,$DB_USER,$DB_PASS);
$req_presence = "SELECT DISTINCT idCarteEtudiant FROM eleve e INNER JOIN scan s ON e.idCarteEtudiant=s.uid WHERE s.time BETWEEN '$debut' AND '$fin' AND e.idClass=$classe";
$req_eleve = "SELECT idCarteEtudiant, nom, prenom FROM eleve WHERE idClass=$classe";
$result_presence = requeteSelect($cnx, $req_presence);
$result_eleve = requeteSelect($cnx, $req_eleve);
$result_presence = $result_presence->fetchAll();
$result_eleve = $result_eleve->fetchAll();

//echo "presence: ".$req_presence."</br>";
//echo "eleve: ".$req_eleve."</br>";


foreach($result_eleve as $line){
    $flag = "";
    foreach($result_presence as $line2){
        if($line['idCarteEtudiant']==$line2['idCarteEtudiant']){
            $flag = 1;
            break;
        } 
    }

    if ($flag == "") {
        $data[] = array($line[1], $line[2], "Non");
    }
    else{
        $data[] = array($line[1], $line[2], "Oui");
    }
}

/*
foreach($data as $x){
    print_r($x);
    echo "</br>";
}*/ 





$header = array('Nom', 'Prenom', utf8_decode('Présent(e)'));
$pdf = new PDF();
$pdf->SetFont('Arial','',12);
$pdf->SetLeftMargin(45);
$pdf->SetTitle('Feuille de présence', true);
$pdf->AddPage();
$pdf->SetXY(130,5);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(70, 10, $label." - ".substr($debut, 0, 10)." de ".substr($debut, -8, 2).'h00 a '.substr($fin, -8, 2).'h00',0, 0,'C');
$pdf->SetXY(10,5);
$pdf->Cell(10, 10, utf8_decode("Feuille de presence"));
$pdf->Ln(20);
$pdf->FancyTable($header, $data);
$pdf->Output('I', $label."_".substr($debut, 0, 10)."_".substr($debut, -8, 2)."h_a_".substr($fin, -8, 2)."h.pdf",true);

?>  
 