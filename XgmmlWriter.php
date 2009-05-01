<?php

/**
 *   PHP Xgmml Writer Class
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


class XgmmlWriter extends XMLWriter {

   /**
    * sets graph background color
    * @param string $element color to declare
    */
    function setXgmmlBackgroundColor($element) {
        $this->_setXgmmlAttribute('string','backgroundColor',$element);
 
    }

   /**
    * initiates some basic graph parameters
    * @param integer $x x coordinate to set center of graph
    * @param integer $y y coordinate to set center of graph
    * @param integer $z z zoome level of graph 
    */
    function setXgmmlGraphView($x,$y,$zoom) {
         $this->_setXgmmlAttribute('real','GRAPH_VIEW_CENTER_X',$x);
         $this->_setXgmmlAttribute('real','GRAPH_VIEW_CENTER_Y',$y);
         $this->_setXgmmlAttribute('real','GRAPH_VIEW_ZOOM',$zoom);
    }

   /**
    * adds a node to the graph 
    * @param string $label node label
    * @param integer $id unique identifier for node
    * @param array $graphattributes graph related node attributes
    * @param array $metaattributes user defined node meta information 
    */
    function addXgmmlNode($label,$id,$graphattributes = array(),$metaattributes = array()) {
         XMLWriter::startElement('node');
         XMLWriter::writeAttribute('label',$label);
         XMLWriter::writeAttribute('id',$id);

         foreach($metaattributes as $key => $value){
                 $this->_setXgmmlAttribute('string',$key,$value);
         }
         $this->_setXgmmlGraphicsAttribute($graphattributes);
         XMLWriter::endElement();
    }

   /**
    * connects two nodes 
    * @param string $label edge label connecting two nodes
    * @param integer $source unique identifier for start node 
    * @param integer $target unique identifier for target node 
    * @param array $graphattributes graph related edge attributes
    * @param array $metaattributes user defined edge meta information 
    */
    function addXgmmlEdge($label,$source,$target,$graphattributes = array(),$metaattributes = array()) {
         XMLWriter::startElement('edge');
         XMLWriter::writeAttribute('label',$label);
         XMLWriter::writeAttribute('source',$source);
         XMLWriter::writeAttribute('target',$target);

         foreach($metaattributes as $key => $value){
                 $this->_setXgmmlAttribute('string',$key,$value);
         }
         $this->_setXgmmlGraphicsAttribute($graphattributes);
         XMLWriter::endElement();
    }

   /**
    * internal variable to set xgmml meta attributes
    * @param string $type
    * @param string $name
    * @param string $value
    */
    function _setXgmmlAttribute($type,$name,$value) {
         XMLWriter::startElement('att');
         XMLWriter::writeAttribute('type',$type);
         XMLWriter::writeAttribute('name',$name);
         XMLWriter::writeAttribute('value',$value);
         XMLWriter::endElement();
    }

   /**
    * internal variable to set xgmml meta attributes
    * @param string $type
    * @param string $name
    * @param string $value
    */
    function _setXgmmlGraphicsAttribute($array) {    
              XMLWriter::startElement('graphics');
              foreach($array as $key => $value){
                      XMLWriter::writeAttribute($key,$value);
              }
              XMLWriter::endElement();
    }


}
?> 
