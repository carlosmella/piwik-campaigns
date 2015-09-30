<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\Campaigns;

use Piwik\Db;
use Piwik\Common;
use \Exception;
use Piwik\View;

/**
 * A controller let's you for example create a page that can be added to a menu. For more information read our guide
 * http://developer.piwik.org/guides/mvc-in-piwik or have a look at the our API references for controller and view:
 * http://developer.piwik.org/api-reference/Piwik/Plugin/Controller and
 * http://developer.piwik.org/api-reference/Piwik/View
 */
class DAOCampaign 
{
    public function getCampaings()
    {
	$result = null;
       try{
		$sql = "select * from ".Common::prefixTable("campaigns")." ";
		$result = Db::fetchAll($sql);
	}catch(Exception $e){
		print_r($e);
	}
	return $result;

    }

    public function insertCampaign($urlDestino,$nombre){

	$url = $urlDestino . "?pk_campaign=".urlencode($nombre);
	
	try{
		$sql = "insert into ".Common::prefixTable("campaigns")." values (null,'".urldecode($nombre)."','".$urlDestino."','".$url."') ";
		Db::exec($sql);
	}catch(Exception $e){
		print_r($e);
	}

    }

    public function deleteCampaign($id){
	try{
		$sql = "delete from  ".Common::prefixTable("campaigns")." where id=".$id." ";
		Db::exec($sql);
	}catch(Exception $e){
		print_r($e);
	}
    }

}
