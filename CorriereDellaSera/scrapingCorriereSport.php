<?php

$categoria = "sport";
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
$hrefs = $xpath->evaluate("//div[@class='bck-media-news']/div[@class='media-news__content']//div[@class='media-content']//a/text()");
$hrefs1 = $xpath->evaluate("//div[@class='bck-media-news']/div[@class='media-news__content']//div[@class='media-content']//@href");
$hrefs2 = $xpath->evaluate("//div[@class='bck-media-news']/div[@class='media-news__content']//div[@class='media-content']//span");

/*
<h4 class="title-art is-xsmall is-line-h-11"><a class="has-text-black" href="https://www.corriere.it/sport/20_aprile_28/calcio-serie-a-fase-2-non-decolla-ecco-tutti-ostacoli-ripartenza-post-coronavirus-a46a6c60-88c3-11ea-96e3-c7b28bb4a705.shtml">Perché la Fase 2 non decolla: ecco gli ostacoli. Spadafora: «Un complotto? Ridicolo» </a></h4>
<div class="bck-media-news">
<div class="media-news__content">
<h4 class="title-art is-medium"><a class="has-text-black" href="https://www.corriere.it/sport/20_aprile_28/tennis-kirsten-flipkens-sconfina-pedalando-arresto-poi-multa-essere-entrata-olanda-daa90ba2-896c-11ea-8073-abbb9eae2ee6.shtml"> Tennis, Flipkens sconfina pedalando: arresto (e multa) per essere entrata in Olanda</a></h4>
<span class="author-art is-mr-t-12">di Marco Calabresi </span>
</div>
<div class="media-news__image is-hero">
<figure class="image is-6by3"><a href="https://www.corriere.it/sport/20_aprile_28/tennis-kirsten-flipkens-sconfina-pedalando-arresto-poi-multa-essere-entrata-olanda-daa90ba2-896c-11ea-8073-abbb9eae2ee6.shtml"><div class="shadowBkgPhoto"><img class="lazy loaded" src="https://images2.corriereobjects.it/methode_image/2020/04/28/Sport/Foto%20Sport%20-%20Trattate/afp_1ot4f9-kht-u318013349977717ge-656x492corriere-web-sezioni_414x232_M.jpg?v=202004281835" data-src="https://images2.corriereobjects.it/methode_image/2020/04/28/Sport/Foto%20Sport%20-%20Trattate/afp_1ot4f9-kht-u318013349977717ge-656x492corriere-web-sezioni_414x232_M.jpg?v=202004281835" data-was-processed="true"></div></a></figure>
</div>
<div class="media-news__footer is-paddingless">
<ul class="related-art">
</ul>
</div>
</div>
<h4 class="title-art is-xsmall is-line-h-11"><a class="has-text-black" href="https://www.corriere.it/sport/20_aprile_28/calcio-serie-a-fase-2-non-decolla-ecco-tutti-ostacoli-ripartenza-post-coronavirus-a46a6c60-88c3-11ea-96e3-c7b28bb4a705.shtml">Perché la Fase 2 non decolla: ecco gli ostacoli. Spadafora: «Un complotto? Ridicolo» </a></h4>
*/
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
        $urlArticoloTagliato = str_replace("//", "", $urlArticolo);
        echo(" $urlArticoloTagliato");
        echo($urlAutoreTagliato);
    
    
       //Data
        $dataArt = strpos($urlArticoloTagliato, 'aprile');
        $dataArticolo = substr($urlArticoloTagliato, $dataArt,36);
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
        "categoria" => "Sport",
        "editore" => "$editore",
        "linkEditore" => "$linkEditore"
    
     ];
     creaDataset($player);

    
       /**FINE SCRAPING PRIMO ARTICOLO */
    
    }    


    
function creaDataset($dati){

    $var = fopen("datasetCorriere.json", "a");
  
    $json = json_encode($dati);
    fwrite($var, $json);
  
  }
  
?>