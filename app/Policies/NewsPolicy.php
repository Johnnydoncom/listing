<?php

namespace App\Policies;

use App\Models\Auth\User;
use App\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if($user->isAdmin()){
            return true;
        }
    }

    /**
     * Determine whether the user can view the news.
     *
     * @param  \App\Models\Auth\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function view(User $user, News $news)
    {
        //
    }

    /**
     * Determine whether the user can create news.
     *
     * @param  \App\Models\Auth\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \App\Models\Auth\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function update(User $user, News $news)
    {
        return $user->id == $news->author;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \App\Models\Auth\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function delete(User $user, News $news)
    {
        return $user->id == $news->author;
    }

    /**
     * Determine whether the user can restore the news.
     *
     * @param  \App\Models\Auth\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function restore(User $user, News $news)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the news.
     *
     * @param  \App\Models\Auth\User  $user
     * @param  \App\News  $news
     * @return mixed
     */
    public function forceDelete(User $user, News $news)
    {
        //
    }
}
