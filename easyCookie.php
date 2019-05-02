<?php
/**
 * User: Stefano
 * Date: 24/04/2019
 * Time: 11:09
 */

class easyCookie extends \MyCMS\App\Utils\Models\Container
{
    public function __construct($container, $language)
    {
        parent::__construct($container);
        $this->container['language'] = $language;


        $emptySaveData = [
            "messageCookie" => "We use cookies to understand how you use our site and to improve your experience.\nThis includes personalizing content and advertising.",
    "position" => "center",
    "positionHeight" => "bottom",
    "acceptButton" => "Accept",
    "declineButton" => "Decline",
    "moreInfoButton" => "More info",
    "moreInfoLink" => "#",
    "template" => "default",
    "templateButtons" => "default",
    "buttonsRounded" => true
        ];

        $this->container['settings']->addSettingsValue("easyCookiePlugin", base64_encode(serialize($emptySaveData)));

        $this->container['settingsPlugin'] = unserialize(base64_decode($this->container['settings']->getSettingsValue("easyCookiePlugin")));

        $this->addAdminPage();
        $this->addAdminMenu();
        $this->applyBar();

    }

    function addAdminPage()
    {
        //my_plugin_easycookie
        $container = $this->container;
        $this->container['plugins']->applyEvent("addAdminPage", "easycookie", function () use ($container)
        {

            //$this->container['settingsPlugin']
            ?>
            <div id="easyCookieContainer">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="h1PagesTitle"><?php echo $container['language']['menu_easycookietitle']; ?></h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['edit_message']; ?></label>
                                <br><br>
                                <textarea type="text" class="form-control" v-model="messageCookie" rows="5">
                                </textarea>
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['edit_position']; ?></label>
                                <br><br>
                                <input type="radio" id="left" value="left" v-model="position">
                                <label for="left"><?php echo $this->container['language']['left']; ?></label>
                                <input type="radio" id="center" value="center" v-model="position">
                                <label for="center"><?php echo $this->container['language']['center']; ?></label>
                                <input type="radio" id="right" value="right" v-model="position">
                                <label for="right"><?php echo $this->container['language']['right']; ?></label>
                                <br>
                                <input type="radio" id="bottom" value="bottom" v-model="positionHeight">
                                <label for="bottom"><?php echo $this->container['language']['bottom']; ?></label>
                                <input type="radio" id="top" value="top" v-model="positionHeight">
                                <label for="top"><?php echo $this->container['language']['top']; ?></label>
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['acceptButtonLabel']; ?></label>
                                <br><br>
                                <input type="text" v-model="acceptButton" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['declineButtonLabel']; ?></label>
                                <br><br>
                                <input type="text" v-model="declineButton" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['moreInfoButtonLabel']; ?></label>
                                <br><br>
                                <input type="text" v-model="moreInfoButton" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['selectStyle']; ?></label>
                                <br><br>
                                <select v-model="template">
                                    <option value="default">Default</option>
                                    <option value="light">Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['buttonsStyle']; ?></label>
                                <br><br>
                                <select v-model="templateButtons">
                                    <option value="default">Default</option>
                                    <option value="light">Light</option>
                                    <option value="dark">Dark</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['moreInfoLinkLabel']; ?></label>
                                <br><br>
                                <input type="text" v-model="moreInfoLink" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="label"><?php echo $this->container['language']['buttonRounded']; ?></label>
                                <br><br>
                                <input type="checkbox" v-model="buttonsRounded" value="">
                            </div>
                            <button class="btn btn-block btn-danger" @click="saveSettings"><?php echo $this->container['language']['save']; ?></button>
                        </div>
                       <!-- <input type="checkbox" v-model="pluginEnabled" id="pluginEnabled">
                        <label for="pluginEnabled">Enabled</label>-->
                    </div>
                </div>
            </div>
           <?php

            $this->container['plugins']->addEvent("adminFooter", function () use ($container)
            {
                /*
                 * <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
                 */
                //todo set production:
                /*

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
                 */
                ?>
                <script src="https://cdn.jsdelivr.net/npm/vue"></script>
                <script>
                    $().ready(function () {
                        let app = new Vue({
                            el: '#easyCookieContainer',
                            data: {
                                messageCookie: `<?php echo $container['settingsPlugin']['messageCookie']; ?>`,
                                position: "<?php echo $container['settingsPlugin']['position']; ?>",
                                positionHeight: "<?php echo $container['settingsPlugin']['positionHeight']; ?>",
                                acceptButton: "<?php echo $container['settingsPlugin']['acceptButton']; ?>",
                                declineButton: "<?php echo $container['settingsPlugin']['declineButton']; ?>",
                                moreInfoButton: "<?php echo $container['settingsPlugin']['moreInfoButton']; ?>",
                                moreInfoLink: "<?php echo $container['settingsPlugin']['moreInfoLink']; ?>",
                                template: "<?php echo $container['settingsPlugin']['template']; ?>",
                                templateButtons: "<?php echo $container['settingsPlugin']['templateButtons']; ?>",
                                buttonsRounded: <?php echo $container['settingsPlugin']['buttonsRounded'] ? "true" : "false"; ?>
                            },
                            methods: {
                                saveSettings()
                                {
                                    let _this = this;

                                    $.post("{@MY_PLUGINS_PATH@}/easyCookie/saveInfo.php", {
                                        messageCookie: _this.messageCookie,
                                        position: _this.position,
                                        positionHeight: _this.positionHeight,
                                        acceptButton: _this.acceptButton,
                                        declineButton: _this.declineButton,
                                        moreInfoButton: _this.moreInfoButton,
                                        moreInfoLink: _this.moreInfoLink,
                                        template: _this.template,
                                        templateButtons: _this.templateButtons,
                                        buttonsRounded: _this.buttonsRounded,
                                    });

                                    parent.window.location.reload(true);
                                }
                            }
                        })
                    });
                </script>
                <?php
            });
        });
    }

