<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function createTimeTable()
    {
        $time_table_image_ar = Storage::url(Config::getValue('time_table_image_ar'));
        $time_table_image_en = Storage::url(Config::getValue('time_table_image_en'));

        return view('dashboard.config.change-time-table', ['time_table_image_ar' => $time_table_image_ar, 'time_table_image_en' => $time_table_image_en]);
    }

    public function storeTimeTable(Request $request)
    {
        $request->validate([
           'time_table_image_ar' => 'nullable|file',
           'time_table_image_en' => 'nullable|file'
        ]);

        if ($request->file('time_table_image_ar')){
            Config::setValue('time_table_image_ar', $request->file('time_table_image_ar')->store('/public/images'));
        }

        if ($request->file('time_table_image_en')){
            Config::setValue('time_table_image_en', $request->file('time_table_image_en')->store('/public/images'));
        }

        return redirect()->route('dashboard.config.storeTimeTable')->withSuccess('تم تحديث صورة الجدول الزمني بنجاح');
    }
}
