<?php

namespace App\Http\Livewire;

use Exception;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserWelcomeEmailNotification;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class User extends Component
{
    public $users, $name, $email, $phone, $status, $user_id;
    public $isModalOpen = 0;
    public $isViewOpen = 0;
    public $confirmingDelete = 0;
    public $confirmRecordId = null;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = null;

    public $saved = false;

    public function render()
    {
        $this->users = ModelsUser::isUser()->get();
        return view('livewire.user.index');
    }

    public function showRecord($id)
    {
        return redirect(route('users.record', ['id' => encrypt($id)]));
    }

    public function viewRecord($id)
    {
        $rid = decrypt($id);

        $this->state = ModelsUser::isUser()->find($rid);

        return view('livewire.user.show', ['state' => $this->state]);
    }

    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }

    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }

    public function closeModalPopover()
    {
        $this->isModalOpen = false;
        $this->user_id = null;
    }

    public function openViewModal()
    {
        $this->isViewOpen = true;
    }

    public function closeViewModal()
    {
        $this->isViewOpen = false;
    }

    private function resetCreateForm(){
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->status = 0;
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $password = Str::random(10);
        $user = ModelsUser::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'password' => Hash::make($password)
        ]);

        try {
            $user->notify(new UserWelcomeEmailNotification($user, $password));
        } catch (Exception $ex) {

        } finally {
            session()->flash('message', 'User created.');

            $this->closeModalPopover();
            $this->resetCreateForm();
        }

    }

    public function update()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $user = ModelsUser::find($this->user_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);

        session()->flash('message', 'User updated.');

        $this->closeModalPopover();
        $this->resetCreateForm();

    }

    public function edit($id)
    {
        $user = ModelsUser::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->status = $user->status;

        $this->openModalPopover();
    }

    public function view($id)
    {
        $user = ModelsUser::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->status = $user->status;

        $this->openViewModal();
    }

    public function delete($id)
    {
        ModelsUser::find($id)->delete();
        session()->flash('message', 'User deleted.');

        $this->confirmRecordId = null;
        $this->confirmingDelete = false;
    }

    public function confirmDeletion($id)
    {
        $this->confirmRecordId = $id;
        $this->confirmingDelete = true;
    }

    /**
     * Update the user's password.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserPasswords  $updater
     * @return void
     */
    // public function updatePassword()
    // {
    //     $this->resetErrorBag();

    //     $this->validate($this->state, [
    //         'password' => 'required|confirmed'
    //     ], [
    //         'password.required' => 'New Password is required',
    //         'password.confirmed' => 'Passwords does not match',
    //     ]);

    //     // dd($validator->failed());

    //     User::find($this->user_id)->update([
    //         'password' => Hash::make($this->state['password'])
    //     ]);

    //     $this->state = [
    //         'password' => '',
    //         'password_confirmation' => '',
    //     ];

    //     $this->emit('saved');
    // }
}
