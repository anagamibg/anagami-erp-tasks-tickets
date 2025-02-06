<?php

// Извадка от resources/lang/eng/messages.php - само ключовете за задачи и тикети.
// НЕ презаписвайте оригиналния файл: слейте ключовете (array_merge) в съответния езиков файл на ERP системата.

return [
    'taskTimerRunning' => 'Task timer is Active',
    'youCannotMoveTask' => 'You cannot move this task to the selected status.',
    'projectTasksNotCompleted' => 'Please complete the tasks of project.',
    'newTaskAddedToTheProject' => 'New task added to the project.',
    'ticketReplySuccess' => 'Reply sent successfully.',
    'taskUpdated' => 'Marked the task as ',
    'timerStartedTask' => 'Started the timer for task ',
    'noTicketTypeAdded' => 'No ticket type added.',
    'noSubTaskFound' => 'Seems like no sub task exists in the database. Please create the sub task first',
    'removeTicketText' => 'This will remove the ticket type from the list.',
    'ticketText' => 'You will not be able to recover the deleted ticket!',
    'deleteTask' => 'You will not be able to recover the deleted task!',
    'markCompleteTask' => 'There is an incomplete sub-task in this task do you want to mark complete!',
    'sendApprovalTask' => 'Do you want to send approval for this task to admin?',
    'ticketCreateSuccess' => 'Ticket created successfully.',
    'taskAfterDateValidation' => 'Task end date should not be less than the task start date',
    'taskBeforeDateValidation' => 'Task end date should not be greater than the milestones end date',
    'noTaskFound' => 'Seems like no task exists. Please create the task first',
    'noTaskFilesFound' => 'Seems like no task files uploaded.',
    'noTicketsFound' => 'Seems like no tickets exist.',
    'unresolveTicketInfo' => 'Tickets with status Pending or Open.',
    'unassignTicketInfo' => 'Tickets which are not assigned to an agent.',
    'taskDependentDate' => 'Dependent task due date cannot be in future.',
    'resolveTicketInfo' => 'Tickets with status Closed or Resolved.',
    'archivedTaskNotWork' => 'You will not be able to act on archived project tasks.',
    'calculateTaskProgress' => 'We calculate progress on task completion',
    'noTicketChannelAdded' => 'No Ticket Channel Added',
    'unassignedTask' => 'The project :has :unassigned unassigned :task. To show unassigned :task',
];
