@extends('layouts.master', ['body_class' => 'body__issue_detail'])

@section('title', 'Issue Tracker | ' . $issue['title'])

@section('sidebar')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $issue['title'] }}</h2>
            <dl>
                <dt>Description:</dt>
                <dd>{{ $issue['description'] }}</dd>
                <dt>Assigned department:</dt>
                <dd>{{ $issue['assigned_to_group_name'] }}</dd>
                <dt>Submitted by:</dt>
                <dd>{{ $original_submit_user->email }}</dd>
                <dt>When:</dt>
                <dd>{{ $issue['created_at']->diffForHumans() }}</dd>

            </dl>
        </div>
    </div>
@endsection

@section('content')
    <div>
        <div style="display: none;">
            <?php print_r($session_data); ?>
            <hr />
            <?php print_r($issue); ?>
            <pre><?php print_r($thread_messages); ?>
            </pre>
        </div>
        <div class="content_section">
            <h2>Issue Thread</h2>
            @if (count($thread_messages))
                @foreach ($thread_messages as $thread)
                    <div class="thread">
                        <div>{{ $thread['description'] }}</div>
                        <small>submitted by: {{ $thread['comment_user_detail']['email'] }}
                            <br />
                            {{ \Carbon\Carbon::parse($thread['created_at'])->diffForHumans() }}
                            <br />
                            STATUS: {{ $thread['status'] }}
                        </small>

                    </div>
                @endforeach
            @else
                no follow-ups yet. add one
            @endif


        </div>

        @if (!$issue['closed_at'])
            <form method="post" action="{{ route('saveIssueThread') }}" accept-charset="UTF-8" class="content_section">
                <h2>Add Update</h2>
                {{ csrf_field() }}

                <?php
                $textarea_fields = [];
                $textarea_fields[] = ['k' => 'description', 'label' => 'Description'];

                ?>
                @foreach ($textarea_fields as $field)
                    <div class="form-group">
                        <label for="<?php echo $field['k']; ?>"><?php echo $field['label']; ?></label>
                        <textarea name="<?php echo $field['k']; ?>" required class="form-control"></textarea>
                    </div>
                @endforeach

                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" required class="form-control">
                        <option value="">Select</option>
                        <option value="waiting">Waiting on User</option>
                        <option value="blocked">Blocked</option>
                        <option value="closed">Closed</option>
                    </select>

                </div>


                <input type="hidden" name="issue_id" value="{{ $issue['id'] }}" />
                <input type="hidden" name="submitted_by_user_id" value="{{ Session::get('logged_in_user')->id }}">
                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        @endif
    </div>
@endsection
