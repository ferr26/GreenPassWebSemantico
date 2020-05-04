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
            
            <div  id="over" class="header-wrapper sm-padding bg-grey">
        <img src="./img/semanticWeb.png" width="170" height="170">	
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


        echo"$autore";

        selectAutore($autore);

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

        print"<h3 class=\"title\">RISULTATI (".sparql_num_rows( $result ).") </h3>";


        
    while( $row = sparql_fetch_array( $result ) )
    {    
        
      
        foreach( $fields as $field ){

           if($field == "birthDate"){
                $anno=$row[$field];      
           } else if($field == "name"){
                 $name=$row[$field];
           }else if ($field == "gender"){
            $gender=$row[$field];
           }else if ($field == "federation"){
            $federation=$row[$field];
           }


        }

        echo "
             $anno $name $gender $federation <br>";
   

    }
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
				<img class="img-responsive center-block" src="img/walk1.png" alt="logo" height="90" width="90">

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