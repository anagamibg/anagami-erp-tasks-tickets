<?php

/*
|--------------------------------------------------------------------------
| Anagami ERP - модул "Задачи и тикети" - дефиниции на маршрути
|--------------------------------------------------------------------------
|
| Този файл съдържа САМО маршрутите за задачи и тикети, извадени дословно от
| routes/web.php, routes/web-settings.php, routes/web-public.php и
| routes/SuperAdmin/web.php. Всяка секция запазва оригиналните middleware и
| prefix на групата, от която е взета.
|
| Подключване - в RouteServiceProvider::boot() (или чрез require във всеки от
| оригиналните файлове), напр.:
|
|   Route::middleware(['web', 'check-company-package', 'auto-logout'])
|       ->group(base_path('routes/tasks-tickets.routes.php'));
|
| Забележка: секциите "public" и "super admin" в оригинала се зареждат с
| различни middleware (виж RouteServiceProvider) - при нужда ги разделете
| на отделни файлове. Контролерите HomeController (публични страници) и
| DashboardController не са част от модула.
*/

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RecurringTaskController;
use App\Http\Controllers\SubTaskController;
use App\Http\Controllers\SubTaskFileController;
use App\Http\Controllers\SuperAdmin\SupportTicketFileController;
use App\Http\Controllers\SuperAdmin\SupportTicketReplyController;
use App\Http\Controllers\SuperAdmin\SupportTicketsController;
use App\Http\Controllers\SuperAdmin\SupportTicketTypeController;
use App\Http\Controllers\TaskBoardController;
use App\Http\Controllers\TaskCalendarController;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskFileController;
use App\Http\Controllers\TaskLabelController;
use App\Http\Controllers\TaskNoteController;
use App\Http\Controllers\TaskReportController;
use App\Http\Controllers\TaskSettingController;
use App\Http\Controllers\TicketAgentController;
use App\Http\Controllers\TicketChannelController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCustomFormController;
use App\Http\Controllers\TicketEmailSettingController;
use App\Http\Controllers\TicketFileController;
use App\Http\Controllers\TicketGroupController;
use App\Http\Controllers\TicketReplyController;
use App\Http\Controllers\TicketReplyTemplatesController;
use App\Http\Controllers\TicketSettingController;
use App\Http\Controllers\TicketTypeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. Основно приложение (оригинал: routes/web.php)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'multi-company-select', 'email_verified'], 'prefix' => 'account'], function () {

    // Клиентски контакти за формата за тикет (оригинално в групата с клиентите)
    Route::get('get-contacts', [TicketController::class, 'getContacts'])->name('get.contacts');

    /* TASKS */
    Route::get('tasks/client-detail', [TaskController::class, 'clientDetail'])->name('tasks.clientDetail');
    Route::post('tasks/change-status', [TaskController::class, 'changeStatus'])->name('tasks.change_status');
    Route::post('tasks/change-milestone', [TaskController::class, 'milestoneChange'])->name('tasks.change_milestone');

    Route::post('tasks/apply-quick-action', [TaskController::class, 'applyQuickAction'])->name('tasks.apply_quick_action');
    Route::post('tasks/store-pin', [TaskController::class, 'storePin'])->name('tasks.store_pin');
    Route::post('tasks/reminder', [TaskController::class, 'reminder'])->name('tasks.reminder');
    Route::post('tasks/destroy-pin/{id}', [TaskController::class, 'destroyPin'])->name('tasks.destroy_pin');
    Route::post('tasks/check-task/{taskID}', [TaskController::class, 'checkTask'])->name('tasks.check_task');
    Route::post('tasks/send-approval', [TaskController::class, 'sendApproval'])->name('tasks.send_approval');
    Route::post('tasks/gantt-task-update/{id}', [TaskController::class, 'updateTaskDuration'])->name('tasks.gantt_task_update');
    Route::get('tasks/members/{id}', [TaskController::class, 'members'])->name('tasks.members');
    Route::get('tasks/project_tasks/{id}', [TaskController::class, 'projectTasks'])->name('tasks.project_tasks');
    Route::get('tasks/check-leaves', [TaskController::class, 'checkLeaves'])->name('tasks.checkLeaves');
    Route::get('tasks/waiting-approval', [TaskController::class, 'waitingApproval'])->name('tasks.waiting-approval');
    Route::get('tasks/show-waiting-approval-change-status-modal', [TaskController::class, 'statusReason'])->name('tasks.show_status_reason_modal');
    Route::post('tasks/store-status-reason', [TaskController::class, 'storeStatusReason'])->name('tasks.store_comment_on_change_status');

    Route::group(['prefix' => 'tasks'], function () {

        Route::post('recurring-task/apply-quick-action', [RecurringTaskController::class, 'applyQuickAction'])->name('recurring-task.apply_quick_action');
        Route::resource('recurring-task', RecurringTaskController::class);

        Route::resource('task-label', TaskLabelController::class);
        Route::resource('taskCategory', TaskCategoryController::class);
        Route::post('taskComment/save-comment-like', [TaskCommentController::class, 'saveCommentLike'])->name('taskComment.save_comment_like');
        Route::resource('taskComment', TaskCommentController::class);
        Route::resource('task-note', TaskNoteController::class);

        // task files routes
        Route::get('task-files/download/{id}', [TaskFileController::class, 'download'])->name('task_files.download');
        Route::resource('task-files', TaskFileController::class);

        // Sub task routes
        Route::post('sub-task/change-status', [SubTaskController::class, 'changeStatus'])->name('sub_tasks.change_status');
        Route::resource('sub-tasks', SubTaskController::class);

        // Task files routes
        Route::get('sub-task-files/download/{id}', [SubTaskFileController::class, 'download'])->name('sub-task-files.download');
        Route::resource('sub-task-files', SubTaskFileController::class);

        // Taskboard routes
        Route::post('taskboards/collapseColumn', [TaskBoardController::class, 'collapseColumn'])->name('taskboards.collapse_column');
        Route::post('taskboards/updateIndex', [TaskBoardController::class, 'updateIndex'])->name('taskboards.update_index');
        Route::get('taskboards/loadMore', [TaskBoardController::class, 'loadMore'])->name('taskboards.load_more');
        Route::resource('taskboards', TaskBoardController::class);

        Route::resource('task-calendar', TaskCalendarController::class);
    });

    Route::resource('tasks', TaskController::class);

    // Tickets
    Route::post('tickets/apply-quick-action', [TicketController::class, 'applyQuickAction'])->name('tickets.apply_quick_action');
    Route::post('tickets/updateOtherData/{id}', [TicketController::class, 'updateOtherData'])->name('tickets.update_other_data');
    Route::post('tickets/change-status', [TicketController::class, 'changeStatus'])->name('tickets.change-status');
    Route::post('tickets/refreshCount', [TicketController::class, 'refreshCount'])->name('tickets.refresh_count');
    Route::get('tickets/agent-group/{id}/{exceptThis?}', [TicketController::class, 'agentGroup'])->name('tickets.agent_group');
    Route::get('tickets/edit-details/{id}', [TicketController::class, 'editDetail'])->name('tickets.edit_detail');
    Route::put('tickets/update-details/{id}', [TicketController::class, 'updateDetail'])->name('tickets.update_detail');
    Route::resource('tickets', TicketController::class);

    // Ticket Custom Embed From
    Route::post('ticket-form/sort-fields', [TicketCustomFormController::class, 'sortFields'])->name('ticket-form.sort_fields');
    Route::resource('ticket-form', TicketCustomFormController::class);

    Route::get('ticket-files/download/{id}', [TicketFileController::class, 'download'])->name('ticket-files.download');
    Route::resource('ticket-files', TicketFileController::class);

    Route::resource('ticket-replies', TicketReplyController::class);
    Route::post('ticket-replies/edit-note/{id}', [TicketReplyController::class, 'editNote'])->name('ticket-replies.edit_note');

    Route::post('task-report-chart', [TaskReportController::class, 'taskChartData'])->name('task-report.chart');
    Route::get('task-report/employee-wise-task-report', [TaskReportController::class, 'employeeWiseTaskReport'])->name('employee-wise-task-report');
    Route::get('task-report/consolidated-task-report', [TaskReportController::class, 'consolidatedTaskReport'])->name('consolidated-task-report');

    Route::resource('task-report', TaskReportController::class);
});

