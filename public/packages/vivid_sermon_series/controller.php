<?php       

namespace Concrete\Package\VividSermonSeries;
use Package;
use BlockType;

defined('C5_EXECUTE') or die(_("Access Denied."));

class Controller extends Package
{

    protected $pkgHandle = 'vivid_sermon_series';
    protected $appVersionRequired = '5.7.1';
    protected $pkgVersion = '1.0';
    
    
    
    public function getPackageDescription()
    {
        return t("Add a Series of Sermons to your Site");
    }

    public function getPackageName()
    {
        return t("Sermon Series");
    }
    
    public function install()
    {
        $pkg = parent::install();
        BlockType::installBlockTypeFromPackage('vivid_sermon_series', $pkg); 
        
    }
}
?>