<?php
/**
 *   PHP Xgmml Writer Test code
 *
 *   @author Jan Wildenhain 
 *   @version 0.1
 *   @package phpXgmmlWriter
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 *   This program is distributed in the hope that it will be useful,
 *   but WITHOUT ANY WARRANTY; without even the implied warranty of
 *   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *   GNU General Public License for more details.
 */


/**
 * Class Xgmml Writer is called
 */
include_once('XgmmlWriter.php');

//@date_default_timezone_set("GMT");

$writer = new XgmmlWriter();
// Output directly to the user

#$writer->openURI('php://output');
$writer->openMemory();

$writer->startDocument('1.0',"utf-8","yes");

$writer->setIndent(4);

$writer->startElement('graph');
$writer->writeAttribute('label', 'GeneNet');
$writer->writeAttribute('xmlns:dc', 'http://purl.org/dc/elements/1.1/');
$writer->writeAttribute('xmlns:xlink',"http://www.w3.org/1999/xlink");
$writer->writeAttribute('xmlns:rdf', "http://www.w3.org/1999/02/22-rdf-syntax-ns#");
$writer->writeAttribute('xmlns:cy', "http://www.cytoscape.org"); 
$writer->writeAttribute('xmlns', "http://www.cs.rpi.edu/XGMML");

$writer->startElement('att');
# can be skipped
$writer->writeAttribute('name', 'documentVersion');
$writer->writeAttribute('value', '1.1');
$writer->endElement(); 
# important
$writer->startElement('att');
  $writer->writeAttribute('name', 'networkMetadata');
  $writer->startElement('rdf:RDF');
    $writer->startElement('rdf:Description');
    $writer->writeAttribute('rdf:about', 'http://www.cytoscape.org/');
        $writer->writeElement('dc:type', 'Gene Interaction Network'); 
        $writer->writeElement('dc:description', 'N/A'); 
        $writer->writeElement('dc:identifier', 'N/A'); 
        $writer->writeElement('dc:date','2009-04-23 13:42:54');
        $writer->writeElement('dc:title','Prohits Report');
        $writer->writeElement('dc:source','http://www.cytoscape.org/');
        $writer->writeElement('dc:format','Cytoscape-XGMML');
    // end rdf:Description
    $writer->endElement();
  // end rdf:RDF
  $writer->endElement();

// end att for NetworkMetadata
$writer->endElement(); 

$writer->setXgmmlBackgroundColor("#ccccff");
$writer->setXgmmlGraphView(400,400,1.0);

// add nodes

$nodeattributes = array("Gene Name" => "drs1",
                        "Gene ID" => "drs1",
                        "Frequency" => "" );

$nodegraphicsettings = array("type" => "ELLIPSE",
                             "h" => 10,
                             "w" => 10,
                             "x" => 0,
                             "y" => 0,
                             "fill"=>"#ffffff",
                             "width"=> "1",
                             "outline" => "#666666",
                             "cy:nodeTransparency"=> "1.0",
                             "cy:nodeLabelFont" => "SansSerif.bold-0-12",
                             "cy:borderLineType"=> "solid"
);

$writer->addXgmmlNode(62738050,1,$nodegraphicsettings,$nodeattributes);

$nodeattributes = array("Gene Name" => "Tor1",
                        "Gene ID" => "Tor1",
                        "Frequency" => "" );

$writer->addXgmmlNode("Tor1",2,$nodegraphicsettings,$nodeattributes);

$edgeattributes = array ("Hit Score"=>"633");

$edgegraphicsettings = array("width"=>"1", "fill"=>"#0000b9", "cy:sourceArrow"=>"0", "cy:targetArrow"=>"1", "cy:sourceArrowColor"=>"#0000b9", "cy:targetArrowColor"=>"#0000b9", "cy:edgeLabelFont"=>"Default-0-10", "cy:edgeLineType"=>"SOLID", "cy:curved"=>"STRAIGHT_LINES");


$writer->addXgmmlEdge("test drs1 -- tor1",1,2,$edgegraphicsettings,$edgeattributes);

$writer->endDocument();

$webstartDir = "tmp/";
if(!is_dir($webstartDir)) mkdir($webstartDir);

$filename_out = $webstartDir."_jan_test.xgmml";
$handle_write = fopen($filename_out, "w");


fwrite($handle_write,$writer->outputMemory());
fclose($handle_write);

$writer->flush();

?>
