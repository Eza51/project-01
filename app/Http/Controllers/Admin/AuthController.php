<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\CoreHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

/**index: Displays the admin login page.
 * 
login: Authenticates the admin and redirects to the dashboard if credentials are valid.

logout: Logs out the admin and redirects to the logout route.

forgotPassword: Displays the forgot password page.

sendResetLinkEmail: Sends a password reset link to the admin's email.

newPassword: Displays the page to enter a new password using the reset token.

newPasswordSave: Validates and saves the new password for the admin.

profile: Displays the admin's profile page.

profileUpdate: Updates the admin's profile information and uploads a new profile image if provided.

profilePassword: Displays the admin's password change page.

profilePasswordUpdate: Updates the admin's password after validating the old password. */
class AuthController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('admin.auth.index');
    }

    /**
     * Check the login credentials and go to the dashboard.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
//users table collumn config..auth by default
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        // checks if the provided credentials match any user in the database

        if (Auth::attempt($credentials)) {
            sleep(1);//pagw ghrbe
            return redirect()->route('admin.dashboard');
        } else {
            return back()
                ->withInput()
                ->with('error', 'Email or Password is not valid.');
        }
    }

    /**
     * Logout
     *SESSSION :SOTRAGE :framework:SESSION
     * @return RedirectResponse
     */
    public function logout(): RedirectResponse
    {
        // Clears all session data.and generate new session token
        Auth::logout();
        return redirect()->route('admin.auth.logout');
    }

    /**
     * @return View
     */
    //forget pass frontend 1st step
    public function forgotPassword(): View
    {
        return view('admin.auth.forgot_password');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function sendResetLinkEmail(Request $request): RedirectResponse
    {
  
        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.exists' => 'The email address does not exist.',
        ]);

       

        return view('admin.auth.new_password', compact('token'));
    }

    /**
     * @param Request $request
     * @param string $token
     * @return RedirectResponse
     */
    public function newPasswordSave(Request $request, string $token): RedirectResponse
    {
        
    }

    /**
     * @return View
     */
    public function profile(): View
    {
        $user = Auth::user();

        return view('admin.profile.profile', compact('user'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    function profileUpdate(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];

        // Image Upload
        if ($request->hasFile('image')) {
            // Delete previous file if exist
            $filename = $user->__get('image');
            
            if ($filename && Storage::exists('public/uploads/' . $filename)) {
                Storage::delete('public/uploads/' . $filename);
            }

            // Handle file upload
            $image = $request->file('image');
            $imageName = 'user_' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/uploads', $imageName);

            $data['image'] = $imageName;
        } else {
            $data['image'] = $user->__get('image');
            // $data['image'] = $user->image;
        }

        User::query()
            ->where('id', '=', Auth::id())
            ->update($data);

        return redirect()
            ->back()
            ->with('message', CoreHelper::success('Profile has been updated successfully.'));
    }

    /**
     * @return View
     */
    public function profilePassword(): View
    {
        return view('admin.profile.password');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function profilePasswordUpdate(Request $request): RedirectResponse
    {
       
    }
}
