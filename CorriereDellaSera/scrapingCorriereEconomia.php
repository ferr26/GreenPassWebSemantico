<?php

$categoria = "economia";
$editore ="RCS MediaGroup";
$variabileSupp = 0;
$urlHome='https://www.corriere.it/';

$urlCorriere='https://www.corriere.it/'.$categoria. '';

$linkEditore = 'https://www.rcsmediagroup.it/';
echo($urlCorriere);

$html = file_get_contents($urlCorriere);
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("//div[@class='bck-single-art single-art__large']//h1[@class='title is--large']");
$hrefs1 = $xpath->evaluate("//div[@class='bck-single-art single-art__large']//h1[@class='title is--large']/a/@href");
$hrefs2 = $xpath->evaluate("//div[@class='bck-single-art single-art__large']//p[@class='signature']");
$hrefs3 = $xpath->evaluate("//article[@class='bck-media-list is--paddingless-left']//h2[@class='title is--medium-2']");
$hrefs4 = $xpath->evaluate("//article[@class='bck-media-list is--paddingless-left']//h2[@class='title is--medium-2']/a/@href");
$hrefs5 = $xpath->evaluate("//article[@class='bck-media-list is--paddingless-left']//p[@class='signature has--pd-top']");
$hrefs6= $xpath->evaluate("//div[@class='bck-single-art single-art__small']//h2[@class='title is--medium']");
$hrefs7= $xpath->evaluate("//div[@class='bck-single-art single-art__small']//h2[@class='title is--medium']/a/@href");
$hrefs8= $xpath->evaluate("//div[@class='bck-single-art single-art__small']//p[@class='signature']");
$hrefs9= $xpath->evaluate("//div[@class='bck-single-art single-art__small single-art__box']//h2[@class='title is-4 is--small']");
$hrefs10= $xpath->evaluate("//div[@class='bck-single-art single-art__small single-art__box']//h2[@class='title is-4 is--small']/a/@href");
$hrefs11= $xpath->evaluate("//div[@class='bck-single-art single-art__small single-art__box']//p[@class='signature is--small']");

