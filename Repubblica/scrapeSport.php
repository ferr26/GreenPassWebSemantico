<?php

for ($pag=2;$pag<20;$pag++){
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
?>