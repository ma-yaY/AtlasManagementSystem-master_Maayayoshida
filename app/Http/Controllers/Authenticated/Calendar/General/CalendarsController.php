<?php

namespace App\Http\Controllers\Authenticated\Calendar\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Calendars\General\CalendarView;
use App\Models\Calendars\ReserveSettings;
use App\Models\Calendars\Calendar;
use App\Models\USers\User;
use Auth;
use DB;

class CalendarsController extends Controller
{
    public function show(){
        $calendar = new CalendarView(time());
        $user_reserve = new ReserveSettings();
        return view('authenticated.calendar.general.calendar', compact('calendar','user_reserve'));
    }

    public function reserve(Request $request){
        /*try {
              //例外の発生を捕まえたい処理
            } catch(Exception $e) {
                //例外が発生した時に行う処理
            } finally {
                //例外の発生に関係なく、必ず最後に行う処理
            }*/
        DB::beginTransaction();//以下処理のワンセット
        try{
            //予約を取得する
            $getPart = $request->getPart;
            $getDate = $request->getData;
            //コールバック関数使用し配列要素をフィルタリングする場合array_filter
            $reserveDays = array_filter(array_combine($getDate, $getPart));
            //2つの配列の一方をキー名、もう一方を値として、1つの配列に結合array_combine
            foreach($reserveDays as $key => $value){
                $reserve_settings = ReserveSettings::where('setting_reserve', $key)->where('setting_part', $value)->first();
                $reserve_settings->decrement('limit_users');
                //decrement減少increment増加
                $reserve_settings->users()->attach(Auth::id());
            }
            DB::commit();
        }catch(\Exception $e){// 失敗時に元に戻る処理
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);

    }


    public function delete(Request $request){
        dd($request);
        DB::beginTransaction();//以下処理のワンセット
        try{
            $cancelPart = $request->delete_part;
            $cancelDate = $request->delete_date;

                $reserve_settings = ReserveSettings::where('setting_reserve', $cancelDate)->where('setting_part', $cancelPart)->first();
                $reserve_settings->increment('limit_users');
                //decrement減少increment増加
                $reserve_settings->users()->detach(Auth::id());/*修正*/
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->route('calendar.general.show', ['user_id' => Auth::id()]);
    }

}
