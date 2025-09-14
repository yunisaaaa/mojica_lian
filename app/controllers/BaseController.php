<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: BaseController
 * 
 * Automatically generated via CLI.
 */
class BaseController extends Controller {
    public function index()
    {
       $this->call->view('base');
    }
}