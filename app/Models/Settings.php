<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    // Disable timestamps
    public $timestamps = false;

    protected $fillable = [
        'group', 'key', 'value', 'comments'
    ];

    protected array $groups = [
        'mailing', 'contact', 'social', 'fiscal', 'other'
    ];

    protected array $mailers = [
        'smtp' => 'SMTP',
        'sendmail' => 'Sendmail / PHP mail()',
        'mailgun' => 'Mailgun',
        'postmark' => 'Postmark',
        'ses' => 'Amazon SES',
        'mailersend' => 'MailerSend',
    ];

    /**
     * @todo Merge this array with the $mailers array in a multidimensional array
     */
    protected array $mailers_composer_packages = [
        'mailgun' => 'symfony/mailgun-mailer',
        'postmark' => 'symfony/postmark-mailer',
        'ses' => 'aws/aws-sdk-php',
        'mailersend' => 'mailersend/laravel-driver',
    ];

    protected array $smtpEncryptionMethods = [
        'tls' => 'TLS',
    ];

    public function groups(): array
    {
        return $this->groups;
    }

    public function mailers(): array
    {
        return $this->mailers;
    }

    public function smtpEncryptionMethods(): array
    {
        return $this->smtpEncryptionMethods;
    }

    public function mailersComposerPackages(): array
    {
        return $this->mailers_composer_packages;
    }
}
