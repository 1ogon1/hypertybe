<?php

namespace App\Http\Controllers;
//namespace App\Model;

use App\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ixudra\Curl\Facades\Curl;
use \Facebook\Facebook;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function __construct()
    {
        session_start();
    }

    public function Index()
    {
        if (isset($_SESSION['email']))
        {
            return redirect('/profile');
        }

        return view('index');
    }

    public function Login()
    {
        $title = 'Login';
        $fb = new Facebook([
            'app_id' => '177732936171160',
            'app_secret' => 'd7518e59ad8c183935424668b7b5d0c7',
            'default_graph_version' => 'v2.2'

        ]);
        $helper = $fb->getRedirectLoginHelper();
        $loginFb = $helper->getLoginUrl('http://localhost:80/facebooklogin');

        return view('user.login')->with('loginFb', $loginFb);
    }
    public function SignIn()
    {
        if ($_POST['name'])
        {
            echo $_POST['name'];
        }
    }

    public function Register()
    {
        return view('user.register');
    }

    public function SignUp()
    {
        if (!empty($_POST['name']) && !empty($_POST['password']) && !empty($_POST['email']))
        {
            $user = new User();

            $user->name = empty($_POST['name']) ? "" : $_POST['name'];
            $user->surname = empty($_POST['surname']) ? "" : $_POST['surname'];
            $user->token = empty($_POST['token']) ? "" : $_POST['token'];
            $user->password = $_POST['password'];
            $user->email = $_POST['email'];

            $user->save();

        }
    }

    public function facebooklogin()
    {
        $fb = new Facebook([
            'app_id' => '177732936171160',
            'app_secret' => 'd7518e59ad8c183935424668b7b5d0c7',
            'default_graph_version' => 'v2.2'
        ]);

        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
            $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }
        try {
            $accessToken = $helper->getAccessToken('http://localhost:80/facebooklogin');
        } catch(FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FFacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        $oAuth2Client = $fb->getOAuth2Client();

        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        $tokenMetadata->validateAppId('177732936171160');

        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch (FacebookSDKException $e) {
                echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
                exit;
            }
        }

        $requestPicture = $fb->get('/me/picture?redirect=false&height=300', $accessToken->getValue());
        $picture = $requestPicture->getGraphUser();

        $requestProfile = $fb->get('/me?fields=id,first_name,last_name,email,birthday', $accessToken->getValue());
        $profile = $requestProfile->getGraphUser();

        if (!DB::table('users')->where('email',$profile['email'])->first()) {
            $user = new User();

            $user->name = $profile['first_name'];
            $user->surname = $profile['last_name'];
            $user->image = $picture['url'];
            $user->token = "";
            $user->password = "";
            $user->email = $profile['email'];

            $user->save();
        }
        $_SESSION['email'] = $profile['email'];
        return redirect('/profile/');
    }

    public function intralogin()
    {
        $code = $_GET['code'];

        $response = Curl::to('https://api.intra.42.fr/oauth/token')
            ->withData(
                array(
                'grant_type' => 'authorization_code',
                'client_id' => 'ad0570aea500deeacfb27d1cb682999daa4c43b6b171ca99ff9ea2713562d4aa',
                'client_secret' => '5b2491a867c5e9c1435e90b1202ee1e0fb84c4f028e94653b18baf0776849249',
                'code' => $code,
                'redirect_uri' => 'http://localhost:80/intralogin',
                    )
            )
            ->asJsonRequest(true)
            ->post();
        $response = json_decode($response);
        $token = $response->access_token;
        $apiUrl = 'https://api.intra.42.fr/v2/me';
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $token]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        if ($result) {
            $result = json_decode($result);
            if (!DB::table('users')->where('email',$result->email)->first()) {
                $user = new User();
//
                $user->name = $result->first_name;
                $user->surname = $result->last_name;
                $user->image = $result->image_url;
                $user->token = "";
                $user->password = "";
                $user->email = $result->email;

                $user->save();
            }
            $_SESSION['email'] = $result->email;
            return redirect('/profile/');
        }
    }

    public function logout()
    {
        unset($_SESSION['email']);
        return redirect('/');
    }

    public function profile()
    {
        if (!isset($_SESSION['email'])) {
            return redirect('/');
        }
        $user = DB::table('users')->where('email', $_SESSION['email'])->first();

        return View('user.profile')->with('user', $user);
    }
}
