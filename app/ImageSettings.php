<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Image;

class ImageSettings extends Model
{

   

    ////////////////////////////
    // Profile Upload Options //
    ////////////////////////////
    protected $prefix = 'public/';
    protected $profilePicsPath      = "uploads/users/";
	protected $profilePicsThumbnailpath = "uploads/users/thumbnail/";
    protected $thumbnailSize = 50;
    protected $profilePicSize = 140;
    protected $defaultProfilePicPath           = "uploads/users/default.png";
    protected $defaultprofilePicsThumbnailpath = "uploads/users/thumbnail/default.png";
	protected $settingsImagePath = "/uploads/settings/";



    ///////////////////////////////////
    // Bank Image //
    ///////////////////////////////////
    protected $bankLogosPath      = "uploads/banks/";
    protected $bankLogosThumbnailpath = "uploads/banks/thumbnail/";


    ///////////////////////////////////
    // Image Question upload options //
    ///////////////////////////////////
    protected $examImagepath                = "uploads/exams/";
    protected $examImageSize                = 600;
    protected $examMaxFileSize              = 10000;

    protected $qualificationPath  = "uploads/qualification/";
   

    protected $signaturePath  = "uploads/signature/";
   


    protected $defaultAuctionImagePath           = "uploads/auctions/default.png";
    protected $defaultAuctionImageThumbnailpath  = "uploads/auctions/thumbnail/default.png";


    protected $auctionImagesPath           = "uploads/auctions/";
    protected $auctionImagesThumbnailpath  = "uploads/auctions/thumbnail/";

    protected $auctionThumbnailSize = 125;
    protected $auctionImageSize     = 300; 



    protected $englishSaleNoticePath           = "uploads/english_sale_notice/";
    protected $vernacularSaleNoticePath        = "uploads/vernacular_sale_notice/";
    protected $annexure2Path                   = "uploads/annexure_2/";



    protected $bidSignaturesPath      = "uploads/bid_signatures/";
    protected $bidSignaturesThumbnailpath = "uploads/bid_signatures/thumbnail/";


    protected $defaultCompanyLogoPath           = "uploads/company-logos/default.png";
    protected $defaultCompanyLogoThumbnailpath = "uploads/company-logos/thumbnail/default.png";

    protected $companyLogoPath      = "uploads/company-logos/";
    protected $companyLogoThumbnailpath = "uploads/company-logos/thumbnail/";

