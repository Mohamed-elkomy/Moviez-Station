<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2021 Doothemes. All rights reserved
* ----------------------------------------------------
**************
* @since 2.5.0
*/

class DooAuth{

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function __construct(){
        // Log Out
        add_action('wp_ajax_dooplay_logout', array($this, 'Action_LogoutUser') );
        // Login / signup
		add_action('wp_ajax_nopriv_dooplay_login', array($this, 'Action_LoginUser'));
		add_action('wp_ajax_nopriv_dooplay_register', array($this, 'Action_RegisterUser'));
        // Action delete transient
        add_action('init', array($this, 'clean_SiteTransient'));
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function __destruct(){
		return false;
	}

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public static function LoginForm(){
        $redirect = ( is_ssl() ? 'https://' : 'http://').$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $register = doo_compose_pagelink('pageaccount'). '?action=sign-in';
        $lostpassword = esc_url(site_url('wp-login.php?action=lostpassword','login_post'));
        require_once(DOO_DIR.'/inc/parts/login_form.php');
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function Action_LogoutUser(){
        wp_destroy_current_session();
        wp_clear_auth_cookie();
        wp_send_json(array('response' => true));
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function Action_LoginUser(){
        $response = array();
        $username = doo_isset($_POST,'log');
        $password = doo_isset($_POST,'pwd');
        $redirect = doo_isset($_POST,'red');
        $remember = doo_isset($_POST,'rmb') ? true : false;
        $loginuser = $this->LoginUser($username, $password, $remember);
        if($loginuser){
            $response = array(
                'response' => true,
                'redirect' => esc_url($redirect),
                'message'  => __d('Welcome, reloading page')
            );
        }else{
            $response = array(
                'response' => false,
                'message'  => __d('Wrong username or password')
            );
        }
        // End Action
        wp_send_json($response);
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    public function Action_RegisterUser(){
        $response = array();
        if(dooplay_google_recaptcha() === true){
            $data = array(
                'username'  => doo_isset($_POST,'username'),
                'password'  => doo_isset($_POST,'spassword'),
                'firstname' => doo_isset($_POST,'firstname'),
                'lastname'  => doo_isset($_POST,'lastname'),
                'email'     => doo_isset($_POST,'email')
            );
            if(!doo_isset($data,'username'))
                $response = array('response' => false,'message' => __d('A username is required for registration'));
            elseif(username_exists(doo_isset($data,'username')))
                $response = array('response' => false,'message' => __d('Sorry, that username already exists'));
            elseif(!is_email(doo_isset($data,'email')))
                $response = array('response' => false,'message' => __d('You must enter a valid email address'));
            elseif(email_exists(doo_isset($data,'email')))
                $response = array('response' => false,'message' => __d('Sorry, that email address is already used'));
            elseif(!$this->RegisterUser($data))
                $response = array('response' => false,'message' => __d('Unknown error'));
            else{
                $this->LoginUser( doo_isset($data,'username'), doo_isset($data,'password'), true);
                $response = array('response' => true,'message' => __d('Registration completed successfully'), 'redirect' => doo_compose_pagelink('pageaccount'));
            }
        } else {
            $response = array('response' => false,'message' => __d('Google reCAPTCHA Error'));
        }
        // End Action
        wp_send_json($response);
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function LoginUser($username, $password, $remember = true){
        $auth = array();
        $auth['user_login']    = $username;
        $auth['user_password'] = $password;
        $auth['remember']      = $remember;
        $login = wp_signon($auth, false);
        if(!is_wp_error($login)){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function RegisterUser($data){
        if(is_array($data)){
            $new_user = array(
                'user_pass'  => doo_isset($data,'password'),
                'user_login' => esc_attr(doo_isset($data,'username')) ,
                'user_email' => esc_attr(doo_isset($data,'email')) ,
                'first_name' => doo_isset($data,'firstname'),
                'last_name'	 => doo_isset($data,'lastname'),
                'role'		 => 'subscriber',
            );
            return wp_insert_user($new_user);
        }
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function ChangePasswordUser($user_id, $new_password){
        // soon..
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function ChangeEmailUser($user_id, $new_email){
        // soon..
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function NotifyLogin($user_id){
        // soon..
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function NotifyChanges($user_id, $notice_type){
        // soon..
    }

    /**
     * @since 2.5.0
     * @version 1.0
     */
    private function JsonHeader(){
        header('Access-Control-Allow-Origin:*');
        header('Content-type: application/json');
    }

    /**
     * @since 2.5.5
     * @version 1.0
     */
    public function clean_SiteTransient(){
        if(doo_isset($_GET,'doo_transient') == 'delete'){
            delete_transient('dooplay_website');
        }
    }
}

new DooAuth;
