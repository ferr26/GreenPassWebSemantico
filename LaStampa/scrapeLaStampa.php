<?php
$contenuti = array();
$nomeQuotidiano="La Stampa";
$linkHomePage ="https://www.lastampa.it/";
$editore = "G.E.D.I";
$linkEditore="http://www.gedispa.it/";

$tot=0;
for($pag=1;$pag<10;$pag++){
    $html = file_get_contents("https://www.lastampa.it/cronaca?page=$pag");
    $categoria= "Cronaca";


    //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='block__item']/article/div/span");

    $i=0;
    

    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);
           
        if ($autori= $homeCronacaAutori->item($i))
        {
                $autoreRaw = $autori->nodeValue;
                $autore=strtoupper(trim($autoreRaw));
        } 
        else 
        {
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
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='entry__date']");
        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim($data);
        $data=trim(substr($data,14));

    

        echo "<h2> $titolo </h2> <p>";
        echo "<h3 style=\"color:green\"> $autore</h3> <p>";
        echo "<h5 style=\"color:green\"> $data</h3> <p>";
        echo "<h6 style=\"color:blue\"> $link </h6> <p>";
        echo "<h7 style=\"color:red\"><b> $categoria </b></h7> <p>";
        echo "---------------------------------------------------------------------------------";
        
        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );

        $i++;
    }

    $tot=$tot+$i;
    echo "<h2> $tot </h2> <p>";


}

