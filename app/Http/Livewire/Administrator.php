<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserWelcomeEmailNotification;

class Administrator extends Component
{
    public $users, $name, $email, $phone, $status, $user_id;
    public $isModalOpen = 0;
    public $isViewOpen = 0;
    public $confirmingDelete = 0;
    public $confirmRecordId = null;

    public function render()
    {
        $this->users = User::isAdmin()->get();
        return view('livewire.administrator.index');
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
        $user = User::updateOrCreate(['id' => $this->user_id], [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
            'password' => Hash::make($password),
            'role' => 'doctor'
        ]);

        try {
            $user->notify(new UserWelcomeEmailNotification($user, $password));
        } catch (\Exception $ex) {

        } finally {
            session()->flash('message', 'Administrator created.');

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

        $user = User::find($this->user_id);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Administrator updated.');

        $this->closeModalPopover();
        $this->resetCreateForm();

    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->status = $user->status;

        $this->openModalPopover();
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->status = $user->status;

        $this->openViewModal();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Administrator deleted.');

        $this->confirmRecordId = null;
        $this->confirmingDelete = false;
    }

    public function confirmDeletion($id)
    {
        $this->confirmRecordId = $id;
        $this->confirmingDelete = true;
    }
}
