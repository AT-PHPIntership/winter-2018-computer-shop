<?php
namespace App\Services;

use Socialite;
use App\Models\SocialProvider;
use App\Models\User;
use App\Models\Role;
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
        } catch (Exception $ex) {
            session()->flash('warning', __('master.content.message.error', ['attribute' => $ex->getMessage()]));
            return redirect()->route('public.login');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();
        if (!$socialProvider) {
            DB::beginTransaction();
            try {
                $checkEmailProvider = User::where('email', $socialUser->getEmail())->first();
                if (!($checkEmailProvider)) {
                    //create a new user and provider
                    $user = User::firstOrCreate([
                        'email' => $socialUser->getEmail(),
                        'name' => $socialUser->getName(),
                        'role_id' => Role::where('name', Role::ROLE_NORMAL)->select('id')->pluck('id')->first(),
                    ]);
                    $user->profile()->create([
                        'avatar' => $socialUser->getAvatar()
                    ]);
                    $user->socialProviders()->create(
                        ['provider_id' => $socialUser->getId(), 'provider' => $provider]
                    );
                    DB::commit();
                } else {
                    throw new InvalidStateException(__('public.login.duplicate', ['attribute' => $checkEmailProvider->socialProviders->pluck('provider')->first()]));
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
