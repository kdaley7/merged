<?php
function convert_to_xml(SimpleXMLElement $obj, array $array)
{
    $attr = "Attribute_";
     
    foreach ($array as $key => $attribute) {
        
        if (is_array($attribute)) {
            
            $new_obj = $obj->addChild($key);
            
            convert_to_xml($new_obj, $attribute);
        } else {
            
            if(strpos($key, $attr) !== false){
                
                $obj->addAttribute(substr($key, strlen($attr)), $attribute);
            }else{
                
                $obj->addChild($key, $attribute);
            }
        }
    }
}

$test_array = array( array( "name" => "Hulk Hogan", "email" => "HulkHogan3@mail.com", ), array( "name" => "thor odenson", "email" => "godofthunder@mail.com", ), array( "name" => "rupert", "email" => "rupert  @mail.com", ) );

$xml = new SimpleXMLElement('<characters/>');

convert_to_xml($xml, $test_array);
$xml_document=$xml->asXML();

$myfile = fopen("characters.xml", "w");

fwrite($myfile, $xml_document);

fclose($myfile);

