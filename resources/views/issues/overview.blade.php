@extends('layouts.master-right-sidebar', ['body_class' => 'body__issue_overview'])

@section('title', 'Issue Tracker Add Item')

@section('sidebar')
    <form method="post" action="{{ route('saveIssueIntake') }}" accept-charset="UTF-8">
        <h2>Add Issue</h2>
        {{ csrf_field() }}
        <div class="form-group">
            <label for="title">Subject</label>
            <input type="text" name="title" required class="form-control"></input>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" required class="form-control"></textarea>
        </div>
        <div>
        </div>
        <div class="form-group">
            <label for="assigned_to_group_id">Which department?</label>
            <select name="assigned_to_group_id" required class="form-control">
                <option value="">Select the appropriate group</option>
                <option value="1">Group 1</option>
                <option value="2">Group 2</option>
                <option value="3">Group 3</option>
            </select>
        </div>
        <input type="hidden" name="submitted_by_user_id" value="{{ Session::get('logged_in_user')->id }}">
        <button type="submit" class="btn btn-primary">Submit Issue</button>

    </form>
@endsection

@section('content')
    <div>
        <div style="display: none;">
            <?php print_r($session_data); ?>
            <hr />
            <?php print_r($issues); ?>
        </div>

        @if (count($issues))
            <h2>My Open Issues</h2>
            @foreach ($issues as $issue)
                @if (!$issue['closed_at'])
                    <div class="card" style="width: 18rem;">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $issue['title'] }}</h5>
                            <p class="card-text">{{ $issue['description'] }}</p>

                            <dl style="font-size: .8em;">
                                <dt>Assigned department:</dt>
                                <dd>{{ $issue['assigned_to_group_name'] }}</dd>
                                <dt>Submitted:</dt>
                                <dd>{{ $issue['created_at']->diffForHumans() }}</dd>
                            </dl>

                            <a href="/issueDetail/{{ $issue['id'] }}" class="btn btn-primary">View</a>

                        </div>
                    </div>
                @endif
            @endforeach
        @else
            <h2>No Open Issues?</h2>
            You don't have any open issues. Really? We all have issues. Go ahead and add yours.
        @endif


    </div>

    @if (count($issues_needing_response))
        <hr />
        <div>
            <h2>Issues Needing Response</h2>
        </div>
        @foreach ($issues_needing_response as $issue)
            <div class="card" style="width: 18rem;">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $issue['title'] }}</h5>
                    <p class="card-text">{{ $issue['description'] }}</p>

                    <dl style="font-size: .8em;">
                        <dt>Assigned department id:</dt>
                        <dd>{{ $issue['assigned_to_group_id'] }}</dd>
                        <dt>Submitted:</dt>
                        <dd>{{ $issue['created_at']->diffForHumans() }}</dd>
                        <dt></dt>
                        <dd></dd>
                    </dl>

                    <a href="/issueDetail/{{ $issue['id'] }}" class="btn btn-primary">View</a>

                </div>
            </div>
        @endforeach
    @endif




@endsection
