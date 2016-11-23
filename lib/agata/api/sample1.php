<?
#+-----------------------------------------------------------------+
#| AGATA Report API (http://www.pablo.blog.br/agata)               |
#| Licensed under GPL: http://www.fsf.org for further details      |
#+-----------------------------------------------------------------+
#| Started in  2001, August, 10                                    |
#| Author: Pablo Dall'Oglio (pablo@dalloglio.net)                  |
#+-----------------------------------------------------------------+
#| Agata Report: A Database reporting tool written in PHP-GTK      |
#| This file shows how to use AgataAPI to generate simple reports  |
#+-----------------------------------------------------------------+

# Include AgataAPI class
include_once '/agata/classes/core/AgataAPI.class';

# Instantiate AgataAPI
$api = new AgataAPI;
$api->setLanguage('en'); //'en', 'pt', 'es', 'de', 'fr', 'it', 'se'
$api->setReportPath('/agata/reports/samples/general/customers.agt');
//$api->setProject('Samples');
$api->setFormat('pdf'); // 'pdf', 'txt', 'xml', 'html', 'csv', 'sxw'
$api->setOutputPath('/tmp/test.pdf');
$api->setLayout('default-PDF');
var_dump($api->GetParameters());
#How to set parameters, if they exist
$api->setParameter('$city', 1);
#$api->setParameter('$personCode', 4);
#$api->setParameter('$personName', "'mary'");
$ok = $api->generateReport();
if (!$ok)
{
    echo $api->getError();
}
else
{
    // opens file dialog
//    $api->fileDialog();
}
?>
