<?php

// Извадка от resources/lang/eng/clan.php - само ключовете за задачи и тикети.
// НЕ презаписвайте оригиналния файл: слейте ключовете (array_merge) в съответния езиков файл на ERP системата.

return [
    'tasks' => [
        'rate' => 'Rate',
        'rating' => 'Rating',
        'addRating' => 'Add Rating',
        'coldTask' => 'Cold Task',
        'addWatchers' => 'Add Task Watchers',
        'taskWatchers' => 'Task Watchers',
        'taskWatchersMessage' => 'Watchers are people who are notified when changes are made to a task.',
        'timeEstimateRequired' => 'Time estimate is required?',
        'timeEstimateRequiredInfo' => 'Set estimated time you expect this task to be closed',
        'lastUpdatedOn' => 'Last updated on',
        'showGitlab' => 'Gitlab Tasks',
        'taskWithoutEstimateTime' => 'Tasks without estimate time',
        'taskWithoutStartDate' => 'Tasks without start date',
        'completed_tasks_not_rated' => 'Task(s) are completed for this duration but not rated yet',
        'taskRatingButtonMessage' => 'Task rating button works if task is completed or you have permission to rate.',
        'employeeWiseTaskReport' => 'Employee Wise Task Report',
        'totalTaskAssigned' => 'Total Task Assigned',
        'totalTaskCompleted' => 'Total Task Completed',
        'totalTaskPending' => 'Total Task Pending',
        'missedDeadline' => 'Missed Deadline',
        'task_missed_deadline_column' => 'Missed Deadline:- Task(s) which are completed but their deadline is missed.',
    ],
    'coldTask' => [
        'subject' => 'Cold Tasks',
        'content' => 'These are tasks which were not updated in last 30 days',
        'action' => 'View Cold Tasks',
    ],
    'taskWatcher' => [
        'subject' => 'You are added as a watcher in this task',
        'action' => 'Vew Task',
    ],
    'dependentTaskComplete' => [
        'subject' => 'Dependent Task Completed',
        'action' => 'View Task',
        'completedBy' => 'Task completed by',
    ],
];
