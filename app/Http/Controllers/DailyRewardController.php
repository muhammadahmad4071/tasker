<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyRewardController extends Controller
{
    public function update(Request $request) {
        $validated = $request->validate([
            'day' => 'required|integer|min:0|max:9'
        ]);

        $user = $request->user();
        $dailyReward = $user->dailyReward;
        $claimed = str_split($dailyReward->claimed, 1);
        $claimed[(int)$validated['day']] = 1;
        $dailyReward->claimed = implode("", $claimed);
        $dailyReward->save();

        return back();
    }
}
