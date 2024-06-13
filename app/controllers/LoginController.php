<?php
/**
 * Login Controller
 */
class LoginController extends Controller
{
    /**
     * Process
     */
    public function process()
    {
        $AuthUser = $this->getVariable("AuthUser");
       
        
        if ($AuthUser) {
            error_log("15 " );
            header("Location: ".APPURL);
            exit;
        }   
        // var_dump($_POST);
        if (Input::post("action") == "login") {
            error_log("21 " );
            $this->login();
        } 
        error_log("24 " );
        $this->view("login");
    }


    /**
     * Login
     * @return void
     */
    private function login()
    {
       
        $username = Input::post("username");
        $password = Input::post("password");
        $remember = Input::post("remember");

       
        if ($username && $password) {
            
            try {
               
                $client = new GuzzleHttp\Client();
              
                $resp = $client->request('POST', APIURL."/login",  [
                    'form_params' => [
                        'username' => $username,
                        'password' => $password
                    ],
                    'verify' => false
                ]);
               
                $body = $resp->getBody();
                
                //Kiểm tra và loại bỏ các phần không phải JSON
                $jsonStartPos = strpos($body, '{');
                    $jsonString = substr($body, $jsonStartPos);
    
                   // Giải mã JSON
                    $resp = @json_decode($jsonString);
                
                // $resp = @json_decode($resp->getBody());
                 
                 if($resp->result == 1){
                    
                    $exp = $remember ? time()+86400*30 : 0;
                    setcookie("accessToken", $resp->accessToken, $exp, "/", DOMAINNAME);

                    if($remember) {
                        setcookie("mplrmm", "1", $exp, "/", DOMAINNAME);
                    } else {
                        setcookie("mplrmm", "1", time() - 30*86400, "/", DOMAINNAME);
                    }
    
                    // Fire user.signin event
                    // Event::trigger("user.signin", $User);
                    echo "o day";
                    header("Location: ".APPURL);
                    // $this->view("dashboard");
                    exit;
                }else {
                    // $this->view("recovery");
                    // exit;
                }
            } catch (\GuzzleHttp\Exception\RequestException $e) {
                // Xử lý ngoại lệ khi có lỗi trong quá trình gửi yêu cầu
                echo "Error: " . $e->getMessage();
            }
        }

        return $this;
    }
}