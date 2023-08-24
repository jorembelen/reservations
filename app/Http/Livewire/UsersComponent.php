<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class UsersComponent extends Component
{
    public $userId;
    public $password;
    public $password_confirmation;
    public $state = [];
    protected $listeners = ['delete'];

    public function render()
    {
        $users = User::query()->latest()->get();

        return view('livewire.users-component', compact('users'));
    }

    public function close() 
    {
        $this->dispatchBrowserEvent('hide-modal');
    }
    
    public function create() 
    {
        $this->dispatchBrowserEvent('show-modal');
    }
    
    public function edit(User $user) 
    {
        $this->dispatchBrowserEvent('show-edit-modal');
        $this->state = $user->toArray();
        $this->userId = $user->id;
    }

    public function submit() 
    {
        $data = Validator::make($this->state, [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ])->validate();

        $user = User::create($data);
        $this->getAlert($user->name .' was successfully created!');
        $this->close();
    }
    
    public function update(User $user) 
    {
        $data = Validator::make($this->state, [
            'name' => 'required',
            'username' => 'required|unique:users,username,' .$user->id,
            'email' => 'required|email|unique:users,email,' .$user->id,
        ])->validate();

        if($this->password) {
            $this->validate(['password' => 'required|min:6|confirmed']);
            $data['password'] = $this->password;
        }

        $user->update($data);
        $this->getAlert($user->name .' was successfully updated!');
        $this->close();
    }

    public function getAlert($msg) 
    {
        $this->dispatchBrowserEvent('swal:modal',[
            'type' => 'success',
            'title' => 'Success',
            'text' => $msg
        ]);
    }

       /**
     * show confirmation on delete
     *
     * @param  mixed $id
     * @return void
     */
    public function confirmDelete($id)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure? Please confirm to proceed.',
            'id' => $id
        ]);
    }

    public function delete(User $user) 
    {
        $user->delete();
        $this->getAlert('User was successfully deleted!', 'success');
        $this->close();
    }

}
