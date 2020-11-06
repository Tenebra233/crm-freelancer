<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Events\EmailSent;
use App\Order;
use App\Template;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Response;
use PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{
    public function getCustomerEmail(Request $request)
    {

        $body = '<html>' . $request->get('emailBody') . '</html>';
        $subject = $request->get('emailSubject');
        $orderId = $request->get('orderId');
        $customerId = Order::query()->where('id', '=', $orderId)->pluck('customer_id')[0];
        $customerEmail = Customer::query()->where('id', '=', $customerId)->pluck('email')[0];

        ini_set("SMTP", "ssl://smtp.gmail.com");
        ini_set("smtp_port", "465"); //No further need to edit your configuration files.
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->SMTPAuth = true;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->setFrom('4deveterbo@gmail.com', 'Roberto Urbani');
        $mail->SMTPSecure = "ssl";
        $mail->Username = "4deveterbo@gmail.com"; //account with which you want to send mail. Or use this account. i dont care :-P
        $mail->Password = "Maquestoeunmalocchio123."; //this account's password.
        $mail->Port = "465";
        $mail->isSMTP();  // telling the class to use SMTP
        $rec1 = $customerEmail; //receiver. email addresses to which u want to send the mail.
        $mail->AddAddress($rec1);
        $mail->Subject = $subject;
        $mail->Body = $body;
        //        $mail->Subject = $fields->template == null ? $fields->subject : Template::query()->where('name', '=', $fields->template)->pluck('subject');
        //        $mail->Body = $fields->template == null ? $fields->content : Template::query()->where('name', '=', $fields->template)->pluck('body');
        $mail->WordWrap = 200;
        if (!$mail->Send()) {
            return 'Email not sent, error: ' . $mail->ErrorInfo;
        } else {
            $beamsClient = new \Pusher\PushNotifications\PushNotifications(array(
                "instanceId" => "acde3300-a57b-4805-9817-00eea5b5ece5",
                "secretKey" => "1ADA5380FA3A63DAD034C5B5AA0CEF39284A2DD18D9407CAAD7DED246310D569",
            ));

            $publishResponse = $beamsClient->publishToInterests(
                array("hello"),
                array("web" => array("notification" => array(
                    "title" => "Hello",
                    "body" => "Hello, World!",
                    "deep_link" => "https://www.pusher.com",
                )),
                ));
            return 'Email sent correctly';
        }
    }


    public function getTemplate()
    {
        return Template::all('name')->pluck('name')->toArray();
    }

    public function selectTemplateEvent(Request $request)
    {
        $template = $request->get('name');
        if ($template === 0) {
            return null;
        }
        return Response::json([
            'subject' => Template::query()->select('subject')->where('name', '=', $template)->pluck('subject')[0],
            'body' => Template::query()->select('body')->where('name', '=', $template)->pluck('body')[0],
        ]);
    }
}
