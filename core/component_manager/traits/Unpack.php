<?php

namespace core\component_manager\traits;


trait Unpack
{
    /**
     * @param string $url
     * @param string $path
     * @return bool
     */
   public function unpack(string $url, string $path): bool
   {
       $zip = new \ZipArchive();
       if($zip->open(ROOT_DIR  . $url) === TRUE){
           $zip->extractTo(ROOT_DIR . $path);
           $zip->close();
           return true;
       } else {
           return false;
       }
   }
}