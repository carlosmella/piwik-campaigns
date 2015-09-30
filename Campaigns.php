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

class Campaigns extends \Piwik\Plugin
{

public function getListHooksRegistered(){
		return array(
			'AssetManager.getJavaScriptFiles' => 'getJavaScriptFiles',
			'AssetManager.getStylesheetFiles' => 'getStylesheetFiles');
	}
	public function getJavaScriptFiles(&$files){
		$files[] = "plugins/Campaigns/javascripts/ajaxCampaigns.js";
	}	
	public function getStylesheetFiles(&$files){
		$files[] = "plugins/Campaigns/stylesheets/estilosCampaigns.css";
	}
	public function install() {

        	try {
			$sql = "CREATE TABLE ".Common::prefixTable('campaigns')." (
					id int(6) not null auto_increment primary key,
					nombre varchar(50) not null,
					urlDestino varchar(255) not null,
					url varchar(255) not null
				) default charset=utf8";

       			Db::exec($sql);
        	} catch (Exception $e) {
            		// ignore error if table already exists (1050 code is for 'table already exists')
            		if (!Db::get()->isErrNo($e, '1050')) {
                		throw $e;

            		}
        	}
    }
	
    public function uninstall(){
	Db::dropTables(Common::prefixTable('campaigns'));
    }	


}
