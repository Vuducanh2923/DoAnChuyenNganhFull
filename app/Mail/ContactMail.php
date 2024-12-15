<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;


class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $name;
    public $email;
    public $content;

    // Tạo một hàm khởi tạo với các tham số tương ứng
    public function __construct($name, $email, $content,$subject)
    {
        // Gán các tham số vào các thuộc tính
        $this->name = $name;
        $this->email = $email;
        $this->content = $content;
        $this->subject =  $subject;
    }

    // Tạo một hàm build để xây dựng nội dung email
    public function build()
    {
        // Trả về một email với tiêu đề, người gửi và nội dung là view user_mail.blade.php trong thư mục resources/views
        return $this->subject($this->subject)
                    ->from($this->email, $this->name)
                    ->replyTo($this->email)
                    ->view('emails.contactEmail');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
