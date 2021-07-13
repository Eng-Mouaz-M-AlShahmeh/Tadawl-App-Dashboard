<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use File;
use Helper;
use Illuminate\Support\Facades\Auth;
use Image;
use Laravel\Socialite\Facades\Socialite;
use Redirect;

class SocialAuthController extends Controller
{
    /**
     * List of providers configured in config/services acts as whitelist
     *
     * @var array
     */
    protected $providers = [
        'facebook',
        'twitter',
        'google',
        'linkedin',
        'github',
        'bitbucket'
    ];
    private $uploadPath = "uploads/users/";

    public function __construct()
    {
        $this->middleware('guest');
    }


    /**
     * Redirect to provider for authentication
     *
     * @param $driver
     * @return mixed
     */
    public function redirectToProvider($driver)
    {
        if (!$this->isProviderAllowed($driver)) {
            return $this->sendFailedResponse("{$driver} " . __('backend.notCurrentlySupported'));
        }

        try {
            return Socialite::driver($driver)->redirect();
        } catch (Exception $e) {
            // You should show something simple fail message
            return $this->sendFailedResponse($e->getMessage());
        }
    }

    /**
     * Check for provider allowed and services configured
     *
     * @param $driver
     * @return bool
     */
    private function isProviderAllowed($driver)
    {
        return in_array($driver, $this->providers) && config()->has("services.{$driver}");
    }

    /**
     * Send a failed response with a msg
     *
     * @param null $msg
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedResponse($msg = null)
    {
        return Redirect::to(url('/login'))
            ->withErrors(['msg' => $msg ?: __('backend.UnableToLogin')]);
    }

    /**
     * Handle response of authentication redirect callback
     *
     * @param $driver
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($driver)
    {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (Exception $e) {
            return $this->sendFailedResponse($e->getMessage());
        }

        // check for email in returned user
        return empty($user->email)
            ? $this->sendFailedResponse(__('backend.NoEmailReturned') . " {$driver}")
            : $this->loginOrCreateAccount($user, $driver);
    }

    protected function loginOrCreateAccount($providerUser, $driver)
    {
        // check for already has account
        $user = User::where('email', $providerUser->getEmail())->first();

        // if user already found
        if ($user) {

            if ($user->photo != "") {
                // Delete old Avatar
                File::delete($this->getUploadPath() . $user->photo);
            }
            $photo_filename = "";
            if ($providerUser->getAvatar() != "") {
                // Save Avatar to uploads folder
                $avatar_path = $providerUser->getAvatar();
                $photo_filename = time() . rand(1111, 9999);
                $extension = pathinfo($avatar_path, PATHINFO_EXTENSION);
                if ($extension == 0 || $extension == "") {
                    $extension = "png";
                }
                $photo_filename = $photo_filename . '.' . $extension;

                //get file content from url
                $file_contents = file_get_contents($avatar_path);
                $save = file_put_contents($this->getUploadPath() . $photo_filename, $file_contents);
                if (!$save) {
                    $photo_filename = "";
                }
            }

            // update the avatar and provider that might have changed
            $user->update([
                'photo' => $photo_filename,
                'provider' => $driver,
                'provider_id' => $providerUser->id,
                'access_token' => $providerUser->token
            ]);
        } else {
            $photo_filename = "";
            if ($providerUser->getAvatar() != "") {
                // Save Avatar to uploads folder
                $avatar_path = $providerUser->getAvatar();
                $photo_filename = time() . rand(1111, 9999);
                $extension = pathinfo($avatar_path, PATHINFO_EXTENSION);
                if ($extension == 0 || $extension == "") {
                    $extension = "png";
                }
                $photo_filename = $photo_filename . '.' . $extension;

                //get file content from url
                $file_contents = file_get_contents($avatar_path);
                $save = file_put_contents($this->getUploadPath() . $photo_filename, $file_contents);
                if (!$save) {
                    $photo_filename = "";
                }
            }

            // create a new user
            $user = User::create([
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
                'photo' => $photo_filename,
                'permissions_id' => Helper::GeneralWebmasterSettings("permission_group"),
                'status' => true,
                'provider' => $driver,
                'provider_id' => $providerUser->getId(),
                'access_token' => $providerUser->token,
                // user can use reset password to create a password
                'password' => ''
            ]);
        }

        // login the user
        Auth::login($user, true);

        return $this->sendSuccessResponse();
    }

    public function getUploadPath()
    {
        return $this->uploadPath;
    }

    public function setUploadPath($uploadPath)
    {
        $this->uploadPath = Config::get('app.APP_URL') . $uploadPath;
    }

    /**
     * Send a successful response
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendSuccessResponse()
    {
        return redirect()->intended('home');
    }
}