    function addAdminMenu()
    {
        $this->container['plugins']->applyEvent('addAdminSubMenu', "admin_settings_simpleseo", "menu_settings", $this->container['language']['menu_easycookietitle'], "{@siteURL@}/my-admin/my_plugin/easycookie", ['admin_settings_easycookie']);
        $this->container['plugins']->applyEvent('addSubMenuPermission', "admin_settings_easycookie", "manage_options");
    }

    function applyBar()
    {
        if ($_COOKIE['easyCookie'] == "accept")
        {
            return;
        }

        //todo add setting to bypass theme
        $container = $this->container;

        $this->container['plugins']->addEvent('underFooter', function () use ($container)
        {
            $classList = "";
            switch ($container['settingsPlugin']['position'])
            {
                case 'left':
                    $classList .= "leftTemplate ";
                    break;
                case 'right':
                    $classList .= "rightTemplate ";
                    break;
                case 'center':
                default:
                    $classList .= "centerTemplate ";
                    break;
            }

            switch ($container['settingsPlugin']['positionHeight'])
            {
                case 'top':
                    $classList .= "topTemplate ";
                    break;
                case 'bottom':
                default:
                    $classList .= "bottomTemplate ";
                    break;
            }

            switch ($container['settingsPlugin']['template'])
            {
                case 'light':
                    $classList .= "lightBar ";
                    break;
                case 'dark':
                    $classList .= "darkBar ";
                    break;
                case 'default':
                default:
                    $classList .= "defaultBar ";
                    break;
            }

            $buttonsClassList = "";

            switch ($container['settingsPlugin']['templateButtons'])
            {
                case 'light':
                    $buttonsClassList .= "light ";
                    break;
                case 'dark':
                    $buttonsClassList .= "dark ";
                    break;
                case 'default':
                default:
                    break;
            }

            //var_dump($container['settingsPlugin']['buttonsRounded']);
            if($container['settingsPlugin']['buttonsRounded'] == true)
            {
                $buttonsClassList .= "rounded ";
            }


            ?>
            <link rel="stylesheet" href="{@MY_PLUGINS_PATH@}/easyCookie/css/style.css">
            <div class="easyCookieContainer <?php echo $classList; ?>" id="easyCookieContainer">
                <?php echo nl2br(htmlentities($container['settingsPlugin']['messageCookie'])); ?>
                <div class="buttonsContainer <?php echo $buttonsClassList; ?>">
                    <a href="#" onclick="ESCsetCookie()" class="acceptButton"><?php echo htmlentities($container['settingsPlugin']['acceptButton']); ?></a>
                    <a href="#" onclick="ESCdisableCookie()" class="declineButton"><?php echo htmlentities($container['settingsPlugin']['declineButton']); ?></a>
                    <a href="<?php echo htmlentities($container['settingsPlugin']['moreInfoLink']); ?>" class="moreInfoButton"><?php echo htmlentities($container['settingsPlugin']['moreInfoButton']); ?></a>
                </div>
            </div>
            <script>
                function ESCsetCookie() {
                    let date = new Date();
                    date.setTime(date.getTime() + (30 *24*60*60*1000));
                    let expires = "expires="+date.toUTCString();
                    document.cookie = "easyCookie" + "=" + "accept" + "; " + expires;

                  //  document.getElementById("easyCookieContainer").remove();

                    parent.window.location.reload(true);
                }

                function ESCdisableCookie() {
                        let c = document.cookie.split(';');
                        for (let i = 0 ; i < c.length; i++) {
                            document.cookie = c[i].split('=')[0] + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';

                    }
                    document.getElementById("easyCookieContainer").remove();
                }

                let c = document.cookie.split(';');
                for (let i = 0 ; i < c.length; i++) {
                    document.cookie = c[i].split('=')[0] + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                }
            </script>
            <?php


            if ($_COOKIE['easyCookie'] != "accept")
            {
               // $container['plugins']->addEvent('initialized', function (){
                    ini_set('session.use_cookies', '0');

                    if (isset($_COOKIE[session_name()])) {
                        setcookie(session_name(), NULL,  -1, "/");
                    }

                    session_destroy();

                    setcookie (session_id(), "", time() - 3600);
                    session_destroy();
                    session_write_close();
              //  });


              /*  $container['plugins']->addEvent('initialized', function (){
                    ?>
                    <script>
                        let c = document.cookie.split(';');
                        for (let i = 0 ; i < c.length; i++) {
                            document.cookie = c[i].split('=')[0] + '=; path=/; expires=Thu, 01 Jan 1970 00:00:01 GMT;';
                        }
                    </script>
                 /*   <?php
                });*/

            }
        });
    }
}

switch (MY_LANGUAGE)
{
    case 'en_US':
    default:
        $language = require_once ("languages/en.php");
        break;
}

new easyCookie($this->container, $language);