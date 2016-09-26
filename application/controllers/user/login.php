<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
    ////////////////////////////////////////////////////////////////
    ///// Constructor
    ////////////////////////////////////////////////////////////////
    function __construct(){
        parent::__construct();
        $this->load->model("user_service");
    }
    ////////////////////////////////////////////////////////////////
    ///// Index
    ////////////////////////////////////////////////////////////////
    public function index() {
        if (! $this->session->userdata ( 'username' )) {
            $this->show_login ();
        }
    }

    ////////////////////////////////////////////////////////////////
    ///// Show Login
    ////////////////////////////////////////////////////////////////
    public function show_login() {
        if (! $this->session->userdata ( 'username' )) {
            $view_data['head'] = $this->load->view('head', NULL, TRUE);
            $view_data['header'] = $this->load->view('header', NULL, TRUE);
            $view_data['footer'] = $this->load->view('footer', NULL, TRUE);
            $this->load->view('user/login', $view_data);
        } else {
            redirect ('welcome');
        }
    }
    ////////////////////////////////////////////////////////////////
    ///// Do Login
    ////////////////////////////////////////////////////////////////
    public function do_login() {
        $this->form_validation->set_rules ( 'username', 'User Name', 'required|trim|max_length[50]|xss_clean|callback_validateUsernameEx' );
        $this->form_validation->set_rules ( 'password', 'Password', 'required|trim|max_length[200]|xss_clean|callback_validatePwd' );

        if ($this->form_validation->run () == TRUE) {
            $this->load->model ( 'user_service' );
            // get variables
            $username = $this->input->post ( 'username' );
            $password = $this->input->post ( 'password' );

            // get everything about users
            $userdata = $this->user_service->get_user_info ( $username );

            //and store in session
            $this->session->set_userdata ( $userdata );
            redirect ( 'welcome' );
        }
        $this->show_login ();
    }
    ////////////////////////////////////////////////////////////////
    ///// Register
    ////////////////////////////////////////////////////////////////
    public function show_register() {
        if (! $this->session->userdata ( 'username' )) {
            $view_data['head'] = $this->load->view('head', NULL, TRUE);
            $view_data['header'] = $this->load->view('header', NULL, TRUE);
            $view_data['footer'] = $this->load->view('footer', NULL, TRUE);
            $this->load->view('user/register', $view_data);
        } else {
            redirect ( 'welcome' );
        }
    }
    ////////////////////////////////////////////////////////////////
    ///// Create member
    ////////////////////////////////////////////////////////////////
    public function create_member() {
        $this->form_validation->set_rules ( 'username', 'User Name', 'trim|required|min_length[4]|callback_validateUsernameSp|callback_validateUsernameNotEx' );
        $this->form_validation->set_rules ( 'password', 'Password', 'trim|required|min_length[4]|callback_validatePwdStr' );
        $this->form_validation->set_rules ( 'password_confirm', 'Password Confirmation', 'trim|required|matches[password]' );
        $this->form_validation->set_rules ( 'email', 'Email Address', 'trim|required|valid_email|callback_validateEmail' );
        $this->form_validation->set_rules ( 'email_confirm', 'Email Address', 'trim|required|valid_email|matches[email]|callback_validateEmail' );

        if ($this->form_validation->run () == FALSE) {
            $this->show_register ();
        } else {
            $this->load->model ( 'user_service' );
            if ($user_id = $this->user_service->create_member ()) {
                $this->show_login ();
            } else {
                $this->load->view ( 'user/register' );
            }
        }
    }
    ////////////////////////////////////////////////////////////////
    ///// Logout
    ////////////////////////////////////////////////////////////////
    public function do_logout() {
        $this->session->sess_destroy ();
        redirect ( 'welcome' );
    }
    /**
     * The callback to validate if username exists.
     *
     * Error if does not exist.
     * Used for login
     */
    public function validateUsernameEx() {
        $username = $this->input->post ( 'username' );
        $q = $this->user_service->validateUsername ( $username );
        if (! $q) {
            $this->form_validation->set_message ( 'validateUsernameEx', 'Invalid username!' );
            return FALSE;
        }
    }
    // --------------------------------------------------------------------
    /**
     * The callback to validate if username is not duplicated
     * Error if exists.
     *
     * Used for register.
     */
    public function validateUsernameNotEx() {
        $username = $this->input->post ( 'username' );
        $q = $this->user_service->validateUsername ( $username );
        if ($q) {
            $this->form_validation->set_message ( 'validateUsernameNotEx', 'Username ' . $username . ' already exists!' );
            return FALSE;
        }
    }
    // --------------------------------------------------------------------
    /**
     * Validate if password is correct when compared to DB
     * Error if does not match
     * Used for login
     */
    public function validatePwd() {
        $pwdHash = $this->user_service->getPwdHashUser ();
        $password = $this->input->post ( 'password' );

        if (isset ( $pwdHash )) {
            if (! $this->user_service->validatePwd ( $password, $pwdHash )) {
                $this->form_validation->set_message ( 'validatePwd', 'The password you entered is incorrect. Lost your password?' );
                return FALSE;
            }
        }
    }
    // --------------------------------------------------------------------
    /**
     * Validate if username contains no special characters
     * Error if contains
     * Used for register
     */
    public function validateUsernameSp() {
        $username = $this->input->post ( 'username' );
        if (! ctype_alnum ( $username )) {
            $this->form_validation->set_message ( 'validateUsernameSp', 'No special characters in username!' );
            return FALSE;
        }
    }
    // --------------------------------------------------------------------
    /**
     * Validate if password is strong enough
     * Error if weak
     * Used for register
     */
    public function validatePwdStr() {
        $password = $this->input->post ( 'password' );
        if (strlen ( $password ) < 8) {
            $this->form_validation->set_message ( 'validatePwdStr', 'Password too short!' );
            return FALSE;
        }

        if (! preg_match ( "#[0-9]+#", $password )) {
            $this->form_validation->set_message ( 'validatePwdStr', 'Password must include at least one number!' );
            return FALSE;
        }

        if (! preg_match ( "#[a-zA-Z]+#", $password )) {
            $this->form_validation->set_message ( 'validatePwdStr', 'Password must include at least one letter!' );
            return FALSE;
        }
    }
    // --------------------------------------------------------------------
    /**
     * Validate if email is duplicated
     * Error if duplicated
     * Used for register
     */
    public function validateEmail() {
        $email = $this->input->post ( 'email' );
        $query = $this->user_service->validateEmail ( $email );

        if ($query) {
            $this->form_validation->set_message ( 'validateEmail', 'Your email is registered for another account' );
            return FALSE;
        }
    }
}