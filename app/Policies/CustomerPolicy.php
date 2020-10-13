<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Gate;

class CustomerPolicy
{
    use HandlesAuthorization;

    public function viewAny($user)
    {
        return Gate::any(['root', 'viewOwnCustomerPage', 'editOwnCustomerPage'], $user);
    }

    public function view($user, $post)
    {
        if($user->hasRoleWithPermission('viewOwnCustomerPage')){
            if($user->id == $post->user_id){
                return true;
            }
        }
        return Gate::any([ 'root'], $user, $post);
    }

    public function create($user)
    {
        return Gate::any(['root']);
    }

    public function update($user, $post)
    {
        if($user->hasRoleWithPermission('editOwnCustomerPage')){
            if($user->id == $post->user_id){
                return true;
            }
        }
        return Gate::any(['root'], $post);
    }

    public function delete($user, $post)
    {
        return Gate::any(['root'], $post);
    }

    public function restore($user, $post)
    {
        return Gate::any(['root'], $post);
    }

    public function forceDelete($user, $post)
    {
        return Gate::any(['root'], $post);
    }
}
