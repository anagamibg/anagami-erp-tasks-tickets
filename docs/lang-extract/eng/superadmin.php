<?php

// Извадка от resources/lang/eng/superadmin.php - само ключовете за задачи и тикети.
// НЕ презаписвайте оригиналния файл: слейте ключовете (array_merge) в съответния езиков файл на ERP системата.

return [
    'ticketAddSuccess' => 'Ticket added successfully',
    'newSupportTicketRequester' => [
        'subject' => 'New Support Ticket Has Been Generated For You.',
        'text' => 'New  ticket for support is has been generated for you. Login to view the ticket.',
    ],
    'newSupportTicket' => [
        'subject' => 'New Ticket For Support Requested',
        'text' => 'A new support ticket has been created for you. Please log in to view the ticket details.',
        'notificationText' => 'New support ticket has been created for you.',
    ],
    'selfTickets' => 'Self Tickets',
    'supportTicketReply' => [
        'subject' => 'Support Ticket Reply',
        'text' => 'New reply received on support ticket ',
        'action' => 'View Ticket',
    ],
    'myTickets' => 'My Tickets',
];
