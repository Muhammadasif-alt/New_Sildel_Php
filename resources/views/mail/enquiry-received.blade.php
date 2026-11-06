{{-- Plain, inline-styled e-mail (mail clients ignore external CSS). Colours mirror the design tokens. --}}
<!DOCTYPE html>
<html lang="{{ $enquiry->locale }}">
<body style="margin:0;padding:32px 16px;background:#EFE8DC;font-family:Helvetica,Arial,sans-serif;color:#1A1612;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:600px;margin:0 auto;background:#ffffff;border:1px solid #E4DACA;">
        <tr>
            <td style="padding:32px 40px;background:#0D0B09;color:#D2B27C;font-family:Georgia,serif;font-size:22px;letter-spacing:.3em;">SILDEL</td>
        </tr>
        <tr>
            <td style="padding:36px 40px;">
                <p style="margin:0 0 24px;font-size:11px;letter-spacing:.3em;text-transform:uppercase;color:#9A7648;">{{ __('forms.mail.heading') }}</p>
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;line-height:1.6;">
                    <tr><td style="padding:6px 0;width:110px;color:#8A7D6E;">{{ ucfirst(__('forms.attributes.name')) }}</td><td style="padding:6px 0;">{{ $enquiry->name }}</td></tr>
                    <tr><td style="padding:6px 0;color:#8A7D6E;">{{ ucfirst(__('forms.attributes.email')) }}</td><td style="padding:6px 0;"><a href="mailto:{{ $enquiry->email }}" style="color:#9A7648;">{{ $enquiry->email }}</a></td></tr>
                    @if ($enquiry->subject)
                        <tr><td style="padding:6px 0;color:#8A7D6E;">{{ ucfirst(__('forms.attributes.subject')) }}</td><td style="padding:6px 0;">{{ $enquiry->subject }}</td></tr>
                    @endif
                </table>
                <div style="margin-top:24px;padding-top:24px;border-top:1px solid #E4DACA;font-size:15px;line-height:1.7;white-space:pre-line;">{{ $enquiry->message }}</div>
                <p style="margin:32px 0 0;font-size:12px;color:#8A7D6E;">{{ __('forms.mail.reply_hint', ['name' => $enquiry->name]) }}</p>
            </td>
        </tr>
    </table>
</body>
</html>
