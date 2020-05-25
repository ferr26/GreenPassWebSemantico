<!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="icon" href="img/semanticWeb.png" type="image/png">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    

        <title>GreenPass</title>

        <!-- Google font -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7CVarela+Round" rel="stylesheet">

        <!-- Bootstrap -->
        <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />


        <!-- Owl Carousel -->
        <link type="text/css" rel="stylesheet" href="css/owl.carousel.css" />
        <link type="text/css" rel="stylesheet" href="css/owl.theme.default.css" />

        <!-- Magnific Popup -->
        <link type="text/css" rel="stylesheet" href="css/magnific-popup.css" />

        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="css/font-awesome.min.css">

        <!-- Custom stlylesheet -->
        <link type="text/css" rel="stylesheet" href="css/style.css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        
        <style>
            #over img {
            margin-left: auto;
            margin-right: auto;
            display: block;
            }    
    </style>

    </head>
    <body>

        <!-- Header -->
        <header>

            <!-- Nav -->
            <nav id="nav" class="navbar">
                <div class="container">

                    <div class="navbar-header">
                        
                        <!-- Collapse nav button -->
                        <div class="nav-collapse">
                            <span></span>
                        </div>
                        <!-- /Collapse nav button -->
                    </div>

                    <!--  Main navigation  -->
                    <ul class="main-nav nav navbar-nav navbar-right">
                        <li><a href="index3.html#home">Home</a></li>
                        <li><a href="index3.html#service">Servizi</a></li>
                        <li><a href="index3.html#team">Team</a></li>
                        <li><a href="index3.html#contact">Contatti</a></li>
                    </ul>
                    <!-- /Main navigation -->

                </div>
            </nav>
            <!-- /Nav -->
            
        </div>  
            
        
        </header>
        <!-- /Header -->

        <!-- Blog -->
        <div id="blog" class="section md-padding">

            <!-- Container -->
            <div class="container">

                <!-- Row -->
                <div class="row">

                    <!-- Main -->
                    <main id="main" class="col-md-9">
                        <div class="blog">
                            
                            



                            <!-- blog comments -->
                            <div class="blog-comments">

                              

    <?php

        require_once( "lib/sparqllib.php" );
        $db = sparql_connect("http://localhost:8890/sparql");

        $autore= $_GET["variabile"];



        selectAutore($autore);
        visualizzArticoli($autore);


    function selectAutore($autore){
            $sparql = "SELECT DISTINCT *  WHERE {
                ?x foaf:name ?name .
                ?x js:birthDate ?birthDate .
                ?x foaf:gender ?gender .
                ?x js:federation ?federation.
                ?x foaf:img ?img .
                ?x foaf:nick ?nick .
                ?x foaf:publications ?publications  .
                Filter (REGEX(?name,'$autore'))    
        }";
        
        $result = sparql_query( $sparql ); 
        if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
    
        $fields = sparql_field_array( $result );



        
    while( $row = sparql_fetch_array( $result ) )
    {    
        
      
        foreach( $fields as $field ){

           if($field == "birthDate"){
                $data=$row[$field];      
           } else if($field == "name"){
                 $name=$row[$field];
           }else if ($field == "gender"){
            $gender=$row[$field];
           }else if ($field == "federation"){
            $federation=$row[$field];
           }else if ($field == "nick"){
            $nick=$row[$field];
           }else if ($field == "x"){
            $linkAutore=$row[$field];
           }
           else if ($field == "publications"){
            $linkPubblicazioni=$row[$field];
           }
           else if ($field == "img"){
            $linkImg=$row[$field];
           }

        } //fine FOREACH

        /*
        echo " <p>$dataNascita $name $gender $federation - $nick <br><p>";
        echo "<p>$linkAutore</p>";
        echo "<p>$linkPubblicazioni</p>";
        echo "<p>$linkAutore</p>";
        echo "<p>$linkImg</p>";
        */

        $anno=substr($data, 0, 4);
        $mese=substr($data, 5, 2);
        if ($mese=="01"){
            $mese="Gennaio";
        }
        if ($mese=="02"){
            $mese="Febbraio";
        }
        if ($mese=="03"){
            $mese="Marzo";
        }
        if ($mese=="04"){
            $mese="Aprile";
        }
        if ($mese=="05"){
            $mese="Maggio";
        }
        if ($mese=="06"){
            $mese="Giugno";
        }
        if ($mese=="07"){
            $mese="Luglio";
        }
        if ($mese=="08"){
            $mese="Agosto";
        }
        if ($mese=="09"){
            $mese="Settembre";
        }
        if ($mese=="10"){
            $mese="Ottobre";
        }
        if ($mese=="11"){
            $mese="Novembre";
        }
        if ($mese=="12"){
            $mese="Dicembre";
        }
        
        $giorno=substr($data, 8, 10);
        $data="$giorno $mese $anno";


        echo "
        <div class=\"media\">
        <div class=\"media-left\">";
        echo"<a href=\"$linkAutore\"><img class=\"media-object\" src=\"$linkImg\" alt=\"\" width=\"250\" height=\"250\"></a>
        </div>
        <div class=\"media-body\">";
        echo("<h4 class=\"media-heading\"> $name <span class=\"time\"> </span></h4>");
        echo("<em style=\"color:#3498DB\"> @$nick </em>");
        echo("<p></p>");
        echo("<em> $data </em>");
        echo ("<p></p>");
        if ($federation=="\"https://odg.roma.it/\""){
        echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=https://odg.roma.it/\"><img class=\"media-object\" src=\"./img/lazio.png\" alt=\"\" width=\"70\" height=\"70\"></a>");
        }
        if ($federation=="\"http://www.odgsicilia.it/\""){
            echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=http://www.odgsicilia.it/\"><img class=\"media-object\" src=\"./img/sicilia.png\" alt=\"\" width=\"70\" height=\"90\"></a>");
            }
        if ($federation=="\"http://www.odg.campania.it/\""){
                echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=http://www.odg.campania.it/\"><img class=\"media-object\" src=\"./img/campania.jpg\" alt=\"\" width=\"70\" height=\"70\"></a>");
                }
        if ($federation=="\"http://www.odg.toscana.it/\""){
                    echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=http://www.odg.toscana.it/\"><img class=\"media-object\" src=\"./img/toscana.png\" alt=\"\" width=\"70\" height=\"90\"></a>");
                    }
        if ($federation=="\"https://odg.bo.it/\""){
                        echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=https://odg.bo.it/\"><img class=\"media-object\" src=\"./img/emilia.png\" alt=\"\" width=\"70\" height=\"90\"></a>");
                        }
        if ($federation=="\"http://www.ordinegiornalisti.veneto.it/#sthash.wW1ftcUK.dpbs\""){
                            echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=http://www.ordinegiornalisti.veneto.it/#sthash.wW1ftcUK.dpbs\"><img class=\"media-object\" src=\"./img/veneto.jpg\" alt=\"\" width=\"70\" height=\"90\"></a>");
                            }
                        
        if ($federation=="\"https://www.odg.mi.it/\""){
                            echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=https://www.odg.mi.it/\"><img class=\"media-object\" src=\"./img/lombardia.png\" alt=\"\" width=\"70\" height=\"70\"></a>");
                                            }
        if ($federation=="\"https://www.og.puglia.it/\""){
                            echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=https://www.og.puglia.it/\"><img class=\"media-object\" src=\"./img/puglia.png\" alt=\"\" width=\"70\" height=\"100\"></a>");
                                                }
        if ($federation=="\"http://www.odgs.it/\""){
                             echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=http://www.odgs.it/\"><img class=\"media-object\" src=\"./img/sardegna.png\" alt=\"\" width=\"70\" height=\"90\"></a>");
                                                    }
        if ($federation=="\"http://www.odgpiemonte.it/\""){
                            echo ("<a href=\"http://localhost/WebSemantico/websemantico/agency/visualizzaOrdini.php?variabile=http://www.odgpiemonte.it/\"><img class=\"media-object\" src=\"./img/piemonte.jpg\" alt=\"\" width=\"100\" height=\"90\"></a>");
                                                     }
                                  
        echo ("<p></p>");
        echo ("<a href=$linkPubblicazioni><img class=\"media-object\" src=\"./img/pubblicazioni.png\" alt=\"\" width=\"70\" height=\"70\"></a></div>");

                                                    
        


    }

}

    function visualizzArticoli($nomeAutore){
        $sparql = "SELECT DISTINCT *  WHERE {
            ?x js:birthName ?birthName.
            ?x ww:originalTitle ?originalTitle .
            ?x dc:date ?date .
            ?x dc:language ?language .
            ?x rdf:type ?type .
            ?x dc:format ?format .
            ?x np:Newspaper ?newspaper .
            ?x np:publisher ?publisher .
            ?x np:associateEditor ?associateEditor .
            ?associateEditor foaf:name ?name .
            ?x foaf:primaryTopic ?primaryTopic  .
            Filter (REGEX(?birthName,'$nomeAutore'))    
       }
    ORDER BY DESC(?date)
    ";
     $result = sparql_query( $sparql ); 
     if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
     
     $fields = sparql_field_array( $result );
     
     print("<br> <br>");
     print"<h3 cstyle=\"color:#3498DB\">Articoli Pubblicati (".sparql_num_rows( $result ).") </h3>";

     while( $row = sparql_fetch_array( $result ) )
     {    
         
        foreach( $fields as $field )
        {
        if($field == "originalTitle"){
            $titolo=$row[$field];      
       } else if($field == "x"){
             $linkArticolo=$row[$field];
       }else if($field == "date"){
           $data=$row[$field];
           $anno=substr($data, 0, 4);
           $mese=substr($data, 5, 2);
           if ($mese=="01"){
               $mese="Gennaio";
           }
           if ($mese=="02"){
               $mese="Febbraio";
           }
           if ($mese=="03"){
               $mese="Marzo";
           }
           if ($mese=="04"){
               $mese="Aprile";
           }
           if ($mese=="05"){
               $mese="Maggio";
           }
           if ($mese=="06"){
               $mese="Giugno";
           }
           if ($mese=="07"){
               $mese="Luglio";
           }
           if ($mese=="08"){
               $mese="Agosto";
           }
           if ($mese=="09"){
               $mese="Settembre";
           }
           if ($mese=="10"){
               $mese="Ottobre";
           }
           if ($mese=="11"){
               $mese="Novembre";
           }
           if ($mese=="12"){
               $mese="Dicembre";
           }
           
           $giorno=substr($data, 8, 10);
           $data="$giorno $mese $anno";


       }else if($field == "birthName"){
           $nomeAutore=$row[$field];
       } else if($field == "newspaper"){
           $linkGiornale=$row[$field];
       }else if($field == "publisher"){
           $linkEditore=$row[$field];
       } else if($field == "primaryTopic"){
           $topic=$row[$field];
       } 


    } 

   echo "
   <div class=\"media\">
   <div class=\"media-left\">";

   if ($linkGiornale=="https://www.repubblica.it/"){
   echo"<a href=\"$linkGiornale\"><img class=\"media-object\" src=\"./img/rep.png\" alt=\"\" width=\"100\" height=\"100\"></a>
   </div>
   <div class=\"media-body\">";
   }
   if ($linkGiornale=="https://www.corriere.it/"){
       echo"<a href=\"$linkGiornale\"><img class=\"media-object\" src=\"./img/corriere.jpg\" alt=\"\" width=\"70\" height=\"70\"></a>
       </div>
       <div class=\"media-body\">";
   }
   if ($linkGiornale=="https://www.lastampa.it/"){
       echo"<a href=\"$linkGiornale\"><img class=\"media-object\" src=\"./img/stampa.jpg\" alt=\"\" width=\"100\" height=\"100\"></a>
       </div>
       <div class=\"media-body\">";
   }
   if ($linkGiornale=="https://www.ilfattoquotidiano.it/"){
       echo"<a href=\"$linkGiornale\"><img class=\"media-object\" src=\"./img/ilfatto2.png\" alt=\"\" width=\"100\" height=\"100\"></a>
       </div>
       <div class=\"media-body\">";
   }
   if ($linkGiornale=="https://www.ilriformista.it/"){
       echo"<a href=\"$linkGiornale\"><img class=\"media-object\" src=\"./img/riformista.png\" alt=\"\" width=\"100\" height=\"100\"></a>
       </div>
       <div class=\"media-body\">";
   }



   echo(" <a href=\"$linkArticolo\"><i class=\"fa fa-external-link\" style=\" font-size:23px; color:#3498DB\"></i> </a><h4 class=\"media-heading\"> $titolo <span class=\"time\"> </span></h4>");
        
        echo"
        <p>$data - <em><a href=\"http://localhost/progettowebsemantico/websemantico/agency/visualizzaGiornalista.php?variabile=$nomeAutore\">$nomeAutore</a> </em></p>
        ";


        if ($topic=="http://www.treccani.it/vocabolario/cronaca/"){
                echo"
                <a href=\"$topic\"><p> CRONACA </p> </a>     
                <br>
                ";

                if ($linkEditore=="http://www.gedispa.it/"){
                echo "<p> <a href=\"$linkEditore\">G.E.D.I.</a></p>
                    </div>
                    </div>";
                }
                if ($linkEditore=="https://www.seif-spa.it/"){
                    echo "<p> <a href=\"$linkEditore\">SOCIETA' EDITORIALE IL FATTO</a></p>
                        </div>
                        </div>";
                }
                if ($linkEditore=="https://www.rcsmediagroup.it/"){
                    echo "<p> <a href=\"$linkEditore\">RCS GROUP</a></p>
                        </div>
                        </div>";
                }
                if ($linkEditore=="https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL"){
                    echo "<p> <a href=\"$linkEditore\">ROMEO EDITORIALE</a></p>
                        </div>
                        </div>";
                }


        } 
        if ($topic=="http://www.treccani.it/vocabolario/economia/"){
            echo"
            <a href=\"$topic\" style=\"color:#3498DB\"><p> ECONOMIA </p> </a>     
            <br>
            ";

            if ($linkEditore=="http://www.gedispa.it/"){
            echo "<p> <a href=\"$linkEditore\">G.E.D.I.</a></p>
                </div>
                </div>";
            }
            if ($linkEditore=="https://www.seif-spa.it/"){
                echo "<p> <a href=\"$linkEditore\">SOCIETA' EDITORIALE IL FATTO</a></p>
                    </div>
                    </div>";
            }
            if ($linkEditore=="https://www.rcsmediagroup.it/"){
                echo "<p> <a href=\"$linkEditore\">RCS GROUP</a></p>
                    </div>
                    </div>";
            }
            if ($linkEditore=="https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL"){
                echo "<p> <a href=\"$linkEditore\">ROMEO EDITORIALE</a></p>
                    </div>
                    </div>";
            }
        } 

        if ($topic=="http://www.treccani.it/vocabolario/politica/"){
        echo"
        <a href=\"$topic\" style=\"color:#3498DB\"><p> POLITICA </p> </a>     
        <br>
        ";

        if ($linkEditore=="http://www.gedispa.it/"){
        echo "<p> <a href=\"$linkEditore\">G.E.D.I.</a></p>
            </div>
            </div>";
        }
        if ($linkEditore=="https://www.seif-spa.it/"){
            echo "<p> <a href=\"$linkEditore\">SOCIETA' EDITORIALE IL FATTO</a></p>
                </div>
                </div>";
        }
        if ($linkEditore=="https://www.rcsmediagroup.it/"){
            echo "<p> <a href=\"$linkEditore\">RCS GROUP</a></p>
                </div>
                </div>";
        }
        if ($linkEditore=="https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL"){
            echo "<p> <a href=\"$linkEditore\">ROMEO EDITORIALE</a></p>
                </div>
                </div>";
        }
        } 

        if ($topic=="http://www.treccani.it/vocabolario/cultura/"){
        echo"
        <a href=\"$topic\" style=\"color:#3498DB\"><p> CULTURA </p> </a>     
        <br>
        ";

        if ($linkEditore=="http://www.gedispa.it/"){
        echo "<p> <a href=\"$linkEditore\">G.E.D.I.</a></p>
        </div>
        </div>";
        }
        if ($linkEditore=="https://www.seif-spa.it/"){
        echo "<p> <a href=\"$linkEditore\">SOCIETA' EDITORIALE IL FATTO</a></p>
            </div>
            </div>";
        }
        if ($linkEditore=="https://www.rcsmediagroup.it/"){
        echo "<p> <a href=\"$linkEditore\">RCS GROUP</a></p>
            </div>
            </div>";
        }
        if ($linkEditore=="https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL"){
        echo "<p> <a href=\"$linkEditore\">ROMEO EDITORIALE</a></p>
            </div>
            </div>";
        }
        } 

        if ($topic=="http://www.treccani.it/vocabolario/sport/"){
        echo"
        <a href=\"$topic\" style=\"color:#3498DB\"><p> SPORT </p> </a>     
        <br>
        ";

        if ($linkEditore=="http://www.gedispa.it/"){
        echo "<p> <a href=\"$linkEditore\">G.E.D.I.</a></p>
        </div>
        </div>";
        }
        if ($linkEditore=="https://www.seif-spa.it/"){
        echo "<p> <a href=\"$linkEditore\">SOCIETA' EDITORIALE IL FATTO</a></p>
            </div>
            </div>";
        }
        if ($linkEditore=="https://www.rcsmediagroup.it/"){
        echo "<p> <a href=\"$linkEditore\">RCS GROUP</a></p>
            </div>
            </div>";
        }
        if ($linkEditore=="https://www.informazione-aziende.it/Azienda_ROMEO-EDITORE-SRL"){
        echo "<p> <a href=\"$linkEditore\">ROMEO EDITORIALE</a></p>
            </div>
            </div>";
        }
        } 


        } // fine WHILE

   

}
    ?>



</div>
						<!-- /blog comments -->

					</div>
				</main>
				<!-- /Main -->


				<!-- Aside -->
				<aside id="aside" class="col-md-3">

					<!-- Search -->
					<div class="widget">
						<div class="widget-search">
					
						</div>
					</div>
					<!-- /Search -->

					



				</aside>
				<!-- /Aside -->

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</div>
	<!-- /Blog -->

	<!-- Footer -->
	<footer id="footer" class="sm-padding bg-dark">

		<!-- Container -->
		<div class="container">
				<img class="img-responsive center-block" src="img/semanticWeb.png" alt="logo" height="30" width="30">
                <p></p>

			<!-- Row -->
			<div class="row">

				<div class="col-lg-12">

					
					<!-- footer copyright -->
					<div class="footer-copyright">
                    <p>Copyright © 2020. All Rights Reserved. Designed by Alfonso Del Gaizo, Rosa Ferraioli & Francesca Festa</p>
					</div>
					<!-- /footer copyright -->

				</div>

			</div>
			<!-- /Row -->

		</div>
		<!-- /Container -->

	</footer>
	<!-- /Footer -->

	<!-- Back to top -->
	<div id="back-to-top"></div>
	<!-- /Back to top -->



    </body>

    </html>
