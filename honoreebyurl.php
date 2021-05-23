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
  if ($formName == 'CRM_Contribute_Form_Contribution_Main') {
    // Get the htype and hcid in the URL parameter
    $htype = CRM_Utils_Array::value('htype', $_GET);
    $hcid = CRM_Utils_Array::value('hcid', $_GET);

    // If htype is equals to 1 (In Honor of) or 2 (In Memory of)
    // and hcid is not empty
    if (($htype == 1 || $htype == 2) && $hcid) {
      // Get contact details base on hcid
      $contactDetails = \Civi\Api4\Contact::get()
        ->addSelect('first_name', 'last_name', 'prefix_id')
        ->addWhere('id', '=', $hcid)
        ->addWhere('is_deleted', '=', FALSE)
        ->execute()
        ->first();

      // If contactDetails exist
      if ($contactDetails) {
        // Get contact email using hcid
        $contactEmail = CRM_Contact_BAO_Contact::getPrimaryEmail($hcid);
        // Add soft_credit_type_id as htype
        $defaults['soft_credit_type_id'] = $htype;

        // Get soft_credit_type_id field
        $softCreditTypeField = $form->getElement('soft_credit_type_id');
        // Foreach field options
        foreach ($softCreditTypeField->_elements as $softCreditTypeElementKey => $softCreditTypeElementOption) {
          // Unset options if its not equals to the htype
          if ($softCreditTypeElementOption->_attributes['value'] != $htype) {
            unset($softCreditTypeField->_elements[$softCreditTypeElementKey]);
          }
        }

        // Set allowclear as 0 to remove the clear button
        $softCreditTypeField->_attributes['allowclear'] = 0;

        // Get all fields
        $fields = $form->_elements;
        // Foreach fields
        foreach ($fields as $field) {
          // If field attributes name exist and attribute name contains 'honor'
          if ($field->_attributes['name'] && strpos($field->_attributes['name'], 'honor')  !== FALSE) {
            // If contactEmail exist and field attribute name contains 'email'
            // (field name would likely be email-1 or email-2 that is why we need this conditional statment)
            // if didn't contact, check other contactDetails field
            if (strpos($field->_attributes['name'], 'email') !== FALSE && $contactEmail) {
              // Set field default value as contactEmail and mark it as readonly
              $defaults[$field->_attributes['name']] = $contactEmail;
              $field->_attributes['readonly'] = 1;
            }
            else {
              // Remove honor[] to match it on the contactDetails
              $fieldName = str_replace('honor[', '', $field->_attributes['name']);
              $fieldName = str_replace(']', '', $fieldName);

              // contactDetails exist base on fieldName
              if ($contactDetails[$fieldName]) {
                // Set field default value and mark it as readonly
                $defaults[$field->_attributes['name']] = $contactDetails[$fieldName];
                $field->_attributes['readonly'] = 1;

                // If fieldName is equals to prefix_id and it cannot be set as readonly
                // disable the field and remove the data option
                if ($fieldName == 'prefix_id') {
                  $field->_attributes['disabled'] = 1;
                  unset($field->_attributes['data-option-edit-path']);
                }
              }
            }
          }
        }

        // Set defaults on all fields
        $form->setDefaults($defaults);
      }
    }
  }
}
