<?php
require_once( "lib/sparqllib.php" );
 
$db = sparql_connect( "http://dbpedia.org/" );
if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
sparql_ns( "rooms","http://vocab.deri.ie/rooms#" );
 
$sparql = "SELECT DISTINCT ?Concept WHERE {[] a ?Concept} LIMIT 100";
$result = sparql_query( $sparql ); 
if( !$result ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }
 
$fields = sparql_field_array( $result );
 
print "<p>Number of rows: ".$result." results.</p>";

?>