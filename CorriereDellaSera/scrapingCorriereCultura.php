<?php

$categoria = "cultura";
$editore ="RCS MediaGroup";
$urlHome='https://www.corriere.it/';

$urlCorriere='https://www.corriere.it/'.$categoria. '';

$linkEditore = 'https://www.rcsmediagroup.it/';
echo($urlCorriere);


$html = file_get_contents($urlCorriere);
$dom = new DOMDocument();
@$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
//*[@id="l-main"]/div/section/div/div/div[2]/div/div/div/h4/a/text()
$hrefs = $xpath->evaluate("//div[@class='bck-media-news']/div[@class='media-news__content']//h4[@class='title-art-hp is-medium is-line-h-106']");
$hrefs1 = $xpath->evaluate("//div[@class='bck-media-news']/div[@class='media-news__content']//a[@class='has-text-black']//@href");
$hrefs2 = $xpath->evaluate("//div[@class='bck-media-news']/div[@class='media-news__content']//div[@class='media-content']//span[@class='author-art is-xsmall-it']");
for ($i=0;$i < $hrefs->length; $i++) {

    /** SCRAPING PRIMO ARTICOLO CHE è DIVERSO DA TUTTI GLI ALTRI  */
       //TITOLO
       $href1 = $hrefs->item($i);
       $titolo = $href1->nodeValue; 
    
      //Url articolo
    
       $href2 = $hrefs1->item($i);
       $urlArticolo = $href2->nodeValue; 
    
      // autore
      $href3 = $hrefs2->item($i);
      $urlAutore = $href3->nodeValue; 
        $urlAutoreTagliato = str_replace("di", "", $urlAutore);
    

        echo($titolo);
        echo($urlArticolo);

        $urlArticoloTagliato = str_replace("//", "", $urlArticolo);    
        if(empty($urlAutore)){
            $urlAutoreTagliato = "NULL";
        }else{
          $urlAutoreTagliato = str_replace("di", "", $urlAutore);
        }
        echo($urlAutoreTagliato);
       //Data
        $dataArt = strpos($urlArticoloTagliato, 'aprile');
        $dataArticolo = substr($urlArticoloTagliato, $dataArt,36);
        $mese = substr($dataArticolo, 0,6);
        $giorno = substr($dataArticolo, 7,2);
        $dataCompleta = $giorno." ".$mese." "."2020";
    
       echo("$dataCompleta <BR>");
    
       $contenuti[] = array(
        "nomeQuotidiano" => "Il Corriere della Sera",
        "linkHomePage" => "$urlHome",
        "titoloArticolo" => "$titolo",
        "linkArticolo" => "$urlArticoloTagliato",
        "autoreArticolo" => "$urlAutoreTagliato",
        "dataArticolo" => "$dataCompleta",
        "categoria" => "Politica",
        "editore" => "$editore",
        "linkEditore" => "$linkEditore"
    
       );
     creaDataset($contenuti);

    
       /**FINE SCRAPING PRIMO ARTICOLO */
    
    }    


    
function creaDataset($dati){

    $var = fopen("datasetCorriereCultura.json", "w+");
  
    $json = json_encode($dati);
    fwrite($var, $json);
  
  }
  
?>