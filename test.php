<?php

// Make an annotation on a PDF based on text position
// Needs mutools

require_once(dirname(__FILE__) . '/hypothesis.php');


//----------------------------------------------------------------------------------------
// Get PDF fingerprint
function get_pdf_fingerprint($filename)
{
	$fingerprint = '';

	$command = "mutool show '" . $filename . "'";
	$output = array();
	$return_var = 0;
	exec($command, $output, $return_var);

	print_r($output);
	
	$id_one = $id_two = '';
	
	// fingerprint of document
	// /ID[<1DF5C424B06409960AD7E8C67DC4DC9D><C10EFB2E302C62F886DC2F4C11E8492C>]
	foreach ($output as $line)
	{
	
		if (preg_match('/\/ID\s*\[\s*\<(?<one>[^\>]+)\>\s*\<(?<two>[^\>]+)\>\s*\]/', $line, $m))
		{
			$id_one = $m['one'];
			$id_two = $m['two'];
		}

	}	
	
	if ($id_one != '')
	{
		$fingerprint = 'urn:x-pdf:' . strtolower($id_one);
	}

	return $fingerprint;
	
}

//----------------------------------------------------------------------------------------

// file and identifiers
$filename 	= 'ZK_article_71171_en_1.pdf';
$url 		= 'https://zookeys.pensoft.net/article/71171/';
$doi 		= '10.3897/zookeys.1062.71171';

$uri = get_pdf_fingerprint($filename);

echo $uri . "\n";

 
// Create an annotation
$a = new Annotation($uri);

// Link it to my account
$a->add_permissions("acct:rdmpage@hypothes.is");

// Add DOI
$a->set_doi($doi);

// DOI as identifier
$a->add_identifier("doi:" . $doi);
 
// Annotation anchors based on text position

/*
// surrounding text
$a->add_text_quote(
'Nanhaipotamon longhaiense sp. nov.',
'e herein describe a new species,',
' Materials and methods Specimens'
);	

// position in text stream from PDF
$a->add_text_position(3328, 3362);
*/

// surrounding text
$a->add_text_quote(
'Nanhaipotamon longhaiense sp. nov.',
', 1896 Nanhaipotamon Bott, 1968 ',
' http://zoobank.org/E25133A7-AB4A'
);	

// position in text stream from PDF
$a->add_text_position(7924, 7958);


// Dump annotation
print_r($a->data);

// Create annotation	
$result = hypothesis_create_annotation($a->data);
print_r($result);

	
?>

