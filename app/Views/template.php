<?php 

echo view('header');
echo view($pageName, $pageData);
// print_r($pageData);
echo view('footer');

?>