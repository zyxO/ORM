<?php

//require_once 'src/query/Query.php';

require_once 'src/Connection/ConnectionFactory.php';

require_once __DIR__.'/vendor/autoload.php';

use \App\Model\Model;
use \App\Model\Article;
use \App\Query\Query;

$conf = parse_ini_file('src/Connection/config.ini');

\Connection\ConnectionFactory::makeConnection($conf);

$article = new Article(array('id' => 68,'nom' => 'Voiture', 'descr' => 'Une jolie voiture', 'id_categ' => 1));


echo $article->__get('nom');
echo '<br>';
$article->__set('descr', 'voiture jolie Une');
echo $article->__get('descr');
echo '<br>';
echo '<br>';

$article1 = new Article();
$article1->nom = 'fourchette';
$article1->descr = 'vert';
$article1->tarif = 2;
$article1->id_categ = 1;
//echo $article1->insert();

$liste = Article::all();
foreach( $liste as $art) {
echo $art->tarif."\n";

}


$l= $article1::find(69, ['descr','nom']);
print_r($article1 = $l[0]);

/*$query = new Query();
$query = $query::table('article')->where('nom', '=', 'fourchette')->delete();*/