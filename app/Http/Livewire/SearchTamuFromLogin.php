<?php

namespace App\Http\Livewire;

use App\Models\HistoryAttendanceGuests;
use App\Models\UserTamu;
use DateTime;
use Livewire\Component;

class SearchTamuFromLogin extends Component
{
    public $itemId;
    public $keperluan = [];
    public $rak = [];

    protected $rules = [
        'keperluan' => 'required',
        'rak' => 'required'
    ];

    protected $listeners = [
        'keperlaun',
    ];

    public function keperlaun($value)
    {
        $this->itemId = $value;
    }
    public function save()
    {
        $validatedData = $this->validate($this->rules);

        $userMasuk = UserTamu::find($this->itemId);
        $result = $userMasuk->update([
            'status' => 1
        ]);
        if ($result) {
            $validatedData['user_id'] = $this->itemId;
            $validatedData['masuk'] = new DateTime('now');
            HistoryAttendanceGuests::create($validatedData);
            return redirect(Route('masuk.tamu'));
        }
    }
    public function render()
    {
        return view('livewire.search-tamu-from-login');
    }
}
