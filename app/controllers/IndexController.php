<?php
/**
 * Index Controller
 */
class IndexController extends Controller
{
    /**
     * Process
     */
    public function process()
    {   
       
        $AuthUser = $this->getVariable("AuthUser");
        if (!$AuthUser){
            // Auth
            header("Location: ".APPURL."/login");
            exit;
        }
        error_log("Redirecting to: " . APPURL . "/login");

        // Set variables
        $this->view("dashboard");
    }
}