//FINE CRONACA 
//INIZIO POLITICA
for($pag=1;$pag<10;$pag++){
    $html = file_get_contents("https://www.lastampa.it/politica?page=$pag");
    $categoria= "Politica";


    //echo "<h5> $html</h5> <p>";

    //parse the html into a DOMDocument
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $xpath = new DOMXPath($dom);
    $homeCronacaTitoli= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a");
    $homeCronacaLink= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a/@href");
    $homeCronacaAutori= $xpath->evaluate("//div[@class='block__item']/article/div/span");

    $i=0;
    

    while($i<$homeCronacaTitoli->length){
        $titoli= $homeCronacaTitoli->item($i);
        $titolo = $titoli->nodeValue;
        $titolo=trim($titolo);
           
        if ($autori= $homeCronacaAutori->item($i))
        {
                $autoreRaw = $autori->nodeValue;
                $autore=strtoupper(trim($autoreRaw));
        } 
        else 
        {
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
       
        //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
       // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
        $homeSingoloArticolo =$xpath->evaluate("//span[@class='entry__date']");
        //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
        $date= $homeSingoloArticolo->item(0);
        $data = $date->nodeValue;
        $data=trim($data);
        $data=trim(substr($data,14));

    

        echo "<h2> $titolo </h2> <p>";
        echo "<h3 style=\"color:green\"> $autore</h3> <p>";
        echo "<h5 style=\"color:green\"> $data</h3> <p>";
        echo "<h6 style=\"color:blue\"> $link </h6> <p>";
        echo "<h7 style=\"color:red\"><b> $categoria </b></h7> <p>";
        echo "---------------------------------------------------------------------------------";

        $contenuti[] = array(
            'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
            'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
            'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
        );

        $i++;
    }

    $tot=$tot+$i;
    echo "<h2> $tot </h2> <p>";


}

    //FINE SEZIONE POLITICA
    //INIZIO SEZIONE CULTURA

    for($pag=1;$pag<10;$pag++){
        $html = file_get_contents("https://www.lastampa.it/cultura?page=$pag");
        $categoria= "Cultura";
    
    
        //echo "<h5> $html</h5> <p>";
    
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $homeCronacaTitoli= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a");
        $homeCronacaLink= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a/@href");
        $homeCronacaAutori= $xpath->evaluate("//div[@class='block__item']/article/div/span");
    
        $i=0;
        
    
        while($i<$homeCronacaTitoli->length){
            $titoli= $homeCronacaTitoli->item($i);
            $titolo = $titoli->nodeValue;
            $titolo=trim($titolo);
               
            if ($autori= $homeCronacaAutori->item($i))
            {
                    $autoreRaw = $autori->nodeValue;
                    $autore=strtoupper(trim($autoreRaw));
            } 
            else 
            {
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
           
            //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
           // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
            $homeSingoloArticolo =$xpath->evaluate("//span[@class='entry__date']");
            //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
            $date= $homeSingoloArticolo->item(0);
            $data = $date->nodeValue;
            $data=trim($data);
            $data=trim(substr($data,14));
    
        
    
            echo "<h2> $titolo </h2> <p>";
            echo "<h3 style=\"color:green\"> $autore</h3> <p>";
            echo "<h5 style=\"color:green\"> $data</h3> <p>";
            echo "<h6 style=\"color:blue\"> $link </h6> <p>";
            echo "<h7 style=\"color:red\"><b> $categoria </b></h7> <p>";
            echo "---------------------------------------------------------------------------------";
    
            $contenuti[] = array(
                'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
            );
    
            $i++;
        }
    
        $tot=$tot+$i;
        echo "<h2> $tot </h2> <p>";
    
    
    }

    //FINE CULTURA
    //INIZIO SPORT

    for($pag=1;$pag<10;$pag++){
        $html = file_get_contents("https://www.lastampa.it/sport/archivio?page=$pag");
        $categoria= "Sport";
    
    
        //echo "<h5> $html</h5> <p>";
    
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $homeCronacaTitoli= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a");
        $homeCronacaLink= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a/@href");
        $homeCronacaAutori= $xpath->evaluate("//div[@class='block__item']/article/div/span");
    
        $i=0;
        
    
        while($i<$homeCronacaTitoli->length){
            $titoli= $homeCronacaTitoli->item($i);
            $titolo = $titoli->nodeValue;
            $titolo=trim($titolo);
               
            if ($autori= $homeCronacaAutori->item($i))
            {
                    $autoreRaw = $autori->nodeValue;
                    $autore=strtoupper(trim($autoreRaw));
            } 
            else 
            {
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
           
            //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
           // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
            $homeSingoloArticolo =$xpath->evaluate("//span[@class='entry__date']");
            //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
            $date= $homeSingoloArticolo->item(0);
            $data = $date->nodeValue;
            $data=trim($data);
            $data=trim(substr($data,14));
    
        
    
            echo "<h2> $titolo </h2> <p>";
            echo "<h3 style=\"color:green\"> $autore</h3> <p>";
            echo "<h5 style=\"color:green\"> $data</h3> <p>";
            echo "<h6 style=\"color:blue\"> $link </h6> <p>";
            echo "<h7 style=\"color:red\"><b> $categoria </b></h7> <p>";
            echo "---------------------------------------------------------------------------------";
    
            $contenuti[] = array(
                'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
            );
    
            $i++;
        }
    
        $tot=$tot+$i;
        echo "<h2> $tot </h2> <p>";
    
    
    }


     //FINE SPORT
    //INIZIO ECONOMIA

    for($pag=1;$pag<10;$pag++){
        $html = file_get_contents("https://www.lastampa.it/economia/archivio?page=$pag");
        $categoria= "Economia";
    
    
        //echo "<h5> $html</h5> <p>";
    
        //parse the html into a DOMDocument
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);
        $homeCronacaTitoli= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a");
        $homeCronacaLink= $xpath->evaluate("//div[@class='block__item']/article/div/h2/a/@href");
        $homeCronacaAutori= $xpath->evaluate("//div[@class='block__item']/article/div/span");
    
        $i=0;
        
    
        while($i<$homeCronacaTitoli->length){
            $titoli= $homeCronacaTitoli->item($i);
            $titolo = $titoli->nodeValue;
            $titolo=trim($titolo);
               
            if ($autori= $homeCronacaAutori->item($i))
            {
                    $autoreRaw = $autori->nodeValue;
                    $autore=strtoupper(trim($autoreRaw));
            } 
            else 
            {
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
           
            //$homeSingoloArticolo =$xpath->evaluate("/main/section/article/div[@class='main-column aside-visible ']/div[@class='article-wrapper']/
           // div[@class='social-article-wrapper']/div[@class='wrapper-info-article']");
            $homeSingoloArticolo =$xpath->evaluate("//span[@class='entry__date']");
            //echo "<h2>$homeSingoloArticolo->length</h2> <p>";
            $date= $homeSingoloArticolo->item(0);
            $data = $date->nodeValue;
            $data=trim($data);
            $data=trim(substr($data,14));
    
        
    
            echo "<h2> $titolo </h2> <p>";
            echo "<h3 style=\"color:green\"> $autore</h3> <p>";
            echo "<h5 style=\"color:green\"> $data</h3> <p>";
            echo "<h6 style=\"color:blue\"> $link </h6> <p>";
            echo "<h7 style=\"color:red\"><b> $categoria </b></h7> <p>";
            echo "---------------------------------------------------------------------------------";
    
            $contenuti[] = array(
                'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                'dataArticolo'=>$data,'categoria'=> $categoria,'editore'=> $editore,'linkEditore'=> $linkEditore
            );
    
            $i++;
        }
    
        $tot=$tot+$i;
        echo "<h2> $tot </h2> <p>";
    
    
    }






$fp = fopen('resultScrapeStampa.json', 'w+');
fwrite($fp, json_encode($contenuti));
fclose($fp);

?>