<?php
$myfile = fopen("datasetArticoli.rdf", "w") or die("Unable to open file!");



$intro = "<?xml version=\"1.0\"?> \n
        <rdf:RDF

        xmlns:rdf=\"http://www.w3.org/1999/02/22-rdf-syntax-ns#\"
        xmlns:np=\"http://mappings.dbpedia.org/server/ontology/classes/Newspaper#\"
        xmlns:js=\"http://mappings.dbpedia.org/server/ontology/classes/Journalist#\"
        xmlns:ww=\"http://mappings.dbpedia.org/server/ontology/classes/WrittenWork#\"
        xmlns:dc=\"http://purl.org/dc/elements/1.1/\"
        xmlns:foaf=\"http://xmlns.com/foaf/0.1/\">
";

fwrite($myfile, $intro);


//LaRepubblica
//LETTURA DATASET .json && CONVERSIONE IN .rdf

$json = file_get_contents("datasetRepubblica.json");
$data = json_decode($json, TRUE);
$cnt=count($data);
echo "$cnt";

for ($i=0;$i<$cnt;$i++){

    $titoloArticolo=$data[$i]["titoloArticolo"];
    $linkArticolo=$data[$i]["linkArticolo"];
    $linkGiornale=$data[$i]["linkHomePage"];
    $autore=$data[$i]["autoreArticolo"];
    $dataArticolo=$data[$i]["dataArticolo"];
    $topic=$data[$i]["categoria"];
    $editore=$data[$i]["editore"];

    echo"<h1>$topic</h1>";

    $dataArticolo=str_replace("gennaio","01",$dataArticolo);
    $dataArticolo=str_replace("Gennaio","01",$dataArticolo);

    $dataArticolo=str_replace("febbraio","02",$dataArticolo);
    $dataArticolo=str_replace("Febbraio","02",$dataArticolo);

    $dataArticolo=str_replace("marzo","03",$dataArticolo);
    $dataArticolo=str_replace("Marzo","03",$dataArticolo);

    $dataArticolo=str_replace("aprile","04",$dataArticolo);
    $dataArticolo=str_replace("Aprile","04",$dataArticolo);

    $dataArticolo=str_replace("maggio","05",$dataArticolo);
    $dataArticolo=str_replace("Maggio","05",$dataArticolo);

    $dataArticolo=str_replace("giugno","06",$dataArticolo);
    $dataArticolo=str_replace("Giugno","06",$dataArticolo);

    $dataArticolo=str_replace("luglio","07",$dataArticolo);
    $dataArticolo=str_replace("Luglio","07",$dataArticolo);

    $dataArticolo=str_replace("agosto","08",$dataArticolo);
    $dataArticolo=str_replace("Agosto","08",$dataArticolo);

    $dataArticolo=str_replace("settembre","09",$dataArticolo);
    $dataArticolo=str_replace("settembre","09",$dataArticolo);

    $dataArticolo=str_replace("ottobre","10",$dataArticolo);
    $dataArticolo=str_replace("Ottobre","10",$dataArticolo);

    $dataArticolo=str_replace("novembre","11",$dataArticolo);
    $dataArticolo=str_replace("Novembre","11",$dataArticolo);

    $dataArticolo=str_replace("dicembre","12",$dataArticolo);
    $dataArticolo=str_replace("Dicembre","12",$dataArticolo);




    $giorno=substr($dataArticolo, 0, 2);
    if ($giorno>=10){
        $mese=substr($dataArticolo, 4, 2);
    }
    if ($giorno<10){
        $mese=substr($dataArticolo, 3, 2);
    }

    if ($giorno>=10){
        $anno=substr($dataArticolo, 6, 4);
    }
    if ($giorno<10){
        $anno=substr($dataArticolo, 5, 4);
    }
    
    if ($giorno<10){
        $giorno="0$giorno";
    }

    if ($mese<10){
        $mese="0$mese";
    }

    $mese=trim($mese);

    $dataParse="$anno-$mese-$giorno";
    //echo"<h1>$dataParse";

    //Genarazione Triplette



            $core1="
                    <rdf:Description rdf:about=\"$linkArticolo\">
                    <rdf:type rdf:resource=\"http://xmlns.com/foaf/0.1/Document\"/>
                    <ww:originalTitle>$titoloArticolo</ww:originalTitle>
                    <dc:date>$dataParse</dc:date>";
    
    if ($topic=="Cronaca")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cronaca/\"></foaf:primaryTopic>";
            }

    if ($topic=="Economia")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/economia/\"></foaf:primaryTopic>";
            }

    if ($topic=="Politica")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/politica/\"></foaf:primaryTopic>";
            }

    if ($topic=="Sport")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/sport/\"></foaf:primaryTopic>";
            }

    if ($topic=="Cultura")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cultura/\"></foaf:primaryTopic>";
            }

    if ($autore=="NULL"){

                    $core2="
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Maurizio_Molinari\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"http://www.gedispa.it/\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }
    else {

                $core2="
                    <js:birthName>$autore </js:birthName>
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Maurizio_Molinari\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"http://www.gedispa.it/\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }

        fwrite($myfile, $core1);
        fwrite($myfile, $coreTopic);
        fwrite($myfile, $core2);


}

//IlFattoQuotidiano
//LETTURA DATASET .json && CONVERSIONE IN .rdf


$json = file_get_contents("datasetIlFatto.json");
$data = json_decode($json, TRUE);
$cnt=count($data);
echo "$cnt";

for ($i=0;$i<$cnt;$i++){

    $titoloArticolo=$data[$i]["titoloArticolo"];
    $linkArticolo=$data[$i]["linkArticolo"];
    $linkGiornale=$data[$i]["linkHomePage"];
    $autore=$data[$i]["autoreArticolo"];
    $dataArticolo=$data[$i]["dataArticolo"];
    $topic=$data[$i]["categoria"];
    $editore=$data[$i]["editore"];

    //echo"<h1>$topic</h1>";

    $dataArticolo=str_replace("gennaio","01",$dataArticolo);
    $dataArticolo=str_replace("Gennaio","01",$dataArticolo);

    $dataArticolo=str_replace("febbraio","02",$dataArticolo);
    $dataArticolo=str_replace("Febbraio","02",$dataArticolo);

    $dataArticolo=str_replace("marzo","03",$dataArticolo);
    $dataArticolo=str_replace("Marzo","03",$dataArticolo);

    $dataArticolo=str_replace("aprile","04",$dataArticolo);
    $dataArticolo=str_replace("Aprile","04",$dataArticolo);

    $dataArticolo=str_replace("maggio","05",$dataArticolo);
    $dataArticolo=str_replace("Maggio","05",$dataArticolo);

    $dataArticolo=str_replace("giugno","06",$dataArticolo);
    $dataArticolo=str_replace("Giugno","06",$dataArticolo);

    $dataArticolo=str_replace("luglio","07",$dataArticolo);
    $dataArticolo=str_replace("Luglio","07",$dataArticolo);

    $dataArticolo=str_replace("agosto","08",$dataArticolo);
    $dataArticolo=str_replace("Agosto","08",$dataArticolo);

    $dataArticolo=str_replace("settembre","09",$dataArticolo);
    $dataArticolo=str_replace("settembre","09",$dataArticolo);

    $dataArticolo=str_replace("ottobre","10",$dataArticolo);
    $dataArticolo=str_replace("Ottobre","10",$dataArticolo);

    $dataArticolo=str_replace("novembre","11",$dataArticolo);
    $dataArticolo=str_replace("Novembre","11",$dataArticolo);

    $dataArticolo=str_replace("dicembre","12",$dataArticolo);
    $dataArticolo=str_replace("Dicembre","12",$dataArticolo);




    $giorno=substr($dataArticolo, 0, 2);
    if ($giorno>=10){
        $mese=substr($dataArticolo, 4, 2);
    }
    if ($giorno<10){
        $mese=substr($dataArticolo, 3, 2);
    }

    if ($giorno>=10){
        $anno=substr($dataArticolo, 6, 4);
    }
    if ($giorno<10){
        $anno=substr($dataArticolo, 5, 4);
    }
    
    if ($giorno<10){
        $giorno="0$giorno";
    }

    if ($mese<10){
        $mese="0$mese";
    }

    $mese=trim($mese);

    $dataParse="$anno-$mese-$giorno";
    //echo"<h1>$dataParse";

    //Genarazione Triplette



            $core1="
                    <rdf:Description rdf:about=\"$linkArticolo\">
                    <rdf:type rdf:resource=\"http://xmlns.com/foaf/0.1/Document\"/>
                    <ww:originalTitle>$titoloArticolo</ww:originalTitle>
                    <dc:date>$dataParse</dc:date>";
    
    if ($topic=="Cronaca")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cronaca/\"></foaf:primaryTopic>";
            }

    if ($topic=="Economia")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/economia/\"></foaf:primaryTopic>";
            }

    if ($topic=="Politica")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/politica/\"></foaf:primaryTopic>";
            }

    if ($topic=="Sport")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/sport/\"></foaf:primaryTopic>";
            }

    if ($topic=="Cultura")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cultura/\"></foaf:primaryTopic>";
            }

    if ($autore=="NULL"){

                    $core2="
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Peter_Gomez\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"https://www.seif-spa.it/\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }
    else {

                $core2="
                    <js:birthName>$autore </js:birthName>
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Peter_Gomez\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"https://www.seif-spa.it/\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }

        fwrite($myfile, $core1);
        fwrite($myfile, $coreTopic);
        fwrite($myfile, $core2);


}


//LaStampa
//LETTURA DATASET .json && CONVERSIONE IN .rdf


$json = file_get_contents("datasetLaStampa.json");
$data = json_decode($json, TRUE);
$cnt=count($data);
echo "$cnt";

for ($i=0;$i<$cnt;$i++){

    $titoloArticolo=$data[$i]["titoloArticolo"];
    $linkArticolo=$data[$i]["linkArticolo"];
    $linkGiornale=$data[$i]["linkHomePage"];
    $autore=$data[$i]["autoreArticolo"];
    $dataArticolo=$data[$i]["dataArticolo"];
    $topic=$data[$i]["categoria"];
    $editore=$data[$i]["editore"];

    //echo"<h1>$topic</h1>";

    $dataArticolo=str_replace("gennaio","01",$dataArticolo);
    $dataArticolo=str_replace("Gennaio","01",$dataArticolo);

    $dataArticolo=str_replace("febbraio","02",$dataArticolo);
    $dataArticolo=str_replace("Febbraio","02",$dataArticolo);

    $dataArticolo=str_replace("marzo","03",$dataArticolo);
    $dataArticolo=str_replace("Marzo","03",$dataArticolo);

    $dataArticolo=str_replace("aprile","04",$dataArticolo);
    $dataArticolo=str_replace("Aprile","04",$dataArticolo);

    $dataArticolo=str_replace("maggio","05",$dataArticolo);
    $dataArticolo=str_replace("Maggio","05",$dataArticolo);

    $dataArticolo=str_replace("giugno","06",$dataArticolo);
    $dataArticolo=str_replace("Giugno","06",$dataArticolo);

    $dataArticolo=str_replace("luglio","07",$dataArticolo);
    $dataArticolo=str_replace("Luglio","07",$dataArticolo);

    $dataArticolo=str_replace("agosto","08",$dataArticolo);
    $dataArticolo=str_replace("Agosto","08",$dataArticolo);

    $dataArticolo=str_replace("settembre","09",$dataArticolo);
    $dataArticolo=str_replace("settembre","09",$dataArticolo);

    $dataArticolo=str_replace("ottobre","10",$dataArticolo);
    $dataArticolo=str_replace("Ottobre","10",$dataArticolo);

    $dataArticolo=str_replace("novembre","11",$dataArticolo);
    $dataArticolo=str_replace("Novembre","11",$dataArticolo);

    $dataArticolo=str_replace("dicembre","12",$dataArticolo);
    $dataArticolo=str_replace("Dicembre","12",$dataArticolo);




    $giorno=substr($dataArticolo, 0, 2);
    if ($giorno>=10){
        $mese=substr($dataArticolo, 4, 2);
    }
    if ($giorno<10){
        $mese=substr($dataArticolo, 3, 2);
    }

    if ($giorno>=10){
        $anno=substr($dataArticolo, 6, 4);
    }
    if ($giorno<10){
        $anno=substr($dataArticolo, 5, 4);
    }
    
    if ($giorno<10){
        $giorno="0$giorno";
    }

    if ($mese<10){
        $mese="0$mese";
    }

    $mese=trim($mese);

    $dataParse="$anno-$mese-$giorno";
   // echo"<h1>$dataParse";

    //Genarazione Triplette



            $core1="
                    <rdf:Description rdf:about=\"$linkArticolo\">
                    <rdf:type rdf:resource=\"http://xmlns.com/foaf/0.1/Document\"/>
                    <ww:originalTitle>$titoloArticolo</ww:originalTitle>
                    <dc:date>$dataParse</dc:date>";
    
    if ($topic=="Cronaca")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cronaca/\"></foaf:primaryTopic>";
            }

    if ($topic=="Economia")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/economia/\"></foaf:primaryTopic>";
            }

    if ($topic=="Politica")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/politica/\"></foaf:primaryTopic>";
            }

    if ($topic=="Sport")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/sport/\"></foaf:primaryTopic>";
            }

    if ($topic=="Cultura")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cultura/\"></foaf:primaryTopic>";
            }

    if ($autore=="NULL"){

                    $core2="
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Massimo_Giannini\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"http://www.gedispa.it/\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }
    else {

                $core2="
                    <js:birthName>$autore </js:birthName>
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Massimo_Giannini\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"http://www.gedispa.it/\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }

        fwrite($myfile, $core1);
        fwrite($myfile, $coreTopic);
        fwrite($myfile, $core2);


}


//IlRiformista
//LETTURA DATASET .json && CONVERSIONE IN .rdf


$json = file_get_contents("datasetIlRiformista.json");
$data = json_decode($json, TRUE);
$cnt=count($data);
echo "IL RIFORMISTA : $cnt";

for ($i=0;$i<$cnt;$i++){

    $titoloArticolo=$data[$i]["titoloArticolo"];
    $linkArticolo=$data[$i]["linkArticolo"];
    $linkGiornale=$data[$i]["linkHomePage"];
    $autore=$data[$i]["autoreArticolo"];
    $dataArticolo=$data[$i]["dataArticolo"];
    $topic=$data[$i]["categoria"];
    $editore=$data[$i]["editore"];

    echo"<h1>$dataArticolo</h1>";

    $dataArticolo=str_replace("gen","01",$dataArticolo);
    $dataArticolo=str_replace("Gen","01",$dataArticolo);

    $dataArticolo=str_replace("feb","02",$dataArticolo);
    $dataArticolo=str_replace("Feb","02",$dataArticolo);

    $dataArticolo=str_replace("mar","03",$dataArticolo);
    $dataArticolo=str_replace("Mar","03",$dataArticolo);

    $dataArticolo=str_replace("apr","04",$dataArticolo);
    $dataArticolo=str_replace("Apr","04",$dataArticolo);

    $dataArticolo=str_replace("mag","05",$dataArticolo);
    $dataArticolo=str_replace("Mag","05",$dataArticolo);

    $dataArticolo=str_replace("giu","06",$dataArticolo);
    $dataArticolo=str_replace("Giu","06",$dataArticolo);

    $dataArticolo=str_replace("lug","07",$dataArticolo);
    $dataArticolo=str_replace("Lug","07",$dataArticolo);

    $dataArticolo=str_replace("ago","08",$dataArticolo);
    $dataArticolo=str_replace("Ago","08",$dataArticolo);

    $dataArticolo=str_replace("Set","09",$dataArticolo);
    $dataArticolo=str_replace("set","09",$dataArticolo);

    $dataArticolo=str_replace("ott","10",$dataArticolo);
    $dataArticolo=str_replace("Ott","10",$dataArticolo);

    $dataArticolo=str_replace("nov","11",$dataArticolo);
    $dataArticolo=str_replace("Nov","11",$dataArticolo);

    $dataArticolo=str_replace("dic","12",$dataArticolo);
    $dataArticolo=str_replace("Dic","12",$dataArticolo);




    $giorno=substr($dataArticolo, 0, 2);
    if ($giorno>=10){
        $mese=substr($dataArticolo, 4, 2);
    }
    if ($giorno<10){
        $mese=substr($dataArticolo, 3, 2);
    }

    if ($giorno>=10){
        $anno=substr($dataArticolo, 6, 4);
    }
    if ($giorno<10){
        $anno=substr($dataArticolo, 5, 4);
    }
    
    if ($giorno<10){
        $giorno="0$giorno";
    }

    if ($mese<10){
        $mese="0$mese";
    }

    $mese=trim($mese);

    $dataParse="$anno-$mese-$giorno";
    echo"<h1>$dataParse";

    //Genarazione Triplette



            $core1="
                    <rdf:Description rdf:about=\"$linkArticolo\">
                    <rdf:type rdf:resource=\"http://xmlns.com/foaf/0.1/Document\"/>
                    <ww:originalTitle>$titoloArticolo</ww:originalTitle>
                    <dc:date>$dataParse</dc:date>";
    
    if ($topic=="cronaca")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cronaca/\"></foaf:primaryTopic>";
            }

    if ($topic=="economia")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/economia/\"></foaf:primaryTopic>";
            }

    if ($topic=="politica")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/politica/\"></foaf:primaryTopic>";
            }

    if ($topic=="sport")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/sport/\"></foaf:primaryTopic>";
            }

    if ($topic=="scienze")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cultura/\"></foaf:primaryTopic>";
            }

    if ($autore=="null"){

                    $core2="
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Piero_Sansonetti\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }
    else {

                $core2="
                    <js:birthName>$autore </js:birthName>
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Piero_Sansonetti\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }

        fwrite($myfile, $core1);
        fwrite($myfile, $coreTopic);
        fwrite($myfile, $core2);


}



