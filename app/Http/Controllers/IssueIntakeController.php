<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue_Intake;
use App\Models\Issue_Thread;
use App\Models\User;

class IssueIntakeController extends Controller
{
    //request is everything from form to endpoint
    public function saveItem(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        $newIssueIntake = new Issue_Intake;
        $keys = ['title', 'description', 'submitted_by_user_id', 'assigned_to_group_id'];
        foreach ($keys as $key) {
            //$newIssueIntake->description = $request->description;
            $newIssueIntake->$key = $request->$key;
        }
        $newIssueIntake->save();

        //return view('welcome', ['session_data' => $request->session()]);
        return redirect('/issues');
    }

    //request is everything from form to endpoint
    public function closeItem(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        $now = date("Y-m-d H:i:s");

        Issue_Intake::where('id', $request->id)->update(['closed_at' => $now]);

        return redirect('/issues');
    }

    public function getOverview(Request $request)
    {
        /* \Log::info(json_encode($request->all())); */


        if ($request->session()->missing('logged_in_user')) {
            return redirect('/');
        }

        $submitted_by_user = $request->session()->get('logged_in_user');
        $issues = Issue_Intake::where('submitted_by_user_id', $submitted_by_user->id)->where('closed_at', NULL)->get();
        $issues_needing_response = Issue_Intake::where('assigned_to_group_id', $submitted_by_user->user_groups)->where('closed_at', NULL)->get();

        for ($i = 0; $i < count($issues); $i++) {
            $issues[$i]->assigned_to_group_name = User::getDepartmentName($issues[$i]->assigned_to_group_id);
            //$issues[$i]->assigned_to_group_name = 'test';
        }

        //session(['issues' => $issues]);
        return view('issues.overview', ['session_data' => $request->session(), 'issues' => $issues, 'issues_needing_response' => $issues_needing_response, 'user' => $submitted_by_user]);
    }

    public function issueDetail($id, Request $request)
    {
        /* \Log::info(json_encode($request->all())); */
        if ($request->session()->missing('logged_in_user')) {
            return redirect('/login');
        }

        $issue = Issue_Intake::findOrFail($id);
        $thread_messages = Issue_Thread::where('issue_id', $id)->get()->toArray();

        for ($i = 0; $i < count($thread_messages); $i++) {
            $msg = $thread_messages[$i];
            $thread_messages[$i]['comment_user_detail'] = User::where('id', $msg['submitted_by_user_id'])->first();
        }

        $original_submit_user = User::findOrFail($issue->submitted_by_user_id);

        $issue->assigned_to_group_name = User::getDepartmentName($issue->assigned_to_group_id);

        return view('issues.detail', ['session_data' => $request->session(), 'issue' => $issue, 'thread_messages' => $thread_messages, 'original_submit_user' => $original_submit_user]);

        /*
        if ($request->session()->missing('user_registered_id')) {
            return redirect('/');
        }

        $user = User::where('id', $request->session()->get('user_registered_id'))->first();



        //session(['issues' => $issues]);

        */
    }
}
