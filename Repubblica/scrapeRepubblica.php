<?php

$contenuti = array();
$nomeQuotidiano="LaRepubblica";
$linkHomePage ="https://www.repubblica.it/";
$editore = "G.E.D.I";
$linkEditore="http://www.gedispa.it/it/nc.html";

    $html = file_get_contents("https://www.repubblica.it/cronaca/");
    $categoria= "Cronaca";


    //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//article[@class='entry sequence-8 media-4']/div[@class='entry-content']/h2");
    $homeCronacaAutori= $xpath->evaluate("//article[@class='entry sequence-8 media-4']/div[@class='entry-content']/em");
    $homeCronacaLink= $xpath->evaluate("//article[@class='entry sequence-8 media-4']/div[@class='entry-content']/h2/a/@href");


    $homeCronaca3= $xpath->evaluate("//article/div[@class='widget-box_content']/h5/a");

    /*
    $i=0;    
    echo "<h5> $homeCronaca2->length</h5> <p>";

    while($i<$homeCronaca2->length){
        $articoli= $homeCronaca2->item($i);
        $articolo = $articoli->nodeValue;
        echo "<h1> $articolo </h1> <p>";
        $i++;
    }

   */
    $i=0;
    echo "<h5> $homeCronacaTitoli->length</h5> <p>";

    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);


        if($homeCronacaAutori->item($i)){
            $autori= $homeCronacaAutori->item($i);
            $autoreRaw = $autori->nodeValue;
            $autore=trim(substr($autoreRaw,3));
        }
        else {
            $autore="NULL";
        }


        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        $homeSingoloArticolo =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;

        echo "<h9 style=\"color:red\"><b> Cronaca </b></h9> <p>";
        echo "<h2> $titolo </h2> <p>";
        echo "<h7 style=\"color:red\"> $autore </h7> <p>";
        echo "<h7 style=\"color:blue\"><u> $link </u></h7> <p>";
        echo "<h7 style=\"color:green\"> $data </h7> <p>";
        echo"<h4> -------------------------------------------------------------------------------------------------- </h4>";
        echo "<p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );

        $i++;
    }


    // FINE SEZIONE CRONACA
    // INIZIO SEZIONE POLITICA

    for ($pag=2;$pag<10;$pag++){
    $html = file_get_contents("https://www.repubblica.it/politica/$pag");

    $categoria= "Politica";

     //parse the html into a DOMDocument
     $dom = new DOMDocument();
     @$dom->loadHTML($html);
     $xpath = new DOMXPath($dom);
     $homeLink= $xpath->evaluate("//li/article/div/h2/a/@href");
     /*
     $i=0;    
     echo "<h5> $homeCronaca2->length</h5> <p>";
 
     while($i<$homeCronaca2->length){
         $articoli= $homeCronaca2->item($i);
         $articolo = $articoli->nodeValue;
         echo "<h1> $articolo </h1> <p>";
         $i++;
     }
 
    */
     $i=0;
     echo "<h5> $homeLink->length</h5> <p>";
 
     while($i<$homeLink->length){
         $links= $homeLink->item($i);
         $link = $links->nodeValue;
 
         $paginaArticolo = file_get_contents($link);
         $dom = new DOMDocument();
         @$dom->loadHTML($paginaArticolo);
         $xpath = new DOMXPath($dom);
 
         //echo "<h5> $paginaArticolo</h5> <p>";
 
        
         $homeTitoli =$xpath->evaluate("//article/header/h1");
         $homeAutori =$xpath->evaluate("//span[@itemprop='name']");
         $homeDate =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
 
         if ($titoli= $homeTitoli->item(0)){
         $titolo = $titoli->nodeValue;
         $titolo=trim($titolo);
         
        
         if($homeAutori->length > 0){
             $autori= $homeAutori->item(0);
             $autoreRaw = $autori->nodeValue;
             $autore=trim(substr($autoreRaw,3));
         }
         else {
             $autore="NULL";
         }
 
         $date= $homeDate->item(0);
         $data = $date->nodeValue;
 
           //$homeAutore =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
         //$homeData =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
         echo "<h3 style=\"color:green\"> Politica</h3> <p>";
         echo "<h7 style=\"color:red\"> $titolo </h7> <p>";
         echo "<h5> $autore</h5> <p>";
         echo "<h7 style=\"color:green\"> $data</h7> <p>";
         echo "<h7 style=\"color:\"> $link</h7> <p>";
 
         echo"<h4> -------------------------------------------------------------------------------------------------- </h4>";
 
         $contenuti[] = array(
                                 'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                                 'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                                 'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore, 'linkEditore'=> $linkEditore
          );
         }
       
       
 
 
         $i++;
     }
 


    

   

} // fine for

    //FINE SEZIONE POLITICA
    //INIZIO SEZIONE ECONOMIA


    $html = file_get_contents("https://www.repubblica.it/economia/");
    $categoria= "Economia";


   //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//article[@class='entry gs-morebuttons-container sequence-8 media-4']/div[@class='entry-content']/h2");
    $homeCronacaAutori= $xpath->evaluate("//article[@class='entry gs-morebuttons-container sequence-8 media-4']/div[@class='entry-content']/em");
    $homeCronacaLink= $xpath->evaluate("//article[@class='entry gs-morebuttons-container sequence-8 media-4']/div[@class='entry-content']/h2/a/@href");


    $homeCronaca3= $xpath->evaluate("//article/div[@class='widget-box_content']/h5/a");

    /*
    $i=0;    
    echo "<h5> $homeCronaca2->length</h5> <p>";

    while($i<$homeCronaca2->length){
        $articoli= $homeCronaca2->item($i);
        $articolo = $articoli->nodeValue;
        echo "<h1> $articolo </h1> <p>";
        $i++;
    }

   */
    $i=0;
    echo "<h5> $homeCronacaTitoli->length</h5> <p>";

    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);


    

        if($homeCronacaAutori->item($i)){
            $autori= $homeCronacaAutori->item($i);
            $autoreRaw = $autori->nodeValue;
            $autore=trim(substr($autoreRaw,3));
        }
        else {
            $autore="NULL";
        }


        $links= $homeCronacaLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        //echo "<h5> $paginaArticolo</h5> <p>";
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);
       
        $homeSingoloArticolo =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;

        echo "<h9 style=\"color:red\"><b> Economia </b></h9> <p>";
        echo "<h2> $titolo </h2> <p>";
        echo "<h7 style=\"color:red\"> $autore </h7> <p>";
        echo "<h7 style=\"color:blue\"><u> $link </u></h7> <p>";
        echo "<h7 style=\"color:green\"> $data </h7> <p>";
        echo"<h4> -------------------------------------------------------------------------------------------------- </h4>";
        echo "<p>";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore, 'linkEditore'=> $linkEditore
        );

        $i++;
    }


    // FINE SEZIONE SPORT
    //INIZIO SEZIONE CULTURA

    for ($pag=2;$pag<10;$pag++){
    $html = file_get_contents("https://www.repubblica.it/robinson/$pag");
    $categoria= "Cultura";

    
   
    // echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeLink= $xpath->evaluate("//li/article/div/h2/a/@href");
    /*
    $i=0;    
    echo "<h5> $homeCronaca2->length</h5> <p>";

    while($i<$homeCronaca2->length){
        $articoli= $homeCronaca2->item($i);
        $articolo = $articoli->nodeValue;
        echo "<h1> $articolo </h1> <p>";
        $i++;
    }

   */
    $i=0;
    echo "<h5> $homeLink->length</h5> <p>";

    while($i<$homeLink->length){
        $links= $homeLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);

        //echo "<h5> $paginaArticolo</h5> <p>";

       
        $homeTitoli =$xpath->evaluate("//article/header/h1");
        $homeAutori =$xpath->evaluate("//span[@itemprop='name']");
        $homeDate =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");

        if ($titoli= $homeTitoli->item(0)){
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);
        
       
        if($homeAutori->length > 0){
            $autori= $homeAutori->item(0);
            $autoreRaw = $autori->nodeValue;
            $autore=trim(substr($autoreRaw,3));
        }
        else {
            $autore="NULL";
        }

        $date= $homeDate->item(0);
        $data = $date->nodeValue;

          //$homeAutore =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
        //$homeData =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
        echo "<h7 style=\"color:red\"> $titolo </h7> <p>";
        echo "<h5> $autore</h5> <p>";
        echo "<h7 style=\"color:green\"> $data</h7> <p>";
        echo "<h7 style=\"color:\"> $link</h7> <p>";

        echo"<h4> -------------------------------------------------------------------------------------------------- </h4>";

        $contenuti[] = array(
                                'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                                'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                                'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore, 'linkEditore'=> $linkEditore
         );
        }
      
      


        $i++;
    }

    }

     // FINE SEZIONE CULTURA
    //INIZIO SEZIONE SPORT

    
