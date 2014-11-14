<?php

namespace Tranquility\Controllers\Backend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author Andrew
 */
class LoginController extends BackendController {
    
    public function viewLoginForm() {
        return \View::make('backend::login.loginForm');
        
        
        
        
        //$this->layout->content = \View::make('backend::login.loginForm');
    }
}
