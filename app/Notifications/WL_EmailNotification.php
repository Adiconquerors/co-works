<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\EmailTemplate;

class WL_EmailNotification extends Notification
{
    use Queueable;

    public $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $data )
    {
        $this->data = $data;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

     /**
     * Route notifications for the mail channel.
     *
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return string
     */
    public function routeNotificationForMail($notification)
    {
        if ( ! empty( $this->data['email'] ) ) {
            return $this->data['email'];
        } else {
            return $this->email;
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $template = $this->data['template'];
        $template = EmailTemplate::where('key', '=', $template)->first();

        $data = $this->data['data'];
        $content = \Blade::compileString($this->getTemplate($template, $this->data));
        $message = $this->render($content, $data);

         $mailmessage = (new MailMessage)
        ->subject( $template->subject )
        ->from($template->from_email)
        ->markdown('admin.listings.mail.template', ['body' => $message]);

        if ( ! empty( $this->data['attachment'] ) ) {
            $mailmessage->attach( $this->data['attachment'] );
        }

        return $mailmessage;

        // return (new MailMessage)
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
    }


    /**
     * Prepares the view from string passed along with data
     * @param  [type] $__php  [description]
     * @param  [type] $__data [description]
     * @return [type]         [description]
     */
    public function render($__php, $__data)
    {
        $obLevel = ob_get_level();
        ob_start();
        extract($__data, EXTR_SKIP);
        try {
            eval('?' . '>' . $__php);
        } catch (Exception $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $obLevel) ob_end_clean();
            throw new FatalThrowableError($e);
        }
        return ob_get_clean();
    }

      /**
     * Returns the template html code by forming header, body and footer
     * @param  [type] $template [description]
     * @return [type]           [description]
     */
    public function getTemplate($template, $data)
    {
        
        $header = EmailTemplate::where('title', '=', 'header')->first();
        $footer = EmailTemplate::where('title', '=', 'footer')->first();
        $content = $template->content;
        if ( isset( $data['content'] ) ) {
            $content = $data['content'];
        }
           
        $view = \View::make('admin.listings.mail.template', [
                                                'header' => $header->content, 
                                                'footer' => $footer->content,
                                                'body'  => $content, 
                                                ]);

        return $view->render();
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