//CorriereDellaSera
//LETTURA DATASET .json && CONVERSIONE IN .rdf


$json = file_get_contents("datasetCorriere.json");
$data = json_decode($json, TRUE);
$cnt=count($data);
echo "$cnt";

for ($i=0;$i<$cnt;$i++){

    $titoloArticolo=$data[$i]["titoloArticolo"];
    $titoloArticolo=trim($titoloArticolo);
    $linkArticolo=$data[$i]["linkArticolo"];
    $linkGiornale=$data[$i]["linkHomePage"];
    $autore=$data[$i]["autoreArticolo"];
    $autore=trim($autore);
    $dataArticolo=$data[$i]["dataArticolo"];
    $topic=$data[$i]["categoria"];
    $editore=$data[$i]["editore"];
    $linkEditore=$data[$i]["linkEditore"];

    //echo"<h1>$topic</h1>";

    $dataArticolo=str_replace("gennaio","01",$dataArticolo);
    $dataArticolo=str_replace("Gennaio","01",$dataArticolo);

    $dataArticolo=str_replace("febbraio","02",$dataArticolo);
    $dataArticolo=str_replace("Febbraio","02",$dataArticolo);

    $dataArticolo=str_replace("marzo","03",$dataArticolo);
    $dataArticolo=str_replace("Marzo","03",$dataArticolo);

    $dataArticolo=str_replace("aprile","04",$dataArticolo);
    $dataArticolo=str_replace("Aprile","04",$dataArticolo);

    $dataArticolo=str_replace("maggio","05",$dataArticolo);
    $dataArticolo=str_replace("Maggio","05",$dataArticolo);

    $dataArticolo=str_replace("giugno","06",$dataArticolo);
    $dataArticolo=str_replace("Giugno","06",$dataArticolo);

    $dataArticolo=str_replace("luglio","07",$dataArticolo);
    $dataArticolo=str_replace("Luglio","07",$dataArticolo);

    $dataArticolo=str_replace("agosto","08",$dataArticolo);
    $dataArticolo=str_replace("Agosto","08",$dataArticolo);

    $dataArticolo=str_replace("settembre","09",$dataArticolo);
    $dataArticolo=str_replace("settembre","09",$dataArticolo);

    $dataArticolo=str_replace("ottobre","10",$dataArticolo);
    $dataArticolo=str_replace("Ottobre","10",$dataArticolo);

    $dataArticolo=str_replace("novembre","11",$dataArticolo);
    $dataArticolo=str_replace("Novembre","11",$dataArticolo);

    $dataArticolo=str_replace("dicembre","12",$dataArticolo);
    $dataArticolo=str_replace("Dicembre","12",$dataArticolo);




    $giorno=substr($dataArticolo, 0, 2);
    if ($giorno>=10){
        $mese=substr($dataArticolo, 4, 2);
    }
    if ($giorno<10){
        $mese=substr($dataArticolo, 3, 2);
    }

    if ($giorno>=10){
        $anno=substr($dataArticolo, 6, 4);
    }
    if ($giorno<10){
        $anno=substr($dataArticolo, 5, 4);
    }
    
    if ($giorno<10){
        $giorno="0$giorno";
    }

    if ($mese<10){
        $mese="0$mese";
    }

    $mese=trim($mese);

    $dataParse="$anno-$mese-$giorno";
   // echo"<h1>$dataParse";

    //Genarazione Triplette



            $core1="
                    <rdf:Description rdf:about=\"$linkArticolo\">
                    <rdf:type rdf:resource=\"http://xmlns.com/foaf/0.1/Document\"/>
                    <ww:originalTitle>$titoloArticolo</ww:originalTitle>
                    <dc:date>$dataParse</dc:date>";
    
    if ($topic=="Cronaca")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cronaca/\"></foaf:primaryTopic>";
            }

    if ($topic=="Economia")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/economia/\"></foaf:primaryTopic>";
            }

    if ($topic=="Politica")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/politica/\"></foaf:primaryTopic>";
            }

    if ($topic=="Sport")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/sport/\"></foaf:primaryTopic>";
            }

    if ($topic=="Cultura")
            {
                    $coreTopic="
                    <foaf:primaryTopic rdf:resource=\"http://www.treccani.it/vocabolario/cultura/\"></foaf:primaryTopic>";
            }

    if ($autore=="NULL"){

                    $core2="
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Luciano_Fontana\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"$linkEditore\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }
    else {

                $core2="
                    <js:birthName>$autore </js:birthName>
                    <np:Newspaper rdf:resource=\"$linkGiornale\"></np:Newspaper>
                    <np:associateEditor> 
                    <foaf:Person>
                        <foaf:name rdf:resource=\"https://it.wikipedia.org/wiki/Luciano_Fontana\"></foaf:name>
                    </foaf:Person>
                    </np:associateEditor>
                    <np:publisher rdf:resource=\"$linkEditore\"></np:publisher>
                    <dc:format>text/html</dc:format>
                    <dc:language>it</dc:language>
                    </rdf:Description> 
                    \n
                    ";

    }

        fwrite($myfile, $core1);
        fwrite($myfile, $coreTopic);
        fwrite($myfile, $core2);


}






$final = "\n</rdf:RDF>";
fwrite($myfile, $final);
fclose($myfile);
?>