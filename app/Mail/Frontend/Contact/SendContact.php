<?php

namespace App\Mail\Frontend\Contact;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SendinBlue;
use GuzzleHttp;
use SendinBlue\Client;
/**
 * Class SendContact.
 */
class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         $this->configcontact1();

        return $this->to(config('mail.from.address'), config('mail.from.name'))
            ->view('frontend.mail.contact')
            ->text('frontend.mail.contact-text')
            ->subject(__('strings.emails.contact.subject', ['app_name' => app_name()]))
            ->from($this->request->email, $this->request->name)
            ->to('info@triplannerr.com')
            ->replyTo($this->request->email, $this->request->name);
    }

    public function configcontact1(){
        
        require_once(base_path() . '/vendor/autoload.php');
        // Configure API key authorization: api-key
        $config = SendinBlue\Client\Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');
        $apiInstance = new SendinBlue\Client\Api\ContactsApi(
            new GuzzleHttp\Client(),
            $config
        );
        $createContact = new \SendinBlue\Client\Model\CreateContact(); // Values to create a contact
        $createContact['email'] = $this->request->email;
        $createContact['listIds'] = [1];

        try {
            $result = $apiInstance->createContact($createContact);
        } catch (\Exception  $e) {
           // echo 'Exception when calling ContactsApi->createContact: ', $e->getMessage();
        }
        /*
        $api_instance = new SendinBlue\Client\Api\EmailCampaignsApi();
        $emailCampaigns = new \SendinBlue\Client\Model\CreateEmailCampaign();
        # Define the campaign settings\
        $email_campaigns['name'] = "Campaign sent via the API";
        $email_campaigns['subject'] = "My subject";
        $email_campaigns['sender'] = array("name": "From name", "email":"dario@findandsharetravel.com");
        $email_campaigns['type'] = "classic";
        # Content that will be sent\
        "htmlContent"=> "Congratulations! You successfully sent this example campaign via the Sendinblue API.",
        # Select the recipients\
        "recipients"=> array("listIds"=> [2, 7]),
        # Schedule the sending in one hour\
        "scheduledAt"=> "2018-01-01 00:00:01"
        );
        # Make the call to the client\
        try {
        $result = $api_instance->createEmailCampaign($emailCampaigns);
        print_r($result);
        }
        */
    }

}
