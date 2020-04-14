<?php 
namespace Concrete\Package\VividSermonSeries\Block\VividSermonSeries;
use \Concrete\Core\Block\BlockController;
use Loader;
use File;

class Controller extends BlockController
{
    protected $btTable = 'btVividSermonSeries';
    protected $btInterfaceWidth = "650";
    protected $btWrapperClass = 'ccm-ui';
    protected $btInterfaceHeight = "465";

    public function getBlockTypeDescription()
    {
        return t("Add a Series of Sermons to your Site");
    }

    public function getBlockTypeName()
    {
        return t("Sermon Series");
    }

    public function add()
    {
        $this->requireAsset('core/file-manager');
    }

    public function edit()
    {
        $this->requireAsset('core/file-manager'); 
        
        $db = Loader::db();
        $items = $db->GetAll('SELECT * from btVividSermon WHERE bID = ? ORDER BY sort', array($this->bID));
        $this->set('items', $items);
    }

    public function view()
    {
        $db = Loader::db();
        $items = $db->GetAll('SELECT * from btVividSermon WHERE bID = ? ORDER BY sort', array($this->bID));
        $this->set('items', $items);
        $uh = Loader::helper('concrete/urls');
        $bObj = $this->getBlockObject();       
        $bt=$bObj->getBlockTypeObject();
        $blockURL = $uh->getBlockTypeAssetsURL($bt);
        $this->set("blockURL",$blockURL);
    }

    public function duplicate($newBID) {
        parent::duplicate($newBID);
        $db = Loader::db();
        $v = array($this->bID);
        $q = 'select * from btVividSermon where bID = ?';
        $r = $db->query($q, $v);
        while ($row = $r->FetchRow()) {
            $vals = array($this->bID,$args['sermonTitle'][$i],$args['vidType'][$i],$args['video'][$i],$args['afID'][$i],$args['pdfID'][$i],$args['sort'][$i]);     
            $db->execute('INSERT INTO btVividSermon (bID, sermonTitle, vidType, video, afID, pdfID, sort) values(?,?,?,?,?,?,?)', $vals);
        }
    }

    public function delete()
    {
        $db = Loader::db();
        $db->delete('btVividSermon', array('bID' => $this->bID));
        parent::delete();
    }

    public function save($args)
    {
        $db = Loader::db();
        $db->execute('DELETE from btVividSermon WHERE bID = ?', array($this->bID));
        $count = count($args['sort']);
        $i = 0;
        parent::save($args);
        while ($i < $count) {
            $vals = array($this->bID,$args['sermonTitle'][$i],$args['vidType'][$i],$args['video'][$i],$args['afID'][$i],$args['pdfID'][$i],$args['sort'][$i]);     
            $db->execute('INSERT INTO btVividSermon (bID, sermonTitle, vidType, video, afID, pdfID, sort) values(?,?,?,?,?,?,?)', $vals);
            $i++;
        }
    }
    public function validate($args)
    {
        $e = Loader::helper('validation/error');
        $count = count($args['sort']);
        $i = 0;
        for ($i=0;$i<$count;$i++){
            if(empty($args['sermonTitle'][$i])){
                $e->add(t("you have to at least add a sermon title on item %s",$i+1));
            }
            if(strlen($args['sermonTitle'][$i]>255)){
                $e->add(t("That title is a bit long on item %s. Reduce it below 255 characters",$i+1));
            }
        }
        return $e;
    }
    

}