<?php

/**
 * category actions.
 *
 * @package    jobeet
 * @subpackage category
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class categoryActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    $this->category = $this->getRoute()->getObject();

    $this->pager = new sfDoctrinePager('JobeetJob', sfConfig::get('app_max_jobs_on_category') );
    //sfDoctrinePager::setQuery() receive Doctrine_Query object which will be used to select item from database
    $this->pager->setQuery($this->category->getActiveJobsQuery());
    //sfRequest::getParameter() takes the second argument as default value
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
}
