<?php

namespace App\Policies\Employer;

use App\Models\Account;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

//employer blog controller
//2 ta model upload dilam
//ekta blog model r ekta account jat ekore user authentication kaj kore
//policy make korar somoy php artisan make:policy PostPolicy ekhane (Post eta model name hobe)
//amra banaisi php artisan make:Blog PostPolicy --model=Blog 
class BlogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Account $account): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * 
     * view function 2 ta paraemetr (account model theke aacount Blog model theke)true false
     * id account tble er collum= blog model er account id er sathe true hobe tokhon view hobe
     * blog controller gate
     */
    public function view(Account $account, Blog $blog): bool
    {
        return $account->__get('id') == $blog->__get('account_id');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Account $account): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * function update....2 ta parameter account model $account,$blog blog model
     * $account->__get('id')=id authenticated kina
     * $blog->__get('account_id')=user id foregn key blogpost...
     * ai 2 ta jodi same hoy..mane je user login korse shei tar post change korte chay tahole return ture
     *  hobe or false
     * blog controller gate
     */
    public function update(Account $account, Blog $blog): bool
    {
        return $account->__get('id') == $blog->__get('account_id');
    }

    /** * view function 2 ta paraemetr (account model theke aacount Blog model theke)true false
     * id user account tble er collum= blog model er account id er sathe true hobe tkhn delete hobe
     *blog controller gate
     */
    public function delete(Account $account, Blog $blog): bool
    {
        return $account->__get('id') == $blog->__get('account_id');
    }

    /**
     *  * view function 2 ta paraemetr (account model theke aacount Blog model theke)true false
     * id user account tble er collum= blog model er account id er sathe true hobe tkhn restore hobe
     * blog controller gate
     */
    public function restore(Account $account, Blog $blog): bool
    {
        return $account->__get('id') == $blog->__get('account_id');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, Blog $blog): bool
    {
        return $account->__get('id') == $blog->__get('account_id');
    }
}
