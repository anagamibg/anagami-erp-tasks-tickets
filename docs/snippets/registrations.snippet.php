<?php

/*
|--------------------------------------------------------------------------
| Регистрации, които трябва да се добавят в host приложението
|--------------------------------------------------------------------------
| Този файл НЕ се зарежда от Laravel - това е справка с редовете, извадени
| дословно от оригиналните app/Providers/EventServiceProvider.php,
| app/Providers/SuperAdmin/EventServiceProvider.php и app/Console/Kernel.php.
| Добавете ги (заедно със съответните use) в същите файлове на ERP системата.
*/

// ---------------------------------------------------------------------------
// app/Providers/EventServiceProvider.php  ->  protected $listen
// ---------------------------------------------------------------------------
//         SubTaskCompletedEvent::class => [SubTaskCompletedListener::class],
//         TaskCommentEvent::class => [TaskCommentListener::class],
//         TaskCommentMentionEvent::class => [TaskCommentMentionListener::class],
//         TaskNoteEvent::class => [TaskNoteListener::class],
//         TaskNoteMentionEvent::class => [TaskNoteMentionListener::class],
//         TaskEvent::class => [TaskListener::class],
//         TicketEvent::class => [TicketListener::class],
//         TicketReplyEvent::class => [TicketReplyListener::class],
//         AutoTaskReminderEvent::class => [AutoTaskReminderListener::class],
//         TaskReminderEvent::class => [TaskReminderListener::class],
//         TicketRequesterEvent::class => [TicketRequesterListener::class],
//         MailTicketReplyEvent::class => [MailTicketReplyListener::class],

// ---------------------------------------------------------------------------
// app/Providers/EventServiceProvider.php  ->  protected $observers
// ---------------------------------------------------------------------------
//         SubTask::class => [SubTaskObserver::class],
//         Task::class => [TaskObserver::class],
//         TaskboardColumn::class => [TaskBoardColumnObserver::class],
//         TaskCategory::class => [TaskCategoryObserver::class],
//         TaskComment::class => [TaskCommentObserver::class],
//         TaskFile::class => [TaskFileObserver::class],
//         TaskLabelList::class => [TaskLabelListObserver::class],
//         TaskNote::class => [TaskNoteObserver::class],
//         TaskUser::class => [TaskUserObserver::class],
//         Ticket::class => [TicketObserver::class],
//         TicketEmailSetting::class => [TicketEmailSettingObserver::class],
//         TicketReply::class => [TicketReplyObserver::class],
//         TicketFile::class => [TicketFileObserver::class],
//         TicketReplyTemplate::class => [TicketReplyTemplateObserver::class],
//         TicketGroup::class => [TicketGroupObserver::class],
//         TicketAgentGroups::class => [TicketAgentGroupsObserver::class],
//         TicketChannel::class => [TicketChannelObserver::class],
//         TicketCustomForm::class => [TicketCustomFormObserver::class],
//         TicketType::class => [TicketTypeObserver::class],
//         TaskSetting::class => [TaskSettingObserver::class],
//         TicketTag::class => [TicketTagObserver::class],
//         TicketTagList::class => [TicketTagListObserver::class],
//         UserTaskboardSetting::class => [UserTaskboardSettingObserver::class],

// ---------------------------------------------------------------------------
// app/Providers/SuperAdmin/EventServiceProvider.php  ->  protected $listen
// ---------------------------------------------------------------------------
//         NewSupportTicketEvent::class => [NewSupportTicketListener::class],
//         SupportTicketReplyEvent::class => [SupportTicketReplyListener::class],
//         SupportTicketRequesterEvent::class => [SupportTicketRequesterListener::class],
// Забележка: SupportTicket и SupportTicketReply регистрират наблюдателите си
// директно в моделите (static::observe(...)) - допълнителна регистрация не е нужна.

// ---------------------------------------------------------------------------
// app/Console/Kernel.php  ->  $commands и schedule()
// ---------------------------------------------------------------------------
//         SendAutoTaskReminder::class,
//         AutoCreateRecurringTasks::class,
//         FetchTicketEmails::class,
//         $schedule->command('recurring-task-create')->dailyAt('00:30');
//         // $schedule->command('fetch-ticket-emails')->everyMinute(); // phpcs:ignore
//         $schedule->command('send-auto-task-reminder')->dailyAt('01:20');
