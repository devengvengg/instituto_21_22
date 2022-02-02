<?php

namespace App\Policies;

use App\Models\Centro;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CentroPolicy
{
    use HandlesAuthorization;

    // Creamos La Funcion:
   /**
    * Perform pre-authorization checks.
    *
    * @param  \App\Models\User  $user
    * @param  string  $ability
    * @return void|bool
    */
    public function before(User $user, $ability) {
	    if ($user->isAdministrator()) {
	        return true;
	    }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->id == 10; // Ej de autorizacion a un usuario concreto.
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Centro $centro)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user) {
        return $user->role == 1; //'administrador';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Centro $centro) {
        //Agregamos:
	return $user->id === $centro->coordinador;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Centro $centro)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Centro $centro)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Centro  $centro
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Centro $centro)
    {
        //
    }
}
