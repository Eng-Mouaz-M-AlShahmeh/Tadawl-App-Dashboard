<?php

namespace App\Mail;

use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Helper;

class NotificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $email_info;

    /**
     * Create a new message instance.
     *
     * @param array $email_info
     */
    public function __construct(array $email_info)
    {
        $this->email_info = $email_info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $site_title_var = "site_title_" . @Helper::currentLanguage()->code;
        $this->email_info["website_name"] = @Helper::GeneralSiteSettings($site_title_var);
        $this->email_info["website_url"] = @Helper::GeneralSiteSettings('site_url');
        $this->email_info["details"] = $this->ParseContent($this->email_info, @Helper::GeneralWebmasterSettings('mail_template'));

        return $this->from($this->email_info['from_email'], $this->email_info['from_name'])
            ->subject($this->ParseContent($this->email_info, @Helper::GeneralWebmasterSettings('mail_title')))
            ->view('emails.template', $this->email_info);
    }

    public function ParseContent($data, $html_code)
    {
        return preg_replace_callback('/{(.*?)}/', function ($matches) use ($data) {
            list($shortCode, $index) = $matches;

            if (isset($data[$index])) {
                return $data[$index];
            }

        }, $html_code);
    }
}
