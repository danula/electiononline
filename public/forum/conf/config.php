<?php if (!defined('APPLICATION')) exit();

// Conversations
$Configuration['Conversations']['Version'] = '2.1.6';

// Database
$Configuration['Database']['Name'] = 'voting_forum';
$Configuration['Database']['Host'] = 'localhost';
$Configuration['Database']['User'] = 'root';
$Configuration['Database']['Password'] = '123456';

// EnabledApplications
$Configuration['EnabledApplications']['Conversations'] = 'conversations';
$Configuration['EnabledApplications']['Vanilla'] = 'vanilla';

// EnabledPlugins
$Configuration['EnabledPlugins']['GettingStarted'] = 'GettingStarted';
$Configuration['EnabledPlugins']['HtmLawed'] = 'HtmLawed';
$Configuration['EnabledPlugins']['OpenID'] = TRUE;
$Configuration['EnabledPlugins']['GoogleSignIn'] = TRUE;
$Configuration['EnabledPlugins']['Gravatar'] = TRUE;
$Configuration['EnabledPlugins']['Facebook'] = TRUE;
$Configuration['EnabledPlugins']['Twitter'] = TRUE;

// Garden
$Configuration['Garden']['Title'] = 'Online Election Forum';
$Configuration['Garden']['Cookie']['Salt'] = '7138XBQ2HV';
$Configuration['Garden']['Cookie']['Domain'] = '';
$Configuration['Garden']['Registration']['ConfirmEmail'] = TRUE;
$Configuration['Garden']['Email']['SupportName'] = 'Online Election Forum';
$Configuration['Garden']['InputFormatter'] = 'Html';
$Configuration['Garden']['Html']['SafeStyles'] = TRUE;
$Configuration['Garden']['Version'] = '2.1.6';
$Configuration['Garden']['RewriteUrls'] = FALSE;
$Configuration['Garden']['Cdns']['Disable'] = FALSE;
$Configuration['Garden']['CanProcessImages'] = TRUE;
$Configuration['Garden']['SystemUserID'] = '2';
$Configuration['Garden']['Installed'] = TRUE;
$Configuration['Garden']['Analytics']['AllowLocal'] = TRUE;
$Configuration['Garden']['Theme'] = 'bootstrap';
$Configuration['Garden']['ThemeOptions']['Name'] = 'Bootstrap';
$Configuration['Garden']['InstallationID'] = '2989-14CD2F78-6C9FC37B';
$Configuration['Garden']['InstallationSecret'] = 'd53cde810527d5d2134ffbe85166986d41dcfe02';
$Configuration['Garden']['Embed']['Allow'] = TRUE;

// Plugins
$Configuration['Plugins']['GettingStarted']['Dashboard'] = '1';
$Configuration['Plugins']['GettingStarted']['Plugins'] = '1';

// Routes
$Configuration['Routes']['DefaultController'] = 'discussions';

// Vanilla
$Configuration['Vanilla']['Version'] = '2.1.6';

// Last edited by admin (127.0.0.1)2014-11-27 04:07:14