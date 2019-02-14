<?php
namespace App\Services;

use Socialite;
use App\Models\SocialProvider;
use App\Models\User;
use Laravel\Socialite\Two\InvalidStateException;
use DB;

class SocialProviderService
{
    /**
     * Obtain the user information from provider.
     *
     *@param collection $provider [request login]
     *
     * @return Response
     */
    public function createOrGetUser($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->route('public.login');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();
        if (!$socialProvider) {
            DB::beginTransaction();
            try {
                if (!(User::where('email', $socialUser->getEmail())->first())) {
                    //create a new user and provider
                    $user = User::firstOrCreate([
                        'email' => $socialUser->getEmail(),
                        'name' => $socialUser->getName(),
                        'role_id' => 1
                    ]);
                    $user->profile()->create([
                        'avatar' => $socialUser->getAvatar()
                    ]);
                    $user->socialProviders()->create(
                        ['provider_id' => $socialUser->getId(), 'provider' => $provider]
                    );
                    DB::commit();
                } else {
                    throw new InvalidStateException(__('public.login.duplicate'));
                }
            } catch (\Exception $ex) {
                DB::rollback();
                throw new InvalidStateException($ex->getMessage());
            }
        } else {
            $user = $socialProvider->user;
        }
        auth()->login($user);
    }
}
