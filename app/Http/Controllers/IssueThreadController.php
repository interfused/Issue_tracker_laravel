<?php

namespace App\Http\Controllers;

use App\Models\Issue_Intake;
use App\Models\Issue_Thread;
use Illuminate\Http\Request;

class IssueThreadController extends Controller
{
    //
    public function addItem(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        $newIssueThreadItem = new Issue_Thread();
        $keys = ['issue_id', 'submitted_by_user_id', 'description', 'status'];
        foreach ($keys as $key) {
            $newIssueThreadItem->$key = $request->$key;
        }

        $newIssueThreadItem->save();

        if ($request->status === 'closed') {
            $now = date("Y-m-d H:i:s");
            Issue_Intake::where('id', $request->issue_id)->update(['closed_at' => $now]);
        }

        //return view('welcome', ['session_data' => $request->session()]);
        return redirect('/issueDetail/' . $request->issue_id);
    }
}