/*
|--------------------------------------------------------------------------
| 2. Настройки (оригинал: routes/web-settings.php)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth', 'prefix' => 'account/settings'], function () {

    /* Start Ticket settings routes */
    Route::post('ticket-agents/update-group/{id}', [TicketAgentController::class, 'updateGroup'])->name('ticket_agents.update_group');
    Route::resource('ticket-agents', TicketAgentController::class);
    Route::get('agent-groups', [TicketAgentController::class, 'agentGroups'])->name('ticket_agents.agent_groups');

    Route::resource('ticket-settings', TicketSettingController::class);
    Route::post('ticket-settings-status/update-status/{companyId}', [TicketSettingController::class, 'updateTicketSettingStatus'])->name('ticket-setting.update_status');
    Route::post('/ticket-agent-settings/{companyId}', [TicketSettingController::class, 'updateTicketSettingForAgent'])->name('ticket-agent-settings.update');
    Route::resource('ticket-groups', TicketGroupController::class);
    Route::resource('ticketTypes', TicketTypeController::class);
    Route::resource('ticketChannels', TicketChannelController::class);
    Route::resource('ticket-email-settings', TicketEmailSettingController::class);

    Route::get('replyTemplates/fetch-template', [TicketReplyTemplatesController::class, 'fetchTemplate'])->name('replyTemplates.fetchTemplate');
    Route::resource('replyTemplates', TicketReplyTemplatesController::class);
    /* End Ticket settings routes */

    // Task Settings
    Route::resource('task-settings', TaskSettingController::class, ['only' => ['index', 'store']]);
});

