<?php

namespace App\Http\Controllers;

use App\Activate;
use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Ixudra\Curl\Facades\Curl;
use \Facebook\Facebook;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        if (!empty($_POST['email']))
        {
            $user = DB::table('users')
                ->where('email', $_POST['email'])
                ->first();
            if ($user != null && $user->id > 0)
            {
                if (hash('whirlpool', $_POST['password']) == $user->password) {
                    $_SESSION['email'] = $user->email;
                    $_SESSION['user_id'] = $user->id;
                    return redirect('/profile/' . $user->id . '');
                }
                else {
                    return redirect('/login/')->with('warning', 'Incorrect password');
                }
            }
            else
            {
                return redirect('/login/')->with('warning', 'Wrong email');
            }
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
            if (!DB::table('users')->where('email',$_POST['email'])->first()) {
                $user = new User();

                $user->name = $_POST['name'];
                $user->surname = $_POST['surname'];
                $user->email = $_POST['email'];
                $user->image = "";
                $user->token = $_POST['_token'];
                $user->password = hash('whirlpool', $_POST['password']);


                if ($user->save())
                {
                    $activate = new Activate();

                    $activate->token = $_POST['_token'];
                    $activate->user_email = $_POST['email'];

                    $activate->save();
//                    Mail::send('emails.welcome', ['user' => $user], function ($mail) use ($user) {
//                        $mail->from('hello@app.com', 'Your Application');
//
//                        $mail->to($user->email, $user->name)->subject('Your Reminder!');
//                    });
                    return redirect('/login/')->with('success', 'Please check you email');
                }
                else
                {
                    return redirect('/register/')->with('error', 'Something wrong! User not saved! Sorry :(');
                }

            }
            else
            {
                return redirect('/register/')->with('error', "user with email ".$_POST['email']." already exists");
            }
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

        $db_user = DB::table('users')->where('email', $profile['email'])->first();
        if (!$db_user)
        {
            $user = new User();

            $user->name = $profile['first_name'];
            $user->surname = $profile['last_name'];
            $user->image = $picture['url'];
            $user->password = "";
            $user->token = $accessToken->getValue();
            $user->email = $profile['email'];

            $user->save();

//            $url = "http://www.google.co.in/intl/en_com/images/srpr/logo1w.png";
//            $contents = file_get_contents($url);
//            $name = substr($url, strrpos($url, '/') + 1);
//            Storage::disk('uploads/user_'.$user->id)->put($name, $contents);
//            DB::table('users')
//                ->where('id', $user->id)
//                ->update([
//                    'image' => '/public/uploads/user_'.$user->id.$name
//                ]);

            $_SESSION['email'] = $profile['email'];
            $_SESSION['user_id'] = $user->id;
            return redirect('/profile/'.$user->id.'');
        }
        else
        {
            if (empty($db_user->image))
            {
                DB::table('users')
                    ->where('id', $db_user->id)
                    ->update(['image' => $picture['url']]);
            }
            $_SESSION['email'] = $profile['email'];
            $_SESSION['user_id'] = $db_user->id;
            return redirect('/profile/'.$db_user->id.'');
        }

    }

    public function intralogin()
    {
        $response = Curl::to('https://api.intra.42.fr/oauth/token')
            ->withData(
                array(
                'grant_type' => 'authorization_code',
                'client_id' => 'ad0570aea500deeacfb27d1cb682999daa4c43b6b171ca99ff9ea2713562d4aa',
                'client_secret' => '5b2491a867c5e9c1435e90b1202ee1e0fb84c4f028e94653b18baf0776849249',
                'code' => $_GET['code'],
                'redirect_uri' => 'http://localhost:80/intralogin',
                    )
            )
            ->asJsonRequest(true)
            ->post();
        $response = json_decode($response);
        $curl = curl_init('https://api.intra.42.fr/v2/me');
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $response->access_token]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        if ($result) {
            $result = json_decode($result);
            $db_user = DB::table('users')->where('email', $result->email)->first();
            if (!$db_user) {
                $user = new User();

                $user->name = $result->first_name;
                $user->surname = $result->last_name;
                $user->image = $result->image_url;
                $user->password = "";
                $user->token = $response->access_token;
                $user->email = $result->email;

                $user->save();
                $_SESSION['email'] = $result->email;
                $_SESSION['user_id'] = $user->id;
                return redirect('/profile/'.$user->id.'');
            }
            else {
                $_SESSION['email'] = $result->email;
                $_SESSION['user_id'] = $db_user->id;
                return redirect('/profile/'.$db_user->id.'');
            }

        }
    }

    public function Update(Request $request)
    {
        if (!empty($_POST['email']))
        {
            if (empty($_POST['password'])) {
                DB::table('users')
                    ->where('id', $_POST['id'])
                    ->update([
                        'name' => $_POST['name'],
                        'surname' => $_POST['surname'],
                        'email' => $_POST['email']

                    ]);
            }
            else
            {
                DB::table('users')
                    ->where('id', $_POST['id'])
                    ->update([
                        'name' => $_POST['name'],
                        'surname' => $_POST['surname'],
                        'email' => $_POST['email'],
                        'password' => hash('whirlpool', $_POST['password'])
                    ]);

            }

            if ($request->file('image')) {
                $file = $request->file('image');
                $file->move('uploads/user_'.$_POST['id'], $file->getClientOriginalName());
                DB::table('users')
                    ->where('id', $_POST['id'])
                    ->update([
                        'image' => '/public/uploads/user_'.$_POST['id'].'/'.$file->getClientOriginalName()
                    ]);
            }

            return redirect('/profile/'.$_POST['id'].'')->with('update', 'User data updated');
        }
    }

    public function logout()
    {
        unset($_SESSION['email']);
        return redirect('/');
    }

    public function profile($id = 0)
    {
        if (!isset($_SESSION['email']) && $id != 0) {
            return redirect('/login/')->with('warning', 'Please login first!');
        }
        $user = DB::table('users')->where('id', $id)->first();

        return View('user.profile')->with(['user' => $user]);
    }
}
