# ExternalCronJobs PHP SDK

## How to install
The ExternalCronJobs PHP API client can be installed using Composer.
[Composer](https://packagist.org/packages/externalcronjobs/sdk)

```
composer require externalcronjobs/sdk
```

## How to Configure and Use this SDK
```
// load Composer
require 'vendor/autoload.php';

$Client = new \ExternalCronJobs\V1\Client('YOUR_API_KEY');
```

## Cron Jobs
```
// Fetch all cron jobs (Returns paginated data)
$parameters = [
    'page' => 1
];

$cronJobs = $Client->crons->getAll($parameters);

// Fetch single cron job
$cronJob = $Client->crons->get('cron_job_id');

// Create a cron job
$parameters = [
    'title' => 'Created by PHP SDK',
    'status' => 1,
    'cron_type' => 1,
    'timezone' => 1,
    'time_schedule' => 0,
    'cron_expression' => '* * * * *',
    'notify_by' => 1,
    'notify_when' => [1,2],
    'failure_notification_criteria' => 1,
    'url'=>'http://www.mydomain.com/path/to/cron',
    'timeout' => 60,
    'method' => 1
];

$Client->crons->create($parameters);

// Update a cron job
$Client->crons->update('cron_job_id', $parameters);

// Delete a cron job
$Client->crons->delete('cron_job_id');

```

## Folders
```
// Fetch all folders
$parameters = [
    'page' => 1
];

$folders = $Client->folders->getAll($parameters);

// Fetch single folder
$folder = $Client->folders->get('folder_id');

// Create folder
$Client->folders->create('title', 'description);

// Update a folder
$Client->folders->update('folder_id', 'name', 'description');

// Delete a folder
$Client->folders->delete('folder_id');
```

## Timezones
```
// Fetch all timezones
$parameters = [
    'page' => 1
];

$timezones = $Client->timezones->getAll($parameters);
```

## Cron Job Types
```
// Fetch all cron types
$parameters = [
    'page' => 1
];

$cronTypes = $Client->cronTypes->getAll($parameters);
```

## Time Schedules
```
// Fetch all time schedules
$parameters = [
    'page' => 1
];

$timeSchedules = $Client->timeSchedules->getAll($parameters);
```