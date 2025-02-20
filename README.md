# Anagami ERP - модул "Задачи и тикети"

Самостоятелно извадена част от **Anagami ERP** (Laravel, multi-tenant), която обхваща два тясно свързани домейна:

- **Задачи** - управление на задачи, подзадачи, канбан табло, повтарящи се задачи, одобрение, отчети;
- **Тикети** - система за заявки за поддръжка (helpdesk) с агенти, групи, типове, канали, шаблони за отговори и синхронизация с имейл, плюс отделен поток за тикети към поддръжката на самата платформа (супер админ).

> **Важно:** това не е самостоятелно пакетирано Laravel приложение или composer пакет. Репото съдържа само файловете на модула, разположени по **оригиналните относителни пътища** на Anagami ERP, така че да могат да се копират върху Laravel проекта. Без останалата система (потребители, компании, проекти, клиенти, помощни функции) кодът не може да работи самостоятелно - вижте раздела [Зависимости](#зависимости-от-останалата-система).

## Съдържание

1. [Функционалности](#функционалности)
2. [Структура на репото](#структура-на-репото)
3. [Зависимости от останалата система](#зависимости-от-останалата-система)
4. [Какво е изключено](#какво-е-изключено-от-модула)
5. [Изисквания](#изисквания)
6. [Интеграция](#интеграция)
7. [Забележка за ползване](#забележка-за-ползване)

## Функционалности

### Задачи

Реализирани в `TaskController` и свързаните контролери, модели, DataTables и изгледи.

- **Задачи (CRUD)** - създаване, редакция, преглед и изтриване; списък с Yajra DataTables, отделен списък на архивираните задачи; бързи (масови) действия върху избрани задачи; смяна на статус и на етап (milestone); прикачване (pin) на задача; ръчно изпращане на напомняне; проверка за застъпване с отпуски на назначените; връзка към задача, от която зависи текущата (`dependent_task_id`); частни задачи (`is_private`), billable задачи, прогнозирано време (часове/минути).
- **Категории и етикети** - `TaskCategory`, `TaskLabel`/`TaskLabelList` и тагове (`TaskTag`/`TaskTagList`), със собствени контролери и форми.
- **Подзадачи** - `SubTask` със статус, файлове (`SubTaskFile`) и известия при създаване, назначаване и приключване.
- **Коментари** - `TaskComment` с емоджи реакции (`TaskCommentEmoji`), харесвания на коментар и известия за споменаване (mention).
- **Бележки и файлове** - `TaskNote` (с известия и споменаване), `TaskFile` с изтегляне.
- **История и време** - раздел с историята на промените (`TaskHistory`) и раздел с времеви записи към задачата.
- **Канбан табло (Taskboard)** - колони (`TaskboardColumn`), влачене и пренареждане, свиване на колона, зареждане на още карти (load more), потребителски настройки на таблото (`UserTaskboardSetting`), публичен изглед на таблото и на отделна задача (`resources/views/front/tasks`).
- **Календар на задачите** - `TaskCalendarController`.
- **Повтарящи се задачи** - `RecurringTaskController`, команда `recurring-task-create` (по график всеки ден в 00:30).
- **Одобрение** - работен процес "чака одобрение": списък `WaitingForApprovalDataTable`, модал за причина при смяна на статус, известие `TaskApproval`.
- **Настройки на задачите** - `TaskSetting` (напр. дали проектът е задължителен при създаване).
- **Отчети** - отчет по задачи с графика, отчет по служител и консолидиран отчет (`TaskReportController`).
- **Известия и напомняния** - Notification класове за потребители и за клиенти (нова/обновена/приключена задача, коментар, бележка, споменаване, напомняне); команди `send-auto-task-reminder` и `send-task-reminder`; команда `tasks:convert-base64-images` (с `--dry-run`).
- **Табла и профили** - карти/уиджети на задачите (`TaskCard`, `my_tasks`), табове със задачи в профила на служител и в проект.
- **По избор** - ако е активен външният модул `Gitlab`, детайлът на задачата показва GitLab данни (`module_enabled('Gitlab')` в `TaskController`).

### Тикети

Реализирани в `TicketController` и свързаните контролери, модели, DataTables и изгледи.

- **Тикети (CRUD)** - създаване от служител/агент, списък (`TicketDataTable`), преглед, редакция на детайли, масови действия, смяна на статус (`open`, `pending`, `resolved`, `closed`), обновяване на броячите, филтриране по тагове.
- **Заявител и агенти** - заявител (клиент/контакт), назначаване на агент в рамките на група, споменаване на агент (`MentionTicketAgent`).
- **Отговори и бележки** - `TicketReply` (отговор и вътрешна бележка с редакция), файлове (`TicketFile`), журнал на активността по тикета (`TicketActivity`).
- **Настройки на тикетите** - типове (`TicketType`), канали (`TicketChannel`), групи (`TicketGroup`) и агенти към групи (`TicketAgentGroups`), тагове (`TicketTag`/`TicketTagList`), шаблони за отговори (`TicketReplyTemplate`), настройки по агент (`TicketSettingForAgents`).
- **Автоматично назначаване (round robin)** - превключвател в настройките (`ticket_round_robin_status`).
- **Вграждаема форма за тикет** - конфигурируема форма (`TicketCustomForm`) и публична страница за подаване на тикет отвън (`ticket-form`).
- **Имейл синхронизация** - настройки на пощенска кутия по компания (`TicketEmailSetting`) и команда `fetch-ticket-emails` за изтегляне на писма през IMAP (`webklex/laravel-imap`) като тикети/отговори; в оригиналния график на командите редът е закоментиран.
- **Табло** - `TicketDashboard` trait, уиджет за тикети в личното табло и табове с тикети в профила на клиент, служител и проект.
- **Известия** - нов тикет, отговор, нов заявител, бележка, поемане от агент (`NewTicket*`, `TicketAgent` и др.) и обработка на отговор по имейл (`MailTicketReply`).
- **Тикети към поддръжката на платформата (супер админ)** - отделен поток `SupportTicket`, `SupportTicketReply`, `SupportTicketFile`, `SupportTicketType` със свои контролери, DataTable, известия и изгледи.

## Структура на репото

Всички файлове са на оригиналните си пътища в Laravel проекта. Обща бройка: **396 файла**.

| Категория | Път | Файлове |
|-----------|-----|--------:|
| Модели (17 задачи, 15 тикети, 4 поддръжка) | `app/Models` | 36 |
| Контролери (вкл. 4 в `SuperAdmin`) | `app/Http/Controllers` | 28 |
| Form Request валидации | `app/Http/Requests` | 30 |
| DataTables | `app/DataTables` | 10 |
| Observers | `app/Observers` | 25 |
| Events | `app/Events` | 16 |
| Listeners | `app/Listeners` | 15 |
| Notifications | `app/Notifications` | 31 |
| Console команди | `app/Console/Commands` | 5 |
| Trait (`TicketDashboard`) | `app/Traits` | 1 |
| Blade компоненти (класове) | `app/View/Components` | 6 |
| Blade изгледи (по-долу) | `resources/views` | 150 |
| SCSS | `resources/scss` | 3 |
| Миграции (по име/таблица) | `database/migrations` | 25 |
| Seeders | `database/seeders` | 2 |
| Factories | `database/factories` | 1 |
| Маршрути | `routes/tasks-tickets.routes.php` | 1 |
| Справочни материали (езикови извадки, регистрации) | `docs/` | 9 |
| Служебни (`README.md`, `.gitignore`) | корен | 2 |
| **Общо** | | **396** |

Разпределение на Blade изгледите:

| Група | Директория / файл | Файлове |
|-------|-------------------|--------:|
| Задачи | `tasks/` | 29 |
| Табло на задачите | `taskboard/`, `taskboard*.blade.php` | 8 |
| Повтарящи се задачи | `recurring-task/` | 7 |
| Настройки на задачите | `task-settings/` | 1 |
| Отчети по задачи | `reports/tasks/` | 4 |
| Публични страници на задачи | `front/tasks/` | 21 |
| Тикети | `tickets/`, `ticket-form.blade.php` | 7 |
| Настройки на тикетите | `ticket-settings/` | 18 |
| Известия | `notifications/` | 29 |
| Имейл шаблони | `mail/task/`, `emails/ticket/` | 5 |
| Компоненти (карти, dropdown) | `components/` | 5 |
| Табове и уиджети (проект, служител, клиент, табло) | `projects/ajax/`, `employees/ajax/`, `clients/ajax/`, `dashboard/` | 9 |
| Супер админ - тикети за поддръжка | `super-admin/`, `sections/` | 7 |
| **Общо** | | **150** |

Допълнителни файлове, които **не** съществуват в оригиналния проект:

- `routes/tasks-tickets.routes.php` - само релевантните маршрути, извадени от `routes/web.php`, `routes/web-settings.php`, `routes/web-public.php` и `routes/SuperAdmin/web.php` с оригиналните им групи и middleware.
- `docs/lang-extract/eng/*.php` - извадка на ключовете за задачи и тикети от `app`, `email`, `permissions`, `clan`, `messages`, `modules`, `placeholders` и `superadmin`. В оригинала тези ключове са в споделени езикови файлове, затова не са копирани цели (за да не се презапишат); слейте ги ръчно.
- `docs/snippets/registrations.snippet.php` - справка с редовете за `EventServiceProvider` (listeners и observers) и `Console/Kernel`, които модулът очаква.

## Зависимости от останалата система

Модулът е **изваден**, а не изолиран. Следните части са споделени с Anagami ERP и **не са включени**:

| Област | Какво се използва |
|--------|-------------------|
| Multi-tenancy | trait `HasCompany`, `CompanyScope`, `ActiveScope`, модел `Company` |
| Основа на приложението | `AccountBaseController`, `BaseModel`, `BaseDataTable`, `CommonRequest`/`CoreRequest`, `BaseNotification` |
| Помощни функции | `app/Helper/start.php` (глобални функции като `company()`, `user()`, `user_modules()`, `module_enabled()`, проверки за права), `Reply`, `Files`, `Common`, `UserService` |
| Потребители и права | `User`, `Role`, RBAC (Entrust), записи в `Module`/`PermissionRole` за права като `view_tasks`, `add_tickets`, `manage_ticket_type` |
| Проекти | `Project`, `ProjectMilestone`, `ProjectTimeLog`, `ProjectTimeLogBreak`, trait `ProjectProgress` |
| Клиенти | `ClientContact`, `ClientDetails` |
| Известия и настройки | `EmailNotificationSetting`, `SlackSetting`, `SmtpSetting`, `PushNotificationSetting`, `Notification`, `MentionUser`, `GlobalSetting`, `LeadSetting` |
| Други модели | `Pinned`, `Leave`, `DashboardWidget`, `UniversalSearch`, `CustomField`/`CustomFieldGroup` и trait-овете `CustomFieldsTrait`/`CustomFieldsRequestTrait`, `IconTrait`, `EmployeeActivityTrait` |
| Публични страници | `HomeController` (методите за публичното табло, детайла на задача и подаване на тикет) - маршрутите са в `tasks-tickets.routes.php`, но контролерът не е включен |
| Layout и фронтенд | основният `layouts/app`, JS/CSS пакетите (`public/js`, `public/css`), `x-*` Blade компонентите на системата (форми, таблици, модали, менюта) |
| Пакети | `yajra/laravel-datatables-*`, `webklex/laravel-imap` (имейл синхронизация), `nwidart/laravel-modules`, Entrust |

Изгледите, които показват задачи/тикети в страниците на проект, служител и клиент (`projects/ajax/{tasks,taskboard,tickets}`, `employees/ajax/{tasks,tickets}`, `clients/ajax/tickets`), са включени като таб-партиали, но самите страници-"хостове" (`ProjectController`, `EmployeeController`, `ClientController`) остават в основното приложение.

## Какво е изключено от модула

Умишлено **не** са включени (дори да споменават задачи/тикети):

- **Проекти** и всичко, което им принадлежи - `Project*` модели/контролери, Gantt (`GanttLink`), времеви записи (`ProjectTimeLog*`), прогрес на проект.
- **Шаблони на проекти** - `ProjectTemplateTask`, `ProjectTemplateSubTask` и свързаните им контролери, заявки и изгледи.
- **База знания** (`KnowledgeBase*`) - самостоятелен модул, който в кода няма връзка с тикетите.
- Споделени езикови, маршрутни и провайдър файлове - извадени са само релевантните части (виж `docs/` и `routes/`).
- Големите базови миграции на системата (`2018_*`, `2022_08_12_..._other_migration_till_date`), които създават таблиците за цялата система; включени са само миграциите, специфични за задачи/тикети (по име).
- `vendor`, `node_modules`, `public/` ресурси, `.env`, конфигурации, тайни и ключове.

## Изисквания

- PHP **8.2** или по-нов (изходният проект работи на PHP 8.3)
- Laravel **10** или по-нов
- MariaDB / MySQL (InnoDB, utf8mb4)
- Работещо ядро на Anagami ERP (виж зависимостите по-горе)
- Пакети: `yajra/laravel-datatables-oracle`, `-buttons`, `-html`; `webklex/laravel-imap` (само за имейл синхронизацията на тикети)

## Интеграция

1. **Копиране на файловете.** Копирайте съдържанието на `app/`, `database/`, `resources/` и `routes/` в корена на Laravel проекта, запазвайки структурата. Не копирайте `docs/` върху `resources/lang` - езиковите извадки са за ръчно сливане.
   ```bash
   rsync -av --exclude=.git --exclude=docs --exclude=README.md ./ /път/до/проекта/
   ```
2. **Езикови ключове.** Слейте ключовете от `docs/lang-extract/eng/*.php` в съответните `resources/lang/eng/*.php` (напр. с `array_merge`), ако липсват.
3. **Миграции.** Таблиците `tasks`, `tickets` и др. се създават от базовите миграции на системата; включените тук са допълнителните промени и данни. Изпълнете:
   ```bash
   php artisan migrate
   ```
   Някои миграции (напр. вмъкване на права, widget-и и редове в `taskboard_columns`) разчитат на съществуващи компании и роли.
4. **Observers и Events.** Регистрирайте редовете от `docs/snippets/registrations.snippet.php` в `app/Providers/EventServiceProvider.php` (`$listen`, `$observers`) и в `app/Providers/SuperAdmin/EventServiceProvider.php`. Моделите `SupportTicket` и `SupportTicketReply` регистрират наблюдателите си сами.
5. **Маршрути.** Подключете `routes/tasks-tickets.routes.php` в `RouteServiceProvider` (с middleware `web`, `check-company-package`, `auto-logout`) или поставете секциите му в съответните оригинални файлове. Файлът съдържа и публичните и супер админ маршрути - ако ги разделяте, следвайте коментарите в началото му.
6. **Планировчик.** Добавете командите в `app/Console/Kernel.php`: `recurring-task-create` (дневно), `send-auto-task-reminder` (дневно) и, при нужда от имейл синхронизация, `fetch-ticket-emails`.
7. **Права и менюта.** Модулите `tasks`, `tickets` и `superadmin_ticket` (с правата им) трябва да са налични в таблиците за модули/права на системата (виж `Module` модела) и в страничното меню.
8. **Фронтенд.** SCSS файловете (`task-board.scss`, `task_list.scss`, `ticket.scss`) трябва да бъдат включени в билда на ресурсите (Laravel Mix) на основния проект.

## Забележка за ползване

Това репо е **частно** и е предназначено за **вътрешно ползване** в рамките на Anagami. Кодът е част от закрит продукт - не го публикувайте и не го разпространявайте извън организацията. Репото не съдържа тайни, ключове или данни за достъп; при интеграция конфигурацията (`.env`, пощенски кутии, API ключове) се задава в основния проект.
