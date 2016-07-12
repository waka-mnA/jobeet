<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetJobForm extends BaseJobeetJobForm
{
  public function configure()
  {
    //Fields that end user must not edit
    //delete field from form. This will delete both widget and validator
    $this->removeFields();
    //Change the email validator from validatorString
    $this->validatorSchema['email'] = new sfValidatorEmail();
    // Or add new one to existing schema
    // $this->validatorSchema['email']= new sfValidatorAnd(array(
    //   $this->validatorSchama['email'],
    //   new sfValidatorEmail(),
    // ));

    //Add hidden field and use the fields in array to change the order of them
    // $this->useFields(array('category_id', 'type', 'company', 'logo', 'url', 'position', 'location', 'description', 'how_to_apply', 'token', 'is_public', 'email'));

    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
       'choices'  => Doctrine_Core::getTable('JobeetJob')->getTypes(),
       'expanded' => true,
     ));
     $this->validatorSchema['type'] = new sfValidatorChoice(array(
       'choices' => array_keys(Doctrine_Core::getTable('JobeetJob')->getTypes()),
     ));

    $this->widgetSchema['logo'] = new sfWidgetFormInputFile(array(
      'label' => 'Company logo',
    ));

    $this->widgetSchema->setLabels(array(
      'category_id'    => 'Category',
      'is_public'      => 'Public?',
      'how_to_apply'   => 'How to apply?',
    ));

    $this->validatorSchema['logo'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/jobs',
      'mime_types' => 'web_images',
    ));

    $this->widgetSchema->setHelp('is_public', 'Whether the job can also be published on affiliate websites or not.');

    $this->widgetSchema->setNameFormat('job[%s]');

//if true,can avoid the security issue regarding the additional form field
//if false, the token value can be retrieved
    $this->validatorSchema->setOption('allow_extra_fields', false);
  }
  protected function removeFields()
  {
    unset(
      $this['created_at'], $this['updated_at'],
      $this['expires_at'], $this['is_activated'],
      $this['token']
    );
  }

}
