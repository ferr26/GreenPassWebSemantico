<!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="icon" href="img/walk1.png" type="image/png">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    

        <title>WalkToWalk</title>

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
            
            <div  id="over" class="header-wrapper sm-padding bg-grey">
        <img src="./img/web.png" width="300" height="300">	
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
        $db = sparql_connect( "http://localhost:8890/sparql" );

        $nomeCategoria= $_POST["tipoEnte"];
        $ordine= $_POST["ordine"];


    if($ordine == "dRecente"){
        selectCategoria($nomeCategoria, "DESC");
    }      

    if($ordine == "dLontana"){
        selectCategoria($nomeCategoria, "ASC");
    }
    
    function selectCategoria($nomeCategoria, $ordine){
        $sparql = "SELECT DISTINCT *  WHERE {
            ?x ww:originalTitle ?originalTitle .
            ?x dc:date ?date .
            ?x js:birthName ?birthName.
            ?x dc:language ?language .
            ?x rdf:type ?type .
            ?x dc:format ?format .
            ?x np:Newspaper ?newspaper .
            ?x np:publisher ?publisher .
            ?x np:associateEditor ?associateEditor .
            ?associateEditor foaf:name ?name .
            ?x foaf:primaryTopic ?primaryTopic  .
            Filter (REGEX(?primaryTopic,'$nomeCategoria'))    
    }
    ORDER BY $ordine(?date)";

    $result = sparql_query( $sparql ); 
    if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

    $fields = sparql_field_array( $result );


    

  //  print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
   
  //print "<table class='example_table'>";
   // print "<tr>";
    
   
    while( $row = sparql_fetch_array( $result ) )
    {    echo "
        <div class=\"media\">
        <div class=\"media-left\">
        <img class=\"media-object\" src=\"./img/giornali.png\" alt=\"\" width=\"70\" height=\"70\">
        </div>
        <div class=\"media-body\">";
          
    foreach( $fields as $field )
    {
      //  echo("$field : $row[$field]");

         if($field == "originalTitle"){
             echo("<h4 class=\"media-heading\">$row[$field]         
            <span class=\"time\"> </span></h4>");
         } else if($field == "x"){
            echo("<div> <h4>Link dell'Articolo <a href=$row[$field]><i class=\"fa fa-external-link\" style=\" font-size:23px; color:#1ac6ff\"></i> </a>
            <span class=\"time\"> </span></h4>");
         }else if($field == "date"){
            echo("$row[$field] </div>");
         }else if($field == "birthName"){
            echo("$row[$field]");
         } else if($field == "newspaper"){
            echo("<a href=$row[$field]>$row[$field]</a>");
         }else if($field == "publisher"){
            echo("<br> $row[$field]");
         } else if($field == "primaryTopic"){
            echo("<br> $row[$field]");
         } 




     }
     echo"</div>";

    }
    echo"</div>";

    }

   
                            
                            ?>

                            </div>
                            <!-- /blog comments -->

                        </div>
                    </main>
                    <!-- /Main -->


                    <!-- Back to top -->
        <div id="back-to-top"></div>
        <!-- /Back to top -->



        </body>

        </html>