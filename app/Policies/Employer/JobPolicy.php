<?php

namespace App\Policies\Employer;

use App\Models\JobPost;
use App\Models\Account;

class JobPolicy
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
     */
    public function view(Account $account, JobPost $jobPost): bool
    {
        return $account->__get('id') == $jobPost->__get('account_id');
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
     */
    public function update(Account $account, JobPost $jobPost): bool
    {
        return $account->__get('id') == $jobPost->__get('account_id');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Account $account, JobPost $jobPost): bool
    {
        return $account->__get('id') == $jobPost->__get('account_id');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Account $account, JobPost $jobPost): bool
    {
        return $account->__get('id') == $jobPost->__get('account_id');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Account $account, JobPost $jobPost): bool
    {
        return $account->__get('id') == $jobPost->__get('account_id');
    }
}
