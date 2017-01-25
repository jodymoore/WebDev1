<?php
   require("../includes/config.php");
   include('simple_html_dom.php');
   
   $imageUrl = "";
   // Create DOM from URL or file
   $html = file_get_html('http://hometracks.nascar.com/series/KN-Pro-Series-West');

   // loop thru find image src that matches $pattern 
   foreach($html->find('img') as $element) {      
       $subject = $element->src;
       $href = $element->href;
       $pattern = '/racecentral-/';
       if (preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE)) {
           $imageUrl = $subject;
       } 
   }

   if($imageUrl === "") {
       $imageUrl = "img/comingSoon.jpg";
   }
   else{
       $imageUrl = "http://hometracks.nascar.com".$imageUrl;
   }
     
   render("colerouse.php", ['imageUrl' => $imageUrl, 'href' => $href]); 
?>
