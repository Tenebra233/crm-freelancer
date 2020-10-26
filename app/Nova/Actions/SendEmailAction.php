<?php

namespace App\Nova\Actions;

use App\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use PHPMailer\PHPMailer\PHPMailer;

class SendEmailAction extends Action
{
    use InteractsWithQueue, Queueable;

    public $showOnTableRow = true;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            ini_set("SMTP", "ssl://smtp.gmail.com");
            ini_set("smtp_port", "465"); //No further need to edit your configuration files.
            $mail = new PHPMailer();
            $mail->SMTPAuth = true;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->setFrom('4deveterbo@gmail.com', 'Roberto Urbani');
            $mail->SMTPSecure = "ssl";
            $mail->Username = "4deveterbo@gmail.com"; //account with which you want to send mail. Or use this account. i dont care :-P
            $mail->Password = "Diocanetrattore123."; //this account's password.
            $mail->Port = "465";
            $mail->isSMTP();  // telling the class to use SMTP
            $rec1 = "thetenebrax23@gmail.com"; //receiver. email addresses to which u want to send the mail.
            $mail->AddAddress($rec1);
            $mail->Subject = $fields->template == null ? $fields->subject : Template::query()->where('name','=',$fields->template)->pluck('subject');
            $mail->Body = $fields->template == null ? $fields->content : Template::query()->where('name','=',$fields->template)->pluck('body');
            $mail->WordWrap = 200;
            if (!$mail->Send()) {
                echo 'Message was not sent!.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                echo  //Fill in the document.location thing
                '<script type="text/javascript">
                        if(confirm("Your mail has been sent"))
                        document.location = "/";
        </script>';
            }
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        $options = with(Template::query()->pluck('name'));

        return [
            Text::make('Subject', 'subject'),
            Textarea::make('Content', 'content'),
            Select::make('Template', 'template')->options($options)->nullable(true),
        ];
    }


}