    function __construct() {
        $server_software = ! empty($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : '';
        if ( ! empty( $server_software ) ) {
            if(strpos($server_software, 'nginx') !== false){
                $this->prefix = '';
            }
        }

     }

    /**
     * If Needed can change the Profile Pics Path
     * @param [string] $path [description]
     * @return  void
     */
    

    public function setProfilePicsPath($path)
	{
		$this->profilePicsPath = $path;
	}
    
    /**
     * Returns the Profile Pics Path
     * @return [string] [description]
     */
    public function getDefaultProfilePicPath()
    {
        return $this->prefix . $this->defaultProfilePicPath;
    }

      /**
     * Returns the Profile Pics Path
     * @return [string] [description]
     */
    public function getDefaultprofilePicsThumbnailpath()
    {
        return $this->prefix . $this->defaultprofilePicsThumbnailpath;
    }


    /**
     * Returns the Profile Pics Path
     * @return [string] [description]
     */
    public function getProfilePicsPath()
    {
        return $this->prefix . $this->profilePicsPath;
    }

    /**
     * Returns the Profile Thumbnail Path
     * @return [string] [description]
     */
    public function getProfilePicsThumbnailpath()
    {
        return $this->prefix . $this->profilePicsThumbnailpath;
    }

     /**
     * Returns the Qualification Pics Path
     * @return [string] [description]
     */
    public function getQualificationPath()
    {
        return $this->prefix . $this->qualificationPath;
    }

    /**
     * Returns the Qualification Thumbnail Path
     * @return [string] [description]
     */
    /*public function getQualificationThumbnailpath()
    {
        return $this->qualificationThumbnailPath;
    }
*/

    /**
     * Returns the Signature Pics Path
     * @return [string] [description]
     */
    public function getSignaturePath()
    {
        return $this->prefix . $this->signaturePath;
    }

    /**
     * Returns the Signature Thumbnail Path
     * @return [string] [description]
     */
    /*public function getSignatureThumbnailpath()
    {
        return $this->signatureThumbnailPath;
    }*/



    /**
     * Returns the Thumbnail size
     * @return [numeric] [description]
     */
    public function getThumbnailSize()
    {
        return $this->thumbnailSize;
    }

    /**
     * Returns the Profile Pic size
     * @return [numeric] [description]
     */
    public function getProfilePicSize()
    {
    	return $this->profilePicSize;
    }

    /**
     * If needed can change the Thumb size
     * @param [Integer] $size [description]
     * @return  void [<description>]
     */
    public function setThumbnailSize($size)
    {
    	$this->thumbnailSize = $size;
    }

  
    public function getExamImagePath()
    {
        return $this->prefix . $this->examImagepath;
    }

    public function getExamImageSize()
    {
        return $this->examImageSize;
    }

    public function getExamMaxFilesize()
    {
        return $this->examMaxFileSize;
    }

    public function getSettingsImagePath()
    {
        return $this->prefix . $this->settingsImagePath;
    }


    /**
     * Set Bank Logos Path
     * @return [string] [description]
     */
    public function setBankLogoPath($path)
    {
        $this->bankLogosPath = $path;
    }

    /**
     * Returns the Bank Logos Path
     * @return [string] [description]
     */
    public function getBankLogosPath()
    {
        return $this->prefix . $this->bankLogosPath;
    }

     /**
     * Returns the Bank logo Thumbnail Path
     * @return [string] [description]
     */
    public function getBankLogosThumbnailpath()
    {
        return $this->prefix . $this->bankLogosThumbnailpath;
    }




    /**
     * Returns the Default Auction Image Path
     * @return [string] [description]
     */
    public function getDefaultAuctionImagePath()
    {
        return $this->prefix . $this->defaultAuctionImagePath;
    }

      /**
     * Returns the Default Auction thumbnail Image path
     * @return [string] [description]
     */
    public function getDefaultAuctionImageThumbnailpath()
    {
        return $this->prefix . $this->defaultAuctionImageThumbnailpath;
    }



    /**
     * Returns the Auction Image Path
     * @return [string] [description]
     */
    public function getAuctionImagePath()
    {
        return $this->prefix . $this->auctionImagesPath;
    }

     /**
     * Returns the Auction Image Thumbnail Path
     * @return [string] [description]
     */
    public function getAuctionImageThumbnailpath()
    {
        return $this->prefix . $this->auctionImagesThumbnailpath;
    }


    /**
     * Returns the Auction Image size
     * @return [numeric] [description]
     */
    public function getAuctionImageSize()
    {
        return $this->auctionImageSize;
    }




     /**
     * Returns the Thumbnail size
     * @return [numeric] [description]
     */
    public function getAuctionThumbnailSize()
    {
        return $this->auctionThumbnailSize;
    }




     /**
     * Returns the Property English Sale Notice Document Path
     * @return [string] [description]
     */
    public function getEnglishSaleNoticePath()
    {
        return $this->prefix . $this->englishSaleNoticePath;
    }



    /**
     * Returns the Property Vernacular Sale Notice Document Path
     * @return [string] [description]
     */
    public function getVernacularSaleNoticePath()
    {
        return $this->prefix . $this->vernacularSaleNoticePath;
    }



     /**
     * Returns the Property Annexure || Document Path
     * @return [string] [description]
     */
    public function getAnnexure2Path()
    {
        return $this->prefix . $this->annexure2Path;
    }



     /**
     * Returns the Profile Pics Path
     * @return [string] [description]
     */
    public function getBidSignaturesPath()
    {
        return $this->prefix . $this->bidSignaturesPath;
    }

    /**
     * Returns the Profile Thumbnail Path
     * @return [string] [description]
     */
    public function getBidSignaturesThumbnailpath()
    {
        return $this->prefix . $this->bidSignaturesThumbnailpath;
    }


     /**
     * Returns the Default Company Logo Path
     * @return [string] [description]
     */
    public function getDefaultCompanyLogoPath()
    {
        return $this->prefix . $this->defaultCompanyLogoPath;
    }

      /**
     * Returns the Default Company Logo Thumbnail Path
     * @return [string] [description]
     */
    public function getDefaultCompanyLogoThumbnailpath()
    {
        return $this->prefix . $this->defaultCompanyLogoThumbnailpath;
    }


     /**
     * Returns the Company Logo Path
     * @return [string] [description]
     */
    public function getCompanyLogoPath()
    {
        return $this->prefix . $this->companyLogoPath;
    }

    /**
     * Returns the Company Logo Thumbnail Path
     * @return [string] [description]
     */
    public function getCompanyLogoThumbnailpath()
    {
        return $this->prefix . $this->companyLogoThumbnailpath;
    }

}
