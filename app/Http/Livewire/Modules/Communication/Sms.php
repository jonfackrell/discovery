<?php

namespace App\Http\Livewire\Modules\Communication;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class Sms extends Component
{
    public $items = [];

    protected $listeners = [
        'sms',
        'send',
    ];

    public function render()
    {
        return view('livewire.modules.communication.sms.send');
    }

    public function sms($items)
    {
        $this->items = $items;
    }

    public function send($data)
    {
        $phoneNumber = $data['phone_number'];
        session(['phone_number' => $phoneNumber]);

        foreach ($this->items as $item) {
            $response = Http::get(
                "https://abish.byui.edu/horizon/api/index.cfm/sms/" . $item['item'],
                [
                    'authorization' => env('HORIZON_API_TOKEN'),
                ]
            );
            $record = $response->json()['items'][0];
            if ($response->ok()) {
                $message = Str::limit($record['call_number'] . ' ' . $record['collection'] . ' ' . $record['title'], 90, '...');
                \Twilio::message($phoneNumber, $message);
            }
        }
    }
}
