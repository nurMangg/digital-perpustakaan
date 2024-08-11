<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Buku;

class BukuPolicy
{
    public function view(User $user, Buku $buku)
    {
        return $user->isAdmin() || $user->id === $buku->user_id;
    }

    public function update(User $user, Buku $buku)
    {
        return $user->isAdmin() || $user->id === $buku->user_id;
    }

    public function delete(User $user, Buku $buku)
    {
        return $user->isAdmin() || $user->id === $buku->user_id;
    }
}
