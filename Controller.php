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
class Controller extends \Piwik\Plugin\Controller
{
    public function index()
    {
	$dao = new DAOCampaign();
	$campaings = $dao->getCampaings();

	$view = new View('@Campaigns/index');
	$this->setBasicVariablesView($view);
	$view->campañas = $campaings;
	return $view->render();

    }

    public function insertarCampanha(){
	$urlDestino = urldecode(Common::getRequestVar('url'));
	$nombre = Common::getRequestVar('nombre');
	$dao = new DAOCampaign();
	$dao->insertCampaign($urlDestino,$nombre);


	return $this->index();
    }

    public function eliminarCampanha(){
	$id = Common::getRequestVar('id');
	$dao = new DAOCampaign();
	$dao->deleteCampaign($id);

	return $this->index();
    }

}
