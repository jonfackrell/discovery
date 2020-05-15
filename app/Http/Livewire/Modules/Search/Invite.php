<?php

use App\User;
use Livewire\Component;

class Invite extends Component
{

    public $email = null;
    public $folder;
    public $users = [];



    public function mount(\App\Folder $folder)
    {
        $this->folder = $folder;
    }

    public function render()
    {
        $this->users = [];
        return view('livewire.modules.search.invite');
    }



}
