The basic idea behind the project is to distribute networks for visualization. There are few sites online that display networks with meta information on the screen. Those sites are mostly static and do not have the flexibility to adjust the network layout. The aim of the phpXgmml package is to provide you with the possibility to export networks as extended XGMML files and load those into visualization tools like Cytoscape to adjust networks to your likings.

# Introduction #

We would recommend to check out our existing code.
> svn checkout https://phpxgmml.googlecode.com/svn/trunk/ phpxgmml
Run test\_XgmmlWriter.php to test the class. Use the following command to produce a PhpDocumentor file to check and guide any documentation attempts.

> phpdoc -o HTML:frames:earthli -f test\_XgmmlWriter.php,XgmmlWriter.php -t docs

Make modifications and improvements to help us to make phpxgmml more powerful. And commit your changes :)

# ToDo #

  * the plan is to extend XgmmlWriter with a specific Cytoscape class to support webstart of Cytoscape.
  * to add specific features like the type of edges (eg. pp protein-protein) and so on.