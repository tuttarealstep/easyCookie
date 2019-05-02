<?php

define('MY_CMS_PATH', true);
define("LOADER_LOAD_PAGE", false);
include '../../../../../src/Bootstrap.php';

$app->container['users']->hideIfNotLogged();
if(!$app->container['users']->currentUserHasPermission("manage_options"))
{
    throw new MyCMS\App\Utils\Exceptions\MyCMSException("You do not have permission to access this page!", "Permission denied");
}

$saveData = [];

$saveData["messageCookie"] = "";
if (isset($_POST['messageCookie']))
{
    if(!empty($_POST['messageCookie']))
    {
        $saveData["messageCookie"] = htmlentities($_POST['messageCookie']);
    }
}

$saveData["position"] = "";
if (isset($_POST['position']))
{
    if(!empty($_POST['position']))
    {
        $saveData["position"] = htmlentities($_POST['position']);
    }
}

$saveData["positionHeight"] = "";
if (isset($_POST['positionHeight']))
{
    if(!empty($_POST['positionHeight']))
    {
        $saveData["positionHeight"] = htmlentities($_POST['positionHeight']);
    }
}

$saveData["acceptButton"] = "";
if (isset($_POST['acceptButton']))
{
    if(!empty($_POST['acceptButton']))
    {
        $saveData["acceptButton"] = htmlentities($_POST['acceptButton']);
    }
}

$saveData["declineButton"] = "";
if (isset($_POST['declineButton']))
{
    if(!empty($_POST['declineButton']))
    {
        $saveData["declineButton"] = htmlentities($_POST['declineButton']);
    }
}

$saveData["moreInfoButton"] = "";
if (isset($_POST['moreInfoButton']))
{
    if(!empty($_POST['moreInfoButton']))
    {
        $saveData["moreInfoButton"] = htmlentities($_POST['moreInfoButton']);
    }
}

$saveData["moreInfoLink"] = "";
if (isset($_POST['moreInfoLink']))
{
    if(!empty($_POST['moreInfoLink']))
    {
        $saveData["moreInfoLink"] = htmlentities($_POST['moreInfoLink']);
    }
}

$saveData["template"] = "";
if (isset($_POST['template']))
{
    if(!empty($_POST['template']))
    {
        $saveData["template"] = htmlentities($_POST['template']);
    }
}

$saveData["templateButtons"] = "";
if (isset($_POST['templateButtons']))
{
    if(!empty($_POST['templateButtons']))
    {
        $saveData["templateButtons"] = htmlentities($_POST['templateButtons']);
    }
}

$saveData["buttonsRounded"] = "";
if (isset($_POST['buttonsRounded']))
{
    if(!empty($_POST['buttonsRounded']))
    {
        $saveData["buttonsRounded"] = htmlentities($_POST['buttonsRounded']) == "true" ? true : false;
    }
}

$app->container['settings']->saveSettings("easyCookiePlugin", base64_encode(serialize($saveData)));

/*
if (isset($_POST['settings_site_name']))
{
    if(!empty($_POST['settings_site_name']))
    {
        $app->container['settings']->saveSettings("site_name", htmlentities($_POST['settings_site_name']));
    }
}
if (isset($_POST['settings_site_description']))
{
    if(!empty($_POST['settings_site_description']))
    {
        $app->container['settings']->saveSettings("site_description", htmlentities($_POST['settings_site_description']));
    }
}
if (isset($_POST['settings_keywords']))
{
    if(!empty($_POST['settings_keywords']))
    {
        $app->container['settings']->saveSettings("simpleSEO_keywords", htmlentities($_POST['settings_keywords']));
    }
}*/