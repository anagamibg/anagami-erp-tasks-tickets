<?php

// Извадка от resources/lang/eng/email.php - само ключовете за задачи и тикети.
// НЕ презаписвайте оригиналния файл: слейте ключовете (array_merge) в съответния езиков файл на ERP системата.

return [
    'newTask' => [
        'subject' => 'Task Assignment: A New Task has been Assigned to You',
        'text' => 'We hope you\'re having a great day! You have been assigned a new task.',
        'mentionSubject' => 'You\'ve Been Mentioned in a Task!',
        'mentionTask' => 'Heads up! You\'ve been mentioned in a task.',
    ],
    'newTicket' => [
        'subject' => 'New Support Ticket Requested',
        'text' => 'New Support Ticket is requested. Login to view the ticket.',
        'action' => 'View Ticket',
    ],
    'taskComplete' => [
        'subject' => 'Task marked as complete',
        'action' => 'View Task',
        'completedBy' => 'Task completed by',
    ],
    'taskUpdate' => [
        'subject' => 'Your Task Has Been Updated!',
        'text' => 'Just a quick heads-up! A task assigned to you has been updated.',
        'text2' => 'To check out the changes and keep things moving, log in to your account and head over to the Task section.',
        'action' => 'View Task',
        'updatedBy' => 'Task Status Updated By',
        'statusUpdated' => 'Your Task Status Has Been Updated!',
        'slackStatusUpdated' => 'The following task has been updated, Assigned Employees please check the task for updates!',
    ],
    'taskApproval' => [
        'subject' => 'Task sent for the approval.',
        'text' => 'Task sent for the approval.',
        'action' => 'View Task',
        'updatedBy' => 'Updated By',
    ],
    'newClientTask' => [
        'subject' => 'New Task Generated',
        'content' => 'A New Task has been Created in Project',
    ],
    'taskReminder' => [
        'subject' => 'Urgent Task Reminder: Deadline Approaching',
    ],
    'taskComment' => [
        'subject' => 'New comment on task',
        'action' => 'View Task Comment',
        'mentionTask' => 'You have been mentioned in a task comment',
        'mentionSubject' => 'Mentioned On Comment',
        'commentedBy' => 'Commented by',
    ],
    'taskNote' => [
        'subject' => 'New note added for task',
        'action' => 'View Task Note',
        'mentionNote' => 'You have been mention in task note',
        'mentionSubject' => 'Mentioned On Note',
    ],
    'ticketAgent' => [
        'subject' => 'You have been assigned a ticket',
        'text' => 'You have been assigned a new ticket.',
        'action' => 'View Ticket',
        'mentionSubject' => 'You have been mentioned in a ticket',
        'mentionedText' => 'You have been mentioned in a new ticket',
    ],
    'subTaskComplete' => [
        'subject' => 'Sub Task marked as complete',
        'action' => 'View Sub Tasks',
    ],
    'subTaskAssigneeAdded' => [
        'subject' => 'Sub Task assigned to you.',
        'text' => 'You have been added as assignee on Task ',
        'action' => 'View Sub Tasks',
    ],
    'subTaskCreated' => 'Sub task created.',
    'ticketReply' => [
        'receivedNote' => 'added a note and wants you to have a look.',
        'subject' => 'New ticket reply received',
        'receivedText' => 'You have received a reply on ticket ',
        'repliedText' => 'You have replied on ticket ',
        'action' => 'View Ticket',
        'text' => 'You have received a reply on ticket ',
        'noteAdded' => 'Note Added',
    ],
    'newTicketRequester' => [
        'subject' => 'New Ticket Has Been Generated For You.',
        'text' => 'New support ticket is has been generated for you. Login to view the ticket.',
        'action' => 'View Ticket',
    ],
];
