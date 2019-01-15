<?php
namespace ExternalCronJobs\V1\Services;

use ExternalCronJobs\Exception;
use ExternalCronJobs\V1\AbstractServicesBase;

class Crons extends AbstractServicesBase {
    /**
     * @return string
     */
    protected function endpoint() {
        return '/api/v1/crons';
    }
    
    /**
     * @param array $parameters
     *
     * Optional Params
     *  - $page (The page number)
     *  - $keyword (The Search Keyword)
     *  - $folder_id (Folder ID)
     *  - $server_id (Execution Server ID)
     *  - $attempt_status (failed/successful)
     *  - $status (enabled/disabled)
     *  - $order_by
     *  - $sort_order
     *
     * @return array
     * @throws Exception
     */
    public function getAll(array $parameters = [])
    {
        return parent::getAll($parameters);
    }
    
    /**
     * @param array $payload
     *
     * @var $payload[title] string, required
     * @var $payload[status] integer, required (enabled,disabled)
     * @var $payload[timezone] integer, required(timezone id)
     * @var $payload[cron_type] integer, cron job type
     * @var $payload[folder] integer, optional
     * @var $payload[time_schedule] integer, required
     * @var $payload[cron_expression] string, required if cron time schedule is 0
     * @var $payload[notify_when][] integer, 1 if failed, 2 if success
     *
     * If notify_when is set
     * @var $payload[failure_notification_criteria] required if notify_when is 1
     * @var $payload[notify_by] required if notify_when is set.
     * @var $payload[notification_slack_webhook] if notify_by is 2
     * @var $payload[notification_flock_webhook] if notify_by is 3
     *
     * If cron_type is 1(HTTP CAll)
     * @var $payload[url] string, a valid URL
     * @var $payload[timeout] int, max 600
     * @var $payload[method] int, 1=>get, 2=>post
     * @var $payload[request_body], a valid json
     * @var $payload[basic_auth_username], optional
     * @var $payload[basic_auth_password], optional
     * @var $payload[request_headers], a valid JSON
     * @var $payload[expected_output], string
     *
     * If cron_type is 2(Website Ping)
     * @var $payload[url], a valid URL
     *
     * Basic HTTP payload example
     * $cronPayload = [
     *        'title' => 'Created by API',
     *        'status' => 1,
     *        'cron_type' => 1,
     *        'timezone' => 1,
     *        'time_schedule' => 0,
     *        'cron_expression' => '* * * * *',
     *        'notify_by' => 1,
     *        'notify_when' => [1,2],
     *        'failure_notification_criteria' => 1,
     *        'url'=>'http://www.mydomain.com/path/to/cron',
     *        'timeout' => 60,
     *        'method' => 1
     * ];
     *
     * Basic Website ping payload example
     * $cronPayload = [
     *        'title' => 'Created by API',
     *        'status' => 1,
     *        'cron_type' => 2,
     *        'timezone' => 1,
     *        'time_schedule' => 0,
     *        'cron_expression' => '* * * * *',
     *        'notify_by' => 1,
     *        'notify_when' => [1,2],
     *        'failure_notification_criteria' => 1,
     *        'url'=>'http://www.mydomain.com/path/to/cron'
     * ];
     *
     * @throws Exception
     * @return array
     */
    public function create(array $payload) {
        return $this->post($payload);
    }
}