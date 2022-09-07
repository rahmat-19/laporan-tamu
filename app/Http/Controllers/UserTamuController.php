<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserTamuRequest;
use App\Models\HistoryAttendanceGuests;
use App\Models\UserTamu;
use DateTime;

use Illuminate\Support\Facades\Storage;

class UserTamuController extends Controller
{
    public function index()
    {
        return view('tamu.searchLogin', [
            'title' => 'Guest | Login'
        ]);
    }

    public function create()
    {
        return view('tamu.create', [
            'title' => 'Guest | Create'
        ]);
    }

    public function outGuestPage()
    {
        $datas = UserTamu::where('status', 1)->orderby('name', 'ASC')->get();
        return view('tamu.searchLogout', [
            'title' => 'Guest | Logout',
            'datas' => $datas
        ]);
    }
    public function outGuest(UserTamu $userTamu)
    {
        $result = $userTamu->update([
            'status' => 0
        ]);

        $idSemenetara = $userTamu->id;
        if ($result) {
            $historyUpdate = HistoryAttendanceGuests::where('user_id', $idSemenetara)->latest()->first();
            $historyUpdate->update(['keluar' => new DateTime('now')]);

            return redirect(Route('masuk.tamu'));
        } else {

            return redirect(Route('masuk.tamu'));
        }
    }

    public function store(UserTamuRequest $request)
    {

        $validated = $request->validated();
        $img = $request->images;
        $folderPath = "public/uploads/";
        $image_parts = explode(";base64,", $img);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;

        $validated['images'] = $fileName;

        $result = UserTamu::create($validated);
        if ($result) {
            HistoryAttendanceGuests::create([
                'user_id' => $result->id,
                'keperluan' => $request->keperluan,
                'rak' => $request->rak,
                'masuk' => new DateTime('now')
            ]);


            Storage::put($file, $image_base64);
            return redirect(Route('create.tamu'));
        } else {
            return redirect(Route('create.tamu'));
        }
    }
}
