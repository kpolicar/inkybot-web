<?php

return [
    'failed' => 'Payment failed: :reason',
    'failed_reason_card_error' => 'Card Error',
    'failed_description' => 'An issue with your card has occurred while trying to process your request.',
    'failed_error_code' => '<strong>Error code:</strong> <i>:code</i>',
    'failed_error_message' => 'Error message:',

    'success' => 'Payment successful',
    'success_description' => 'Your payment has been processed successfully. Purchased subscription should be added to your account shortly.',
    'success_unexpected' => 'In the event that you do not receive your subscription, but have paid the amount, send us an email at :link',

    'not_allowed_incomplete' => 'You must first finish an incomplete payment.',
    'not_allowed_verify' => 'You must first verify your email address.',
    'not_allowed_notfinished' => 'You must wait for your active subscription to expire.',
];
