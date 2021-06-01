<?php

require_once 'honoreebyurl.civix.php';
// phpcs:disable
use CRM_Honoreebyurl_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function honoreebyurl_civicrm_config(&$config) {
  _honoreebyurl_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function honoreebyurl_civicrm_xmlMenu(&$files) {
  _honoreebyurl_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function honoreebyurl_civicrm_install() {
  _honoreebyurl_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function honoreebyurl_civicrm_postInstall() {
  _honoreebyurl_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function honoreebyurl_civicrm_uninstall() {
  _honoreebyurl_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function honoreebyurl_civicrm_enable() {
  _honoreebyurl_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function honoreebyurl_civicrm_disable() {
  _honoreebyurl_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function honoreebyurl_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _honoreebyurl_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function honoreebyurl_civicrm_managed(&$entities) {
  _honoreebyurl_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function honoreebyurl_civicrm_caseTypes(&$caseTypes) {
  _honoreebyurl_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function honoreebyurl_civicrm_angularModules(&$angularModules) {
  _honoreebyurl_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function honoreebyurl_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _honoreebyurl_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function honoreebyurl_civicrm_entityTypes(&$entityTypes) {
  _honoreebyurl_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function honoreebyurl_civicrm_themes(&$themes) {
  _honoreebyurl_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function honoreebyurl_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
//function honoreebyurl_civicrm_navigationMenu(&$menu) {
//  _honoreebyurl_civix_insert_navigation_menu($menu, 'Mailings', array(
//    'label' => E::ts('New subliminal message'),
//    'name' => 'mailing_subliminal_message',
//    'url' => 'civicrm/mailing/subliminal',
//    'permission' => 'access CiviMail',
//    'operator' => 'OR',
//    'separator' => 0,
//  ));
//  _honoreebyurl_civix_navigationMenu($menu);
//}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function honoreebyurl_civicrm_buildForm($formName, &$form) {
  // On first build of main form, retrieve soft-credit params from URL and store in session.
  if ($formName === 'CRM_Contribute_Form_Contribution_Main' && !$form->_flagSubmitted){
    CRM_Core_Session::singleton()->set('honoreebyurl_sctype', CRM_Utils_Request::retrieve('sctype', 'Integer'));
    CRM_Core_Session::singleton()->set('honoreebyurl_sccid', CRM_Utils_Request::retrieve('sccid', 'Integer'));
  }
  if (
    $formName === 'CRM_Contribute_Form_Contribution_Main'
    || $formName === 'CRM_Contribute_Form_Contribution_Confirm'
    || $formName === 'CRM_Contribute_Form_Contribution_ThankYou'
  ) {
    CRM_Core_Resources::singleton()->addVars('honoreebyurl', ['a' => 'A']);
    _honoreebyurl_inject_sc_message($form);
  }
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_buildForm/
 */
function honoreebyurl_civicrm_postProcess($formName, &$form) {
  // If CRM_Contribute_Form_Contribution_Confirm and the sctype and sccid settings exist
  if ($formName === 'CRM_Contribute_Form_Contribution_Confirm' && (CRM_Core_Session::singleton()->get('honoreebyurl_sctype') && CRM_Core_Session::singleton()->get('honoreebyurl_sccid'))) {
    $sctype = CRM_Core_Session::singleton()->get('honoreebyurl_sctype');
    $sccid = CRM_Core_Session::singleton()->get('honoreebyurl_sccid');

    // Create ContributionSoft for the sctype and sccid with amount and contribution id
    $results = \Civi\Api4\ContributionSoft::create()
      ->addValue('contribution_id', $form->_contributionID)
      ->addValue('contact_id', $sccid)
      ->addValue('amount', $form->_amount)
      ->addValue('soft_credit_type_id', $sctype)
      ->execute();
  }
}

/**
 * Inject a user-visible mesdsage regarding the soft credit.
 *
 * @param Object $form The civicrm form object on which we're injecting the message.
 */
function _honoreebyurl_inject_sc_message($form) {
  $formKey = $form->controller->_key;
  $messageVarName = 'honoreebyurl_sc_message_'. $formKey;
  $scMessage = CRM_Core_Session::singleton()->get($messageVarName);
  if (!$scMessage) {
    // Get the sctype and sccid from session.
    $sctype = CRM_Core_Session::singleton()->get('honoreebyurl_sctype');
    $sccid = CRM_Core_Session::singleton()->get('honoreebyurl_sccid');

    // If sctype and sccid are defined:
    if ($sctype && $sccid) {
      // Get soft_credit_type base on sctype
      $softCreditType = \Civi\Api4\OptionValue::get()
        ->addWhere('option_group_id:name', '=', 'soft_credit_type')
        ->addWhere('value', '=', $sctype)
        ->execute()
        ->first();

      // Get contact details base on sccid
      $contact = \Civi\Api4\Contact::get()
        ->setCheckPermissions(FALSE)
        ->addSelect('display_name', 'first_name', 'last_name', 'prefix_id')
        ->addWhere('id', '=', $sccid)
        ->addWhere('is_deleted', '=', FALSE)
        ->execute()
        ->first();

      // If contact details and soft credit type exist..
      // show message and set the params as a setting for the postProcess hook
      if ($contact && $softCreditType) {
        $scMessage = E::ts('This contribution will be recorded as "%1" for "%2". Thank you for giving.',
          [
            1 => $softCreditType['label'],
            2 => $contact['display_name'],
          ]
        );
        CRM_Core_Session::singleton()->set($messageVarName, $scMessage);
      }
    }
    else {
      CRM_Core_Session::singleton()->set($messageVarName, NULL);
    }
  }

  if ($scMessage) {
    // Show the message on screen
    $vars = [
      'scMessage' => $scMessage
    ];
    CRM_Core_Resources::singleton()->addVars('honoreebyurl', $vars);
    CRM_Core_Resources::singleton()->addScriptFile('com.joineryhq.honoreebyurl', 'js/injectHonoreeMessage.js');
  }

}