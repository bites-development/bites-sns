<?php

declare(strict_types=1);

namespace Modules\Sns\Services;

use Aws\Exception\AwsException;
use Aws\Sns\SnsClient;

use function config;
use function url;

class SnsService
{
    private $sns;

    public function __construct()
    {
        $this->sns = new SnsClient(
            [
                'version' => 'latest',
                'region' => config('sns.region'),
                'credentials' => [
                    'key' => config('sns.key'),
                    'secret' => config('sns.secret'),
                ],
            ]
        );
        $this->accountId = $this->getAwsAccountId();
        $this->region = config('sns.region');
    }

    /**
     * Publish a message to an SNS topic
     */
    public function publish($message, string $topic = 'Bites')
    {
        $topicArn = $this->generateTopicArn($topic);
        if(is_array($message)){
            $message = json_encode($message);
        }
        try {
            $result = $this->sns->publish(
                [
                    'Message' => $message,
                    'TopicArn' => $topicArn,
                ]
            );

            return [
                'success' => true,
                'messageId' => $result['MessageId']
            ];
        } catch (AwsException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Create a new SNS topic
     */
    public function createTopic(string $topicName)
    {
        try {
            $result = $this->sns->createTopic(
                [
                    'Name' => $topicName,
                ]
            );

            return [
                'success' => true,
                'topicArn' => $result['TopicArn']
            ];
        } catch (AwsException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Subscribe an endpoint to a topic
     */
    public function subscribe(string $siteUrl = null, string $topic = "Bites", string $protocol = 'https')
    {
        if(!$siteUrl){
            $siteUrl = url('api/sns-listener');
        }
        else
        {
            $siteUrl = $siteUrl.'/api/sns-listener';
        }
        $topicArn = $this->generateTopicArn($topic);
        try {
            $result = $this->sns->subscribe(
                [
                    'TopicArn' => $topicArn,
                    'Protocol' => $protocol, // http, https, email, sms, etc.
                    'Endpoint' => $siteUrl,
                ]
            );

            return [
                'success' => true,
                'subscriptionArn' => $result['SubscriptionArn']
            ];
        } catch (AwsException $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    private function getAwsAccountId()
    {
        $sts = new \Aws\Sts\StsClient(
            [
                'version' => 'latest',
                'region' => config('sns.region'),
                'credentials' => [
                    'key' => config('sns.key'),
                    'secret' => config('sns.secret'),
                ],
            ]
        );

        $result = $sts->getCallerIdentity();

        return $result['Account'];
    }

    public function generateTopicArn($topicName)
    {
        return "arn:aws:sns:{$this->region}:{$this->accountId}:{$topicName}";
    }
}
