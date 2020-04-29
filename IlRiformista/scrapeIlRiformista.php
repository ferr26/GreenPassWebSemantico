    <?php

    $contenuti = array();
    $nomeQuotidiano="Il Riformista";
    $linkHomePage ="https://www.ilriformista.it/";
    $editore = "Romeo Editore srl";
    $linkEditore="http://www.emanueleromeoeditore.it/";
    $categoria = array("politica", "scienze", "sport", "cronaca", "economia");

    $j=0;
    for($pag=1;$pag<11;$pag++){

        $html = file_get_contents("https://www.ilriformista.it/$categoria[$j]/page/$pag/");

        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $hrefs = $xpath->evaluate("//div[@class='article-content']//h2[@class='article-title']");
        $hrefs1 = $xpath->evaluate("//div[@class='article-content']//h2[@class='article-title']//@href");
        $hrefs2 = $xpath->evaluate("//div[@class='article-content']//span[@class='article-author']");    
        $hrefs3 = $xpath->evaluate("//div[@class='article-content']//p[@class='article-time']");

        $i=0;
        while($i<$hrefs->length){

            $titoli= $hrefs->item($i);
            $titolo = $titoli->nodeValue;

            $links= $hrefs1->item($i);
            $link = $links->nodeValue;

            $autori= $hrefs2->item($i);
            $autore = $autori->nodeValue;
            if(empty($autore)){
               $autoreFinale = "NULL";
            }else{
               $autoreFinale = $autore;
            }
        

            $date= $hrefs3->item($i);
            $data = $date->nodeValue;
            if(empty($data)){
                $datafinale = "NULL";
            }else{
                $datafinale = $data;
            }
            

            $i++;
        
            $contenuti[] = array(
                'nomeQuotidiano'=> $nomeQuotidiano,'linkHomePage' =>$linkHomePage,
                'titoloArticolo' => $titolo,'linkArticolo'=> $link,'autoreArticolo'=> $autore, 
                'dataArticolo'=>$data,'categoria'=> $categoria[$j],'editore'=> $editore,'linkEditore'=> $linkEditore
            );

            if($i == $hrefs->length){
                $j++;
                $pag=0;
               
            }

            echo("$titolo + $link + $autoreFinale + $datafinale + $categoria[$j] <br>  ");

        }

    }
    creaDataset($contenuti);


    function creaDataset($dati){

        $var = fopen("scrapingIlRiformista.json", "w+");
    
        $json = json_encode($dati);
        fwrite($var, $json);
    
    }
    ?>
