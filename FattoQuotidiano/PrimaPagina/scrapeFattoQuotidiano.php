<?php

$contenuti = array();
$nomeQuotidiano="Il Fatto Quotidiano";
$linkHomePage ="https://www.ilfattoquotidiano.it/";
$editore = "Editoriale Il Fatto SPA";
$linkEditore="https://www.seif-spa.it/";

    $html = file_get_contents("https://www.ilfattoquotidiano.it/cronaca");
    $categoria= "Cronaca";


    //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content cronaca     ']
    /div[@class='text-wrapper']/h3/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content cronaca     ']
    /div[@class='text-wrapper']/h3/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content cronaca     ']
    /div[@class='wrapper-info-article']/cite/a");

    $i=0;
    
    echo "<h2> $homeCronacaTitoli->length </h2> <p>";


    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);
           
        $titolo=str_replace("Ã¨","è",$titolo);
        $titolo=str_replace("Ã","à",$titolo);
        $titolo=str_replace("à¬","ì",$titolo);
        $titolo=str_replace("à¹","ù",$titolo);

        $autori= $homeCronacaAutori->item($i);
        $autoreRaw = $autori->nodeValue;
        $autore=trim(substr($autoreRaw,3));

        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='date']");
        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim(substr($data,2));

        echo "<h9 style=\"color:red\"><b> Cronaca </b></h9> <p>";
        echo "<h2> $titolo </h2> <p>";
        echo "<h6 style=\"color:green\"> $autore</h6> <p>";
        echo "<h6 style=\"color:red\"> $data </h6> <p>";
        echo "<h6 style=\"color:blue\"> $link </h6> <p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );

        $i++;
    }

    // FINE CRONACA

    //INIZIO POLITICA

    $html = file_get_contents("https://www.ilfattoquotidiano.it/politica-palazzo/");
    $categoria= "Politica";


   //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content politica-palazzo     ']
    /div[@class='text-wrapper']/h3/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content politica-palazzo     ']
    /div[@class='text-wrapper']/h3/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content politica-palazzo     ']
    /div[@class='wrapper-info-article']/cite/a");

    $i=0;
    
    echo "<h2> $homeCronacaTitoli->length </h2> <p>";


    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);

         
        $titolo=str_replace("Ã¨","è",$titolo);
        $titolo=str_replace("Ã","à",$titolo);
        $titolo=str_replace("à¬","ì",$titolo);
        $titolo=str_replace("à¹","ù",$titolo);

        $autori= $homeCronacaAutori->item($i);
        $autoreRaw = $autori->nodeValue;
        $autore=trim(substr($autoreRaw,3));

        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='date']");

        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim(substr($data,2));


        echo "<h2> $titolo </h2> <p>";
        echo "<h6 style=\"color:green\"> $autore</h6> <p>";
        echo "<h6 style=\"color:red\"> $data </h6> <p>";

        echo "<h6 style=\"color:blue\"> $link </h6> <p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );
        

        $i++;
    }

    // FINE SEZIONE POLITICA
    // INIZIO SEZIONE ECONOMIA

    $html = file_get_contents("https://www.ilfattoquotidiano.it/economia-lobby/");
    $categoria= "Economia";


   //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content economia-lobby     ']
    /div[@class='text-wrapper']/h3/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content economia-lobby     ']
    /div[@class='text-wrapper']/h3/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content economia-lobby     ']
    /div[@class='wrapper-info-article']/cite/a");

    $i=0;
    
    echo "<h2> $homeCronacaTitoli->length </h2> <p>";


    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);

         
        $titolo=str_replace("Ã¨","è",$titolo);
        $titolo=str_replace("Ã","à",$titolo);
        $titolo=str_replace("à¬","ì",$titolo);
        $titolo=str_replace("à¹","ù",$titolo);

        $autori= $homeCronacaAutori->item($i);
        $autoreRaw = $autori->nodeValue;
        $autore=trim(substr($autoreRaw,3));

        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='date']");

        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim(substr($data,2));


        echo "<h2> $titolo </h2> <p>";
        echo "<h6 style=\"color:green\"> $autore</h6> <p>";
        echo "<h6 style=\"color:red\"> $data </h6> <p>";

        echo "<h6 style=\"color:blue\"> $link </h6> <p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );
        

        $i++;
    }

    //FINE SEZIONE ECONOMIA
    //INIZIO SEZIONE SPORT

    $html = file_get_contents("https://www.ilfattoquotidiano.it/sport-miliardi/");
    $categoria= "Sport";


   //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content calcio     ']
    /div[@class='text-wrapper']/h3/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content calcio     ']
    /div[@class='text-wrapper']/h3/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content calcio     ']
    /div[@class='wrapper-info-article']/cite/a");

    $i=0;
    
    echo "<h2> $homeCronacaTitoli->length </h2> <p>";


    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);

         
        $titolo=str_replace("Ã¨","è",$titolo);
        $titolo=str_replace("Ã","à",$titolo);
        $titolo=str_replace("à¬","ì",$titolo);
        $titolo=str_replace("à¹","ù",$titolo);

        $autori= $homeCronacaAutori->item($i);
        $autoreRaw = $autori->nodeValue;
        $autore=trim(substr($autoreRaw,3));

        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='date']");

        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim(substr($data,2));


        echo "<h2> $titolo </h2> <p>";
        echo "<h6 style=\"color:green\"> $autore</h6> <p>";
        echo "<h6 style=\"color:red\"> $data </h6> <p>";

        echo "<h6 style=\"color:blue\"> $link </h6> <p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );
        

        $i++;
    }

    //FINE SEZIONE SPORT
    //INIZIO SEZIONE CULTURA

    $html = file_get_contents("https://www.ilfattoquotidiano.it/scienza/");
    $categoria= "Cultura";


   //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content scienza     ']
    /div[@class='text-wrapper']/h3/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content scienza     ']
    /div[@class='text-wrapper']/h3/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='right-column']/div[@class='rullo-categoria-main default-block-color-rullo']/div[@class='rullo-item single-item-medium-image rullo-orizzontale-content strillo-content scienza     ']
    /div[@class='wrapper-info-article']/cite/a");

    $i=0;
    
    echo "<h2> $homeCronacaTitoli->length </h2> <p>";


    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);

         
        $titolo=str_replace("Ã¨","è",$titolo);
        $titolo=str_replace("Ã","à",$titolo);
        $titolo=str_replace("à¬","ì",$titolo);
        $titolo=str_replace("à¹","ù",$titolo);

        $autori= $homeCronacaAutori->item($i);
        $autoreRaw = $autori->nodeValue;
        $autore=trim(substr($autoreRaw,3));

        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='date']");

        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim(substr($data,2));


        echo "<h2> $titolo </h2> <p>";
        echo "<h6 style=\"color:green\"> $autore</h6> <p>";
        echo "<h6 style=\"color:red\"> $data </h6> <p>";

        echo "<h6 style=\"color:blue\"> $link </h6> <p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );
        

        $i++;
    }


    $fp = fopen('resultScrapeFatto.json', 'w+');
    fwrite($fp, json_encode($contenuti));
    fclose($fp);
?>