for ($pag=2;$pag<10;$pag++){
    $html = file_get_contents("https://www.repubblica.it/sport/calcio/serie-a/2/");
    $categoria= "Sport";

    
   
    // echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeLink= $xpath->evaluate("//article/div/a/@href");
    /*
    $i=0;    
    echo "<h5> $homeCronaca2->length</h5> <p>";

    while($i<$homeCronaca2->length){
        $articoli= $homeCronaca2->item($i);
        $articolo = $articoli->nodeValue;
        echo "<h1> $articolo </h1> <p>";
        $i++;
    }

   */
    $i=0;
    echo "<h5> $homeLink->length</h5> <p>";

    while($i<$homeLink->length){
        $links= $homeLink->item($i);
        $link = $links->nodeValue;

        $paginaArticolo = file_get_contents($link);
        $dom = new DOMDocument();
        @$dom->loadHTML($paginaArticolo);
        $xpath = new DOMXPath($dom);

        //echo "<h5> $paginaArticolo</h5> <p>";

       
        $homeTitoli =$xpath->evaluate("//article/header/h1");
        $homeAutori =$xpath->evaluate("//span[@itemprop='name']");
        $homeDate =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");

        if ($titoli= $homeTitoli->item(0)){
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);
        
       
        if($homeAutori->length > 0){
            $autori= $homeAutori->item(0);
            $autoreRaw = $autori->nodeValue;
            $autore=trim(substr($autoreRaw,3));
        }
        else {
            $autore="NULL";
        }

        $date= $homeDate->item(0);
        $data = $date->nodeValue;

          //$homeAutore =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
        //$homeData =$xpath->evaluate("//article/div[@class='main-content']/div[@class='toolbar']/time");
        echo "<h3> $categoria </h3>";
        echo "<h7 style=\"color:red\"> $titolo </h7> <p>";
        echo "<h5> $autore</h5> <p>";
        echo "<h7 style=\"color:green\"> $data</h7> <p>";
        echo "<h7 style=\"color:\"> $link</h7> <p>";

        echo"<h4> -------------------------------------------------------------------------------------------------- </h4>";

        $contenuti[] = array(
                                'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                                'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                                'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore, 'linkEditore'=> $linkEditore
         );
        }
      
      


        $i++;
    }

    }
    $fp = fopen('resultScrapeRep.json', 'w+');
    fwrite($fp, json_encode($contenuti));
    fclose($fp);




?>