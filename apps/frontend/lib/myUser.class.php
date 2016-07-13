<?php
//overrides the default symfony base sfUser class with applicaation specific behaviors
class myUser extends sfBasicSecurityUser
{

  public function addJobToHistory(JobeetJob $job)
  {
    //get jobs that is already saved in job history
    $ids=$this->getAttribute('job_history', array());
    //Check whether the id is already in the history
    if(!in_array($job->getId(), $ids))
    {
      //Add current job to the beginning of the array
      array_unshift($ids, $job->getId());

      //Save new job history again into session
      //the latest 3 jobs will be shown to user
      $this->setAttribute('job_history', array_slice($ids, 0, 3));
    }
  }

  public function getJobHistory()
  {
    $ids=$this->getAttribute('job_history', array());

    if (!empty($ids))
    {
      return Doctrine_Core::getTable('JobeetJob')
        ->createQuery('a')
        ->whereIn('a.id', $ids)
        ->execute()
      ;
    }

    return array();
  }

  public function resetJobHistory()
  {
    //remove() does not have sfUser proxy method. Need to use parameter holder object directly
    $this->getAttributeHolder()->remove('job_history');
  }

  //Day 19
  public function isFirstRequest($boolean = null)
  {
    if (is_null($boolean))
    {
      return $this->getAttribute('first_request', true);
    }

    $this->setAttribute('first_request', $boolean);
  }
}
