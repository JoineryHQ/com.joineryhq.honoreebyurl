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
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function honoreebyurl_civicrm_install() {
  _honoreebyurl_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function honoreebyurl_civicrm_enable() {
  _honoreebyurl_civix_civicrm_enable();
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
      ->setCheckPermissions(FALSE)
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
        ->setCheckPermissions(FALSE)
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
