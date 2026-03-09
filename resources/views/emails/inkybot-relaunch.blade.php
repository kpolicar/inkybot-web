@component('mail::message')
# Inkybot is Back — and Better Than Ever

Hey {{ $user->name }},

We have some exciting news: **Inkybot is back online with full support for Dofus Unity!**

The bot has been rebuilt with higher performance and improved reliability for the new Unity client.

---

## It's Completely Free — For Now

To celebrate the relaunch, Inkybot is **totally free to use**. We want you to try it out and experience the improvements firsthand.

> **Important:** The free period ends on **May 1st, 2025**. After that, a subscription will be required to continue using the bot.

@component('mail::button', ['url' => config('app.url'), 'color' => 'primary'])
Try Inkybot Free Now
@endcomponent

---

## Try It Before May 1st — Get an Extra Month Free

If you try Inkybot before the deadline, **your free access will be extended by an additional month** after subscriptions go live. That's our thank-you for coming back early.

---

## The Safest Maging Bot Available

Inkybot remains the **safest option** for automated maging on Dofus.

- **OCR (optical character recognition)** to read the game screen
- **Mouse & keyboard inputs** to interact with the game — exactly like a human player would

This approach makes it far less detectable and keeps your account safer than alternatives.

---

We're glad to have you back. Jump in, give it a spin, and let us know what you think.

Regards,
**The Inkybot Team**

@component('mail::subcopy')
You're receiving this email because you have an account at [inkybot.me]({{ config('app.url') }}). This is a one-time announcement email.
@endcomponent
@endcomponent