for ($i=0;$i < $hrefs->length; $i++) {

/** SCRAPING PRIMO ARTICOLO CHE è DIVERSO DA TUTTI GLI ALTRI  */
   //TITOLO
   $href1 = $hrefs->item($i);
   $titolo = $href1->nodeValue; 

  //Url articolo

   $href2 = $hrefs1->item($i);
   $urlArticolo = $href2->nodeValue; 

  //Url autore
  $href3 = $hrefs2->item($i);
  $urlAutore = $href3->nodeValue; 
   $urlAutoreTagliato = str_replace("di", "", $urlAutore);


    echo($titolo);
    $urlArticoloTagliato = str_replace("//", "", $urlArticolo);
    echo(" $urlArticoloTagliato <br>");
    echo($urlAutoreTagliato);


   //Data
    $dataArt = strpos($urlArticoloTagliato, 'aprile');
    $dataArticolo = substr($urlArticoloTagliato, 36,36);
    $mese = substr($dataArticolo, 0,6);
    $giorno = substr($dataArticolo, 7,2);
    $dataCompleta = $giorno." ".$mese." "."2020";

   echo("$dataCompleta <BR>");

   $player = [
    "nomeQuotidiano" => "Il Corriere della Sera",
    "linkHomePage" => "$urlHome",
    "titoloArticolo" => "$titolo",
    "linkArticolo" => "$urlArticoloTagliato",
    "autoreArticolo" => "$urlAutoreTagliato",
    "dataArticolo" => "$dataCompleta",
    "categoria" => "Economia",
    "editore" => "$editore",
    "linkEditore" => "$linkEditore"

 ];

    creaDataset($player);

   /**FINE SCRAPING PRIMO ARTICOLO */


   /**INIZIO SCRAPING SECONDO ARTICOLO
    */
  //TITOLO 2 ARTICOLO
  $href4 = $hrefs3->item($i);
  $titolo2 = $href4->nodeValue; 

  echo($titolo2);

    //URL 2 ARTICOLO
    $href5 = $hrefs4->item($i);
    $urlArticolo2 = $href5->nodeValue; 

    echo(" $urlArticolo2");

   //AUTORE 2 ARTICOLO
   $href6 = $hrefs5->item($i);
   $autore2 = $href6->nodeValue; 

   echo(" $autore2");
    //Data 2 articoòlo
    $urlArticoloTagliato2 = str_replace("//", "", $urlArticolo2);

    $dataArt2 = strpos($urlArticoloTagliato2, 'aprile');
    $dataArticolo2 = substr($urlArticoloTagliato2, 36,36);
    $mese2 = substr($dataArticolo2, 0,6);
    $giorno2 = substr($dataArticolo2, 7,2);
    $dataCompleta2 = $giorno2." ".$mese2." "."2020";

    echo("$dataCompleta2 <BR>");

    $player = [
      "nomeQuotidiano" => "Il Corriere della Sera",
      "linkHomePage" => "$urlHome",
      "titoloArticolo" => "$titolo2",
      "linkArticolo" => "$urlArticoloTagliato2",
      "autoreArticolo" => "$autore2",
      "dataArticolo" => "$dataCompleta2",
      "categoria" => "Economia",
      "editore" => "$editore",
      "linkEditore" => "$linkEditore"

   ];
  
    creaDataset($player);
   /** */

   for ($k=0;$k < $hrefs6->length; $k++) {

   /**Scraping altri articoli */
   //titolo generico
   $href7 = $hrefs6->item($k);
   $titoloGenerico = $href7->nodeValue; 

   echo($titoloGenerico);

   //URL generico
   $href8 = $hrefs7->item($k);
   $urlArticoloGenerico = $href8->nodeValue; 

   echo(" $urlArticoloGenerico");

   //AUTORE Generico
   $href9 = $hrefs8->item($k);
   $autoreGenerico = $href9->nodeValue; 
   $urlAutoreGenericoTagliato = str_replace("di", "", $autoreGenerico);

   echo(" $urlAutoreGenericoTagliato");

    //Data articolo generico
    $urlArticoloGenerico2 = str_replace("//", "", $urlArticoloGenerico);

    $dataArtGenerica = strpos($urlArticoloGenerico2, 'aprile');
    $dataArticoloGene = substr($urlArticoloGenerico2, $dataArtGenerica,$dataArtGenerica);
    $meseGenerico = substr($dataArticoloGene, 0,6);
    $giornoGenerico = substr($dataArticoloGene, 7,2);
    $dataCompletaGenerica = $giornoGenerico." ".$meseGenerico." "."2020";

    echo("$dataCompletaGenerica <BR>");

    $player = [
      "nomeQuotidiano" => "Il Corriere della Sera",
      "linkHomePage" => "$urlHome",
      "titoloArticolo" => "$titoloGenerico",
      "linkArticolo" => "$urlArticoloGenerico",
      "autoreArticolo" => "$urlAutoreGenericoTagliato",
      "dataArticolo" => "$dataCompletaGenerica",
      "categoria" => "Economia",
      "editore" => "$editore",
      "linkEditore" => "$linkEditore"

   ];
  
      creaDataset($player);
   /** */
   }

   for ($j=0;$j < $hrefs9->length; $j++) {
    /** Scraping articoli in tab */
  //titolo generico
   $href10 = $hrefs9->item($j);
   $titoloGenerico1 = $href10->nodeValue; 

   echo($titoloGenerico1);

   //URL generico
   $href11 = $hrefs10->item($j);
   $urlArticoloGenerico1 = $href11->nodeValue; 

   echo(" $urlArticoloGenerico1");

   //AUTORE Generico
   $href12 = $hrefs11->item($j);
   $autoreGenerico1 = $href12->nodeValue; 
   $urlAutoreGenericoTagliato1 = str_replace("di", "", $autoreGenerico1);

   echo(" $urlAutoreGenericoTagliato1");

    //Data articolo generico
    $urlArticoloGenerico3 = str_replace("//", "", $urlArticoloGenerico1);

    $dataArtGenerica2 = strpos($urlArticoloGenerico3, 'aprile');
    $dataArticoloGene2 = substr($urlArticoloGenerico3, $dataArtGenerica2,$dataArtGenerica2);
    $meseGenerico2 = substr($dataArticoloGene2, 0,6);
    $giornoGenerico2 = substr($dataArticoloGene2, 7,2);
    $dataCompletaGenerica2 = $giornoGenerico2." ".$meseGenerico2." "."2020";

    echo("$dataCompletaGenerica2 <BR>");

    $player1 = [
      "nomeQuotidiano" => "Il Corriere della Sera",
      "linkHomePage" => "$urlHome",
      "titoloArticolo" => "$titoloGenerico1",
      "linkArticolo" => "$urlArticoloGenerico3",
      "autoreArticolo" => "$urlAutoreGenericoTagliato1",
      "dataArticolo" => "$dataCompletaGenerica2",
      "categoria" => "Economia",
      "editore" => "$editore",
      "linkEditore" => "$linkEditore"

   ];
  
      creaDataset($player);
    /**FIne */
   
   }
}       


function creaDataset($dati){

  $var = fopen("datasetCorriere.json", "a");

  $json = json_encode($dati);
  fwrite($var, $json);

}

?> 
