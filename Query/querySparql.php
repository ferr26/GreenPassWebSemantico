<?php
require_once( "lib/sparqllib.php" );
 
$db = sparql_connect( "http://localhost:8890/sparql" );



selectQuotidiano("Roberto Saviano");



function selectQuotidiano($nomeQuotidiano){

$sparql = "SELECT DISTINCT *  WHERE {
                           ?x foaf:primaryTopic ?primaryTopic  .
                           ?x dc:language ?language .
                           ?x rdf:type ?type .
                           ?x dc:format ?format .
                           ?x ww:originalTitle ?originalTitle .
                           ?x np:publisher ?publisher .
                           ?x dc:date ?date .
                           ?x np:Newspaper ?newspaper .
                           ?x np:associateEditor ?associateEditor .
                           ?associateEditor foaf:name ?name .
                           ?x js:birthName ?birthName.
            }
            ORDER BY ASC(?date)";

 $sparqlQueryNeswpaper = "SELECT DISTINCT *  WHERE {
                           ?x foaf:primaryTopic ?primaryTopic  .
                           ?x dc:language ?language .
                           ?x rdf:type ?type .
                           ?x dc:format ?format .
                           ?x ww:originalTitle ?originalTitle .
                           ?x np:publisher ?publisher .
                           ?x dc:date ?date .
                           ?x np:Newspaper ?newspaper .
                           ?x np:associateEditor ?associateEditor .
                           ?associateEditor foaf:name ?name .
                           ?x js:birthName ?birthName.
                           Filter (REGEX(?newspaper,'https://www.repubblica.it/index.html'))                   
            }";


$sparqlQueryTopic = "SELECT DISTINCT *  WHERE {
                            ?x foaf:primaryTopic ?primaryTopic  .
                            ?x dc:language ?language .
                            ?x rdf:type ?type .
                            ?x dc:format ?format .
                            ?x ww:originalTitle ?originalTitle .
                            ?x np:publisher ?publisher .
                            ?x dc:date ?date .
                            ?x np:Newspaper ?newspaper .
                            ?x np:associateEditor ?associateEditor .
                            ?associateEditor foaf:name ?name .
                            ?x js:birthName ?birthName.
                            Filter (REGEX(?primaryTopic,'http://www.treccani.it/vocabolario/economia/'))    
                        }";
 

$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

$fields = sparql_field_array( $result );

print "<p>Number of rows: ".sparql_num_rows( $result )." results.</p>";
print "<table class='example_table'>";
print "<tr>";
foreach( $fields as $field )
{
	print "<th>$field</th>";
}
print "</tr>";
while( $row = sparql_fetch_array( $result ) )
{
	print "<tr>";
	foreach( $fields as $field )
	{
		print "<td>$row[$field]</td>";
	}
	print "</tr>";
}
print "</table>";
}
?>
 