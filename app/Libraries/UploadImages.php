<?php

namespace App\Libraries;


use Image;
use phpDocumentor\Reflection\Types\Self_;

class UploadImages
{
    /**
     * Uploads Paths
     */
    const UPLOADS_PATH = __DIR__ . '/../../public/uploads/';

    const PROFILE_IMAGES_PATH = self::UPLOADS_PATH . 'profile/';
    const DRIVERSDATA_IMAGES_PATH = self::UPLOADS_PATH . 'driversData/';
    const Product_IMAGES_PATH = self::UPLOADS_PATH . 'product/';
    const Category_IMAGES_PATH = self::UPLOADS_PATH . 'category/';
    const General_IMAGES_PATH = self::UPLOADS_PATH . 'general/';
    const Ads_IMAGES_PATH = self::UPLOADS_PATH . 'ads/';
    const BRANDS_IMAGES_PATH = self::UPLOADS_PATH . 'brand/';


    /**
     * Get Upload Path By Type
     * @param $type
     * @return mixed
     */
    public static function getPathByType($type){
        $paths = [
            'profile' => self::PROFILE_IMAGES_PATH,
            'product' => self::Product_IMAGES_PATH,
            'category' => self::Category_IMAGES_PATH,
            'general' => self::General_IMAGES_PATH,
            'ads' => self::Ads_IMAGES_PATH,
            'brand' => self::BRANDS_IMAGES_PATH,
            'driver' => self::DRIVERSDATA_IMAGES_PATH,
        ];
        return $paths[$type];
    }

    /**
     * Upload Image By Type
     * @param $type
     * @param $image
     * @return string
     */
   /*public static function upload($type, $image)
    {
        $extension = $image->getClientOriginalExtension();
        $destinationPath = self::getPathByType($type) ;
        $imageName = time() . rand() .'.' . $extension;
        $image->move($destinationPath,$imageName);
        return $imageName;
    }*/

   public static function upload($type,$image)
   {
       $extension = $image->getClientOriginalExtension();
       $destinationPath = self::getPathByType($type) ;
       $imageName = time() . rand() .'.' . $extension;
       $img = Image::make($image->getRealPath());
       $img->fit(800)->save($destinationPath.'/'.$imageName);
       return $imageName;
   }


    public static function  fullUrl($image,$type)
    {
        $result='uploads/'.$type.'/'.$image;
        return $result;
    }

}