/*
|--------------------------------------------------------------------------
| 3. Публични страници (оригинал: routes/web-public.php, middleware: web)
|    Обработват се от HomeController, който НЕ е част от модула.
|--------------------------------------------------------------------------
*/
Route::get('/ticket-form/{id}', [HomeController::class, 'ticketForm'])->name('front.ticket_form');
Route::post('/lead-form/ticket-store', [HomeController::class, 'ticketStore'])->name('front.ticket_store');
Route::get('/task-board/load-more/{hash}', [HomeController::class, 'taskboardLoadMore'])->name('front.taskboard.load_more');
Route::get('/task-board/{hash}', [HomeController::class, 'taskboard'])->name('front.taskboard');
Route::get('/task/{id}', [HomeController::class, 'taskDetail'])->name('front.task_detail');

/*
|--------------------------------------------------------------------------
| 4. Супер админ - тикети за поддръжка на платформата
|    (оригинал: routes/SuperAdmin/web.php)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'super-admin'], 'prefix' => 'account', 'as' => 'superadmin.'], function () {
    Route::post('support-tickets/apply-quick-action', [SupportTicketsController::class, 'applyQuickAction'])->name('support-tickets.apply_quick_action');
    Route::post('support-tickets/updateOtherData/{id}', [SupportTicketsController::class, 'updateOtherData'])->name('support-tickets.update_other_data');
    Route::resource('support-ticketTypes', SupportTicketTypeController::class);
});

Route::group(['middleware' => ['auth', 'admin-or-super-admin'], 'prefix' => 'account', 'as' => 'superadmin.'], function () {
    Route::resource('support-tickets', SupportTicketsController::class);
    Route::get('support-ticket-files/download/{id}', [SupportTicketFileController::class, 'download'])->name('support-ticket-files.download');
    Route::resource('support-ticket-files', SupportTicketFileController::class);
    Route::resource('support-ticket-replies', SupportTicketReplyController::class);
});
