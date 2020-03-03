<?php

/********************************************************* {COPYRIGHT-TOP} ***
 * Licensed Materials - Property of IBM
 * 5725-L30, 5725-Z22
 *
 * (C) Copyright IBM Corporation 2018, 2019
 *
 * All Rights Reserved.
 * US Government Users Restricted Rights - Use, duplication or disclosure
 * restricted by GSA ADP Schedule Contract with IBM Corp.
 ********************************************************** {COPYRIGHT-END} **/

/**
 * Class ForcedTranslations
 *
 * This class is not called from anywhere, it is not intended to be. It exists purely to provide strings that need to be translated.
 *
 */
class ForcedTranslations {

  /**
   * This function is not called from anywhere, it is purely here to get some strings into our PO files
   */
  private function apim_profile_translate_strings() {
    $confirm_password = t('Confirm password');
    $no_apps = t('No Applications found.');
    $no_apis = t('No APIs were found.');
    $no_apps = t('No Products were found.');
    $name = t('Name');
    $category = t('Category');
    $first_name = t('First Name');
    $last_name = t('Last Name');
    $password_strength = t('Password strength:');
    $already_have_account = t('Already have an account?');
    $sign_up = t('Sign up');
    $reset_instructions = t('Password reset instructions will be sent to your registered email address.');
    $api = t('API');
    $app = t('Application');
    $product = t('Product');
    $org = t('Consumer organization');
    $faq = t('FAQ');
    $faq_lc = t('faq');
    $faqs = t('FAQs');
    $forum = t('Forum topic');
    $decide_avatar = t('Let the site determine which avatar to use.');
    $select_avatar = t("Select source of avatar. It is possible to use an autogenerated avatar or upload your own profile image below.");
    $restrict_by_ip = t('Restrict by IP settings');
    $user_pic_upload = t('User picture upload');
    $last_password_reset = t('Last Password Reset');
    $code_snippet = t('Code Snippet Language');
    $first_time_login = t('First time login');
    $subscription_wizard = t('Subscription Wizard');
    $default_comments = t('Default comments');
    $picture = t('Picture');
    $icon = t('Icon (48x48)');
    $realm = t('realm');
    $state = t('State');
    $url = t('url');
    $apic_user_registry_url = t('apic user registry url');
    $consumer_org_url = t('Consumer organization URL');
    $enabled = t('Enabled');
    $disabled = t('Disabled');
    $reset = t('Reset');
    $sort_by = t('Sort by');
    $order = t('Order');
    $asc = t('Asc');
    $desc = t('Desc');
    $advanced_options = t('Advanced options');
    $items_per_page = t('Items per page');
    $all_header = t('- All -');
    $offset = t('Offset');
    $filter = t('Filter');
    $browse_apis = t('Browse available APIs');
    $api_products = t('API Products');
    $product_list = t('Product List');
    $previous = t('‹ Previous');
    $next = t('Next ›');
    $first = t('« First');
    $last = t('Last »');
    $sort_options = t('Sort options');
    $text_input_required = t('Select any filter and click on Apply to see results');
    $list_of_faqs = t('List of FAQ nodes for use in the Support page');
    $only_show_faws_keywords = t('Only show frequently asked questions containing specific keywords');
    $faqs_long = t('Frequently Asked Questions');
    $app_list = t('App List');
    $apps = t('Apps');
    $api_list = t('API List');
    $apis = t('APIs');
    $production = t('Production');
    $development = t('Development');
    $enabled = t('Enabled');
    $disabled = t('Disabled');
    $confidential = t('Confidential');
    $public = t('Public');
    $online = t('Online');
    $offline = t('Offline');
    $archived = t('Archived');
    $staged = t('Staged');
    $retired = t('Retired');
    $oauth_provider = t('OAuth Provider');
    $login_failure = t('The credentials provided for authentication are invalid. Please repeat the request with valid credentials. Please note that repeated attempts with incorrect credentials can lock the user account.');
    $r4032login_message = t('Access denied. You must log in to view this page.');
    $autologout_message = t('Your session is about to expire. Do you want to reset it?');
    $autologout_inactivity_message = t('You have been logged out due to inactivity.');
  }


}