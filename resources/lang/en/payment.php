<?php

return [
    'failed' => 'Payment failed: :reason',
    'failed_reason_card_error' => 'Card Error',
    'failed_description' => 'An issue with your card has occurred while trying to process your request.',
    'failed_error_code' => '<strong>Error code:</strong> <i>:code</i>',
    'failed_error_message' => 'Error message:',

    'incomplete' => 'Incomplete payment',
    'incomplete_description' => 'Your subscription has not yet been processed due to incomplete payment. If you have been prompted for 3D Secure 2 authentication, please complete the process.',
    'incomplete_status' => '<strong>Status:</strong> <i>:status</i>',
    'incomplete_message' => 'Message:',

    'success' => 'Payment successful',
    'success_description' => 'Your payment has been processed successfully. Purchased subscription should be added to your account shortly.',
    'success_unexpected' => 'In the event that you do not receive your subscription, but have paid the amount, send us an email at :link',
];
