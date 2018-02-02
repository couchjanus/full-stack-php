<?php
class Breadcrumb
{
   private $breadcrumb;

   private $separator = ' / ';

   private $domain = DOMAIN;

   public function build($array)
   {
      $breadcrumbs = array_merge(array('Home' => ''), $array);

      $count = 0;

      foreach($breadcrumbs as $title => $link) {
         $this->breadcrumb .= '
         <span itemscope="" itemtype="">
            <a href="'.$this->domain. '/'.$link.'" itemprop="url">
               <span itemprop="title">'.$title.'</span>
            </a>
         </span>';

         $count++;

         if($count !== count($breadcrumbs)) {
            $this->breadcrumb .= $this->separator;
         }
      }
      return $this->breadcrumb;
   }
}
