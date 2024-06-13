<?php

namespace App\Livewire\UserSuperAdmin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $paginate;
    public $sortBy;
    public $sortDirection;
    public $userCount;
    public $userID;
    public $name;
    public $password;
    public $confirmPassword;

    public function mount(){
        $this->sortBy = 'created_at';
        $this->sortDirection = 'desc';
        $this->paginate = 10;
        $this->userCount = User::whereNotIn('id', [1])->count();
    }

    public function swapSortDirection(){
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function sortTable($columnName){
        if($this->sortBy === $columnName){
            $this->sortDirection = $this->swapSortDirection();
        }
        else {
            $this->sortDirection = 'asc';
        }
        $this->sortBy = $columnName;
    }

    public function updatedPaginate(){
        $this->resetPage();
    }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function editPassword($id){
        if($id != 1){
            $user = User::where('id', $id)->first();
            if($user){
                $this->userID = $user->id;
                $this->name = $user->name;

                $this->dispatch('edit-password');
            }
        }
    }

    public function updatePassword(){
        $this->validate([
            'password' => 'required|max:100',
            'confirmPassword' => 'required|max:100|same:password',
        ]);

        if($this->userID != 1){
            User::where('id', $this->userID)
            ->update([
                'password' => bcrypt($this->password),
            ]);

            $this->dispatch('update-password');
        }
    }

    public function openEnableUser($id){
        if($id != 1){
            $user = User::where('id', $id)->first();
            if($user){
                $this->userID = $user->id;
                $this->name = $user->name;

                $this->dispatch('open-enable-user');
            }
        }
    }

    public function enableUser(){
        if($this->userID != 1){
            $user = User::where('id', $this->userID)
            ->update([
                'is_disabled' => null,
            ]);

            $this->dispatch('enable-user');
        }
    }

    public function openDisableUser($id){
        if($id != 1){
            $user = User::where('id', $id)->first();
            if($user){
                $this->userID = $user->id;
                $this->name = $user->name;

                $this->dispatch('open-disable-user');
            }
        }
    }

    public function disableUser(){
        if($this->userID != 1){
            $user = User::where('id', $this->userID)
            ->update([
                'is_disabled' => 1,
            ]);

            $this->dispatch('disable-user');
        }
    }

    public function resetInputs(){
        $this->userID = null;
        $this->name = null;
        $this->password = null;
        $this->confirmPassword = null;

        $this->resetValidation();
    }

    public function fetchUsers(){
        $users = User::whereNotIn('users.id', [1])
            ->where(function($q){
                $q->where('users.name', 'like', '%'.$this->search.'%')
                ->orWhere('users.username', 'like', '%'.$this->search.'%')
                ->orWhereHas('company', function($query){
                    $query->where('name', 'like', '%'.$this->search.'%');
                })
                ->orWhereHas('roles', function($query){
                    $query->where('name', 'like', '%'.$this->search.'%');
                });
            })
            ->leftJoin('company', 'company.id', '=', 'users.company_id')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->select('users.*', 'company.name as companyName')
            ->paginate($this->paginate);
        // dd($users);
        return $users;
    }

    public function render()
    {
        return view('livewire.user-super-admin.index', [
            'users' => $this->fetchUsers()
        ]);
    }
}
